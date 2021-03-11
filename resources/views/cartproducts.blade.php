<!--------show each element of the items inside our cart---------->
<!------ $item['data']['name']  = inside [] because is accessing an array otherwise would be use -> to access object ---->
@include('layouts.header')


@yield('center')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Shopping Cart</li>
            </ol>
        </div>

<!----------------------alert message-------------->
        <div class="container">
            @include('alert')
        </div>
<!------------------------------------------------->

        <div class="table-responsive cart_info">
            <table class="table">
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
                                <a class="cart_quantity_up" href=" {{ route('IncreaseProduct', ['id' => $item['data']['id']]) }} "> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value="{{ $item['quantity'] }}" autocomplete="off" size="2">
                                <a class="cart_quantity_down" href=" {{ route('DecreaseProduct', ['id' => $item['data']['id']]) }} "> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">£{{ $item['totalSinglePrice'] }}</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{ route('deleteItemFromCart', ['id' => $item['data']['id']] )}} "><i class="fa fa-times"></i></a>
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
                <ul>             
                    <li>Total Items <span>{{ $cartItems->totalQuantity}}</span></li>
                    <li>Shipping Cost <span>Free</span></li>
                    <li>VAT incl. <span> 20% </span></li>
                    <li>Total <span>£{{ $cartItems->totalPrice}} </span></li>
                </ul>
                <a class="btn btn-default update" href="">Update</a>
                <a class="btn btn-default check_out" href="{{ route('checkoutproducts') }}">Check Out</a>
                <!-------- route('checkoutproducts')------>
            </div>
        </div>
    </div>
</section><!-----/#do_action-->


@include('layouts.footer')



