@extends('admin.report.rptLayout')

@section('content')
<main>
	<table class="table table-bordered table-striped"  id="rpt-table">
		<thead>
			<tr>
				<th>#</th>
				<th class="text-left">Collection Date</th>
				<th class="text-left">Invoce Date</th>
				<th class="text-left">Invoice No</th>
				<th class="text-left">Customer Name</th>
				<th class="text-right">TotalAmt(Tk.)</th>
				<th class="text-right">Posted By</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data['order'] as $product)
			<tr>
				<td class="no">{{$loop->iteration}}</td>
				<td>{{date_format(new DateTime($product->updated_at),'Y-m-d')}}</td>
				<td>{{$product->invoice_date}}</td>
				<td>{{$product->invoice_no}}</td>
				<td>{{$product->customer_name}}</td>
				<td class="text-right" id="itemTotal">{{$product->paid_amount}}</td>
				<td class="text-right">{{$product->name}}</td>
			</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<th colspan="3"></th>
				<th class="text-right" colspan="2">Total Amount</th>
				<th class="text-right" id="subtotal">{{$data['totalAmt']}}</th>
			</tr>
		</tfoot>
	</table>
</main>
@endsection