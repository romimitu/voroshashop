
@extends('admin.master.layout')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">About Us</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
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
                        {!! Form::open(['url' => ['/abouts', $about->id], 'method' =>'PATCH', 'class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}

                        <div class="form-group">
                            {!! Form::label('slogan','Slogan',['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-md-10">
                                {!! Form::text('slogan',isset($about->slogan) ? $about->slogan : null, ['class'=> 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('notice','Notice',['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-md-10">
                                {!! Form::text('notice',isset($about->notice) ? $about->notice : null, ['class'=> 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('address', 'Address', ['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('address',isset($about->address) ? $about->address : null,['class'=> 'form-control']) !!}
                            </div>
                            {!! Form::label('free_ship_upto', 'Free shipUpto', ['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-md-2">
                                {!! Form::text('free_ship_upto',isset($about->free_ship_upto) ? $about->free_ship_upto : null,['class'=> 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', 'Email', ['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-md-2">
                                {!! Form::text('email',isset($about->email) ? $about->email : null,['class'=> 'form-control']) !!}
                            </div>
                            {!! Form::label('mobile', 'Mobile', ['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-md-2">
                                {!! Form::text('mobile',isset($about->mobile) ? $about->mobile : null,['class'=> 'form-control']) !!}
                            </div>
                            {!! Form::label('facebook', 'Facebook URL', ['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-md-2">
                                {!! Form::text('facebook',isset($about->facebook) ? $about->facebook : null,['class'=> 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('twitter', 'twitter URL', ['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-md-2">
                                {!! Form::text('twitter',isset($about->twitter) ? $about->twitter : null,['class'=> 'form-control']) !!}
                            </div>
                            {!! Form::label('instagram', 'Instagram URL', ['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-md-2">
                                {!! Form::text('instagram',isset($about->instagram) ? $about->instagram : null,['class'=> 'form-control']) !!}
                            </div>
                            {!! Form::label('youtube', 'Youtube URL', ['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-md-2">
                                {!! Form::text('youtube',isset($about->youtube) ? $about->youtube : null,['class'=> 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('map', 'Google Map', ['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-md-10">
                                {!! Form::text('map',isset($about->map) ? $about->map : null,['class'=> 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('about', 'About Us', ['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-md-10">
                                {!! Form::textarea('about',isset($about->about) ? $about->about : null,['class'=> 'form-control details']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('mission_vision', 'Mission/Vision', ['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-md-10">
                                {!! Form::textarea('mission_vision',isset($about->mission_vision) ? $about->mission_vision : null,['class'=> 'form-control details']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('header_logo', 'HeaderLogo', ['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-md-2">
                                @if(isset($about->header_logo))
                                    <img src="/{{$about->header_logo}}" class="img-responsive" />
                                @else
                                    <img src="http://www.placehold.it/200x150/" alt="" />
                                @endif
                                {!! Form::file('header_logo') !!} 
                            </div>
                            {!! Form::label('footer_logo', 'FooterLogo', ['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-md-2">
                                @if(isset($about->footer_logo))
                                    <img src="/{{$about->footer_logo}}" class="img-responsive" />
                                @else
                                    <img src="http://www.placehold.it/200x150/" alt="" />
                                @endif
                                {!! Form::file('footer_logo') !!} 
                            </div>
                            {!! Form::label('about_img', 'AboutUs Image', ['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-md-2">
                                @if(isset($about->about_img))
                                    <img src="/{{$about->about_img}}" class="img-responsive" />
                                @else
                                    <img src="http://www.placehold.it/200x150/" alt="" />
                                @endif
                                {!! Form::file('about_img') !!} 
                            </div>
                        </div>

                        <div class="form-group text-center">
                            {!! Form::submit('Submit ', ['class'=> 'btn btn-success']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection