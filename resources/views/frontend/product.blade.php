@extends('frontend.layouts.master')

@section('content')

<div class="container main-container headerOffset">
  <!-- /.row  -->
  <div class="row">
    <!--left column-->
    <div class="col-lg-3 col-md-3 col-sm-12">
      <div class="panel-group" id="accordionNo">
        <!--Category-->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"><a data-toggle="collapse" href="#collapseCategory">
             <span class="pull-right"></span> Category (Touch to Collapse)</a></h4>
          </div>
          <div id="collapseCategory">
            <div class="panel-body">
              <ul class="nav nav-pills nav-stacked tree">
                @foreach($allCategories as $category)
                  <li><a href="{{ url('category-product', [$category->id, str_slug($category->name)] )}}" class="cate" id="cate1"> <span class="badge pull-right"></span> {{ $category->name }} </a>
                  </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
        <!--/Category menu end-->
      </div>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-12">
      @if($products[0])
      <div class="w100 clearfix category-top">
        @if(Request::route('id')==$products[0]->cat_id)
        <h2 id="cateName">{{$products[0]->category}}</h2>
        <!--  <div class="categoryImage"><img src="images/site/category.jpg" class="img-responsive" alt="img"></div> -->
        @endif
      </div>
      <div class="row subCategoryList clearfix">
        <div id="productlists">
          <div id="productlists">
            @foreach($products as $product)
            <div class="item col-lg-4 col-md-4 col-sm-4 col-xs-6">
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
      @else
      <h2 id="cateName">Sorry not found any item with this criteria. Return <a href="/shop" class="btn btn-sm btn-success">shop page.</a></h2>
      @endif
    </div>
  </div>
</div>
<div class="gap"></div>
@endsection