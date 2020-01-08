@extends('frontend.layouts.master')

@section('content')
<link href="https://www.emedix.in/assets/css/owl.carousel.css" rel="stylesheet">
<link href="https://www.emedix.in/assets/css/owl.theme.css" rel="stylesheet">

<div class="container main-container headerOffset">
    <div class="row">
        <div class="breadcrumbDiv col-lg-12">
            <ul class="breadcrumb">
                <li><a href="./">Home</a></li>
                <li><a href="/">{{$products[0]->category}}</a></li>
                <li class="active">{{$products[0]->title}}</li>
            </ul>
        </div>
    </div>
    <div class="row transitionfx">
        <div class="col-lg-6 col-md-6 col-sm-6 productImageZoom" >
            <div class='zoom' id='zoomContent'>
                <a><img class='zoomImage1 img-responsive' data-src='/uploads/product/{{$products[0]->image}}' src='/uploads/product/{{$products[0]->image}}'/></a>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-5">
            <h1 class="product-title">{{$products[0]->title}}</h1>
            <h3 class="product-code">BRAND: {{$products[0]->brand}}</h3>
            @if($products[0]->color !='N/A')
            <h3 class="product-code">Color: {{$products[0]->color}}</h3>
            @endif
            <div class="product-price">
                <span class="price-sales" id="sales_price616">৳ {{$products[0]->sales_price}}</span>
                <!--span class="price-standard"><i class="fa fa-inr" aria-hidden="true"></i> 199</span-->
                <span class="price-sales" id="type616"></span>
			</div>
            <!-- <div class="details-description">{!!$products[0]->description!!}</div> -->
            <div class="cart-actions">
                <div class="addto row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        @if($products[0]->balqty>0)
                        <button class="button btn-block btn-cart cart first add2cart" data-id="{{$products[0]->product_id}}" type="button">Add To Cart
                        </button>
                        @else
                        <button class="button btn-block btn-cart cart first" data-id="{{$products[0]->product_id}}" type="button" disabled>Stock Out
                        </button>
                        @endif

                    </div>
                </div>
                <div style="clear:both"></div>
                @if($products[0]->balqty>=1)
                <h3 class="incaps"><i class="fa fa fa-check-circle-o color-in"></i> In stock</h3>
                @endif
                <h3 class="incaps"><i class="glyphicon glyphicon-time"></i> On Time Delivery</h3>
            </div>
            <!--/.cart-actions-->
            <div class="clear"></div>
            <div class="product-tab w100 clearfix">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
                    <li><a href="#size" data-toggle="tab">Size</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="details">{!!$products[0]->description!!}</div>
                    <div class="tab-pane" id="size">{{$products[0]->size}}</div>
                </div>
                <!-- /.tab content -->
            </div>
            <!--/.product-tab-->
            <div style="clear:both"></div>
            <div class="product-share clearfix">
                <p> SHARE </p>
                <div class="socialIcon">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}" data-image="nivea bath lemon shower gel - Copy.jpg" data-title="Nivea Bath Care Lemon and Oil Shower Gel, 250ml" data-desc="" class="btnShare"><i class="fa fa-facebook"></i></a>
					<a href="#"> <i class="fa fa-twitter"></i></a>
                    <a href="#"> <i class="fa fa-google-plus"></i></a>
                    <a href="#"> <i class="fa fa-pinterest"></i></a>
				</div>
            </div>
        </div>
        <!--/ right column end -->
    </div>
    <div class="row recommended">
        <h1> YOU MAY ALSO LIKE </h1>
		<div id="SimilarProductSlider">
            @foreach($sameitem as $product)
            <div class="item">
                <div class="product"><a class="product-image" href="{{ url('product', [$product->product_id, str_slug($product->title)] )}}"> <img src="/uploads/product/{{$product->image}}" alt="img"> </a>
                    <div class="description">
                        <h4><a href="{{ url('product', [$product->product_id, str_slug($product->title)] )}}">{{$product->title}}</a></h4>

                        <div class="price"><span><i class="fa fa-inr" aria-hidden="true"></i> {{$product->sales_price}}</span></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div style="clear:both"></div>
</div>
<div class="gap"></div>



<script src="https://www.emedix.in/assets/js/owl.carousel.min.js"></script>
<script>

$(document).ready(function () {
    function customPager() {
        $.each(this.owl.userItems, function (i) {
            var pagination1 = $('.owl-controls .owl-pagination > div:first-child');
            var pagination = $('.owl-controls .owl-pagination');
            $(pagination[i]).append("<div class=' owl-has-nav owl-next'><i class='fa fa-angle-right'></i>  </div>");
            $(pagination1[i]).before("<div class=' owl-has-nav owl-prev'><i class='fa fa-angle-left'></i> </div>");
        });
    }


// YOU MAY ALSO LIKE  carousel

    $("#SimilarProductSlider").owlCarousel({
        navigation: false, // Show next and prev buttons
        afterInit: customPager,
        afterUpdate: customPager
    });


    var SimilarProductSlider = $("#SimilarProductSlider");
    SimilarProductSlider.owlCarousel({
        navigation: false, // Show next and prev buttons
        afterInit: customPager,
        afterUpdate: customPager
    });

    // Custom Navigation Events
    $("#SimilarProductSlider .owl-next").click(function () {
        SimilarProductSlider.trigger('owl.next');
    })

    $("#SimilarProductSlider .owl-prev").click(function () {
        SimilarProductSlider.trigger('owl.prev');
    })

});

</script>
@endsection