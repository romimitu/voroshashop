@extends('frontend.layouts.master')

@section('content')

<!-- <div class="container-fluid" style="margin-top:80px; height:476px; background:url('/images/1.jpg'); background-size: cover;">
    <div align="center" style="margin-top:90px">
        <h1 class="search_title" style="font-size:48px; color:#fff;text-shadow:0px 0px 5px #888;">Search Medicines And Product</h1>
        <br />

        {!! Form::open(['url' => ['/q/product'], 'method' =>'post','enctype'=>"multipart/form-data"]) !!}
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon2" style="background:transparent; border:none;"> </span>
            <input type="text" class="form-control" placeholder="Search Medicines And Product" name="search" style="height:60px; font-size:22px; text-align:center; background:rgba(255,255,255,.8); color:#111;" id="SearchAllProduct">
            <input class="btn btn-success none" type="submit" value="Search">
        </div>
        {!! Form::close() !!}
        <center>
            <h1 class="search_title" style="font-size:31px; margin-top:20px; color:#fff;text-shadow:0px 0px 5px #888;"> <b> (Discounts will be given on current MRP) </b></h1>
        </center>
    </div>
    <br>
</div> -->
<div class="container" style="margin-top: 60px;">
    <div class="row">
        <div class="col-md-8 col-sm-8 col-xs-12 col-xs-min-12">
            <div id="myCarousel" class="carousel slide">
                <!-- Carousel items -->
                <div class="carousel-inner">
                    @foreach($sliders as $slider)
                    <div class="item"><a href="{{$slider->page_link}}"><img src="{{$slider->image}}" class="img-responsive"></a></div>
                    @endforeach
                </div>
                <!-- Carousel nav --> 
                <a class="carousel-control left-flat" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                <a class="carousel-control right-flat" href="#myCarousel" data-slide="next">&rsaquo;</a>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12 col-xs-min-12 carousel">
            @foreach($features as $feature)
            <div class="feature-item"><a href="{{$feature->page_link}}"><img src="{{$feature->image}}" class="img-responsive"></a></div>
            @endforeach
        </div>
    </div>
</div>

<div style="clear:both"></div>
<div class="container" style="padding-top:20px">
    <div class="row">
        <div class="col-lg-12">
            <hr class="hr3">
        </div>
    </div>
    <div class="row featuredPostContainer ">
        <div class="featuredImageLook3">
            @foreach($categories as $category)
            <div class="col-md-3 col-sm-4 col-xs-6 col-xs-min-12">
                <div class="inner">
                    <div class="box-content-overly box-content-overly-white">
                        <div class="box-text-table">
                            <div class="box-text-cell ">
                                <div class="box-text-cell-inner dark">
                                    <h1 class="uppercase">{{$category->name}} </h1>
                                    <hr class="submini">
                                    <a href="{{ url('category-product', [$category->id, str_slug($category->name)] )}}" class="btn btn-inverse" id="hair_and_beautyl1"> SHOP NOW</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/.box-content-overly -->
                    <div class="img-title"> {{$category->name}}</div>
                    <a class="img-block" href="javascript:"> <img class="img-responsive" src="/{{$category->image}}" alt="img"></a>
                </div>
            </div>
            @endforeach
        </div>
        <!--/.featuredImageLook3-->
    </div>
    <!--/.featuredPostContainer-->
