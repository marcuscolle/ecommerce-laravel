<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class PaymentsController extends Controller
{
    //

    public function index()
    {
        $products = Product::paginate(2);

        return view('products', compact('products'));
    }


    public function paymentpage()
    {
        $cart = Session::get('cart');

        if($cart){
            return view('payment.paymentpage', ['cartItems' => $cart]);
        }else{
            return redirect()->route("products");
        }
        Session::flush();


    }

    public function createNewOrder(Request $request)
    {
        $cart = Session::get('$cart');

        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $address = $request->input('address');
        $postcode = $request->input('postcode');
        $country = $request->input('country');
        $email = $request->input('email');


        if($cart){
            $date = date('Y-m-d H:is');
            $newOrderArray = array('status' => 'on_hold', 'date'=>$date,  'del_date'=>$date, 'price'=> $cart->totalPrice,
                                   'firstname' => $firstname, 'lastname' => $lastname, 'address' => $address, 'postcode' => $postcode,
                                    'country' => $country, 'email' => $email);


            $created_order = DB::table('orders')->insert($newOrderArray);
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

            $payment_info = $newOrderArray;
            $request->session()->put('payment_info', $payment_info);
            
            return redirect()->route('paymentpage');



        }else{
            return redirect()->route('products');
        }
        


    }





}
