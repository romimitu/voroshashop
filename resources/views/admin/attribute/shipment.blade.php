@extends('admin.master.layout')

@section('content')
    <section class="content-header">
      <h1>Shipment Setup</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Shipping Address</h3>
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
                                        <th class="col-sm-3">city</th>
                                        <th class="col-sm-2">Shipping Fee</th>
                                        <th class="col-sm-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="MainCatbody">
                                    @foreach($data as $index => $shipment)
                                    <tr>
                                        <td>{{$index +1}}</td>
                                        <td>{{$shipment->city}}</td>
                                        <td>{{$shipment->fee}}</td>
                                        <td>
                                            {!! Form::open([ 'method' => 'Delete', 'url' => ['/shipments', $shipment->id]]) !!}
                                            @can('shipment-edit')
                                            <a href="javascript:;"><i class="fa fa-edit btn-primary btn btn-sm" onclick="editShipment({{$shipment->id}})"></i></a>
                                            @endcan
                                            @can('shipment-delete')
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
                        <a href="javascript:;" class="btn btn-sm btn-warning pull-right" data-toggle="modal" data-target="#addShipment">Add New</a>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="addShipment">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add New</h5>
                                </div>
                                {!! Form::open(['url' => '/shipments', 'method' =>'post', 'class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">City</label>
                                        <div class="col-sm-8">
                                        {!! Form::text('city', null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Fee</label>
                                        <div class="col-sm-8">
                                        {!! Form::number('fee', null, ['class'=> 'form-control']) !!}
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
                    <div class="modal fade" id="editShipment">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Shipment</h5>
                                </div>
                                {!! Form::open(['url' => '', 'method' =>'PATCH', 'id'=>'editShipmentForm', 'class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">City</label>
                                        <div class="col-sm-8">
                                        {!! Form::text('city',isset($shipment->city) ? $shipment->city : null, ['class'=> 'form-control txtCity']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Fee</label>
                                        <div class="col-sm-8">
                                        {!! Form::number('fee',isset($shipment->fee) ? $shipment->fee : null, ['class'=> 'form-control txtFee']) !!}
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
    function editShipment(param){
        $('#editShipment').modal('show');
        $("#editShipmentForm").prop('action', '/shipments/'+param)
        var url = "/shipments";
        $.get(url + '/' + param, function (data) {
            $('.txtCity').val(data.city);
            $('.txtZone').val(data.zone);
            $('.txtFee').val(data.fee);
        }) 
    }
</script>
@endsection

