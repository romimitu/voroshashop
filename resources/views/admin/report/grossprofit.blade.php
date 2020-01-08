@extends('admin.report.rptLayout')

@section('content')
<main>
	<table class="table table-bordered table-striped"  id="rpt-table">
		<thead>
			<tr>
				<th>#</th>
				<th class="text-left">Tr Date</th>
				<th class="text-left">Invoce Date</th>
				<th class="text-left">Invoice No</th>
				<th class="text-left">Customer Name</th>
				<th class="text-left">Product Name</th>
				<th class="text-right">Unit</th>
				<th class="text-right">Qty</th>
				<th class="text-right">Total</th>
				<th class="text-right">TotalCost</th>
				<th class="text-right">Profit</th>
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
				<td>{{$product->product_name}}</td>
				<td class="text-right">{{$product->price}}</td>
				<td class="text-right">{{$product->quantity}}</td>
				<td class="text-right">{{$product->price * $product->quantity}}</td>
				<td class="text-right">{{$product->purchase_price * $product->quantity}}</td>
				<td class="text-right">{{$product->price * $product->quantity - $product->purchase_price * $product->quantity}}</td>
			</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<th colspan="6"></th>
				<th class="text-right" colspan="2">Total</th>
				<th class="text-right" id="itemTotal"></th>
				<th class="text-right" id="itemTotalCost"></th>
				<th class="text-right" id="itemTotalProfit"></th>
			</tr>
		</tfoot>
	</table>
</main>
<script>
$(document).ready(function () {
    $("#itemTotal").text(sumColumn(9))
    $("#itemTotalCost").text(sumColumn(10))
    $("#itemTotalProfit").text(sumColumn(11))
})
</script>
@endsection