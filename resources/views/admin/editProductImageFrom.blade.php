<!--- extends layouts.app --- navbar with login and register added with laravel auth ---->
@include('layouts.admin')
@yield('center')


<div class="container">
    <div class="row">
        <div>
            <img src="{{Storage::disk('s3')->url('public/product_images/' . $product['image'])}}" width="100" height="100">

            <form action="{{route('adminUpdateProductImage', ['id'=>$product->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                               

                <div class="form-group"> 
                    <label class="input-group-text" for="inputGroupFile01">Upload</label>
                    <input type="file" class="form-control" name="image" id="image" placeholder="image" value="{{ $product->image }} required">    
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                <a class="btn brn-primary" href="{{ route('adminDisplayProducts') }}"> Back </a>
            </form>    
        </div>    
    </div>    
</div>

