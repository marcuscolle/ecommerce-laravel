<!--------show each element of the items inside our cart---------->
<!------ $item['data']['name']  = inside [] because is accessing an array otherwise would be use -> to access object ---->
@include('layouts.app')


<section id="do_action">
    <div class="container">
        
            <div class="col-sm-6">
                <div class="total_area">
                    <p> {{ $payment_info['status']}}</p>
                    <p> {{ $payment_info['price'] }}</p>
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