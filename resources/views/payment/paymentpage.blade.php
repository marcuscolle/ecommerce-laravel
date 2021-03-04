<!--------show each element of the items inside our cart---------->
<!------ $item['data']['name']  = inside [] because is accessing an array otherwise would be use -> to access object ---->
<!--- extends layouts.app --- navbar with login and register added with laravel auth ---->
@include('layouts.header')
@yield('center')



    <div class="container checkout">
        <div class="row">
            <div class="col-sm-12">
              <div class="text-center">
                <div class="total_area">

                    <h3><strong>Payment Status:</strong> Not Paid!</h3>
                    <hr>
                    <h3><strong>Order Id:</strong> {{$payment_info['order_id']}}</h3>


                  <hr>

                    <div class="table-responsive cart_info">
                      <table class="table">
                          <thead>          
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
                              @foreach( $cart->items as $item)
                              <tr>
                                  <td class="cart_product">
                                      <a href=""><img src="{{Storage::disk('local')->url('public/product_images/' .  $item['data']['image'])}}" width="100" height="100"></a>
                                  </td>
                                  <td class="cart_description">
                                      <h4><a href="">{{ $item['data']['name'] }}</a></h4>
                                      <p>{{ $item['data']['brand'] }} - {{ $item['data']['category'] }}</p>
                                      <p>id: {{ $item['data']['id'] }}</p>
                                  </td>
                                  <td class="cart_price">
                                      <p>{{ $item['data']['price'] }}</p>
                                  </td>
                                  <td class="cart_quantity">
                                      <div class="cart_quantity_button">  
                                          <input class="cart_quantity_input" type="text" name="quantity" value="{{ $item['quantity'] }}" autocomplete="off" size="2" readonly="readonly">
                                      </div>
                                  </td>
                                  <td class="cart_total">
                                      <p class="cart_total_price">£{{ $item['totalSinglePrice'] }}</p>
                                  </td>
                              </tr>                    
                              @endforeach
                          </tbody>
                      </table>
                  </div>

                  <hr>


                  <h1><strong>Total:</strong> £{{ $payment_info['price'] }}</h1>
                  <hr>
                  <a class="btn" id="paypal-button"></a>


                </div>
              </div>
            </div>
          </div>
        </div>
    </div>






<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
  paypal.Button.render({
    // Configure environment
    env: 'sandbox',
    client: {
      sandbox: 'AT8vDkxpLmvXeafaGv-ushQAdje4wqtnF7Eko02qhkgE6LN_Vg88sntVoKImvqvFGDIS28BLlAyvHpxo',
      production: 'demo_production_client_id'
    },
    // Customize button (optional)
    locale: 'en_US',
    style: {
      size: 'medium',
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
            total: "{{ $payment_info['price'] }}",
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



@include('layouts.footer')