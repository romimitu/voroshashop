@extends('admin.master.layout')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Report</h3>
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


                        {!! Form::open(['url' => ['/q/reports'],"target"=>"_blank",'method' =>'post','enctype'=>"multipart/form-data"]) !!}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Date From</label>
                            <div class="col-sm-4"><input type="text" class="form-control datepicker" name="dateFrom"  /></div>
                            <label class="col-sm-2 control-label">Date To</label>
                            <div class="col-sm-4"><input type="text" class="form-control datepicker" name="dateTo" /></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Supplier</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="supplier">
                                    <option value="0">Select</option>
                                    @foreach($data as $supplier)
                                    <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">ReportType</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="reportType">
                                    <option value="0">Select</option>
                                    <option value="Stock Report">Stock Summery</option>
                                    <option value="Date Wise Purchase">Date Wise Purchase</option>
                                    <option value="Item Wise Purchase">Item Wise Purchase</option>
                                    <option value="Date Wise Collection">Date Wise Collection</option>
                                    <option value="Item Wise Sales">Item Wise Sales</option>
                                    <option value="Gross Profit">Gross Profit</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-sm btn-success" value="Submit">
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection