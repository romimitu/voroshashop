@extends('admin.report.rptLayout')

@section('content')
<div class="row">
	<div class="card border-light mb-3 col-sm-6">
	  <div class="card-header">Supplier Info</div>
	  <div class="card-body">
	    <address>
	    	<strong>{{$data['products'][0]->supplier}}</strong>
	    	{{$data['products'][0]->mobile}}<br>
	    	{{$data['products'][0]->email}}<br>
	    	{{$data['products'][0]->address}}
	    </address>
	  </div>
	</div>
	<div class="card border-light mb-3 col-sm-6">
	  <div class="card-body text-right">
	    <address>
	    	Invoice No: <strong>#{{$data['products'][0]->invoice_no}}</strong> <br>
	    	Invoice Date: <strong>{{$data['products'][0]->invoice_date}}</strong>
	    </address>
	  </div>
	</div>
</div>
<main>
	<table class="table table-bordered table-striped"  id="rpt-table">
		<thead>
			<tr>
				<th>#</th>
				<th class="text-left">Supplier Name</th>
				<th class="text-left">Product Name</th>
				<th class="text-left">SKU</th>
				<th class="text-right">Amount(Tk.)</th>
				<th class="text-right">Qty</th>
				<th class="text-right">TotalAmt(Tk.)</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data['products'] as $product)
			<tr>
				<td class="no">{{$loop->iteration}}</td>
				<td>{{$product->supplier}}</td>
				<td>{{$product->item_name}}</td>
				<td>{{$product->sku}}</td>
				<td class="text-right">{{$product->purchase_price}}</td>
				<td class="text-right">{{$product->qty}}</td>
				<td class="text-right" id="itemTotal">{{$product->purchase_price * $product->qty}}</td>
			</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<th colspan="4"></th>
				<th class="text-right" colspan="2">Total Amount</th>
				<th class="text-right">{{$data['products'][0]->total_price}}</th>
			</tr>
			<tr>
				<th colspan="4"></th>
				<th class="text-right" colspan="2">Paid Amount</th>
				<th class="text-right">{{$data['products'][0]->paid_amount}}</th>
			</tr>
			<tr>
				<th colspan="4"></th>
				<th class="text-right" colspan="2">Due Amount</th>
				<th class="text-right text-danger">{{$data['products'][0]->total_price - $data['products'][0]->paid_amount}}</th>
			</tr>
		</tfoot>
	</table>
</main>
@endsection