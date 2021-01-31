<?php

namespace App\Http\Controllers;

use App\Models\AdminProducts;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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

        // Update Product Image
    public function updateProductImage(Request $request, $id)
    {
       # Validator::make($request->all(),['image'=>"required|image|mimes: jpg, jpeg, png, bmp, gif, svg, webp| max:5000"])->validate();
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:5000'
        ]);


        if($request->hasFile('image')){

            $product = Product::find($id);
            // this will return true or false, if image exists = true otherwise false!
            $exists = Storage::disk('local')->exists('public/product_images/'. $product->image);

            // this if will delete the old image
            if($exists){
                Storage::delete('public/product_images/' . $product->image );

            }
            //until delete the function its working fine, after that its not saving a new one on the database and local.


            //upload new image
                //file extension
            $ext = $request->file('image')->getClientOriginalExtension();
                
            //Storing image with user original name and extention in the DB.
            $request->image->storeAs('public/storage/product_images/' . $product->image . $ext);
             
            $imageUpdate = array('image' => $product->image);
            DB::table('products')->where('id', $id)->update($imageUpdate);
           
            # Product::where('id', $id)->update($request->except(['_token', '_method']));
            
            return redirect()->route('adminDisplayProducts');

            
        }else{
            // if user dont update any image 
            $error = "No image has been uploaded!";
            return $error;

        }
    }
}
