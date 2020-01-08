<?php

namespace App\Http\Controllers;

use DB;
use App\Supplier;
use App\StockInMain;
use App\PurchaseLedger;
use App\StockLedger;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class PurchaseController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:purchase-list');
        $this->middleware('permission:purchase-create', ['only' => ['create','store']]);
        $this->middleware('permission:purchase-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:purchase-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data = StockInMain::with('supplier')->orderBy('created_at', 'desc')->paginate(20);
        //dd($data);
        return view('admin.purchase.index', compact('data'));
    }

    public function create()
    {
        $products = Product::all()->pluck('title','id');
        $suppliers = Supplier::all()->pluck('name','id');
        return view('admin.purchase.create', compact('products', 'suppliers'));

    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'supplier_id' => 'required',
            'grand_total' => 'required',
        ]);
        DB::transaction(function () use ($request) {
            $lastid = DB::table('orders')->pluck('id')->last()+1;
            $invoiceid =now()->format('ymd').$lastid;
            $invoice_no = "PR".str_pad($invoiceid + 1, 6, "0", STR_PAD_LEFT);
            $purchaseLedger = PurchaseLedger::create([
                'supplier_id' =>  request()->input('supplier_id'),
                'tr_no' => $invoice_no,
                'invoice_no' => $invoice_no,
                'invoice_date' => now()->format('Y-m-d'),
                'payable_amount' => request()->input('grand_total'),
                'less_amount' => request()->input('less_amount'),
                'paid_amount' => request()->input('paid_amount'),
                'payment_status' => request()->input('grand_total')==request()->input('paid_amount')?"paid":"due",
                'status' => "purchase",
                'processed_by' => auth()->user()->id,
            ]);
            $stockInMain = StockInMain::create([
                'supplier_id' =>  request()->input('supplier_id'),
                'invoice_no' => $invoice_no,
                'total_price' => request()->input('grand_total'),
                'paid_amount' => request()->input('paid_amount'),
                'total_product' => request()->input('total_qty'),
                'processed_by' => auth()->user()->id,
            ]);
            
            if($request->paid_amount>0){
                insertIntoTransact('4', 'Payment', $request->paid_amount, 0, 'Purchase Againts : '.$invoice_no.' ', $invoice_no, 'Purchase');
            }

            foreach ($request->products as $key=>$data) {
                $data = new StockLedger();
                $data->invoice_no = $invoice_no;
                $data->tr_no = $invoice_no;
                $data->invoice_date = now()->format('Y-m-d');
                $data->supplier_id = $request->supplier_id;
                $data->product_id = $request->products[$key];
                $data->purchase_price = $request->purchaseprices[$key];
                $data->sale_price = $request->salesprices[$key];
                $data->stock_status = 1;
                $data->inqty = $request->qty[$key];
                $data->processed_by = auth()->user()->id;
                $data->save();
            }
        });

        Session::flash('message','Added  Successfully');
        return redirect('/purchases');
    }

    public function show($id)
    {
        $daterange = ' ';
        $title = "Purchase Invoice";
        $data = [];
        $data['products'] = DB::Select('select c.name as supplier, c.mobile, c.email, c.address, b.invoice_no, b.invoice_date, a.total_price, a.paid_amount, b.purchase_price, b.sale_price, b.inqty as qty, d.title as item_name, d.sku from stock_in_mains as a left join stock_ledgers as b on a.invoice_no=b.invoice_no left join suppliers as c on a.supplier_id=c.id left join products as d on b.product_id=d.id where a.id='.$id.' ');
        //dd($data['products'][0]);
        return view('admin.report.purchase-invoice', compact(['data','title','daterange']));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            DB::table("stock_in_mains")->where("invoice_no", $id)->delete();
            DB::table("purchase_ledgers")->where("invoice_no", $id)->delete();
            DB::table("stock_ledgers")->where("invoice_no", $id)->delete();
            DB::table("transacts")->where("ref_no", $id)->delete();
        });
        Session::flash('message', 'Successfully Deleted');
        return redirect('/purchases');
    }
}
