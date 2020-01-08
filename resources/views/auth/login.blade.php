@extends('frontend.layouts.master')

@section('content')

<div class="container main-container headerOffset">
    <div class="row">
        <div class="breadcrumbDiv col-sm-12">
            <ul class="breadcrumb">
                <li><a href="/"> Home </a></li>
                <li class="active"> Member Login</li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <h1 class="section-title-inner"><span> <i class="fa fa-sign-in"> </i> {{ __('Login') }} </span></h1>

            <div class="row userInfo">
                <div class="col-xs-12 col-sm-12">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif

                    </form>
                    <div class="clear clearfix">
                        <ul class="pager">
                            <li class="previous pull-right"><a href="/register"> Create Account </a></li>
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
