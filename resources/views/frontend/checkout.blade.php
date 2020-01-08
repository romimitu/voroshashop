@extends('frontend.layouts.master')

@section('content')
<div class="container main-container headerOffset">
    <div class="row">
        <div class="breadcrumbDiv col-lg-12">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="/cart">Cart</a></li>
                <li class="active"> Checkout</li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6 col-xxs-12 text-center-xs">
            <h1 class="section-title-inner"><span><i class="glyphicon glyphicon-shopping-cart"></i> Checkout</span></h1>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-5 rightSidebar col-xs-6 col-xxs-12 text-center-xs">
            <h4 class="caps"><a href="/shop"><i class="fa fa-chevron-left"></i> Back to shopping </a></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12">
            <div class="row userInfo">
                <div class="col-xs-12 col-sm-12">
                    {!! Form::open(['url' => '/order', 'method' =>'post', 'enctype'=>"multipart/form-data"]) !!}
                    <div class="w100 clearfix">
                        <div class="row userInfo">
                            <div class="col-lg-12">
                                <h2 class="block-title-2"> Complete your order here. </h2>
                            </div>
                            <div class="col-xs-12 col-sm-12">
                                <hr>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group required">
                                    <label for="InputName">Your Name <sup>*</sup> </label>
                                    <input required type="text" name="customer_name" class="form-control" id="InputName" value="{{ Auth::check() ? auth()->user()->name : old('customer_name') }}" 
                                    placeholder="Full Name">
                                </div>
                                <div class="form-group required">
                                    <label for="InputMobile">Mobile No<sup>*</sup> </label>
                                    <input required type="tel" name="customer_mobile" class="form-control" id="InputMobile" value="{{ Auth::check() ? auth()->user()->mobile : old('customer_mobile') }}" placeholder="Mobile Number">
                                </div>
                                <div class="form-group required">
                                    <label>City <sup>*</sup></label>
                                    <select class="form-control" id="txtCity" name="city" onchange="getZoneInfo()" required>
                                          @foreach($city as $name)
                                          <option value="{{$name->city}}">{{$name->city}}</option>
                                          @endforeach
                                    </select>
                                    <input type="text" id="shippingfee" class="none" name="shipping_fee">
                                </div>

                                @guest()
                                <div class="form-group">
                                    <input id="user-regi" type="checkbox" name="register" class="checkbox-template">
                                    <label for="user-regi" data-toggle="collapse" data-target="#userRegister" aria-expanded="false" aria-controls="userRegister">Register as a member!</label>
                                </div>
                                @endguest
                                <div class="form-group">
                                  <input id="accept-terms" type="checkbox" name="accept-terms" required>
                                  <label for="accept-terms">I accept terms and conditions!</label>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <label for="InputEmail">Email </label>
                                    <input type="email" name="customer_email" class="form-control" value="{{Auth::check() ? auth()->user()->email : old('customer_email')}}" id="InputEmail"
                                    placeholder="Email">
                                </div>
                                <div class="form-group required">
                                    <label for="InputAddress">Complete Address<sup>*</sup></label>
                                    <textarea required rows="3" cols="26" name="address" value="{{old('address')}}" class="form-control"
                                    id="InputAddress"></textarea>
                                </div>
                        
                                <div id="userRegister" aria-expanded="false" class="collapse">
                                <div class="form-group">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" placeholder="Enter password" class="form-control">
                                </div>
                                </div>
                                <input type="hidden" value="1" id="order-status"/>
                            </div>
                        </div>
                    </div>
                    <div class="cartFooter w100">
                        <div class="box-footer">
                            <div class="pull-left">
                                <a class="btn btn-default" href="/shop"> <i class="fa fa-arrow-left"></i>&nbsp; Continue shopping </a>
                            </div>
                            <div class="pull-right">
                                <button class="btn btn-primary btn-small" type="submit">Place Order &nbsp; <i class="fa fa-arrow-circle-right"></i></button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!} 
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 rightSidebar">
            <div class="w100 cartMiniTable">
                <table id="cart-summary" class="std table">
                    <tbody>
                        <tr>
                            <td>Total products</td>
                            <td class="price" id="total-products">{{count($cart) ?? 0}}</td>
                        </tr>
                        <tr>
                            <td> Purchase Amount</td>
                            <td class="price site-color" id="item-total">{{$total ?? 0}}</td>
                        </tr>
                        <tr>
                            <td>Shipping Fee</td>
                            <td class="price" id="shipping-fee">0</td>
                        </tr>

                        <tr>
                            <td> Total Amount</td>
                            <td class="cartPrice site-color" id="total-price">{{$total ?? 0}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!--  /cartMiniTable-->
        </div>
        <!--/rightSidebar-->
    </div>
    <!--/row-->
    <div style="clear:both"></div>
</div>
<!-- /main-container-->
<div class="gap"></div>

<script>
    $(document).ready(function () {
        getZoneInfo()
    });

    function getZoneInfo(){
    	var zone = $('#txtCity').val();
        var url = "{{ route('shipping.fee') }}";
        $.ajax({
            type: "GET",
            url: url,
            data: { 
                "_token": "{{ csrf_token() }}",
                id: zone,
            },
            success: function (data) {
              var total=parseFloat($('#item-total').text());
              if(total<{{$aboutinfo[0]->free_ship_upto}}){
                $('#shipping-fee').text(data[0].fee);
                $('#shippingfee').val(data[0].fee);
                totalCheckoutPrice();
              }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }

    function totalCheckoutPrice(){
    	itemTotal = parseFloat($('#item-total').text());
    	fee = parseFloat($('#shipping-fee').text());
    	$('#total-price').text((itemTotal+fee));
    }
</script>
@endsection