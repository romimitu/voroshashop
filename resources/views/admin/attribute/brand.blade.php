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
                        <h3 class="box-title">Product Brand</h3>
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
                                        <th class="col-sm-3">Origin</th>
                                        <th class="col-sm-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="MainCatbody">
                                    @foreach($data as $index => $brand)
                                    <tr>
                                        <td>{{$index +1}}</td>
                                        <td>{{$brand->name}}</td>
                                        <td>{{$brand->origin}}</td>
                                        <td>
                                            {!! Form::open([ 'method' => 'Delete', 'url' => ['/brands', $brand->id]]) !!}
                                            @can('brand-edit')
                                            <a href="javascript:;"><i class="fa fa-edit btn-primary btn btn-sm" onclick="editBrand({{$brand->id}})"></i></a>
                                            @endcan
                                            @can('brand-delete')
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
                        <a href="javascript:;" class="btn btn-sm btn-warning pull-right" data-toggle="modal" data-target="#addBrand">Add New</a>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="addBrand">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add New Brand</h5>
                                </div>
                                {!! Form::open(['url' => '/brands', 'method' =>'post', 'class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Brand Name</label>
                                        <div class="col-sm-8">
                                        {!! Form::text('name', null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Origin</label>
                                        <div class="col-sm-8">
                                        {!! Form::text('origin', null, ['class'=> 'form-control']) !!}
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
                    <div class="modal fade" id="editBrand">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Brand</h5>
                                </div>
                                {!! Form::open(['url' => '', 'method' =>'PATCH', 'id'=>'editBrandForm', 'class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Brand Name</label>
                                        <div class="col-sm-8">
                                        {!! Form::text('name',isset($brand->name) ? $brand->name : null, ['class'=> 'form-control txtBrand']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Origin</label>
                                        <div class="col-sm-8">
                                        {!! Form::text('origin',isset($brand->origin) ? $brand->origin : null, ['class'=> 'form-control txtOrigin']) !!}
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
    function editBrand(param){
        $('#editBrand').modal('show');
        $("#editBrandForm").prop('action', '/brands/'+param)
        var url = "/brands";
        $.get(url + '/' + param, function (data) {
            $('.txtBrand').val(data.name);
            $('.txtOrigin').val(data.origin);
        }) 
    }
</script>
@endsection

