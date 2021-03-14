<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\EmailController;
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
        $payment_info = Session::get('payment_info');
        $cart = Session::get('cart');
        

        if($payment_info['status'] == 'on_hold' && $cart){

            return view('payment.paymentpage', [ 'payment_info' => $payment_info, 'cart' => $cart]);
        
        }else{
            return redirect()->route("products");
        }
    

    }

    public function createNewOrder(Request $request)
    {
        $cart = Session::get('cart');

        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $address = $request->input('address');
        $postcode = $request->input('postcode');
        $phone = $request->input('phone');
        $email = $request->input('email');
 
        
        if($cart){
            $date = date('Y-m-d H:i:s');
            $newOrderArray = array('status' => 'on_hold', 'date'=>$date,  'del_date'=>$date, 'price'=> $cart->totalPrice,
                                   'first_name' => $first_name, 'last_name' => $last_name, 'address' => $address, 'postcode' => $postcode,
                                    'phone' => $phone, 'email' => $email);

            
                                   
            $created_order = DB::table('orders')->insertGetId($newOrderArray);
            $order_id = DB::getPdo()->lastInsertId();

            foreach($cart->items as $cart_item){
                $item_id = $cart_item['data']['id'];
                $item_name = $cart_item['data']['name'];
                $item_price = str_replace("£","", $cart_item['data']['price']);
                $newItemInCurrentOrder = array('item_id'=>$item_id, 'order_id'=>$order_id, 'item_name'=>$item_name, 'item_price'=>$item_price);
                
                #dd($newItemInCurrentOrder);
                
                $created_order_items = DB::table('order_items')->insertGetId($newItemInCurrentOrder);
            }

            // delete cart
           # Session::forget('cart');
           # Session::flush();
            
            $payment_info = $newOrderArray;
            $payment_info['order_id'] = $order_id; 
            $payment_info['item_id'] = $item_id;
            $payment_info['item_name']= $item_name;
            $payment_info['item_price'] = $item_price;
             
            $request->session()->put('payment_info', $payment_info);
                        
            return redirect()->route('paymentpage');

        }else{
            return redirect()->route('products');
        }
        
     

    }


    /*---------------- doesnt work with localhost only when live ------*/

    public function validate_payment($paypalPaymentID, $paypalPayerID)
    {
        $paypalEnv = 'sandbox'; // or production = to go live
        $paypalURL = 'https://api.sandbox.paypal.com/v2/';
        $paypalClientID = getenv('PAYPAL_CLIENT_KEY');
        $paypalSecret = getenv('PAYPAL_SECRET_KEY');

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $paypalURL.'oauth2/token');
        curl_setopt($ch, CURLOPT_HEADER, false );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $paypalClientID .":". $paypalSecret);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials" );
        $response = curl_exec($ch);
        curl_close($ch);

        if(empty($response)){
            return false;
        }else{
            $jsonData = json_decode($response);
            $curl = curl_init($paypalURL.'payments/payment/'.$paypalPaymentID);
            
            curl_setopt($ch, CURLOPT_POST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt($ch, CURLOPT_HEADER, false );
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Autorization : Bearer'. $jsonData->access_token,
                'Accept: application/json',
                'Content-Type: application/xml'
            ));
            $response = curl_exec($curl);
            curl_close($curl);

            $result = json_decode($response);

            return $result;


        }
 
    }





    private function storePaymentInfo($paypalPaymentID, $paypalPayerID)
    {
        $payment_info = Session::get('payment_info');
        $order_id = $payment_info['order_id'];
        $status = $payment_info['status'];
        $paypal_payer_id = $paypalPayerID;
        $paypal_payment_id = $paypalPaymentID;

        if($status == 'on_hold'){
            $date = date('Y-m-d H:i:s');
            $newPaymentArray = array('order_id'=>$order_id, 'date'=>$date, 
                                     'amount'=>$payment_info['price'], 'paypal_payment_id'=>$paypal_payment_id,
                                     'paypal_payer_id'=>$paypal_payer_id,
                                    );

            $create_order = DB::table('payments')->insert($newPaymentArray);


            DB::table('orders')->where('order_id', $order_id)->update(['status'=> 'paid']);
        }
    }



    public function paymentreceipt($paypalPaymentID, $paypalPayerID)
    {

        if(!empty($paypalPaymentID) && !empty($paypalPayerID)){
            //will return json -> contais aproved transaction status
        #   $this->validate_payment($paypalPaymentID, $paypalPayerID);        
            $this->storePaymentInfo($paypalPaymentID, $paypalPayerID);

            $cart = Session::get('cart');
            
            $payment_receipt = Session::get('payment_info');
            $payment_receipt['paypal_payment_id'] = $paypalPaymentID; 
            $payment_receipt['paypal_payer_id'] = $paypalPayerID;

            $payment_info['order_id'] = $payment_receipt['order_id'];
            $payment_info['item_id'] = $payment_receipt['item_id'];
            $payment_info['item_name']= $payment_receipt['item_name'];
            $payment_info['item_price'] = $payment_receipt['item_price'];

          #  app()->sendmail();
            app()->call('App\Http\Controllers\EmailController@sendmail');
            
            return view('payment.paymentreceipt', ['payment_receipt'=>$payment_receipt, 'cart' => $cart])->with('success', 'Thank You for your Purchase!');
           # return view('email', ['payment_receipt'=>$payment_receipt, 'cart' => $cart]);
        }else{
            return redirect()->route('products')->with('success', 'Thank You for your Purchase!');
        }
    }
        


}
