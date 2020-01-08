@extends('frontend.layouts.master')

@section('content')

<div class="container main-container headerOffset">
    <div class="row">
        <div class="breadcrumbDiv col-sm-12">
            <ul class="breadcrumb">
                <li><a href="/"> Home </a></li>
                <li class="active"> Verify Your Email</li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <h1 class="section-title-inner"><span> <i class="fa fa-unlock-alt"> </i>{{ __('Verify Your Email Address') }}? </span></h1>

            <div class="row userInfo">
                <div class="col-xs-12 col-sm-12">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    
                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                    <div class="clear clearfix">
                        <ul class="pager">
                            <li class="previous pull-right"><a href="/"> &larr; Back to Home </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="clear:both"></div>
</div>
<div class="gap"></div>
@endsection
