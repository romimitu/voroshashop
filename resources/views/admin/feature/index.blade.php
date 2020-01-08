@extends('admin.master.layout')

@section('content')
    <section class="content-header">
      <h1>Features Setup</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Featured Area</h3>
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
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <th class="col-sm-1">Sl</th>
                                        <th class="col-sm-3">Title</th>
                                        <th class="col-sm-4">Sub Title</th>
                                        <th class="col-sm-2">Image</th>
                                        <th class="col-sm-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="MainCatbody">
                                    @foreach($data as $index => $feature)
                                    <tr>
                                        <td>{{$index +1}}</td>
                                        <td>{{$feature->title}}</td>
                                        <td>{{$feature->subtitle}}</td>
                                        <td><img src="/{{$feature->image}}" class="img-responsive" height="120px"></td>
                                        <td>
                                            <a href="{{ url('/features/'.$feature->id.'/edit') }}"><i class="fa fa-edit btn-primary btn btn-sm"></i></a>
                                            {!! Form::close() !!}
                                            {!! Form::open([ 'method' => 'Delete', 'url' => ['/features', $feature->id]]) !!}
                                            {!! Form::submit('Delete',['class'=>'btn-danger btn btn-sm']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="text-center">
                                <?php echo $data->render(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <a href="javascript:;" class="btn btn-sm btn-warning pull-right" data-toggle="modal" data-target="#addMainCat">Add New</a>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="addMainCat">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Banner</h5>
                                </div>
                                {!! Form::open(['url' => '/features', 'method' =>'post', 'class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Title</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="title">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Sub Title</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="subtitle">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Page Link</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="page_link">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Image</label>
                                        <div class="col-sm-8">
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
        </div>
    </section>
@endsection

