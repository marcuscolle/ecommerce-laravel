<!--------show each element of the items inside our cart---------->
<!------ $item['data']['name']  = inside [] because is accessing an array otherwise would be use -> to access object ---->
@foreach( $cartItems->items as $item)

    <br>
    <td class="active">{{ $item['data']['id'] }}</td> 
    <td class="active"><img src="{{Storage::disk('local')->url('product_images/' .  $item['data']['image'])}}" width="100" height="100"/></td>
    <td class="active">{{ $item['data']['name'] }}</td>
    <td class="active">{{ $item['data']['description'] }}</td>
    <td class="active">{{ $item['data']['type'] }}</td>
    <td class="active">{{ $item['data']['price'] }}</td>
    <br>

@endforeach
