@extends('admin.master.layout')

@section('content')
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <section class="content">
      <!-- Info boxes -->
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-6">
          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Orders</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>InvoiceNo</th>
                    <th>InvoiceDate</th>
                    <th>Customer</th>
                    <th>Status</th>
                    <th>Payment</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($letestOrder as $order)
                  <tr>
                    <td><a target="_blank" href="{{url('orders', $order->id)}}">{{$order->invoice_no}}</a></td>
                    <td>{{$order->created_at->format('j-m-y')}}</td>
                    <td>
                      <div class="sparkbar">{{$order->customer_name}}, {{$order->customer_mobile}}</div>
                    </td>
                    <td><span class="label label-danger">{{$order->operational_status}}</span></td>
                    <td>{{$order->payment_status}}</td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-6">
          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Orders Completed</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>InvoiceNo</th>
                    <th>InvoiceDate</th>
                    <th>Customer</th>
                    <th>Status</th>
                    <th>Payment</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($letestOrderCompleted as $order)
                  <tr>
                    <td><a target="_blank" href="{{url('orders', $order->id)}}">{{$order->invoice_no}}</a></td>
                    <td>{{$order->created_at->format('j-m-y')}}</td>
                    <td>
                      <div class="sparkbar">{{$order->customer_name}}, {{$order->customer_mobile}}</div>
                    </td>
                    <td><span class="label label-success">{{$order->operational_status}}</span></td>
                    <td>{{$order->payment_status}}</td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row -->
    </section>
@endsection