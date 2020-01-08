@extends('frontend.layouts.master')

@section('content')
<div class="parallaxOffset no-padding fixedContent contact-intro">
    <div class="w100 map">
        {!! $aboutinfo[0]->map !!}
    </div>
</div>
<div class="wrapper whitebg contact-us">
    <div class="container ">
        <div class="row innerPage">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row userInfo">
                    <div class="col-xs-12 col-sm-12">
                        <h1 class="title-big text-center section-title-style2">
                            <span> Contact Us </span>
                        </h1>
                        <p class="lead text-center">
                            Feel Free to contact our team for any query or suggestion.
                        </p>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h3 class="block-title-5">Customer care</h3>
                                <p>For all customer support
                                    <br>
                                    <strong>Phone number</strong>: {{ $aboutinfo[0]->mobile }}
                                    <br>
                                    <strong>Email us</strong>: {{ $aboutinfo[0]->email }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="gap"></div>
</div>

@endsection