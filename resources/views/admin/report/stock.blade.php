@extends('admin.report.rptLayout')

@section('content')
<main>
	<table class="table table-bordered table-striped"  id="rpt-table">
		<thead>
			<tr>
				<th>#</th>
				<th class="text-left">Category</th>
				<th class="text-left">Item Name</th>
				<th class="text-left">Brand</th>
				<th class="text-right">Sale Price(Tk.)</th>
				<th class="text-right">Quantity</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data['order'] as $product)
			<tr>
				<td class="no">{{$loop->iteration}}</td>
				<td>{{$product->category}}</td>
				<td>{{$product->title}}</td>
				<td>{{$product->brand}}</td>
				<td class="text-right">{{$product->sales_price}}</td>
				<td class="text-right">{{$product->balqty}}</td>
			</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<th colspan="3"></th>
				<th class="text-right" colspan="2">Total Qty</th>
				<th class="text-right">{{$data['totalQty']}}</th>
			</tr>
		</tfoot>
	</table>
</main>
@endsection