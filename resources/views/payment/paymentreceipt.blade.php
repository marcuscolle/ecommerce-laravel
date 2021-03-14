@include('layouts.header')
@yield('center')

<div id="receipt" class="container checkout" style="border: 0.5px groove lightgray;">
    <div class="row">
        <div class="col-sm-12">
            <div class="text-center">
                <div class="total_area">
                    <h4><strong> Order ID:</strong> {{ $payment_receipt['order_id'] }} </h4>
                    <hr>
                    <h4><strong> Payer ID:</strong> {{ $payment_receipt['paypal_payer_id'] }} </h4>
                    <hr>
                    <h4><strong> Payment ID:</strong> {{ $payment_receipt['paypal_payment_id'] }} </h4>
                    <hr>
                    <div class="table-responsive cart_info">
                        <table class="table">
                            <thead>          
                                <tr class="cart_menu">
                                    <td class="image">Item</td>
                                    <td class="description">Description</td>
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
                                        <a href=""><img src="{{Storage::disk('s3')->url('public/product_images/' .  $item['data']['image'])}}" width="100" height="100"></a>
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
                    <h4><strong>Total Paid:</strong> £{{ $payment_receipt['price'] }} </h4>
                    <hr>
                    <div class="text-center butt">
                        <a class="btn btn-primary" href="{{ route('products') }} ">Shop Again!</a>    
                    </div>
                </div>
            </div>
        </div>
        <h6> This page will be redirected after 10 seconds! </h6>
      </div>  
    </div>
</div>   


<script>

    setTimeout(function () {
    window.location = '/cart'; // the redirect goes here

    },10000); // 10 seconds


    function printDiv(receipt) {
        var printContents = document.getElementById(receipt).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
}

</script>

@include('layouts.footer')


