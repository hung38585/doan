<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Store;
use App\Models\Image;
use App\Models\Product_Detail;
use App\Models\About;
use App\Models\Slide;
use Session;
use Validator;
use Illuminate\Support\Str; 
use DB;
use Carbon\Carbon;
use Auth;

class HomeController extends Controller
{
    // Kiem tra xac thuc khi client chua dang nhap
    // public function __construct()
    // {
    //     $this->middleware('auth:client');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::where('isdelete','0')->orderBy('created_at', 'desc');
        $abouts = About::take(1)->get(); 
        $categories = Category::where('isdelete','0')->get(); 
        foreach ($categories as $key => $value) {
            $listquantity[] = $this->countProduct($value->id);
        }
        if ($request->category) {
            $category_id = Category::where('name',$request->category)->take(1)->get();
            $products = $products->where('category_id',$category_id[0]->id);
        }
        if ($request->productname) {
            $products = $products->where('name', 'like', '%'.$request->productname.'%')->where('isdelete','0');
        }
        if ($request->price) {
            
        }
        if ($request->sale) {
            $products = $products->where('promotion','<>','0');
        }
        $products = $products->paginate(8)->appends(request()->query());
        return view('user.home.product',compact('products','abouts','categories','listquantity'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $categories = Category::where('isdelete','0')->get(); 
        $product = Product::where('slug',$slug)->first();
        $colors = DB::table('product_details')->where('product_id',$product->id)->get();
        $sizes = DB::table('product_details')->where('product_id',$product->id)->get();
        $abouts = About::take(1)->get(); 
        $images = Image::where('product_id',$product->id)->get();
        $quantities = Store::select('quantity')->join('product_details', 'product_details.id', '=', 'stores.productdetail_id')->where('stores.isdelete',false)->where('product_details.product_id',$product->id)->get();
        $quantity = 0;
        foreach ($quantities as $key => $value) {
            $quantity += $value->quantity;
        }
        return view('user.home.productdetail',compact('product','categories','abouts','colors','sizes','quantity','images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
   
    public function homepage()
    {
        $abouts = About::take(1)->get();
        $categories = Category::where('isdelete','0')->get(); 
        $listquatity = array();
        $product_promotions = Product::where('promotion','<>','')->where('isdelete','0')->get(); 
        $slides = Slide::where('isdelete','0')->get(); 
        return view('user.home.home',compact('abouts','product_promotions','categories','slides'));
    }
    public function countProduct($id)
    {
        $quantity = Product::where('category_id',$id)->count(); 
        return $quantity;
    }
    public function getQuantity(Request $request)
    {
        if ($request->ajax()) {
            $quantity = 0;
            if ($request->color) {
                $quantities = Store::select('quantity')->join('product_details', 'product_details.id', '=', 'stores.productdetail_id')->where('product_details.product_id',$request->product_id)->where('stores.isdelete',false)->where('product_details.size',$request->size)->where('product_details.color',$request->color)->get();
            }else{
                $quantities = Store::select('quantity')->join('product_details', 'product_details.id', '=', 'stores.productdetail_id')->where('product_details.product_id',$request->product_id)->where('stores.isdelete',false)->where('product_details.size',$request->size)->get();
            }
            foreach ($quantities as $key => $value) {
                $quantity += $value->quantity;
            }
            return Response($quantity);
        }
    }
    public function getListColor(Request $request)
    {
        if ($request->ajax()) {
            $product_details = Product_Detail::select('color')->where('isdelete',false)->where('product_id',$request->product_id)->where('size',$request->size)->get();
            $list = array();
            foreach ($product_details as $key => $product_detail) {
                $list[] = $product_detail->color;
            }
            $list = array_unique($list);
            return Response($list);
        }
    }
}
