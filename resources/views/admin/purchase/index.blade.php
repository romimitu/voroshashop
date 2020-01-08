@extends('admin.master.layout')

@section('content')
    <section class="content-header">
      <h1>Stock Receive</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">InvoiceList</h3>
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
                                        <th class="col-sm-2">InvoiceNo</th>
                                        <th class="col-sm-2">Date</th>
                                        <th class="col-sm-4">Supplier</th>
                                        <th class="col-sm-1">TotalQty</th>
                                        <th class="col-sm-1">TotalAmt</th>
                                        <th class="col-sm-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="MainCatbody">
                                    @foreach($data as $index => $purchase)
                                    <tr>
                                        <td>{{$index +1}}</td>
                                        <td>{{$purchase->invoice_no}}</td>
                                        <td>{{$purchase->created_at->format('Y-m-d')}}</td>
                                        <td>{{$purchase->supplier->name}}</td>
                                        <td>{{$purchase->total_product}}</td>
                                        <td>{{$purchase->total_price}}</td>
                                        <td>
                                            <ul class="list-inline">
                                                @can('purchase-edit')
                                                <li><a class="btn btn-sm btn-info" target="_blank" href="{{url('purchases', $purchase->id)}}"><i class="fa fa-print"></i></a></li>
                                                @endcan
                                                @can('purchase-delete')
                                                <li>
                                                {!! Form::open([ 'method' => 'Delete', 'url' => ['/purchases', $purchase->invoice_no]]) !!}
                                                {!! Form::submit('Delete',['class'=>'btn-danger btn btn-sm']) !!}
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
                    <div class="box-footer clearfix">
                        <a href="/purchases/create" class="btn btn-sm btn-warning pull-right">Add New</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

