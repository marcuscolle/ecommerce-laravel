<?php

namespace App\Http\Controllers;

use App\Models\AdminProducts;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        // 2 is the number os items displayed by page
        $products = Product::paginate(20);

        return view('admin.displayProducts', ['products' => $products]);
    }


    ///Admin Dashboard page
    public function dashboard()
    {

        $earnings = DB::table('payments')->sum('amount');

        $order_number = DB::table('orders')->where('status', 'paid')->count();

        $register_users = DB::table('users')->count();


        $graph = DB::table('payments')->select(
                    DB::raw('MONTH(date) as month'),
                    DB::raw('SUM(amount) as sum')
                )
                ->whereYear('date', '=', Carbon::now()->month)
                ->groupBy('month')
                ->get();  
        

        return view('admin.dashboard', ['earnings' => $earnings, 
                                        'order_number' => $order_number,
                                        'register_users' => $register_users,
                                        'graph' => $graph]);


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





        // Update Product Details
    public function updateProduct (Request $request, $id )
    {
        

        $name = $request->input('name');
        $description = $request->input('description');
        $price =  $request->input('price');
        $category = $request->input('category');
        $brand = $request->input('brand');

        $update = array('name' => $name,
                        'description' => $description,
                        'price' => $price,
                        'category' => $category,
                        'brand' => $brand
                    );
                               
        DB::table('products')->where('id', $id)->update($update);

        return redirect()->route('adminDisplayProducts');

    }




    // Create Product Form

    public function createProductForm()
    {
        return view("admin.createProductForm"); 

    }





    // Create New Product 

    public function newProductForm(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $price =  $request->input('price');
        $category = $request->input('category');
        $brand = $request->input('brand');

        $request->validate(['image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:5000']);
        $imageName = $request->file('image')->getClientOriginalName();
        $imageEncoded = File::get($request->image);

        Storage::disk('local')->put('public/product_images/'.$imageName, $imageEncoded);

        $newProductArray = array('name' => $name,
                                 'description' => $description,
                                 'price' => $price,
                                 'image' => $imageName,
                                 'category' => $category,
                                 'brand' => $brand
                                 );

        $created = DB::table('products')->insert($newProductArray);

        if($created){

            return redirect()->route('adminDisplayProducts'); 
        }else{
            return "The product has not been created";
        }    


    }





    public function deleteProduct($id)
    {

        $product = Product::find($id);

        $exists = Storage::disk('local')->exists('public/product_images/'. $product->image);

        // this if will delete the old image
        if($exists){
            Storage::delete('public/product_images/' . $product->image );

        }

        Product::destroy($id);

        return redirect()->route('adminDisplayProducts');    


    }



    
    public function orders()
    {
        $orders = DB::table('orders')->paginate(12);
        
        return view('admin.orders', ['orders' => $orders]);

    }

    public function customers()
    {
        $customers = DB::table('orders')->get();

        return view('admin.customers', ['customers' => $customers]);

    }


    public function earnings()
    {
        $earnings = DB::table('payments')->sum('amount');

        return view('admin.earnings', ['earnings' => $earnings]);

    }

}


