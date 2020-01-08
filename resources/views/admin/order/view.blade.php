<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>MEDICO...always be happy and spread your happiness</title>
	<link rel="stylesheet" href="{{asset('frontend/css/font-awesome.min.css')}}">
	<link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('css/invoice.css')}}">
</head>
<body>
	<div id="invoice" class="container">
	    <div class="toolbar hidden-print">
	        <div class="text-left float-left">
	            <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-print"></i> Back</a>
	        </div>
	        <div class="text-right">
	            <a id="printInvoice" href="Javascript:;" class="btn btn-info"><i class="fa fa-print"></i> Print</a>
	        </div>
	        <hr>
	    </div>
    	<div class="invoice overflow-auto">
        	<div style="min-width: 600px">
	            <header>
	                <div class="row">
	                    <div class="col">
	                        <a target="_blank" href="https://medico.com">
	                            <img src="{{asset('images/logo.png')}}" data-holder-rendered="true" width="100px" />
                            </a>
	                    </div>
                        <h1 class="text-danger">{{$order->payment_status}}</h1>
	                    <div class="col company-details">
	                        <h2 class="name">
	                        	<a target="_blank" href="http://medico.com/" style="font-family: cursive;">MEDICO.COM</a>
	                        </h2>
	                        <address>2/3-A, Barobag, Mirpur-2, Dhaka-1216.</address>
	                        <div>+88 01920-225330, info@medico.com</div>
	                        <div>www.medico.com, Facebook/medico.com</div>
	                    </div>
	                </div>
	            </header>
	            <main>
	                <div class="row contacts">
	                    <div class="col invoice-to">
	                        <div class="text-gray-light">INVOICE TO:</div>
	                        <h2 class="to">{{$order->customer_name}}</h2>
	                        <div class="address">{{$order->address}}, {{$order->city}}</div>
	                        <div class="email"><a href="mailto:{{$order->customer_email}}">{{$order->customer_email}}</a></div>
	                        <div class="mobile">{{$order->customer_mobile}}</div>
	                    </div>
	                    <div class="col invoice-details">
	                        <h4 class="invoice-id">INVOICE #{{$order->invoice_no}}</h4>
	                        <div class="date">Date of Invoice: {{$order->invoice_date}}</div>
	                        <h5 class="invoice-id text-success"><u>Status: {{$order->operational_status}}</u></h5>
	                    </div>
	                </div>
	                <table border="0" cellspacing="0" cellpadding="0">
	                    <thead>
	                        <tr>
	                            <th>#</th>
	                            <th class="text-left">Item Name</th>
	                            <th class="text-left">Size</th>
	                            <th class="text-right">Quantity</th>
	                            <th class="text-right">Price</th>
	                            <th class="text-right">Total</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	@foreach($order->products as $product)
	                        <tr>
	                            <td class="no">{{$loop->iteration}}</td>
	                            <td class="text-left">
	                               <a target="_blank" href="Javascript:;">
	                                   {{$product->product->title}}
	                               </a> <br/>
	                               <small>Code: <i>{{$product->product->sku}}</i></small>
	                            </td>
	                            <td class="unit text-left">{{$product->product->size->name}}</td>
	                            <td class="qty">{{$product->quantity}}</td>
	                            <td class="unit">৳ {{$product->price}}</td>
	                            <td class="total">৳ {{$product->price * $product->quantity}}</td>
	                        </tr>
	                        @endforeach
	                    </tbody>
	                    <tfoot>
	                        <tr>
	                            <td colspan="3"></td>
	                            <td colspan="2">SubTotal</td>
	                            <td>৳ {{$order->total_amount}}</td>
	                        </tr>
	                        <tr>
	                            <td colspan="3"></td>
	                            <td colspan="2">Shipping Fee</td>
	                            <td>৳ {{$order->shipping_fee}}</td>
	                        </tr>
	                        <tr>
	                            <td colspan="3"></td>
	                            <td colspan="2">Discount</td>
	                            <td>৳ {{$order->products->sum('discount_amount')}}</td>
	                        </tr>
	                        <tr>
	                            <td colspan="3"></td>
	                            <td colspan="2">Grand Total</td>
	                            <td>৳ {{$order->total_amount + $order->shipping_fee - $order->discount_amount}}</td>
	                        </tr>
	                        <tr>
	                            <td colspan="3"></td>
	                            <td colspan="2">Paid</td>
	                            <td>৳ {{$order->paid_amount}}</td>
	                        </tr>
	                    </tfoot>
                	</table>
	                <div class="thanks">Thank you!</div>
	                <div class="notices">
	                    <div>NOTICE:</div>
	                    <div class="notice">Please read our terms and condition carefully.</div>
	                </div>
	            </main>
	            <footer>
	                Invoice was created on a computer and is valid without the signature and seal.
	            </footer>
        	</div>
    	</div>
	</div>
</body>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
	$('#printInvoice').click(function(){
        Popup($('.invoice')[0].outerHTML);
        function Popup(data) 
        {
            window.print();
            return true;
        }
    });
</script>
</html>