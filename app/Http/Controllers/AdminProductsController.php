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
            'image' => 'required|mimes:jpg,png,jpeg,gif,svg|max:5000'
        ]);


        if($request->hasFile('image')){

            $product = Product::find($id);
            // this will return true or false, if image exists = true otherwise false!
            $exists = Storage::disk('local')->exists('public/product_images/'. $product->image);

            // this if will delete the old image
            if($exists){
                Storage::delete('public/product_images/' . $product->image );

            }
            //upload new image
                
            // requesting the image = file  with original name    
            $imageName = $request->file('image')->getClientOriginalName();     
            //Storing image with user original name and extention in the local driver
            $request->image->storeAs('public/product_images/', $imageName);
            
            // creating $imageUpdate as an array as the eloquent update function expect an array
            // then pass $imageName as value to save in the db as original image name
            $imageUpdate = array('image' => $imageName);
            // updating image name in the DB.
            Product::findOrFail($id)->update($imageUpdate);
                      
            return redirect()->route('adminDisplayProducts');

            
        }else{
            // if user dont update any image 
            $error = "No image has been uploaded!";
            return $error;

        }
    }
}
