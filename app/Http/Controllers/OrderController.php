<?php

namespace App\Http\Controllers;
use DB;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:order-list');
        $this->middleware('permission:order-create', ['only' => ['create','store']]);
        $this->middleware('permission:order-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:order-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data = Order::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.order.index', compact('data'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {
        $data = [];
        $data['order'] = Order::with(['products', 'products.product','products.product.brand','products.product.color','products.product.size'])->findOrFail($id);
        //dd($data['order']->toArray());
        return view('admin.order.view', $data);
    }
    public function edit(Order $order)
    {
        $data = [];
        $data['order'] = Order::with(['products', 'products.product','products.product.brand','products.product.color','products.product.size'])->findOrFail($order->id);
        return view('admin.order.edit', ['order'=>$data['order']]);

    }

    public function update(Request $request, order $order)
    {
        DB::transaction(function () use ($order) {            
            if(request()->input('payment_status') == 'Paid'){
                $paidAmt = $order->total_amount + $order->shipping_fee;
                insertIntoTransact('3', 'Payment', 0, $paidAmt, 'Sales Againts : '.$order->invoice_no.' ', $order->invoice_no, 'Sales Collection');
            }else{
                $paidAmt = 0;
                DB::table("transacts")->where("ref_no", $order->invoice_no)->delete();
            }
            $orders = Order::whereId($order->id)->update([
                'paid_amount' => $paidAmt,
                'payment_status' => request()->input('payment_status'),
                'operational_status' => request()->input('operational_status'),
                'processed_by' => auth()->user()->id,
            ]);
        });

        //dd($order);
        session()->flash('message', 'Order Update successfully.');
        return redirect('/orders');

    }

    public function destroy(Order $order)
    {
        DB::transaction(function () use ($order) { 
            $order->delete();
            DB::table("stock_ledgers")->where("invoice_no", $order->invoice_no)->delete();
            DB::table("transacts")->where("ref_no", $order->invoice_no)->delete();
        });
        Session::flash('message', 'Successfully Deleted');
        return redirect('/orders');
    }

}
