<!--------show each element of the items inside our cart---------->
<!------ $item['data']['name']  = inside [] because is accessing an array otherwise would be use -> to access object ---->
@include('layouts.app')




<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>

                    @if(Auth::user())
                    Hello, <strong>{{ $userData->name }}.</strong> Ready to complete your shopping?
                    @else
                    Hello! Ready to complete your shopping?
                    @endif

                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>

                    @foreach( $cartItems->items as $item)

                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{Storage::disk('local')->url('public/product_images/' .  $item['data']['image'])}}" width="100" height="100"></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{ $item['data']['name'] }}</a></h4>
                            <p>{{ $item['data']['description'] }} - {{ $item['data']['type'] }}</p>
                            <p>id: {{ $item['data']['id'] }}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{ $item['data']['price'] }}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                
                                <input class="cart_quantity_input" type="text" name="quantity" value="{{ $item['quantity'] }}" autocomplete="on" size="2" disabled>
                  
                            </div>
                        </td>
                        
                    </tr>
                                  
                    @endforeach


                  
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        
            <div class="col-sm-6">
                <div class="total_area">
                    <p> {{ $cartItems->totalQuantity}}</p>
                    <p> {{ $cartItems->totalPrice }}</p>
                    <a class="btn btn-primary" id="paypal-button">Pay Now! </a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->





<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
  paypal.Button.render({
    // Configure environment
    env: 'sandbox',
    client: {
      sandbox: getenv('PAYPAL_CLIENT_KEY');,
      production: 'demo_production_client_id'
    },
    // Customize button (optional)
    locale: 'en_US',
    style: {
      size: 'small',
      color: 'gold',
      shape: 'pill',
    },

    // Enable Pay Now checkout flow (optional)
    commit: true,

    // Set up a payment
    payment: function(data, actions) {
      return actions.payment.create({
        transactions: [{
          amount: {
            total: "{{ $cartItems->totalPrice }}",
            currency: 'GBP'
          }
        }]
      });
    },
    // Execute the payment
    onAuthorize: function(data, actions) {
      return actions.payment.execute().then(function() {
        // Show a confirmation message to the buyer
        window.alert('Thank you for your purchase!');

        window.location = './paymentreceipt'+'/'+ data.paymentID +'/'+ data.payerID;
        
      });
    }
  }, '#paypal-button');

</script>