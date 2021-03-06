@include('layouts.admin')
@yield('center')

<div class="container">
    <div class="row">
        <div>
            <h3> Create New Product </h3>
            <form action="/admin/newProductForm" method="post" enctype="multipart/form-data" class="adminpanel">
                @csrf

                <div class="form-group"> 
                    <label for="name">Name:</label>
                    <input class="form-control" type="text" name="name" id="name" placeholder="name" required>    
                </div>

                <div class="form-group"> 
                    <label for="image1">Image:</label>
                    <input class="form-control" type="file" name="image" id="image" placeholder="image" required>    
                </div>

                <div class="form-group"> 
                    <label for="description">Description:</label>
                    <input class="form-control" type="text" name="description" id="description" placeholder="description" required>    
                </div>

                <div class="form-group"> 
                    <label for="price">Price:</label>
                    <input class="form-control" type="text" name="price" id="price" placeholder="price" required>    
                </div>

                <div class="form-group"> 
                    <label for="category">Category:</label>
                    <select id="category" name="category" required>
                        <option value="men">Men</option>
                        <option value="women">Women</option>
                        <option value="kids">Kids</option>
                        <option value="accessories">Accessories</option>
                        <option value="shoes">Shoes</option>
                      </select>   
                </div>

                <div class="form-group"> 
                    <label for="brand">Brand:</label>
                    <input class="form-control" type="text" name="brand" id="brand" placeholder="Nike / adidas ..." required>    
                </div>


                <button type="submit" name="submit" class="btn btn-success">Submit</button>
                <a class="btn btn-primary" href="{{ route('adminDisplayProducts') }}"> Back </a>
            </form>    
        </div>    
    </div>    
</div>
