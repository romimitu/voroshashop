@extends('admin.master.layout')

@section('content')
    <section class="content-header">
      <h1>Purchase Payment</h1>
    </section>
    <section class="content">
        <div class="row">
            {!! Form::open(['url' => '/payments', 'method' =>'post', 'class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-info">
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
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Supplier</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="txtSupplier" name="supplier_id" onchange="getSupplierDue();">
                                    <option value="0">-- Select --</option>
                                    @foreach($suppliers as $key=>$supplier)
                                    <option value="{{$key}}">{{$supplier}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Total Due</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control disabled" id="txtTotalDue" name="total_due" >
                            </div>
                            <label class="col-sm-2 control-label">PayableAmt</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control disabled" id="txtPayableAmt" name="payable_amt" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Less</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="txtLessAmt" name="less_amount" value="0">
                            </div>
                            <label class="col-sm-2 control-label">Current Due</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control disabled" id="txtCurrentDue" name="current_due" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Paid Amt</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="txtPaidAmt" name="paid_amount" >
                            </div>
                        </div>
                        <div class="box-footer text-right">
                            {!! Form::submit('Submit ', ['class'=> 'btn btn-primary']) !!}
                        </div>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
        </div>
    </section>
@endsection

@section('script')
<script>
    $("#txtLessAmt").on("keyup change", function(){
        let less= Math.ceil($("#txtTotalDue").val() - $("#txtLessAmt").val());
        less<0?$(this).val(0):less
        $("#txtPayableAmt").val(less)
        $("#txtCurrentDue").val(less)
    })
    $("#txtPaidAmt").on("keyup change", function(){
        let due= Math.ceil($("#txtPayableAmt").val() - $("#txtPaidAmt").val());
        due<0?$(this).val(0):due
        $("#txtCurrentDue").val(due)
    })
    function getSupplierDue() {
		var supplier_id = $('#txtSupplier').val();
		$.ajax({
			type: "GET",
			url: '/supplierdue/'+supplier_id,
            dataType: 'json',
			success: function (data) {
                $('#txtTotalDue').val(data[0].due_amt);
                $('#txtPayableAmt').val(data[0].due_amt);
                $('#txtCurrentDue').val(data[0].due_amt);
			},
			error: function (data) {
			  console.log('Error:', data);
			}
		});
	};
</script>
@endsection

