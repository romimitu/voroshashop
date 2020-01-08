@extends('frontend.layouts.master')

@section('content')

<div class="container main-container headerOffset">
    <div class="row">
        <div class="breadcrumbDiv col-lg-12">
            <ul class="breadcrumb">
                <li><a href="./">Home</a></li>
                <li class="active">Blog</li>
            </ul>
        </div>
    </div>
  <div class="row">
    <!--left column-->
    <div class="col-sm-12">
      <div class="row subCategoryList clearfix">
        <div id="productlists">
          <div id="productlists">
            @foreach($blogs as $blog)
            <div class="item col-lg-4 col-md-4 col-sm-4 col-xs-6">
              <div class="product">
                <div class="image"><a href="{{ url('our-blog', [$blog->id, str_slug($blog->title)] )}}"><img src="/{{$blog->image}}" height="240px"></a></div>
                <div>
                  <h4><a href="{{ url('our-blog', [$blog->id, str_slug($blog->title)] )}}" >{{$blog->title}}</a></h4>
                  <span class="size">{!! str_limit(strip_tags($blog->details), 130) !!}</span>
                  <span class="date"><i class="fa fa-clock-o"></i>{{ $blog->created_at->format('j M Y') }}</span>
                </div>
                <div class="price"> 
                  <div class="action-control">
                    <a class="btn btn-sm btn-primary" href="{{ url('our-blog', [$blog->id, str_slug($blog->title)] )}}"> read More</a>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="gap"></div>

@endsection