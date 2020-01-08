@extends('frontend.layouts.master')

@section('content')

<div class="container main-container headerOffset">
    <div class="row">
        <div class="breadcrumbDiv col-sm-12">
            <ul class="breadcrumb">
                <li><a href="/"> Home </a></li>
                <li class="active"> Confirm Password</li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <h1 class="section-title-inner"><span> <i class="fa fa-unlock-alt"> </i> {{ __('Confirm Password') }}? </span></h1>

            <div class="row userInfo">
                <div class="col-xs-12 col-sm-12">
                    <p>{{ __('Please confirm your password before continuing.') }} </p>
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Confirm Password') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif

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