</div>
<!-- /main container -->
<div class="container">
    <div class="row recommended">
        <h1> YOU MAY ALSO LIKE </h1>
        <div id="SimilarProductSlider">
            @foreach($products as $product)
                <div class="item">
                  <div class="product">
                    <div class="image"><a href="{{ url('product', [$product->product_id, str_slug($product->title)] )}}"><img src="/uploads/product/{{$product->image}}" height="240px"></a></div>
                    <div class="description">
                      <h4><a href="{{ url('product', [$product->product_id, str_slug($product->title)] )}}" id="item_title">{{$product->title}}</a></h4>
                      <span class="size" id="pkg_qty0">1</span>
                      <span class="size">{{$product->category}}</span>
                    </div>
                    <div class="price"> 
                      <span>৳ <span id="sales_price0">{{$product->sales_price}}</span></span>
                      <div class="action-control">
                      @if($product->balqty>0)
                        <button class="btn btn-primary add2cart" data-id="{{$product->product_id}}" type="button"><i class="glyphicon glyphicon-shopping-cart"></i> Add to cart</button>
                      @else
                        <button class="btn btn-info add2cart" data-id="{{$product->product_id}}" type="button" disabled><i class="glyphicon glyphicon-shopping-cart"></i> Not In Stock</button>
                      @endif
                      </div>
                    </div>
                  </div>
                </div>
            @endforeach
        </div>
    </div>    
</div>
<div style="clear:both"></div>
<div class="w100 sectionCategory">
    <div class="container">
        <div class="sectionCategoryIntro text-center">
            <h1>Featured Brands</h1>
        </div>
        <div class="row subCategoryList clearfix">
            <div class="col-md-2 col-sm-3 col-xs-4  col-xs-mini-6  text-center ">
                <div class="thumbnail equalheight"><a class="subCategoryThumb" href="javascript:"><img src="images/1.png" class="img-rounded " alt="img"> </a>
                    <!--a
                    class="subCategoryTitle"><span> T shirt </span></a-->
                </div>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-4 col-xs-mini-6 text-center">
                <div class="thumbnail equalheight"><a class="subCategoryThumb" href="javascript:"><img src="images/2.png" class="img-rounded " alt="img"> </a>
                    <!--a
                    class="subCategoryTitle"><span> T shirt </span></a-->
                </div>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-4 col-xs-mini-6 text-center">
                <div class="thumbnail equalheight"><a class="subCategoryThumb" href="javascript:"><img src="images/3.png" class="img-rounded " alt="img"> </a>
                    <!--a
                    class="subCategoryTitle"><span> T shirt </span></a-->
                </div>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-4 col-xs-mini-6 text-center">
                <div class="thumbnail equalheight"><a class="subCategoryThumb" href="javascript:"><img src="images/4.png" class="img-rounded " alt="img"> </a>
                    <!--a
                    class="subCategoryTitle"><span> T shirt </span></a-->
                </div>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-4 col-xs-mini-6 text-center">
                <div class="thumbnail equalheight"><a class="subCategoryThumb" href="javascript:"><img src="images/5.png" class="img-rounded " alt="img"> </a>
                    <!--a
                    class="subCategoryTitle"><span> T shirt </span></a-->
                </div>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-4 col-xs-mini-6 text-center">
                <div class="thumbnail equalheight"><a class="subCategoryThumb" href="javascript:"><img src="images/6.png" class="img-rounded " alt="img"> </a>
                    <!--a
                    class="subCategoryTitle"><span> T shirt </span></a-->
                </div>
            </div>
        </div>
        <!--/.row-->
    </div>
    <!--/.container-->
</div>
<div class="parallax-section parallax-image-1">
    <div class="container">
        <div class="row ">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="parallax-content clearfix">
                    <h1 class="parallaxPrce" style="color:#15a488"> <b>BUY PRODUCTS</b> </h1>
                    <h2 class="uppercase" style="color:#15a488">WE DELIVER PRODUCTS AT YOUR DOORSTEP WITHIN 24 HOURS</h2><br>
                    <h3 style="color:#111; font-weight:500"> YOU SELECT THE DATE AND TIME. WE DELIVER THE PRODUCTS TO YOU. SERVICE AVAILABLE IN DHAKA</h3>
                    <div style="clear:both"></div>
                    <a class="btn btn-success btn-lg " href="/shop" id="showall"> <i class="fa fa-shopping-cart"></i> SHOP NOW </a>
                </div>
            </div>
        </div>
        <!--/.row-->
    </div>
    <!--/.container-->
</div>
<script>
$(function() {
    $(".carousel-inner .item:first-child").addClass("active");
});
</script>
@endsection
