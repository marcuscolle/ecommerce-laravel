@include('layouts.header')
@yield('center')

<div class="container">
    <div class="row">
        <div>
            <img src="{{asset('storage')}}/product_images/{{$product['image'] }}">

            <form action="/admin/updateProduct/{{$product->id }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group"> 
                    <label for="description">Name:</label>
                    <input type="text" name="name" id="name" placeholder="name" value="{{ $product->name }}" required>    
                </div>

                <div class="form-group"> 
                    <label for="description">Description:</label>
                    <input type="text" name="description" id="description" placeholder="description" value="{{ $product->description }}" required>    
                </div>

                <div class="form-group"> 
                    <label for="description">Price:</label>
                    <input type="text" name="price" id="price" placeholder="price" value="{{ $product->price }}" required>    
                </div>

                <div class="form-group"> 
                    <label for="description">Type:</label>
                    <input type="text" name="type" id="type" placeholder="type" value="{{ $product->type }}" required>    
                </div>


                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>    
        </div>    
    </div>    
</div>


@include('layouts.footer')