@extends('admin.master.layout')

@section('content')
    <style>
        .rpt-area {display: none;}
        .rpt-area tbody tr:last-child {background: #E91E63 !important;font-weight: 800;color: #fff;text-align: right;}
        .subCode {background-color: #f5f8fc;}
        .subCode td:first-child {text-align: right;}
        .mainCode td {background: #ddd;font-weight: 800;color: #000;}
    </style>

    <section class="content">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Accounts Report</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Date From</label>
                            <div class="col-sm-4"><input type="text" class="form-control datepicker" id="dateFrom"  /></div>
                            <label class="col-sm-2 control-label">Date To</label>
                            <div class="col-sm-4"><input type="text" class="form-control datepicker" id="dateTo" /></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">ReportType</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="reportType">
                                    <option value="0">Select</option>
                                    <option value="Manufacturing A/C">Manufacturing A/C</option>
                                    <option value="Profit & Loss A/C">Profit & Loss A/C</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <a href="javascript:;" class="btn btn-sm btn-success" onclick="getAccReport();">Submit</a>
                        </div>
                    </div>
                </div>
                <div class="box box-info rpt-area">
                    <div class="box-body">
                        <table class="table table-bordered table-hover table-condensed">
                            <thead>
                                <tr class="info">
                                    <th>Description</th>
                                    <th class="text-right">Balance</th>
                                </tr>
                            </thead>
                            <tbody class="rptTable"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
<script>
    function getAccReport() {
        $(".rpt-area").css('display', 'block');
        var dateFrom = $('#dateFrom').val();
        var dateTo = $('#dateTo').val();
        var reportType = $('#reportType').val();
        $.ajax({
            type: "POST",
            url: '/q/reports',
            dataType: 'json',
            data: { 'dateFrom': dateFrom,'dateTo':dateTo,'reportType':reportType,'_token': '{{ csrf_token() }}' },
            success: function (data) {
                $('.rptTable').empty();
                $.each(data, function (key, item) {
                    if (item.slno == 1) { classname = "mainCode"; }
                    else { classname = "subCode"; }
                    var rows = "<tr class=" + classname + ">"
                        + "<td>" + item.particulars + "</td>"
                        + "<td class='text-right'>" + item.bal + "</td>"
                        + "</tr>";
                    $('.rptTable').append(rows);
                });
            },
            error: function (data) {
              console.log('Error:', data);
            }
        });
    };
</script>
@endsection