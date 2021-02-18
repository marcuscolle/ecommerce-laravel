@include('layouts.app')


<p> Order ID: {{ $payment_receipt['order_id'] }} </p>
<p> Payer ID: {{ $payment_receipt['paypal_payer_id'] }} </p>
<p> Payment ID: {{ $payment_receipt['paypal_payment_id'] }} </p>
<p> Total: {{ $payment_receipt['price'] }} </p>


<a class="btn ntn-primary" href="{{ route('products') }} ">Shop Again! </a>