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
                        <h3 class="box-title">Product Size</h3>
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
                                        <th class="col-sm-3">Name</th>
                                        <th class="col-sm-3">Unit</th>
                                        <th class="col-sm-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="MainCatbody">
                                    @foreach($data as $index => $size)
                                    <tr>
                                        <td>{{$index +1}}</td>
                                        <td>{{$size->name}}</td>
                                        <td>{{$size->unit}}</td>
                                        <td>
                                            {!! Form::open([ 'method' => 'Delete', 'url' => ['/sizes', $size->id]]) !!}
                                            @can('size-edit')
                                            <a href="javascript:;"><i class="fa fa-edit btn-primary btn btn-sm" onclick="editSize({{$size->id}})"></i></a>
                                            @endcan
                                            @can('size-delete')
                                            {!! Form::submit('Delete',['class'=>'btn-danger btn btn-sm']) !!}
                                            @endcan
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
                        <a href="javascript:;" class="btn btn-sm btn-warning pull-right" data-toggle="modal" data-target="#addSize">Add New</a>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="addSize">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add New Size</h5>
                                </div>
                                {!! Form::open(['url' => '/sizes', 'method' =>'post', 'class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Size Name</label>
                                        <div class="col-sm-8">
                                        {!! Form::text('name', null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Unit</label>
                                        <div class="col-sm-8">
                                        {!! Form::text('unit', null, ['class'=> 'form-control']) !!}
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
                    <div class="modal fade" id="editSize">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Size</h5>
                                </div>
                                {!! Form::open(['url' => '', 'method' =>'PATCH', 'id'=>'editSizeForm', 'class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Size Name</label>
                                        <div class="col-sm-8">
                                        {!! Form::text('name',isset($size->name) ? $size->name : null, ['class'=> 'form-control txtSize']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Unit</label>
                                        <div class="col-sm-8">
                                        {!! Form::text('unit',isset($size->unit) ? $size->unit : null, ['class'=> 'form-control txtUnit']) !!}
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
@section('script')
<script>
    function editSize(param){
        $('#editSize').modal('show');
        $("#editSizeForm").prop('action', '/sizes/'+param)
        var url = "/sizes";
        $.get(url + '/' + param, function (data) {
            $('.txtSize').val(data.name);
            $('.txtUnit').val(data.unit);
        }) 
    }
</script>
@endsection

