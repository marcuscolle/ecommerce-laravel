<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    // fillable deteminate each field can be edited
    // anything you want to change must be added to this array

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'type'
    ];


    // function to add a £ sing automatic everytime i
    // call $product->price in the html blade so i dont have
    // to right in the html all the time
    public function getPriceAttribute($value){
        $newForm = "£". $value;
        return $newForm;
    }


}


