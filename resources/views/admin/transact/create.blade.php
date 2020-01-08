@extends('admin.master.layout')

@section('content')
    <section class="content-header">
      <h1>Voucher Entry</h1>
    </section>
    <section class="content">
        <div class="row">
            {!! Form::open(['url' => '/transacts', 'method' =>'post', 'class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
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
                            <label class="col-sm-2 control-label">Voucher Type</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="voucher_type">
                                    <option value="Payment">Payment</option>
                                    <option value="Receive">Receive</option>
                                </select>
                            </div>
                            <label class="col-sm-2 control-label">Tr Date</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control datepicker" name="tr_date"/>
                            </div>
                        </div>
                        <div class="table-scrollable">
                            <table class="table table-striped table-hover table-bordered">
                                <thead id="input-entry">
                                    <tr>
                                        <th class="col-sm-5"> Product </th>
                                        <th class="col-sm-5"> Description </th>
                                        <th class="col-sm-1"> Amount(Tk.) </th>
                                        <th class="col-sm-1"> Action </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select class="form-control" id="txtChartOfAc">
                                                <option value="0">-- Select --</option>
                                                @foreach($transacts as $transact)
                                                <option value="{{$transact->id}}">{{$transact->code}} - {{$transact->title}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="txtDetails" />
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="txtAmt" />
                                        </td>
                                        <td><button type="button" class="btn btn-sm btn-blue" id="btnAdd" onclick="add()">Add</button></td>
                                    </tr>
                                </thead>
                                <tbody id="tbody"></tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Remarks</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="remark" >
                            </div>
                            <label class="col-sm-2 control-label">Total Amonut</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control disabled" id="txtTotalAmt" name="amount" />
                            </div>
                        </div>
                        <div class="form-group text-center">
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
    function add() {
        var chartOfAcId = $('#txtChartOfAc').val();
        var chartOfAc = $('#txtChartOfAc option:selected').text();
        var details = $("#txtDetails").val();
        var amount = $('#txtAmt').val();
        var valid = validate();
        if (valid == false) {
            return false;
        }
        var html ="<tr>"
            + "<td class='none'><input name='chartofacc[]' type='text' value='" + chartOfAcId + "' /></td>"
            + "<td><input class='form-control' type='text' value='" + chartOfAc + "' /></td>"
            + "<td><input name='details[]' class='form-control' type='text' value='" + details + "' /></td>"
            + "<td><input name='amounts[]' class='form-control' type='text' value='" + amount + "' /></td>"
            + "<td><a href='#' class='deleteRow'><span class='fa fa-trash'></span</a></td>"
            + "</tr>";
        $('#tbody').append(html);
        $('#input-entry input').val(0);
        culculateGrid();
        return false;
    }
    $("table #tbody").on("click", "a.deleteRow", function (event) {
        event.preventDefault();
        $(this).closest('tr').remove();
        return false;
    });

    function culculateGrid(){
        $("#txtTotalAmt").val(sumColumnValue(4));
    }

    function validate() {
        var isValid = true;
        var table = $("table #tbody");
        var itemId = $("#txtChartOfAc").val();
        table.find('tr').each(function (i) {
            var $tds = $(this).find('td'),
                tableValue = $tds.eq(0).find('input').val();
            if (tableValue == itemId) {
                alert("Already Exist");
                isValid = false;
            }
        });
        if ($('#txtChartOfAc').val() == 0) { alert("Please Select ChartOfAc."); isValid = false; }
        if ($('#txtAmt').val() == 0) { alert("Please add Amonut."); isValid = false; }
        return isValid;
    }

</script>
@endsection

