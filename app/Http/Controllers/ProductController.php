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

        // PAGINATION WILL BE ADDED!

        $products = Product::all();

        return view('allproducts', compact('products'));
    }





    // men products function to filter all products type men
    public function menProducts()
    {
        //query builder
        //filtering mens products
        // more type or columns can be added or filtered to the website
        $products = DB::table('products')->where('type', 'Men')->get();

        return view('menProducts', compact('products'));

    }

    // women products function to filter all products type women
    public function womenProducts()
    {
        $products = DB::table('products')->where('type', 'Women')->get();

        return view('womenProducts', compact('products'));

    }


    public function search(Request $request)
    {
        $searchText = $request->get('searchText');
        $products = Product::where('name', 'Like', $searchText."%")->paginate(10);

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





    public function increaseProduct(Request $request, $id)
    {
        //getting the cart.
        $prevCart = $request->session()->get('cart');
        //creating a new object.
        $cart = new Cart($prevCart);

        // using the id to get the information from the DB.
        $product = Product::find($id);
        
        //cart object to add the same product inside the cart.
        $cart->addItem($id, $product);
        //updating a new item inside cart session.
        $request->session()->put('cart', $cart);

        return redirect()->route('cartproducts');



    }

    public function decreaseProduct(Request $request, $id)
    {
        //getting the cart.
        $prevCart = $request->session()->get('cart');
        //creating a new object.
        $cart = new Cart($prevCart);

        if( $cart->items[$id]['quantity'] > 1 ){

            // using the id to get the information from the DB.
            $product = Product::find($id);
        
            //cart object to remove the same product inside the cart.
            $cart->removeItem($id, $product);
            //updating cart total price
            $cart->updatePriceAndQuantity();        
        
            //updating a new item inside cart session.
            $request->session()->put('cart', $cart);

        }

        return redirect()->route('cartproducts');



    }

    public function checkoutproducts()
    {
        // this view will be returned from checkout button inside cart's page
        return view('checkoutproducts');

    }


    


    public function createOrder()
    {
                    
        $cart = Session::get('cart');
             

        if($cart){
            $date = date('Y-m-d H:i:s');
            $newCartArray = array('status' => 'on_hold', 'date'=>$date,  'del_date'=>$date, 'price'=> $cart->totalPrice );
            $created_order = DB::table('orders')->insert($newCartArray);
            $order_id = DB::getPdo()->lastInsertId();


            foreach($cart->items as $cart_item){
                $item_id = $cart_item['data']['id'];
                $item_name = $cart_item['data']['name'];
                $item_price = str_replace("£","", $cart_item['data']['price']);
                $newItemInCurrentOrder = array('item_id'=>$item_id, 'order_id'=>$order_id, 'item_name'=>$item_name, 'item_price'=>$item_price);
                
              #  dd($newItemInCurrentOrder);
                
                $created_order_items = DB::table('order_items')->insertGetId($newItemInCurrentOrder);
            }

            // delete cart
            # Session::forget($cart);
            Session::flush();
            
            return redirect()->route('paymentpage');


        }else{
            return redirect()->route('products');

        }

    }




}
