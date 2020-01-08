@extends('frontend.layouts.master')

@section('content')

<div class="container-fluid" style="margin-top:80px; height:476px; background:url('/images/1.jpg'); background-size: cover;">
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
</div>
<div style="clear:both"></div>
<div class="container main-container headerOffset globalPaddingBottom" style="padding-top:20px">
    <div class="row">
        <div class="col-lg-12">
            <hr class="hr3">
        </div>
    </div>
    <div class="row featuredPostContainer ">
        <div class="featuredImageLook3">
            @foreach($categories as $category)
            <div class="col-md-4 col-sm-6 col-xs-6 col-xs-min-12">
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
                    <h1 class="parallaxPrce" style="color:#15a488"> <b>BUY MEDICINES</b> </h1>
                    <h2 class="uppercase" style="color:#15a488">WE DELIVER MEDICINES AT YOUR DOORSTEP WITHIN 24 HOURS</h2><br>
                    <h3 style="color:#111; font-weight:500"> YOU SELECT THE DATE AND TIME. WE DELIVER THE PRODUCTS TO YOU. SERVICE AVAILABLE IN Dhaka</h3>
                    <div style="clear:both"></div>
                    <a class="btn btn-success btn-lg " href="/shop" id="showall"> <i class="fa fa-shopping-cart"></i> SHOP NOW </a>
                </div>
            </div>
        </div>
        <!--/.row-->
    </div>
    <!--/.container-->
</div>
@endsection