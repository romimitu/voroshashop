@extends('admin.master.layout')

@section('content')
    <section class="content-header">
      <h1>Order Setup</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Order</h3>
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
                            {!! Form::open(['url' => ['/orders', $order->id], 'method' =>'PATCH', 'class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Invoice No</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="text" value="{{$order->invoice_no}}" disabled>
                                    </div>
                                    <label class="col-sm-2 control-label">Invoice Date</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="text" value="{{$order->invoice_date}}" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Customer Name</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="text" value="{{$order->customer_name}}" disabled>
                                        <input class="none" name="product_id" type="text" value="{{$order->id}}">
                                    </div>
                                    <label class="col-sm-2 control-label">Mobile</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="text" value="{{$order->customer_mobile}}" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Shipping Address</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="{{$order->address}}, {{$order->city}}" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="table-scrollable">
                                        <table class="table table-striped table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="col-sm-4"> Product </th>
                                                    <th class="col-sm-2"> SalesPrice </th>
                                                    <th class="col-sm-2"> Discount </th>
                                                    <th class="col-sm-2"> Quantity </th>
                                                    <th class="col-sm-2"> Total </th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                
                                            @if($order->products->count() > 0)
                                            @foreach($order->products as $product)
                                                <tr>
													<td><b><a href="javascript:;">{{$product->product->title}}</a></b>
													<br/>
													<small>Code: <i>{{$product->product->sku}}</i></small>
													<small>, Size: <i>{{$product->product->size->name}}</i></small></td>
													<td>{{$product->price}}</td>
													<td>{{$product->discount_amount}}</td>
													<td>{{$product->quantity}}</td>
													<td>{{$product->price * $product->quantity - $product->discount_amount}}</td>
                                                </tr>
                                            @endforeach
                                            @endif

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="4"> Shipping Charge </th>
                                                    <th> {{$order->shipping_fee}} </th>
                                                </tr>
                                                <tr>
                                                    <th colspan="4"> Sub Total </th>
                                                    <th> {{$order->total_amount+$order->shipping_fee}} </th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
	                            <div class="form-group">
	                                <label class="col-sm-2 control-label">Payment Status</label>
	                                <div class="col-sm-4">
	                                    <select name="payment_status" class="form-control">
	                                        <option value="Paid" {{ $order->payment_status == 'Paid' ? 'selected' : '' }}>Paid</option>
	                                        <option value="Unpaid" {{ $order->payment_status == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
	                                    </select>
	                                </div>
	                                <label class="col-sm-2 control-label">Order Status</label>
	                                <div class="col-sm-4">
	                                    <select name="operational_status" class="form-control">
                                            <option value="Pending" {{ $order->operational_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="On Going" {{ $order->operational_status == 'On Going' ? 'selected' : '' }}>On Going</option>
                                            <option value="Ready To Deliver" {{ $order->operational_status == 'Ready To Deliver' ? 'selected' : '' }}>Ready To Deliver</option>
                                            <option value="On The Way" {{ $order->operational_status == 'On The Way' ? 'selected' : '' }}>On The Way</option>
                                            <option value="Complete" {{ $order->operational_status == 'Complete' ? 'selected' : '' }}>Complete</option>
                                            <option value="Cancel" {{ $order->operational_status == 'Cancel' ? 'selected' : '' }}>Cancel</option>
	                                    </select>
	                                </div>
	                            </div>
                            </div>

                            <div class="modal-footer">
                                {!! Form::submit('Submit ', ['class'=> 'btn btn-primary']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


