@extends('frontend.layouts.master')

@section('content')
<div class="container main-container headerOffset">
    <div class="row">
        <div class="breadcrumbDiv col-sm-12">
            <ul class="breadcrumb">
                <li><a href="/"> Home </a></li>
                <li class="active"> Forgot your password</li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <h1 class="section-title-inner"><span> <i class="fa fa-unlock-alt"> </i> {{ __('Reset Password') }}? </span></h1>

            <div class="row userInfo">
                <div class="col-xs-12 col-sm-12">
                    <p> To reset your password, enter the registered emial to receive reset link by email. </p>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1"> {{ __('E-Mail Address') }} </label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Send Password Reset Link') }}
                        </button>

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
