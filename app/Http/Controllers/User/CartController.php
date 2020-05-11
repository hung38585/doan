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
        $request->session()->forget('cart');
        $abouts = About::take(1)->get();
        return redirect('/cart')->with('success', 'Order complete. Thanks you!');;
    }
}
