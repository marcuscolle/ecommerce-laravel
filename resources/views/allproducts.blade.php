<!--- extends layouts.app --- navbar with login and register added with laravel auth ---->
@include('layouts.header')
@yield('center')

<div class="header-bottom"><!--header-bottom-->
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="mainmenu pull-left dorpdown-content">
                    <ul class="nav navbar-nav collapse navbar-collapse">
                        <li><a href="{{ route('products') }}" class="active">Home</a></li>
                        <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="sub-menu">
                                <li><a href="{{ route('products') }}">Products</a></li>
                                <li><a href="{{ route('menProducts') }}">Mens</a></li> 
                                <li><a href="{{ route('womenProducts') }}">Womens</a></li> 
                                <li><a href="{{ route('kids') }}">Kids</a></li> 
                                <li><a href="{{ route('accessories') }}">Accessories</a></li>
                                <li><a href="{{ route('shoes') }}">Shoes</a></li>  
                            </ul>
                        </li> 
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
            </div>

<!--------------------------------SEARCH BAR -------------------------------------------->           
            <div class="col-sm-3">
                <div class="search_box pull-right">
                    <form action="search" method="get">
                        <input type="text" name="searchText" placeholder="Search"/>
                        
                    </form>
                </div>
            </div>
<!--------------------------------SEARCH BAR -------------------------------------------->

        </div>
    </div>
</div><!--/header-bottom-->
</header><!--/header-->

<!----------------------alert message-------------->
<div class="container">
    @include('alert')
</div>
<!------------------------------------------------->


<section id="slider"><!--slider-->
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#slider-carousel" data-slide-to="1"></li>
                    <li data-target="#slider-carousel" data-slide-to="2"></li>
                </ol>
                
                <div class="carousel-inner">
                    <div class="item active">
                        <div class="col-sm-6">
                            <img class="carousel-img" src="images/carousel/men-nike3.jpg"/>
                        </div>
                        <div class="col-sm-6">
                            <img class="carousel-img" src="images/carousel/sale.png"/>
                        </div>
                    </div>
                    <div class="item">
                        <div class="col-sm-6">
                            <img class="carousel-img" src="images/carousel/sale.png"/>
                        </div>
                        <div class="col-sm-6">
                            <img class="carousel-img" src="images/carousel/men.jpg"/>
                        </div>
                    </div>   
                    <div class="item">
                        <div class="col-sm-6">
                            <img class="carousel-img" src="images/carousel/women-adidas2.jpg"/>
                        </div>
                        <div class="col-sm-6">
                            <img class="carousel-img" src="images/carousel/sale.png"/>
                        </div>
                    </div>                    
                </div>
                
                <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>        
        </div>
    </div>
</div>
</section><!--/slider-->

