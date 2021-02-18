<!--- extends layouts.app --- navbar with login and register added with laravel auth ---->
@include('layouts.app')


<div class="container">
    <div class="row">
        <form action="{{ route('createNewOrder') }}" method="post">
            @csrf
            @method('GET')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                <label for="first_name">First name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="" value="" required>
                <div class="invalid-feedback">
                    Valid first name is required.
                </div>
                </div>
                <div class="col-md-6 mb-3">
                <label for="last_name">Last name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="" value="" required>
                <div class="invalid-feedback">
                    Valid last name is required.
                </div>
                </div>
            </div>
    
    
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
                <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
                </div>
            </div>
    
            <div class="mb-3">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" required>
                <div class="invalid-feedback">
                Please enter your shipping address.
                </div>
            </div>
    
            
            <div class="mb-3">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" required>
            </div>

                <div class="col-md-3 mb-3">
                <label for="postcode">Postcode</label>
                <input type="text" class="form-control" id="postcode" name="postcode" placeholder="" required>
                <div class="invalid-feedback">
                    Post code required.
                </div>
                </div>
            </div>
            
            <input type="submit" value="Submit">

        </form>  
    </div>
</div>       
