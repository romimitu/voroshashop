@extends('admin.master.layout')

@section('content')
    <section class="content-header">
      <h1>Banner Setup</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Banner</h3>
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
                        <div class="table-responsive">
                            {!! Form::open(['url' => ['/features', $feature->id], 'method' =>'PATCH', 'class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Title</label>
                                        <div class="col-sm-10">
                                            {!! Form::text('title',isset($feature->title) ? $feature->title : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Sub Title</label>
                                        <div class="col-sm-10">
                                            {!! Form::text('subtitle',isset($feature->subtitle) ? $feature->subtitle : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Page Link</label>
                                        <div class="col-sm-10">
                                            {!! Form::text('page_link',isset($feature->page_link) ? $feature->page_link : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Image</label>
                                        <div class="col-sm-10">
                                            {!! Form::file('image', ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Close">
                                    {!! Form::submit('Submit ', ['class'=> 'btn btn-primary']) !!}
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

