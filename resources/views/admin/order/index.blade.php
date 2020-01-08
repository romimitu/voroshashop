@extends('admin.master.layout')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Order List</h3>
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
                                        <th class="">Sl</th>
                                        <th class="col-sm-1">InvoiceNo</th>
                                        <th class="col-sm-1">InvoiceDate</th>
                                        <th class="col-sm-2">Customer</th>
                                        <th class="col-sm-1">Mobile</th>
                                        <th class="col-sm-2">Shipping Address</th>
                                        <th class="col-sm-1">Total_Amt</th>
                                        <th class="col-sm-1">Status</th>
                                        <th class="col-sm-1">Payment</th>
                                        <th class="col-sm-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="MainCatbody">
                                    @foreach($data as $index => $order)
                                    <tr>
                                        <td>{{$index +1}}</td>
                                        <td>{{$order->invoice_no}}</td>
                                        <td>{{$order->invoice_date}}</td>
                                        <td>{{$order->customer_name}}</td>
                                        <td>{{$order->customer_mobile}}</td>
                                        <td>{{$order->address}}, {{$order->city}}</td>
                                        <td>{{$order->total_amount+$order->shipping_fee}}</td>
                                        <td>{{$order->operational_status}}</td>
                                        <td>{{$order->payment_status}}</td>
                                        <td>
                                            <ul class="list-inline">
                                                <li><a class="btn btn-sm btn-info" target="_blank" href="{{url('orders', $order->id)}}"><i class="fa fa-print"></i></a></li>
                                                @can('order-edit')
                                                <li><a class="btn btn-sm btn-primary" href="{{url('orders', $order->id)}}/edit"><i class="fa fa-edit"></i></a></li>
                                                @endcan

                                                @can('order-delete')
                                                <li>
                                                {!! Form::open([ 'method' => 'Delete', 'url' => ['/orders', $order->id]]) !!}
                                                {!! Form::submit('D',['class'=>'btn-danger btn btn-sm']) !!}
                                                {!! Form::close() !!}
                                                </li>
                                                @endcan
                                            </ul>
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
                </div>
            </div>
        </div>
    </section>
@endsection

