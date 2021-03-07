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

        $products = Product::paginate(15);

        return view('index', compact('products'));
    }




    /*--------------------Mens Filters--------------------------*/

    // men products function to filter all products type men
    public function menProducts()
    {
        //query builder
        //filtering mens products
        // more type or columns can be added or filtered to the website
        $products = Product::where('category', 'Men')->paginate(12);

        return view('mens.menProducts', compact('products'));

    }

  
    public function menShoes()
    {
        //query builder
        $products = Product::where(function($query)
        {
            $query->where('category', 'men')
                  ->where('name', 'shoes');
        
                })->paginate(9);

        return view('mens.shoesmens', compact('products'));

    }

    public function menPants()
    {
        //query builder
        $products = Product::where(function($query)
        {
            $query->where('category', 'men')
                  ->where('name', 'pants');
        
                })->paginate(9);

        return view('mens.pantsmens', compact('products'));

    }

    public function menShirts()
    {
        //query builder
        $products = Product::where(function($query)
        {
            $query->where('category', 'men')
                  ->where('name', 't-shirt');
        
                })->paginate(9);

        return view('mens.shirtsmens', compact('products'));

    }

    public function menShorts()
    {
        //query builder
        
        $products = Product::where(function($query)
        {
            $query->where('category', 'men')
                  ->where('name', 'shorts');
        
                })->paginate(9);

        return view('mens.shortsmens', compact('products'));

    }





/*------------------Women Filters-------------------------*/

    // women products function to filter all products type women
    public function womenProducts()
    {
        $products = Product::where('category', 'women')->paginate(12);

        return view('women.womenProducts', compact('products'));

    }

    public function womenDress()
    {
        //query builder
        $products = Product::where(function($query)
        {
            $query->where('category', 'women')
                  ->where('name', 'dress');
        
                })->paginate(9);

        return view('women.dresswomen', compact('products'));

    }

    public function womenPants()
    {
        //query builder
        $products = Product::where(function($query)
        {
            $query->where('category', 'women')
                  ->where('name', 'pants');
        
                })->paginate(9);

        return view('women.pantswomen', compact('products'));

    }

    public function womenShirts()
    {
        //query builder
        $products = Product::where(function($query)
        {
            $query->where('category', 'women')
                  ->where('name', 't-shirt');
        
                })->paginate(9);

        return view('women.shirtswomen', compact('products'));

    }

    public function womenShoes()
    {
        //query builder
        $products = Product::where(function($query)
        {
            $query->where('category', 'women')
                  ->where('name', 'shoes');
        
                })->paginate(9);

        return view('women.shoeswomen', compact('products'));

    }





/*-------------Kids Filters-----------------------*/

    public function kids()
    {
        $products = Product::where('category', 'kids')->paginate(12);

        return view('kids.kids', compact('products'));
    }



    public function kidsShoes()
    {
        //query builder
        $products = Product::where(function($query)
        {
            $query->where('category', 'kids')
                  ->where('name', 'shoes');
        
                })->paginate(9);

        return view('kids.shoeskids', compact('products'));

    }

/*---------------------------Accessories Filter---------------------------------------*/

    public function accessories()
    {
        $products = Product::where('category', 'accessories')->paginate(12);

        return view('accessories.accessories', compact('products'));
    }


/*---------------------------Shoes Filter--------------------------------*/
    public function shoes()
    {
        $products = Product::where('name', 'shoes')->paginate(12);

        return view('shoes.shoes', compact('products'));
    }


    
/*---------------------SearchBar-----------------------*/
    
    public function search(Request $request)
    {
        
        $searchText = $request->get('searchText');
        $products = Product::where('name', 'Like', $searchText."%")->paginate(21);

        return view('index', compact('products'));
        

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

         return redirect()->route('products')->with('success',  $product->name . ' ' . $product->brand . ' ' . 'has been added to cart!');

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

        

        return redirect()->route('cartproducts')->with('success', 'Product has been deleted');
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
    
}
