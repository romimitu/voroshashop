@extends('admin.report.rptLayout')

@section('content')
<main>
	<table class="table table-bordered table-striped"  id="rpt-table">
		<thead>
			<tr>
				<th>#</th>
				<th class="text-left">Invoce Date</th>
				<th class="text-left">Invoice No</th>
				<th class="text-left">Supplier Name</th>
				<th class="text-left">Product Name</th>
				<th class="text-left">SKU</th>
				<th class="text-right">Amount(Tk.)</th>
				<th class="text-right">Qty</th>
				<th class="text-right">TotalAmt(Tk.)</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data['order'] as $product)
			<tr>
				<td class="no">{{$loop->iteration}}</td>
				<td>{{$product->invoice_date}}</td>
				<td>{{$product->invoice_no}}</td>
				<td>{{$product->supplier_name}}</td>
				<td>{{$product->product_name}}</td>
				<td>{{$product->sku}}</td>
				<td class="text-right">{{$product->purchase_price}}</td>
				<td class="text-right">{{$product->qty}}</td>
				<td class="text-right" id="itemTotal">{{$product->purchase_price * $product->qty}}</td>
			</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<th colspan="6"></th>
				<th class="text-right" colspan="2">Total Amount</th>
				<th class="text-right" id="subtotal"></th>
			</tr>
		</tfoot>
	</table>
</main>
<script>
$(document).ready(function () {
    $("#subtotal").text(sumColumn(9))
})
</script>
@endsection