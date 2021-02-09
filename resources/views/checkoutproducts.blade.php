<!--- extends layouts.app --- navbar with login and register added with laravel auth ---->
@include('layouts.app')


<div class="container">
    <div class="row">
        <form action="paymentpage" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                <div class="invalid-feedback">
                    Valid first name is required.
                </div>
                </div>
                <div class="col-md-6 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                <div class="invalid-feedback">
                    Valid last name is required.
                </div>
                </div>
            </div>
    
    
            <div class="mb-3">
                <label for="email">Email <span class="text-muted">(Optional)</span></label>
                <input type="email" class="form-control" id="email" placeholder="you@example.com">
                <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
                </div>
            </div>
    
            <div class="mb-3">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
                <div class="invalid-feedback">
                Please enter your shipping address.
                </div>
            </div>
    
            <div class="mb-3">
                <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
            </div>
    
            <div class="row">
                <div class="col-md-5 mb-3">
                <label for="country">Country</label>
                <select class="custom-select d-block w-100" id="country" required>
                    <option value="">Choose...</option>
                    <option>United Kingdom</option>
                </select>
                <div class="invalid-feedback">
                    Please select a valid country.
                </div>
                </div>
                </div>
                <div class="col-md-3 mb-3">
                <label for="postcode">Postcode</label>
                <input type="text" class="form-control" id="postcode" placeholder="" required>
                <div class="invalid-feedback">
                    Post code required.
                </div>
                </div>
            </div>
            <hr class="mb-4">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="same-address">
                <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="save-info">
                <label class="custom-control-label" for="save-info">Save this information for next time</label>
            </div>

            <button class="btn btn-primary check_out" type="submit" name="submit" > Proceed To Payment</button>

        </form>  
    </div>
</div>       
