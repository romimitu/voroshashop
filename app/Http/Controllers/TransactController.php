<?php

namespace App\Http\Controllers;

use DB;
use App\Transact;
use App\ChartOfAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class TransactController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:transact-list');
        $this->middleware('permission:transact-create', ['only' => ['create','store']]);
        $this->middleware('permission:transact-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:transact-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data = Transact::orderBy('created_at', 'desc')->where('ref_no','regexp','^TR')->paginate(20);
        return view('admin.transact.index', compact('data'));
    }

    public function create()
    {
        $transacts = ChartOfAccount::select('title','id','code')->get();
        return view('admin.transact.create', compact('transacts'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            $lastid = DB::table('transacts')->pluck('id')->last()+1;
            $invoiceid =now()->format('ymd').$lastid;
            $invoice_no = "TR".str_pad($invoiceid + 1, 6, "0", STR_PAD_LEFT);

            foreach ($request->chartofacc as $key=>$data) {
                $data = new Transact();
                $data->tr_no = $invoice_no;
                $data->tr_date = $request->tr_date;
                $data->chart_of_account_id = $request->chartofacc[$key];
                $data->details = $request->details[$key];
                $request->voucher_type=="Payment" ? $data->debit = $request->amounts[$key] : $data->credit = $request->amounts[$key];
                $data->voucher_type = $request->voucher_type;
                $data->ref_no = $invoice_no;
                $data->remark = $request->remark;
                $data->save();
            }
        });

        Session::flash('message','Added  Successfully');
        return redirect('/transacts');
    }

    public function show(Transact $transact)
    {
        $daterange = ' ';
        $title = $transact->voucher_type.' Invoice';
        $data = Transact::with('chartOfAccount')->findOrFail($transact->id);
        //dd($data);
        return view('admin.report.trinvoice', compact(['data','title','daterange']));

    }

    public function edit(Transact $transact)
    {
        //
    }

    public function update(Request $request, Transact $transact)
    {
        //
    }

    public function destroy(Transact $transact)
    {
        $transact->delete();
        Session::flash('message', 'Successfully Deleted');
        return redirect('/transacts');
    }
}
