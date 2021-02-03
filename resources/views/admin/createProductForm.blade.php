<div class="container">
    <div class="row">
        <div>
            <h3> Create New Product </h3>
            <form action="/admin/newProductForm" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group"> 
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" placeholder="name" required>    
                </div>

                <div class="form-group"> 
                    <label for="image1">Image</label>
                    <input type="file" name="image" id="image" placeholder="image" reqwuired>    
                </div>

                <div class="form-group"> 
                    <label for="description">Description:</label>
                    <input type="text" name="description" id="description" placeholder="description" required>    
                </div>

                <div class="form-group"> 
                    <label for="price">Price:</label>
                    <input type="text" name="price" id="price" placeholder="price" required>    
                </div>

                <div class="form-group"> 
                    <label for="type">Type:</label>
                    <input type="text" name="type" id="type" placeholder="type" required>    
                </div>


                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>    
        </div>    
    </div>    
</div>