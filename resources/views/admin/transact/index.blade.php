@extends('admin.master.layout')

@section('content')
    <section class="content-header">
      <h1>Voucher Entry</h1>
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
                                        <th class="col-sm-2">TrNo</th>
                                        <th class="col-sm-2">TrDate</th>
                                        <th class="col-sm-3">Remarks</th>
                                        <th class="col-sm-1">Type</th>
                                        <th class="col-sm-2">Amount(dr-cr)</th>
                                        <th class="col-sm-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="MainCatbody">
                                    @foreach($data as $index => $transact)
                                    <tr>
                                        <td>{{$index +1}}</td>
                                        <td>{{$transact->tr_no}}</td>
                                        <td>{{$transact->tr_date}}</td>
                                        <td>{{$transact->remark}}</td>
                                        <td>{{$transact->voucher_type}}</td>
                                        <td><span class="label label-success"> {{$transact->debit}}</span> <span class="label label-success"> {{$transact->credit}}</span></td>
                                        <td>
                                            <ul class="list-inline">
                                                @can('transact-edit')
                                                <li><a class="btn btn-sm btn-info" target="_blank" href="{{url('transacts', $transact->id)}}"><i class="fa fa-print"></i></a></li>
                                                @endcan
                                                @can('transact-delete')
                                                <li>
                                                {!! Form::open([ 'method' => 'Delete', 'url' => ['/transacts', $transact->invoice_no]]) !!}
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
                        <a href="/transacts/create" class="btn btn-sm btn-warning pull-right">Add New</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

