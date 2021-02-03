@include('layouts.header')
@yield('center')

<!-----dashboard must be edited--------------->
<html>
    <body>

      <div class="contaiener"> 
        <div class="row">
          <p> Insert A New Product </p>
          <a href="/admin/createProductForm">Add a product</a>

        </div>  
      </div>



      <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                  <th>#id</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>Type</th>
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
                      {sset('storage')} / product_images / {$product['image']}
                    ----->
                    <td><img src="{{ Storage::url("product_images/" . $product['image']) }}" width="100" height="100"></td>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['description'] }}</td>
                    <td>{{ $product['price'] }}</td>
                    <td>{{ $product['type'] }}</td>

                    <td><a href="{{ route('adminEditProductImageForm', ['id' => $product['id']]) }}" class="btn btn-primary">Edit Image</td>
                    <td><a href="{{ route('adminEditProductForm', ['id' => $product['id']]) }}" class="btn btn-primary">Edit</td>
                    <td><a href="{{ route('adminDeleteProduct', ['id' => $product['id']]) }}" class="btn btn-warning">Remove</td>     
                   
                </tr>
                @endforeach  
    
            </tbody>      
        
        </table>  
      </div>
    </body>
</html>

@include('layouts.footer')

