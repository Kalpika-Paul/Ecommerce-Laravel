<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\select;

class ProductController extends Controller
{
    public function index(){
        $products = Product::paginate(8);
        return view('products',compact('products'));
    }


    public function details($slug){
        $product = Product::where('slug',$slug)->first();
        return view('details',compact('product'));
    }

    public function addToCart($id){

        $cart = new Cart;
        $cart->user_id = auth()->user()->id;
        $cart->product_id = $id;
        $cart->save();
if($cart->save()){
        return redirect()->back()->with('success','Product Added To cart');
}
return redirect()->back()->with('error','Something went wrong!');

    }


    public function showCart(){
        
        $cartItems = DB::table('carts')
        
        ->join('products','carts.product_id','=','products.id')
        
        ->select(
        'carts.product_id',
        DB::raw("count(*) as quantity"),
        'products.title',
        'products.price',
        'products.image',
        'products.slug'
        )

        ->where('carts.user_id',auth()->user()->id)
        
        ->groupBy(
        'carts.product_id',
        'products.title',
        'products.price',
        'products.image',
        'products.slug'
        )
        ->paginate(4);

    return view('cart',compact('cartItems'));



    }

}
