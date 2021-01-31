@include('layouts.header')
@yield('center')

<!-----dashboard must be edited--------------->
<html>
    <body>
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
                    <td><img src="{{ Storage::url("product_images/" . $product['image']) }}" width="100" height="100"></td>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['description'] }}</td>
                    <td>{{ $product['price'] }}</td>
                    <td>{{ $product['type'] }}</td>

                    <td><a href="{{ route('adminEditProductImageForm', ['id' => $product['id']]) }}" class="btn btn-primary">Edit Image</td>
                    <td><a href="{{ route('adminEditProductForm', ['id' => $product['id']]) }}" class="btn btn-primary">Edit</td>
                    <td><a href="#" class="btn btn-warning">Remove</td>     
                   
                </tr>
                @endforeach  
    
            </tbody>      
        
        </table>  
      </div>
    </body>
</html>

@include('layouts.footer')

