@include('layouts.header')
@yield('center')

<div class="container">
    <div class="row">
        <div class="col-lg">
            <div class="total_area">
                <p> Order ID: {{ $payment_receipt['order_id'] }} </p>
                <p> Payer ID: {{ $payment_receipt['paypal_payer_id'] }} </p>
                <p> Payment ID: {{ $payment_receipt['paypal_payment_id'] }} </p>
                <p> Total: £{{ $payment_receipt['price'] }} </p>

                <a class="btn btn-primary" href="{{ route('products') }} ">Shop Again! </a>
            </div>
        </div>

        


      </div>  
    </div>
</div>                


@include('layouts.footer')