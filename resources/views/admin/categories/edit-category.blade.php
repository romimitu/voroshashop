@extends('admin.master.layout')

@section('content')
    <section class="content-header">
      <h1>Category Setup</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Main Category</h3>
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

                            {!! Form::open(['url' => ['/category', $category->id], 'method' =>'PATCH', 'class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
                                <div class="modal-body">
                                    <div class="form-group none">
                                        <label class="col-sm-4 control-label">Parent Category</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="parent_id">
                                                <option value="0" selected>Select Category</option>
                                                @foreach($datas as $data)
                                                    <option value="{{ $data->id }}" {{$data->id == $category->parent_id  ? 'selected' : ''}}>{{ $data->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Name</label>
                                        <div class="col-sm-8">
                                        {!! Form::text('name',isset($category->name) ? $category->name : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Status</label>
                                        <div class="col-sm-8">
                                            <select name="status" class="form-control">
                                                <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Publish</option>
                                                <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Hide</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Image</label>
                                        <div class="col-sm-8">
                                            {!! Form::file('image', ['class'=> 'form-control']) !!}
                                            <img src="/{{$category->image}}" height="80" >
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    {!! Form::submit('Submit ', ['class'=> 'btn btn-primary']) !!}
                            {!! Form::close() !!}
                                    {!! Form::open([ 'method' => 'Delete', 'url' => ['/category', $category->id]]) !!}
                                    {!! Form::submit('Delete',['class'=>'btn-danger btn']) !!}
                                    {!! Form::close() !!}
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

