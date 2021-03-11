@include('layouts.admin')
@yield('center')

<!-----dashboard must be edited--------------->
<html>
    <body>
      <div class="container">
        <div class="row">  

              <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                          <th>#id</th>
                          <th>Image</th>
                          <th>Name</th>
                          <th>Description</th>
                          <th>Price</th>
                          <th>Category</th>
                          <th>Brand</th>
                          <th>Edit Image</th>
                          <th>Edit</th>
                          <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
            
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product['id'] }}</td>

                            <!----other way to display the image would be
                              {asset('storage')} / product_images / {$product['image']}
                            ----->
                            <td><img src="{{Storage::disk('s3')->url('public/product_images/' . $product['image'])}}" width="100" height="100"></td>
                            <td>{{ $product['name'] }}</td>
                            <td>{{ $product['description'] }}</td>
                            <td>{{ $product['price'] }}</td>
                            <td>{{ $product['category'] }}</td>
                            <td>{{ $product['brand'] }}</td>


                            <td><a href="{{ route('adminEditProductImageForm', ['id' => $product['id']]) }}" class="btn btn-primary">Edit Image</a></td>
                            <td><a href="{{ route('adminEditProductForm', ['id' => $product['id']]) }}" class="btn btn-primary">Edit</a></td>
                            <td><a href="{{ route('adminDeleteProduct', ['id' => $product['id']]) }}" class="btn btn-danger">Remove</a></td>     
                          
                        </tr>
                        @endforeach  
            
                    </tbody>      
                
                </table>  

                <!---- function links show pagination numbers and arrows to "turn the page"  ------->
                <div class="text-center">
                  <div class="pagination col-sm-12"> 
                      {{ $products->links('pagination::bootstrap-4') }}
                  </div>  
                </div> 

              </div>
        </div>
      </div>          
    </body>
</html>


