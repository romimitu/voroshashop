@extends('admin.report.rptLayout')

@section('content')
<div class="row">
	<div class="col-sm-6"></div>
	<div class="col-sm-6">
	  <div class="card-body text-right">
	    <address>
	    	Invoice No: <strong>#{{$data->tr_no}}</strong> <br>
	    	Invoice Date: <strong>{{$data->tr_date}}</strong>
	    </address>
	  </div>
	</div>
</div>
<main>
	<table class="table table-bordered table-striped"  id="rpt-table">
		<thead>
			<tr>
				<th class="text-left">A/C Code</th>
				<th class="text-left">A/C Head</th>
				<th class="text-left">Description</th>
				<th class="text-right">Amount(Tk.)</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>{{$data->chartOfAccount->code}}</td>
				<td>{{$data->chartOfAccount->title}}</td>
				<td>{{$data->details}}</td>
				<td class="text-right">{{$data->debit==0?$data->credit:$data->debit}}</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="2">Remarks: {{$data->remark}}</th>
				<th class="text-right">Total Amount</th>
				<th class="text-right" id="subtotal"></th>
			</tr>
		</tfoot>
	</table>
</main>
<script>
$(document).ready(function () {
    $("#subtotal").text(sumColumn(4))
})
</script>
@endsection