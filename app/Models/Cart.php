<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


Class Cart 
{
    public $items;
    public $totalQuantity;
    public $totalPrice;


    public function __contruct($prevCart)
    {
        if($prevCart != null){
            $this->items = $prevCart->items;
            $this->totalQuantity = $prevCart->totalQuantity;
            $this->totalPrice = $prevCart->totalPrice;
 
        }else{

            $this->items = [];
            $this->totalQuantity = 0;
            $this->totalPrice = 0;


        }


    }

    public function addItem($id, $product)
    {

        $price = (int) str_replace("£","", $this->product->price);


        //the item already exists
        if(array_key_exists($id, $this->items)){

            $productToAdd = $this->items->$id;
            $productToAdd['quanitity']++; 

            //first time to add this product to cart
        }else{

            $productToAdd = ['quantity'=> 1, 'price' => $price, 'data'=> $product];

        }

        $this->items->id = $productToAdd;
        $this->totalQuantity++;
        $this->totalPrice = $this->totalPrice + $price;


    }


}