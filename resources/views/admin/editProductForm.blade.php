@include('layouts.admin')
@yield('center')

<div class="container">
    <div class="row">
        <div>
            <img src="{{asset('storage')}}/product_images/{{$product['image'] }}" width="100" height="100">

            <form action="/admin/updateProduct/{{$product->id }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group"> 
                    <label for="name">Name:</label>
                    <input class="form-control" type="text" name="name" id="name" value={{ $product->name}} required>    
                </div>

                <div class="form-group"> 
                    <label for="image1">Image:</label>
                    <input class="form-control" type="file" name="image" id="image" value={{ $product->image}} required>    
                </div>

                <div class="form-group"> 
                    <label for="description">Description:</label>
                    <input class="form-control" type="text" name="description" id="description" value={{ $product->description}} required>    
                </div>

                <div class="form-group"> 
                    <label for="price">Price:</label>
                    <input class="form-control" type="text" name="price" id="price" required>    
                </div>

                <div class="form-group"> 
                    <label for="category">Category:</label>
                    <select id="category" name="category" value={{ $product->category}} required>
                        <option value="men">Men</option>
                        <option value="women">Women</option>
                        <option value="kids">Kids</option>
                        <option value="accessories">Accessories</option>
                        <option value="shoes">Shoes</option>
                      </select>   
                </div>

                <div class="form-group"> 
                    <label for="brand">Brand:</label>
                    <input class="form-control" type="text" name="brand" id="brand" value={{ $product->brand}} required>    
                </div>


                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                <a class="btn brn-primary" href="{{ route('adminDisplayProducts') }}"> Back </a>
            </form>    
        </div>    
    </div>    
</div>

