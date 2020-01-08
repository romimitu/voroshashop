@extends('frontend.layouts.master')

@section('content')
<style>
.blog-img{width: 400px;float: left;margin-right: 10px;}
</style>
<div class="container main-container headerOffset">
    <div class="row">
        <div class="breadcrumbDiv col-lg-12">
            <ul class="breadcrumb">
                <li><a href="./">Home</a></li>
                <li><a href="/our-blog">Blog</a></li>
                <li class="active">{{$blog->title}}</li>
            </ul>
        </div>
    </div>
    <div class="row transitionfx">
        <div class="col-sm-12">
            <h1 class="product-title">{{$blog->title}}</h1>
            <div class="cart-actions">
                <i class="glyphicon glyphicon-time"></i> {{ $blog->created_at->format('j M Y') }}
            </div>
            <img class='img-responsive blog-img' src='/{{$blog->image}}'/>
            {!! $blog->details !!}
        </div>
        <!--/ right column end -->
    </div>
</div>
<div class="gap"></div>

@endsection