@extends('admin.master.layout')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Chart Of A/C</h3>
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
                                        <th class="col-sm-2">Code</th>
                                        <th class="col-sm-3">Title</th>
                                        <th class="col-sm-3">Type</th>
                                        <th class="col-sm-1">Status</th>
                                        <th class="col-sm-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="MainCatbody">
                                    @foreach($data as $index => $item)
                                    <tr>
                                        <td>{{$index +1}}</td>
                                        <td>{{$item->code}}</td>
                                        <td>{{$item->title}}</td>
                                        <td>{{$item->type}}</td>
                                        <td>{{$item->status}}</td>
                                        <td>
                                            {!! Form::open([ 'method' => 'Delete', 'url' => ['/chartofaccounts', $item->id]]) !!}
                                            @can('chartOfAccount-edit')
                                            <a href="javascript:;"><i class="fa fa-edit btn-primary btn btn-sm" onclick="editItem({{$item->id}})"></i></a>
                                            @endcan
                                            @can('chartOfAccount-delete')
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
                        <a href="javascript:;" class="btn btn-sm btn-warning pull-right" data-toggle="modal" data-target="#addItem">Add New</a>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="addItem">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add New Chart Of A/C</h5>
                                </div>
                                {!! Form::open(['url' => '/chartofaccounts', 'method' =>'post', 'class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Chart Of A/C Name</label>
                                        <div class="col-sm-8">
                                        {!! Form::text('title', null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Chart Of A/C Type</label>
                                        <div class="col-sm-8">
                                        {!! Form::select('type', ['None' => 'None','Profit And Loss A/C' => 'Profit And Loss A/C', 'Manufacturing A/C' => 'Manufacturing A/C'],null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Status</label>
                                        <div class="col-sm-8">
                                        {!! Form::select('status', ['1' => 'Valid', '2' => 'Invalid'],null, ['class'=> 'form-control']) !!}
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
                    <div class="modal fade" id="editModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Chart Of A/C</h5>
                                </div>
                                {!! Form::open(['url' => '', 'method' =>'PATCH', 'id'=>'editForm', 'class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">A/C Code</label>
                                        <div class="col-sm-8">
                                        {!! Form::text('code',null, ['class'=> 'form-control txtcode disabled']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Chart Of A/C Name</label>
                                        <div class="col-sm-8">
                                        {!! Form::text('title',null, ['class'=> 'form-control txttitle']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Chart Of A/C Type</label>
                                        <div class="col-sm-8">
                                        {!! Form::select('type', ['None' => 'None','Profit And Loss A/C' => 'Profit And Loss A/C', 'Manufacturing A/C' => 'Manufacturing A/C'],null, ['class'=> 'form-control txttype']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Status</label>
                                        <div class="col-sm-8">
                                        {!! Form::select('status', ['1' => 'Valid', '2' => 'Invalid'], null, ['class'=> 'form-control txtvalid']) !!}
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
    function editItem(param){
        $('#editModal').modal('show');
        $("#editForm").prop('action', '/chartofaccounts/'+param)
        var url = "/chartofaccounts";
        $.get(url + '/' + param, function (data) {
            $('.txtcode').val(data.code);
            $('.txttitle').val(data.title);
            $('.txttype').val(data.type);
            $('.txtvalid').val(data.status);
        }) 
    }
</script>
@endsection

