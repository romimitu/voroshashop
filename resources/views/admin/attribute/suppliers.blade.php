@extends('admin.master.layout')

@section('content')
    <section class="content-header">
      <h1>Supplier Setup</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Supplier</h3>
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
                                        <th class="col-sm-3">mobile</th>
                                        <th class="col-sm-3">Address</th>
                                        <th class="col-sm-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="MainCatbody">
                                    @foreach($data as $index => $supplier)
                                    <tr>
                                        <td>{{$index +1}}</td>
                                        <td>{{$supplier->name}}</td>
                                        <td>{{$supplier->mobile}}</td>
                                        <td>{{$supplier->address}}</td>
                                        <td>
                                            {!! Form::open([ 'method' => 'Delete', 'url' => ['/suppliers', $supplier->id]]) !!}
                                            @can('supplier-edit')
                                            <a href="javascript:;"><i class="fa fa-edit btn-primary btn btn-sm" onclick="editItem({{$supplier->id}})"></i></a>
                                            @endcan
                                            @can('supplier-delete')
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
                                    <h5 class="modal-title">Add New Supplier</h5>
                                </div>
                                {!! Form::open(['url' => '/suppliers', 'method' =>'post', 'class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Supplier Name</label>
                                        <div class="col-sm-8">
                                        {!! Form::text('name', null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Mobile</label>
                                        <div class="col-sm-8">
                                        {!! Form::text('mobile', null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Email</label>
                                        <div class="col-sm-8">
                                        {!! Form::email('email', null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Address</label>
                                        <div class="col-sm-8">
                                        {!! Form::text('address', null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Status</label>
                                        <div class="col-sm-8">
                                        {!! Form::select('valid', ['1' => 'Valid', '2' => 'Invalid'],null, ['class'=> 'form-control']) !!}
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
                                    <h5 class="modal-title">Edit Suppler</h5>
                                </div>
                                {!! Form::open(['url' => '', 'method' =>'PATCH', 'id'=>'editForm', 'class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Supplier Name</label>
                                        <div class="col-sm-8">
                                        {!! Form::text('name',isset($supplier->name) ? $supplier->name : null, ['class'=> 'form-control txtname']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Mobile</label>
                                        <div class="col-sm-8">
                                        {!! Form::text('mobile',isset($supplier->mobile) ? $supplier->mobile : null, ['class'=> 'form-control txtmobile']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Email</label>
                                        <div class="col-sm-8">
                                        {!! Form::email('email',isset($supplier->email) ? $supplier->email : null, ['class'=> 'form-control txtemail']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Address</label>
                                        <div class="col-sm-8">
                                        {!! Form::text('address',isset($supplier->address) ? $supplier->address : null, ['class'=> 'form-control txtaddress']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Status</label>
                                        <div class="col-sm-8">
                                        {!! Form::select('valid', ['1' => 'Valid', '2' => 'Invalid'],isset($supplier->valid) ? $supplier->valid : null, ['class'=> 'form-control txtvalid']) !!}
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
        $("#editForm").prop('action', '/suppliers/'+param)
        var url = "/suppliers";
        $.get(url + '/' + param, function (data) {
            $('.txtname').val(data.name);
            $('.txtmobile').val(data.mobile);
            $('.txtemail').val(data.email);
            $('.txtaddress').val(data.address);
            $('.txtvalid').val(data.valid);
        }) 
    }
</script>
@endsection

