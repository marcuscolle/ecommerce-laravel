@include('layouts.header')
@yield('center')

<div class="container">
    <div class="row">
        <div>
            <img src="{{asset('storage')}}/product_images/{{$product['image'] }}" width="100" height="100">

            <form action="{{route('adminUpdateProductImage', ['id'=>$product->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                               

                <div class="form-group"> 
                    <label for="image">Update Image</label>
                    <input type="file" name="image" id="image" placeholder="image" value="{{ $product->image }} required">    
                </div>

                <button type="submit" name="submit" class="btn btn-default">Submit</button>
            </form>    
        </div>    
    </div>    
</div>


@include('layouts.footer')