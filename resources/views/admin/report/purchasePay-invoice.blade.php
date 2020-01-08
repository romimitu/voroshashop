@extends('admin.report.rptLayout')

@section('content')
<div class="row">
	<div class="card border-light mb-3 col-sm-6">
	  <div class="card-header">Supplier Info</div>
	  <div class="card-body">
	    <address>
	    	<strong>{{$data->supplier->name}}</strong>
	    	{{$data->supplier->mobile}}<br>
	    	{{$data->supplier->email}}<br>
	    	{{$data->supplier->address}}
	    </address>
	  </div>
	</div>
	<div class="card border-light mb-3 col-sm-6">
	  <div class="card-body text-right">
	    <address>
	    	Invoice No: <strong>#{{$data->invoice_no}}</strong> <br>
	    	Invoice Date: <strong>{{$data->invoice_date}}</strong>
	    </address>
	  </div>
	</div>
</div>
<main>
	<table class="table table-bordered table-striped"  id="rpt-table">
		<thead>
			<tr>
				<th class="text-left">Description</th>
				<th class="text-right">TotalAmt(Tk.)</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>{{$data->status}}</td>
				<td  class="text-right">{{$data->paid_amount}}</td>
			</tr>
		</tbody>
	</table>
</main>
@endsection