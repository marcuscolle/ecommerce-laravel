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
            
                        @foreach($customers as $customers)
                        <tr>
                            <td>{{ $customers->first_name }}</td>
                            <td>{{ $customers->last_name }}</td>
                            <td>{{ $customers->address }}</td>
                            <td>{{ $customers->postcode }}</td>
                            <td>{{ $customers->email }}</td>
                            <td>{{ $customers->phone }}</td>                                                   
                        </tr>
                        @endforeach  
            
                    </tbody>      
                
                </table>  

                <!---- function links show pagination numbers and arrows to "turn the page"  ------->
                
              </div>
        </div>
      
        <a class="btn brn-primary" href="{{ route('dashboard') }}"> Back </a>
      </div>   
    </body>
</html>