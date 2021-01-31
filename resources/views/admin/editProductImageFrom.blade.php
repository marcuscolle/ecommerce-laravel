@include('layouts.header')
@yield('center')

<div class="container">
    <div class="row">
        <div>
            <img src="{{asset('storage')}}/product_images/{{$product['image'] }}">

            <form action="/admin/updateImage/{{$product->id }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group"> 
                    <label for="description">Update Image</label>
                    <input type="file" name="image" id="image" placeholder="image" value="{{ $product->image }} required">    
                </div>

                <button type="submit" name="submit" class="btn btn-default">Submit</button>
            </form>    
        </div>    
    </div>    
</div>


@include('layouts.footer')