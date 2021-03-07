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
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Address</th>
                          <th>Postcode</th>
                          <th>Email</th>
                          <th>Phone</th>
                        </tr>
                    </thead>
                    <tbody>
            
                        @foreach($customers as $customer)
                        <tr>
                            <td>{{ $customer->first_name }}</td>
                            <td>{{ $customer->last_name }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>{{ $customer->postcode }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone }}</td>                                                   
                        </tr>
                        @endforeach  
            
                    </tbody>      
                
                </table>  

                <!---- function links show pagination numbers and arrows to "turn the page"  ------->
                <div class="text-center">
                  <div class="pagination col-sm-12"> 
                      {{ $customers->links('pagination::bootstrap-4') }}
                  </div>  
                </div> 
              </div>
        </div>
      </div>   
    </body>
</html>