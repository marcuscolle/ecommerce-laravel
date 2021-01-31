<?php

namespace App\Http\Controllers;

use App\Models\AdminProducts;
use Illuminate\Http\Request;
use App\Models\Product;

class AdminProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //display all products in admin page
        $products = Product::all();

        return view('admin.displayProducts', ['products' => $products]);
    }

        //display edit product form 
    public function editProductForm($id)
    {
        $product = Product::find($id);
        return view('admin.editProductForm', ['product' => $product]);
    }

        //display edit product image form
    public function editProductImageForm($id)
    {
        $product = Product::find($id);
        return view('admin.editProductImageFrom', ['product' => $product]);
    }
}
