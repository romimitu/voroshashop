@extends('admin.master.layout')

@section('content')
    <section class="content-header">
      <h1>Product Receive</h1>
    </section>
    <section class="content">
        <div class="row">
            {!! Form::open(['url' => '/purchases', 'method' =>'post', 'class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
            <div class="col-sm-9">
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
                                <select class="form-control" id="txtSupplier" name="supplier_id">
                                    <option value="0">-- Select --</option>
                                    @foreach($suppliers as $key=>$supplier)
                                    <option value="{{$key}}">{{$supplier}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="table-scrollable">
                            <table class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th class="col-sm-7"> Product </th>
                                        <th class="col-sm-1"> Sales(Tk.) </th>
                                        <th class="col-sm-1"> Purchase(Tk.) </th>
                                        <th class="col-sm-1"> Qty </th>
                                        <th class="col-sm-1"> Total(Tk.) </th>
                                        <th class="col-sm-1"> Action </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select class="form-control" id="txtProduct" onChange="getProductData()">
                                                <option value="0">-- Select --</option>
                                                @foreach($products as $key=>$product)
                                                <option value="{{$key}}">{{$product}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="txtsalesAmt" disabled />
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" id="txtPurchaseAmt"/>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" id="txtQty" value="1" />
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="txtTotal" disabled />
                                        </td>
                                        <td><button type="button" class="btn btn-sm btn-blue" id="btnAdd" onclick="add()">Add</button></td>
                                    </tr>
                                </thead>
                                <tbody id="tbody"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Total Qty</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control disabled" id="txtTotalQty" name="total_qty" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Total Price</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="txtTotalPrice" name="total_price" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-6 control-label">Less Amount</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="txtLess" name="less_amount" value="0">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Grand Total</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control disabled" id="txtGrandTotal" name="grand_total" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Paid Amount</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="txtPaidAmt" name="paid_amount" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Due Amount</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control disabled" id="txtDueAmt" name="due_amount" value="0" >
                            </div>
                        </div>
                    </div>
                    <div class="box-footer text-right">
                        {!! Form::submit('Submit ', ['class'=> 'btn btn-primary']) !!}
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
        </div>
    </section>
@endsection

@section('script')
<script>

    $("#txtPurchaseAmt, #txtQty").on("keyup change", function(){
        let total= Math.ceil($("#txtPurchaseAmt").val() * $("#txtQty").val());
        $("#txtTotal").val(total)
    })
    $("#txtLess").on("keyup change", function(){
        let less= Math.ceil($("#txtTotalPrice").val() - $("#txtLess").val());
        less<0?$(this).val(0):less
        $("#txtGrandTotal").val(less)
        $("#txtPaidAmt").val(less)
    })
    $("#txtPaidAmt").on("keyup change", function(){
        let due= Math.ceil($("#txtGrandTotal").val() - $("#txtPaidAmt").val());
        due<0?$(this).val(0):due
        $("#txtDueAmt").val(due)
    })
    function getProductData() {
		var product_id = $('#txtProduct').val();
		$.ajax({
			type: "GET",
			url: '/productinfo/'+product_id,
            dataType: 'json',
			success: function (data) {
                $('#txtsalesAmt').val(data[0].sales_price)
			},
			error: function (data) {
			  console.log('Error:', data);
			}
		});
	};



    function add() {
        var productId = $('#txtProduct').val();
        var product = $('#txtProduct option:selected').text();
        var purchasePrice = $("#txtPurchaseAmt").val();
        var salesPrice = $('#txtsalesAmt').val();
        var qty = $('#txtQty').val();
        var total = $('#txtTotal').val();
        var valid = validate();
        if (valid == false) {
            return false;
        }
        var html ="<tr>"
            + "<td class='none'><input name='products[]' type='text' value='" + productId + "' /></td>"
            + "<td><input class='form-control' type='text' value='" + product + "' /></td>"
            + "<td><input name='salesprices[]' class='form-control' type='text' value='" + salesPrice + "' /></td>"
            + "<td><input name='purchaseprices[]' class='form-control' type='text' value='" + purchasePrice + "' /></td>"
            + "<td><input name='qty[]' class='form-control' type='text' value='" + qty + "' /></td>"
            + "<td><input name='total[]' class='form-control' type='text' value='" + total + "' /></td>"
            + "<td><a href='#' class='deleteRow'><span class='fa fa-trash'></span</a></td>"
            + "</tr>";
        $('#tbody').append(html);
        culculateGrid();
        return false;
    }
    $("table #tbody").on("click", "a.deleteRow", function (event) {
        event.preventDefault();
        $(this).closest('tr').remove();
        return false;
    });

    function culculateGrid(){
        $("#txtTotalPrice").val(sumColumnValue(6));
        $("#txtGrandTotal").val(sumColumnValue(6));
        $("#txtPaidAmt").val(sumColumnValue(6));
        $("#txtTotalQty").val(sumColumnValue(5));
    }

    function validate() {
        var isValid = true;
        var table = $("table #tbody");
        var itemId = $("#txtProduct").val();
        table.find('tr').each(function (i) {
            var $tds = $(this).find('td'),
                tableValue = $tds.eq(0).find('input').val();
            if (tableValue == itemId) {
                alert("Already Exist");
                isValid = false;
            }
        });
        if ($('#txtProduct').val() == 0) { alert("Please Select Size."); isValid = false; }
        if ($('#txtPurchaseAmt').val() == 0) { alert("Please add purchase Price."); isValid = false; }
        return isValid;
    }

</script>
@endsection

