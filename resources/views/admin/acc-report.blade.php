@extends('admin.master.layout')

@section('content')
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
            </div>
        </div>
    </section>
@endsection

@section('script')
<script>
    function getAccReport() {
        var dateFrom = $('#dateFrom').val();
        var dateTo = $('#dateTo').val();
        var reportType = $('#reportType').val();
        $.ajax({
            type: "POST",
            url: '/q/reports',
            dataType: 'json',
            data: { 'dateFrom': dateFrom,'dateTo':dateTo,'reportType':reportType,'_token': '{{ csrf_token() }}' },
            success: function (data) {
                console.log(data);
            },
            error: function (data) {
              console.log('Error:', data);
            }
        });
    };
</script>
@endsection