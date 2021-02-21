@include('layouts.admin')
@yield('center')


<html>
    <body>
      <div class="container">
        <div class="row">  

              <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                          <th>Order_id</th>
                          <th>Date</th>
                          <th>Status</th>
                          <th>Price</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Address</th>
                          <th>Postcode</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Delivery Date</th>
                        </tr>
                    </thead>
                    <tbody>
            
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->order_id }}</td>
                            <td>{{ $order->date }}</td>
                            <td>{{ $order->status }}</td>
                            <td>£{{ $order->price }}</td>
                            <td>{{ $order->first_name }}</td>
                            <td>{{ $order->last_name }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->postcode }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->del_date }}</td>                                                   
                        </tr>
                        @endforeach  
            
                    </tbody>      
                
                </table>  

                <!---- function links show pagination numbers and arrows to "turn the page"  ------->
                <!-----$orders->links()----->

              </div>
        </div>
        <a class="btn brn-primary" href="{{ route('dashboard') }}"> Back </a>
      </div>          
    </body>
</html>