<?php


namespace App\Http\Controllers;

use DB;
use App\Supplier;
use App\PurchaseLedger;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class PurchasePaymentController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:purchasePayment-list');
        $this->middleware('permission:purchasePayment-create', ['only' => ['create','store']]);
        $this->middleware('permission:purchasePayment-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:purchasePayment-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data = PurchaseLedger::with('supplier')
        ->where('paid_amount','>',0)
        ->where('payable_amount','=',0)
        ->where('status','=','purchase-payment')
        ->orderBy('created_at', 'desc')
        ->paginate(20);
        //dd($data);
        return view('admin.purchase-payment.index', compact('data'));
    }

    public function create()
    {
        $suppliers = Supplier::all()->pluck('name','id');
        return view('admin.purchase-payment.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'supplier_id' => 'required',
            'paid_amount' => 'required',
        ]);
        DB::transaction(function () use ($request) {
            $lastid = DB::table('purchase_ledgers')->pluck('id')->last()+1;
            $invoiceid =now()->format('ymd').$lastid;
            $invoice_no = "PP".str_pad($invoiceid + 1, 10, "0", STR_PAD_LEFT);
            $purchaseLedger = PurchaseLedger::create([
                'supplier_id' =>  request()->input('supplier_id'),
                'tr_no' => $invoice_no,
                'invoice_no' => $invoice_no,
                'invoice_date' => now()->format('Y-m-d'),
                'payable_amount' => 0,
                'less_amount' => request()->input('less_amount'),
                'paid_amount' => request()->input('paid_amount'),
                'payment_status' => "due-paid",
                'status' => "purchase-payment",
                'processed_by' => auth()->user()->id,
            ]);

            if($request->paid_amount>0){
                insertIntoTransact('1', 'Payment', $request->paid_amount, 0, 'Purchase Payment Againts : '.$invoice_no.' ', $invoice_no, 'Purchase Payment');
            }
        });

        Session::flash('message','Added  Successfully');
        return redirect('/payments');
    }

    public function show($id)
    {
        $daterange = ' ';
        $title = "Purchase Payment Invoice";
        $data = PurchaseLedger::with('supplier')->findOrFail($id);
        return view('admin.report.purchasePay-invoice', compact(['data','title','daterange']));
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
            DB::table("purchase_ledgers")->where("invoice_no", $id)->delete();
            DB::table("transacts")->where("ref_no", $id)->delete();
        });
        Session::flash('message', 'Successfully Deleted');
        return redirect('/payments');
    }


    public function supplierDue($id)
    {
        $data =  DB::select('select sum(payable_amount-less_amount-paid_amount-return_amount) as due_amt from purchase_ledgers where supplier_id='.$id.' ');
        return response()->json($data);
    }
}
