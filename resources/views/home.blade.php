@include('layouts.header')
@yield('center')


<div class="container checkout">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header"><h4>Welcome to the {{ __('Dashboard') }}!</h4></div>
                <hr>
                <br>


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                                       
                    <h5>Hello! {!! Auth::user()->name !!}</h5>
                    <p><strong>email:</strong> {!! Auth::user()->email !!}</p>

                    <a href="{{ route('products') }}" class="btn btn-primary">Main Website </a>
                    
                    @if($userData->isAdmin())
                        <a href="{{ route('dashboard') }}" class="btn btn-primary"> Admin Panel </a>   
                    @else 
                        <div class="btn btn-primary">Admin Only </div>
                        
                    @endif
                    

                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
