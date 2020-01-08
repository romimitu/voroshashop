@extends('admin.master.layout')
@section('style')
  <link rel="stylesheet" href="{{asset('admin/css/bootstrap-colorpicker.min.css')}}">
@endsection
@section('content')
    <section class="content-header">
      <h1>Category Setup</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Product Color</h3>
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
                                        <th class="col-sm-3">ColorCode</th>
                                        <th class="col-sm-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="MainCatbody">
                                    @foreach($data as $index => $color)
                                    <tr>
                                        <td>{{$index +1}}</td>
                                        <td>{{$color->name}}</td>
                                        <td>{{$color->color_code}}</td>
                                        <td>
                                            {!! Form::open([ 'method' => 'Delete', 'url' => ['/colors', $color->id]]) !!}
                                            @can('color-edit')
                                            <a href="javascript:;"><i class="fa fa-edit btn-primary btn btn-sm" onclick="editColor({{$color->id}})"></i></a>
                                            @endcan
                                            @can('color-delete')
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
                        <a href="javascript:;" class="btn btn-sm btn-warning pull-right" data-toggle="modal" data-target="#addColor">Add New</a>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="addColor">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add New Color</h5>
                                </div>
                                {!! Form::open(['url' => '/colors', 'method' =>'post', 'class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Color Name</label>
                                        <div class="col-sm-8">
                                        {!! Form::text('name', null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Color Code</label>
                                        <div class="col-sm-8">
                                        {!! Form::text('color_code', null, ['class'=> 'form-control my-colorpicker colorpicker-element']) !!}
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
                    <div class="modal fade" id="editColor">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Color</h5>
                                </div>
                                {!! Form::open(['url' => '', 'method' =>'PATCH', 'id'=>'editColorForm', 'class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Color Name</label>
                                        <div class="col-sm-8">
                                        {!! Form::text('name',isset($color->name) ? $color->name : null, ['class'=> 'form-control txtColorName']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Color Code</label>
                                        <div class="col-sm-8">
                                        {!! Form::text('color_code',isset($color->color_code) ? $color->color_code : null, ['class'=> 'form-control txtColorCode my-colorpicker colorpicker-element']) !!}
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
<script src="{{asset('admin/js/bootstrap-colorpicker.min.js')}}"></script>
<script>
    //Colorpicker
    $('.my-colorpicker').colorpicker()
    function editColor(param){
        $('#editColor').modal('show');
        $("#editColorForm").prop('action', '/colors/'+param)
        var url = "/colors";
        $.get(url + '/' + param, function (data) {
            $('.txtColorName').val(data.name);
            $('.txtColorCode').val(data.color_code);
        }) 
    }
</script>
@endsection

