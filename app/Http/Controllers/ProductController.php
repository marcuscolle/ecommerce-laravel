<?php

namespace App\Http\Controllers;

use App\Models\Product;

use App\Models\Cart;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Arr;

use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        //use use Illuminate\Support\Facades\DB;
        // DB query of products table

        $products = Product::all();

        return view('allproducts', compact('products'));
    }

    
    public function addProductToCart(Request $request, $id)
    {
        // use App\Models\Cart; -> at the top.
        //Cart class has been created, now its time to store inside the session
        // the session is the only way to access from any page out been loose changing pages
        // HTTP Session -> Storing Data

        // Retrieving Data
        $prevCart = $request->session()->get('cart');
        $cart = new Cart($prevCart);

        $product = Product::find($id);
        $cart->addItem($id, $product);

        // Storing Data
        $request->session()->put('cart', $cart);

        // dump($cart);

         return redirect()->route('products');



    }

    public function showCart()
    {

       $cart = Session::get('cart');

       //cart not empty
       if($cart){

       // dump($cart);
       return view('cartproducts', ['cartItems' => $cart]);

       // cart empty
       }else{

       return redirect()->route('products');

       }




    }


    public function deleteItemFromCart( Request $request, $id)
    {
        $cart = $request->session()->get('cart');

        if(Arr::exists($cart->items, $id)){
            unset($cart->items[$id]);  //easy way to delete arrays
        }

        // after delete the item in cart
        // the cart must be updated such as price, quantity ...
        $prevCart = $request->session()->get('cart');
        $updateCart = new Cart($prevCart);
        $updateCart->updatePriceAndQuantity();

        $request->session()->put('cart', $updateCart);

        

        return redirect()->route('cartproducts');
    }




}
