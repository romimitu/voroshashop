@extends('frontend.layouts.master')

@section('content')

<div class="container main-container headerOffset">
  <div class="row">
      <div class="breadcrumbDiv col-sm-12">
          <ul class="breadcrumb">
              <li><a href="/"> Home </a></li>
              <li class="active"> {{$data->name}}</li>
          </ul>
      </div>
  </div>
  <section class="padding-small">
    <div class="container">
      <div class="row">
        <!-- Customer Sidebar-->
        @include('frontend.profile.sidebar')
        <div class="col-lg-8 col-xl-9 pl-lg-3">
          <!-- <div class="block-header mb-5">
            <h5>Change password  </h5>
          </div>
          <form class="content-block">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="password_old" class="form-label">Old password</label>
                  <input id="password_old" type="password" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="password_1" class="form-label">New password</label>
                  <input id="password_1" type="password" class="form-control">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="password_2" class="form-label">Retype new password</label>
                  <input id="password_2" type="password" class="form-control">
                </div>
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Change password</button>
            </div>
          </form> -->

          @if (Session::has('message'))
              <div class="text-center alert-danger">{{ Session::get('message') }}</div>
          @endif
          
          @if (count($errors) > 0)
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          
          {!! Form::open(['url' => ['/user/profile', $data->id], 'method' =>'PATCH', 'class'=>'content-block','enctype'=>"multipart/form-data"]) !!}
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="form-label">Name</label>
                  <input name="name" type="text" value="{{$data->name}}" class="form-control">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="form-label">Mobile</label>
                  <input name="mobile" value="{{$data->mobile}}" type="text" class="form-control">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="form-label">Email</label>
                  <input name="email" type="email" value="{{$data->email}}" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              @if($data->userdetails)
              <div class="col-sm-6 col-md-3">
                <div class="form-group">
                  <label class="form-label">Address</label>
                  <input name="address" type="text" value="{{$data->userdetails->address}}" class="form-control">
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="form-group">
                  <label class="form-label">City</label>
                  <select name="city" class="form-control" id="txtCity">
                      <option value="0">Select</option>
                      @foreach($city as $name)
                      <option value="{{$name->city}}" {{$name->city == $name->city  ? 'selected' : ''}}>{{$name->city}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              @endif
              <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Save changes</button>
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </section>
</div>
@endsection