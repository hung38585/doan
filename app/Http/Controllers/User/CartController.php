<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\About;
use App\Models\Product_Detail;
use App\Models\Store;
use App\Models\Order;
use App\Models\Order_detail;
use Carbon\Carbon;
use Auth;
use App\Http\Requests\PlaceorderRequest;

class CartController extends Controller
{
    // Kiem tra xac thuc khi client chua dang nhap
    public function __construct()
    {
        $this->middleware('auth:client');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abouts = About::take(1)->get(); 
        return view('user.cart.cart',compact('abouts'));
    }

    public function addToCart(Request $request,$id)
    {
        $productdetail_id = Product_Detail::select('id')->where('isdelete',false)->where('product_id',$id)->where('size',$request->size)->where('color',$request->color)->first();
        $product = Product::find($id);
        if(!$product) {
            abort(404);
        }
        $cart = session()->get('cart');
        // if cart is empty then this the first product
        if(!$cart) {
            $cart = [
                $productdetail_id->id => [
                    "id" => $productdetail_id->id,
                    "name" => $product->name,
                    "slug" => $product->slug,
                    "quantity" => $request->quantity,
                    "price" => $product->price,
                    "image" => $product->image,
                    "size" => $request->size,
                    "color" => $request->color
                ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$productdetail_id->id])) {
            $cart[$productdetail_id->id]['quantity'] += $request->quantity;
            $quantity = Store::select('quantity')->where('isdelete',false)->where('productdetail_id',$productdetail_id->id)->first();
            if ($cart[$productdetail_id->id]['quantity'] > $quantity->quantity) {
                $cart[$productdetail_id->id]['quantity'] = $quantity->quantity;
            }
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        // if item not exist in cart then add to cart
        $cart[$productdetail_id->id] = [
            "id" => $productdetail_id->id,
            "name" => $product->name,
            "slug" => $product->slug,
            "quantity" => $request->quantity,
            "price" => $product->price,
            "image" => $product->image,
            "size" => $request->size,
            "color" => $request->color
        ];
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function update(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $quantity = Store::select('quantity')->where('isdelete',false)->where('productdetail_id',$request->id)->first();
            if ($request->quantity > $quantity->quantity) {
                session()->flash('err', 'Quantity less than '.$quantity->quantity);
            }else{
                $cart = session()->get('cart');
                $cart[$request->id]["quantity"] = $request->quantity;
                session()->put('cart', $cart);
                session()->flash('success', 'Cart updated successfully');
            } 
        }
    }
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
    public function checkout(Request $request)
    {
        $abouts = About::take(1)->get();
        return view('user.cart.checkout',compact('abouts'));
    }
    public function placeorder(Request $request)
    {
        //dd($request->all());
        $order = new Order([
            'order_code' => uniqid(),
            'total_amount' => $request->total_amount,
            'status' => 'unconfimred',
            'payment' => $request->payment,
            'transaction_date' => Carbon::now()->toDateTimeString(),
            'notes' => $request->notes,
            'user_id' => Auth::guard('client')->user()->id,
            'created_by' => Auth::guard('client')->user()->id,
            'updated_at' => null,
        ]);
        $order->save();
        foreach ($request->quantity as $key => $value) {
            $order_detail = new Order_detail([
                'quantity' => $value,
                'price' => $request->price[$key],
                'total_amount' => $request->price[$key] * $value,
                'order_id' => $order->id,
                'product_detail_id' => $request->product_detail_id[$key],
                'created_by' => Auth::guard('client')->user()->id,
                'updated_by' => null
            ]);
            $order_detail->save();
        }  
        // $user = Auth::guard('client')->user();
        // if ($request->first_name != $user->first_name || $request->last_name != $user->last_name || $request->address != $user->address || $request->email != $user->email || $request->phone != $user->phone) {
        // } 
        if ($request->payment == 'transfer') { 
            $vnp_TmnCode = "2HULBQDO"; //Mã website tại VNPAY 
            $vnp_HashSecret = "CQBSBRQYSPMAZJSNTOUVNHGRBRFMUHLA"; //Chuỗi bí mật
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://myshop.vn/return-vnpay";
            $vnp_TxnRef = date("YmdHis").$order->id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = "Thanh toán hóa đơn ";
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $request->total_amount * 100;
            $vnp_Locale = 'vn';
            $vnp_IpAddr = request()->ip();
            $vnp_BankCode = $request->input('bank_code');

            $inputData = array(
                "vnp_Version" => "2.0.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
            );
            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . $key . "=" . $value;
                } else {
                    $hashdata .= $key . "=" . $value;
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
               // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
                $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
                $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
            } 
            return redirect($vnp_Url) ;
        }else{
            $abouts = About::take(1)->get();
        return redirect('/cart')->with('success', 'Order complete. Thanks you!');
        } 
    }
    public function return(Request $request)
    {
        if($request->vnp_ResponseCode == "00") { 
            $request->session()->forget('cart');
            return redirect('/cart')->with('success' ,'Payment success. Thanks you!');
        }
        $id = substr($request->vnp_TxnRef, (14-strlen($request->vnp_TxnRef)));
        Order_detail::where('order_id',$id)->delete();
        Order::where('id',$id)->delete();
        return redirect('/cart');
    }
    // public function createPayment(Request $request,$order)
    // {    
    //     $vnp_TmnCode = "2HULBQDO"; //Mã website tại VNPAY 
    //     $vnp_HashSecret = "CQBSBRQYSPMAZJSNTOUVNHGRBRFMUHLA"; //Chuỗi bí mật
    //     $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    //     $vnp_Returnurl = "http://myshop.vn/return-vnpay";
    //     $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
    //     $vnp_OrderInfo = "Thanh toán hóa đơn ";
    //     $vnp_OrderType = 'billpayment';
    //     $vnp_Amount = $request->total_amount * 100;
    //     $vnp_Locale = 'vn';
    //     $vnp_IpAddr = request()->ip();
    //     $vnp_BankCode = $request->input('bank_code');

    //     $inputData = array(
    //         "vnp_Version" => "2.0.0",
    //         "vnp_TmnCode" => $vnp_TmnCode,
    //         "vnp_Amount" => $vnp_Amount,
    //         "vnp_Command" => "pay",
    //         "vnp_CreateDate" => date('YmdHis'),
    //         "vnp_CurrCode" => "VND",
    //         "vnp_IpAddr" => $vnp_IpAddr,
    //         "vnp_Locale" => $vnp_Locale,
    //         "vnp_OrderInfo" => $vnp_OrderInfo,
    //         "vnp_OrderType" => $vnp_OrderType,
    //         "vnp_ReturnUrl" => $vnp_Returnurl,
    //         "vnp_TxnRef" => $vnp_TxnRef,
    //     );
    //     if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    //         $inputData['vnp_BankCode'] = $vnp_BankCode;
    //     }
    //     ksort($inputData);
    //     $query = "";
    //     $i = 0;
    //     $hashdata = "";
    //     foreach ($inputData as $key => $value) {
    //         if ($i == 1) {
    //             $hashdata .= '&' . $key . "=" . $value;
    //         } else {
    //             $hashdata .= $key . "=" . $value;
    //             $i = 1;
    //         }
    //         $query .= urlencode($key) . "=" . urlencode($value) . '&';
    //     }

    //     $vnp_Url = $vnp_Url . "?" . $query;
    //     if (isset($vnp_HashSecret)) {
    //        // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
    //         $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
    //         $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
    //     } 
    //     return redirect($vnp_Url) ;
    // }  
    
}
