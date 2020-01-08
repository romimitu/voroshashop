@extends('admin.report.rptLayout')

@section('content')
<main>
	<table class="table table-bordered table-striped" id="rpt-table">
		<thead>
			<tr>
				<th>#</th>
				<th class="text-left">Invoce Date</th>
				<th class="text-left">Invoice No</th>
				<th class="text-left">Supplier Name</th>
				<th class="text-right">Amount(Tk.)</th>
				<th class="text-right">PostedBy</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data['order'] as $product)
			<tr>
				<td class="no">{{$loop->iteration}}</td>
				<td>{{$product->invoice_date}}</td>
				<td>{{$product->invoice_no}}</td>
				<td>{{$product->supplier_name}}</td>
				<td class="text-right">{{$product->paid_amount}}</td>
				<td class="text-right">{{$product->processed_by}}</td>
			</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<th colspan="2"></th>
				<th class="text-right" colspan="2">Total Amount</th>
				<th class="text-right">{{$data['totalAmt']}}</th>
			</tr>
		</tfoot>
	</table>
</main>
@endsection