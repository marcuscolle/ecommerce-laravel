<div id="receipt" class="container checkout" style="border: 0.5px groove lightgray;">
    <div class="row">
        <div class="col-sm-12">
            <div class="text-center">
                <div class="total_area">
                    <h4><strong> Order ID:</strong> {{ $order_id }} </h4>
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
                               
                            </tbody>
                        </table>
                    </div>

                    <hr>
                    <h4><strong>Total Paid:</strong> £{{ $price }} </h4>
                    <hr>
                    <div class="text-center butt">
                        <a class="btn btn-primary" href="{{ route('products') }} ">Shop Again!</a>                        
                    </div>
                </div>
            </div>
        </div>
      </div>  
    </div>
</div>   
