<!--------show each element of the items inside our cart---------->
<!------ $item['data']['name']  = inside [] because is accessing an array otherwise would be use -> to access object ---->
<!--- extends layouts.app --- navbar with login and register added with laravel auth ---->
@include('layouts.header')
@yield('center')



    <div class="container">
        <div class="row">
            <div class="col-lg">
                <div class="total_area">
                    <p>Payment Status: Not Paid Yet! /{{ $payment_info['status']}}</p>
                    <p>Total: £{{ $payment_info['price'] }}</p>
                    <a class="btn" id="paypal-button">Pay Now! </a>
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