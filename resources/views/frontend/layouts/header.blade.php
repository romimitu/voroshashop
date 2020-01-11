    <header>
        <!-- Fixed navbar start -->
        <div class="navbar navbar-tshop navbar-fixed-top megamenu" role="navigation">
            <div class="navbar-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6">
                            <div class="pull-left ">
                                <ul class="userMenu ">
                                    <li class="phone-number"><a href="tel:{!! $aboutinfo[0]->mobile !!}"> <span> <i class="glyphicon glyphicon-phone-alt "></i></span> <span class="hidden-xs" style="margin-left:5px"> {!! $aboutinfo[0]->mobile !!} &nbsp;&nbsp;&nbsp;</span>
                                        </a></li>
                                    <li class="phone-number"><a href="tel:{!! $aboutinfo[0]->mobile !!}"> <span> </span> <span class="hidden-xs" style="margin-left:5px"><i class="fa fa-whatsapp"></i> {!! $aboutinfo[0]->mobile !!}</span>
                                        </a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6 no-margin no-padding">
                            <div class="pull-right">
                                <ul class="userMenu">
                                    @guest()                                    
                                    <li><a href='/login'><span class='hidden-xs'>Sign In</span><i class='glyphicon glyphicon-log-in hide visible-xs'></i></a></li>
                                    <li class="hidden-xs"><a href="/register"> CreateAccount </a></li>
                                    @endguest
                                    @auth()
                                    @hasanyrole($roles)
                                    <li class='hidden-xs'><a href='/dashboard'>Dashboard</a></li>
                                    @endhasanyrole
                                    <li class='hidden-xs'><a href='/user/profile'>Profile</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">Logout</a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                    @endauth
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/.navbar-top-->
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="sr-only"> Toggle navigation </span> <span class="icon-bar"> </span> <span class="icon-bar"> </span> <span class="icon-bar"> </span></button>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-cart"><i class="fa fa-shopping-cart colorWhite"> </i> <span class="cartRespons colorWhite"> Cart &nbsp; <span class="cartPrice"></span> </span></button>
                    <a class="navbar-brand " href="/"> <img src="/{{ $aboutinfo[0]->header_logo }}" alt="VOROSASHOP" width="30"> </a>
                </div>
                <!-- this part is duplicate from cartMenu  keep it for mobile -->
                <div class="navbar-cart  collapse">
                    <div class="cartMenu  col-lg-4 col-xs-12 col-md-4 ">
                        <div class="miniCartFooter  miniCartFooterInMobile text-right">
                            <h3 class="text-right subtotal"> Subtotal: <span class="cartPrice"></span> </h3>
                            <a class="btn btn-sm btn-danger" href="/cart"> <i class="fa fa-shopping-cart"> </i> VIEW CART
                            </a> <a href="/checkout" class="btn btn-sm btn-primary"> CHECKOUT </a>
                        </div>
                        <!--/.miniCartFooter-->
                    </div>
                    <!--/.cartMenu-->
                </div>
                <!--/.navbar-cart-->
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav col-sm-2">
                        <li class="dropdown megamenu-80width "><a data-toggle="dropdown" class="dropdown-toggle" href="/shop"> SHOP
                                <b class="caret"> </b> </a>
                            <ul class="dropdown-menu">
                                <li class="megamenu-content">
                                    <!-- megamenu-content -->
                                    <ul class="col-lg-12  col-sm-12 col-md-12  unstyled noMarginLeft">
                                        <li>
                                            <p><strong> Categories </strong></p>
                                        </li>
                                        
                                        @foreach($allCategories as $category)
                                        <li><a href="{{ url('category-product', [$category->id, str_slug($category->name)] )}}" class="hair_and_beauty1">{{ $category->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="nav navbar-nav navbar-center col-sm-8">
                        {!! Form::open(['url' => ['/q/product'], 'method' =>'post','enctype'=>"multipart/form-data"]) !!}
                        <input type="text" class="form-control" placeholder="Search Medicines And Product" name="search" style=" text-align:center;margin-top:10px;" id="SearchAllProduct">
                        <input class="btn btn-success none" type="submit" value="Search">
                        {!! Form::close() !!}
                    </div>
                    <!--- this part will be hidden for mobile version -->
                    <div class="nav navbar-nav navbar-right hidden-xs">
                        <div class="dropdown  cartMenu "><a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-shopping-cart"> </i> <span class="cartRespons"> Cart &nbsp; <span class="cartPrice">{{$total ?? 0}}</span> </span> <b class="caret"> </b> </a>
                            <div class="dropdown-menu col-lg-4 col-xs-12 col-md-4 ">
                                <div class="miniCartTable scroll-pane">
                                    <table>
                                        <tbody>
                                            @foreach($cart as $key=>$product)
                                            <tr id="{{$product['id']}}">
                                                <td width="60%"><i class="fa fa-times-circle-o del_cart" onclick="removeCart({{$product['id']}})"></i> {{$product['title']}}</td>
                                                <td width="20%" align="right"><b>৳ {{$product['sales_price']}} X <span class="itemQty">{{$product['quantity']}}</span></b></td>
                                                <td width="20%" align="right">৳ <span class="itemPrice">{{$product['quantity'] * $product['sales_price']}}</span></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!--/.miniCartTable-->
                                <div class="miniCartFooter text-right">
                                    <h3 class="text-right subtotal"> Subtotal: <span class="cartPrice">{{$total ?? 0}}</span></h3>
                                    <a class="btn btn-sm btn-danger" href="/cart"> <i class="fa fa-shopping-cart"> </i> VIEW CART </a>
                                    <a href="/checkout" class="btn btn-sm btn-primary checkoutBtn"> CHECKOUT </a>
                                </div>
                                <!--/.miniCartFooter-->
                            </div>
                            <!--/.dropdown-menu-->
                        </div>
                        <!--/.cartMenu-->
                    </div>
                    <!--/.navbar-nav hidden-xs-->
                </div>
                <!--/.nav-collapse -->
            </div>
            <!--/.container -->
        </div>
    </header>