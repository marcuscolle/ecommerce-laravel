<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\facades\Mail;
use Illuminate\Support\Facades\Session;


class EmailController extends Controller
{
    public function sendmail(Request $request){
   

            $cart = Session::get('cart');
            $payment_receipt = Session::get('payment_info');

          #  app()->call('App\Http\Controllers\PaymentsController@paymentreceipt');

            $payment_info['first_name'] =  $payment_receipt['first_name'];
            $payment_info['last_name'] =  $payment_receipt['last_name'];
            $payment_info['email'] =  $payment_receipt['email'];
            
            
 
  
         try{
             Mail::send('email', $payment_receipt, function($message)use($payment_receipt) {
             $message->to($payment_receipt['email'])
             ->subject($payment_receipt['first_name'] . " " . $payment_receipt['last_name']);
             
             });

            
         }catch(JWTException $exception){
             $this->serverstatuscode = "0";
             $this->serverstatusdes = $exception->getMessage();
         }
         if (Mail::failures()) {
              $this->statusdesc  =   "Error sending mail";
              $this->statuscode  =   "0";
  
         }else{
  
            $this->statusdesc  =   "Message sent Succesfully";
            $this->statuscode  =   "1";
         }

        
             Session::forget('payment_info', 'cart');
             Session::flush();

            return view('payment.paymentreceipt', ['payment_receipt'=>$payment_receipt, 'cart' => $cart]);
        }
    
}