<section>
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <div class="left-sidebar">
                <h2>Category</h2>
                <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="mainmenu pull-left">
                                <div class="dropdown">
                                    <a class="dropbtn">Mens</a>
                                    <div class="dropdown-content">
                                      <a href="{{ route('menProducts') }}">All</a>
                                      <a href="{{ route('menPants') }}">Pants</a>
                                      <a href="{{ route('menShoes') }}">Shoes</a>
                                      <a href="{{ route('menShorts') }}">Shorts</a>
                                      <a href="{{ route('menShirts') }}">T-Shirts</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="mainmenu pull-left">
                                <div class="dropdown">
                                    <a class="dropbtn">Women</a>
                                    <div class="dropdown-content">
                                      <a href="{{ route('womenProducts') }}">All</a>
                                      <a href="{{ route('womenDress') }}">Dress</a>
                                      <a href="{{ route('womenPants') }}">Pants</a>
                                      <a href="{{ route('womenShoes') }}">Shoes</a>
                                      <a href="{{ route('womenShirts') }}">T-Shirts</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="mainmenu pull-left">
                                <div class="dropdown">
                                    <a class="dropbtn">Kids</a>
                                    <div class="dropdown-content">
                                      <a href="{{ route('kids') }}">Shoes</a>
                                      <a href="{{ route('kidsShoes') }}">Kids Shoes</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="mainmenu pull-left">
                                <div class="dropdown">
                                    <a class="dropbtn" href="{{ route('accessories') }}">Accessories</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="mainmenu pull-left">
                                <div class="dropdown">
                                    <a class="dropbtn">Shoes</a>
                                    <div class="dropdown-content">
                                      <a href="{{ route('shoes') }}">All</a>
                                      <a href="{{ route('kidsShoes') }}">Kids Shoes</a>
                                      <a href="{{ route('menShoes') }}">Mens Shoes</a>
                                      <a href="{{ route('womenShoes') }}">Women Shoes</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/category-products-->
            
                <div class="brands_products"><!--brands_products-->
                    <h2>Brands</h2>
                    <div class="brands-name">
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#"> <span class="pull-right"></span>Adidas</a></li>
                            <li><a href="#"> <span class="pull-right"></span>Nike</a></li>
                            <li><a href="#"> <span class="pull-right"></span>Puma</a></li>
                            <li><a href="#"> <span class="pull-right"></span>The North Face</a></li>
                            <li><a href="#"> <span class="pull-right"></span>Polo</a></li>
                            <li><a href="#"> <span class="pull-right"></span>Levis</a></li>
                            <li><a href="#"> <span class="pull-right"></span>Super Dry</a></li>
                            <li><a href="#"> <span class="pull-right"></span>Jack Jones</a></li>
                            <li><a href="#"> <span class="pull-right"></span>Vans</a></li>
                            <li><a href="#"> <span class="pull-right"></span>Gap</a></li>
                            <li><a href="#"> <span class="pull-right"></span>Lacoste</a></li>
                            <li><a href="#"> <span class="pull-right"></span>Converse</a></li>                           
                        </ul>
                    </div>
                </div><!--/brands_products-->
                
                <div class="price-range"><!--price-range-->
                    <h2>Price Range</h2>
                    <div class="well text-center">
                         <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                         <b class="pull-left">£ 0</b> <b class="pull-right">£ 600</b>
                    </div>
                </div><!--/price-range-->
                

                <!-------------------------------------shipping
                <div class="shipping text-center">
                    <img src="images/home/shipping.jpg" alt="" />
                </div>
                ------------------------------------>
            </div>
        </div>
        
        <div class="col-sm-9 padding-right">
            <div class="features_items"><!--features_items-->
                <h2 class="title text-center">Features Items</h2>
<!--------------------------------foreach added to loop our product ----------------------------------------->
                @foreach($products->shuffle() as $product)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">

                                    <div class="productinfo text-center">                              
                                        <img src="{{Storage::disk('s3')->url('https://ecomm-laravel.s3.eu-west-2.amazonaws.com' . 'public/product_images/' . $product->image)}}" width="300" height="200" />
                                        <h2>{{ $product->price }}</h2>
                                        <p>{{ $product->name }}</p>
                                        <p>{{ $product->brand }}</p>
                                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                    
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2>{{ $product->price }}</h2>
                                            <p>{{ $product->name }}</p>
                                            <p>{{ $product->brand }}</p>
                                            <!-----adding product to cart link--------->
                                            <!------1-param route name -------->
                                            <!------2-param id of our product------->
                                            <a href="{{route('AddToCartProduct', ['id'=>$product->id]) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                    </div>
                                    
                            </div>
                        </div>
                    </div>
                @endforeach                
<!---------------------------------------------end foreach of the products------------------------------------------------>
            </div><!--features_items-->         
        </div>



        <!------pagination added to the center of the screen page container/row, not on loop div page col-sm-9------>
        <div class="text-center">
            <div class="pagination col-sm-12"> 
                {{ $products->links('pagination::bootstrap-4') }}
            </div>  
        </div> 


    </div>
</div>
</section>



@include('layouts.footer')


