@extends('frontend.layouts.master')

@section('content')
<div class="container main-container headerOffset">
    <div class="row">
        <div class="breadcrumbDiv col-lg-12">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="/shop">Category</a></li>
                <li class="active">Cart</li>
            </ul>
        </div>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6 col-xxs-12 text-center-xs">
            <h1 class="section-title-inner"><span><i class="glyphicon glyphicon-shopping-cart"></i> Shopping cart </span></h1>
        </div>
    </div>
        <!--/.row-->

    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-7">
            <div class="row userInfo">
                <div class="col-xs-12 col-sm-12">
                    <div class="cartContent w100">
                        @if(count($cart) >0)
                        <table class="cartTable table-responsive table " style="width:100%">
                            <thead>

                                <tr class="CartProduct cartTableHeader">
                                    <th style="width:50%;text-align:left" >Details</th>
                                    <th style="width:20%;text-align:center">QTY</th>
                                    <th style="width:20%;text-align:right">Total</th>
                                    <th style="width:10%"></th>
                                </tr>
							</thead>
							<tbody>
                                @foreach($cart as $product)
                                <tr id="{{$product['id']}}">
                                    <td>{{$product['title']}}</td>
                                    <td align="center"><b>{{$product['quantity']}}</b></td>
                                    <td align="right">{{$product['quantity'] * $product['sales_price']}}</td>
                                    <td style="text-align:right"> <i class="fa fa-2x  fa-times-circle-o del_cart" onclick="removeCart({{$product['id']}})"></i> </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <h4>Your cart is empty now!</h4>
                        @endif
                    </div>
                    <!--cartContent-->
                    <div class="cartFooter w100">
                        <div class="box-footer">
                            <div class="pull-left"><a href="/shop" class="btn btn-default"> <i
                                class="fa fa-arrow-left"></i> &nbsp; Continue shopping </a>
                            </div>
                            <div class="pull-right">
                                <a title="checkout" href="/checkout" class="checkoutBtn btn btn-primary" id="proceed-checkout" > Proceed to checkout &nbsp; <i class="fa fa-arrow-right"></i> </a>
                            </div>
                        </div>
                    </div>
                    <!--/ cartFooter -->
                </div>
            </div>
            <!--/row end-->
        </div>
    </div>
    <!--/row-->
    <div style="clear:both"></div>
</div>
<!-- /.main-container -->

<div class="gap"></div>
@endsection