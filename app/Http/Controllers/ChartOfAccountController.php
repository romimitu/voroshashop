<?php

namespace App\Http\Controllers;

use DB;
use App\ChartOfAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class ChartOfAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:chartOfAccount-list');
        $this->middleware('permission:chartOfAccount-create', ['only' => ['create','store']]);
        $this->middleware('permission:chartOfAccount-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:chartOfAccount-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data = ChartOfAccount::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.attribute.chartof-acc', compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'title' => 'required|min:5'
        ]);
        $data = $request->except('code');
        if($request->input('type')=='Profit And Loss A/C'){
            $lastid = DB::table('chart_of_accounts')->where('type','Profit And Loss A/C')->pluck('id')->last()+1;
            $invoiceid =now()->format('md').$lastid;
            if($request->input('pay_type')=='Receive'){
                $invoice_no = "30".str_pad($invoiceid + 1, 5, "0", STR_PAD_LEFT);
                $data['code'] =$invoice_no;
            }else{
                $invoice_no = "40".str_pad($invoiceid + 1, 5, "0", STR_PAD_LEFT);
                $data['code'] =$invoice_no;
            }

        }elseif($request->input('type')=='Manufacturing A/C'){
            $lastid = DB::table('chart_of_accounts')->where('type','Profit And Loss A/C')->pluck('id')->last()+1;
            $invoiceid =now()->format('md').$lastid;
            $invoice_no = "40".str_pad($invoiceid + 1, 5, "0", STR_PAD_LEFT);
            $data['code'] =$invoice_no;
        }else{
            $lastid = DB::table('chart_of_accounts')->where('type','None')->pluck('id')->last()+1;
            $invoiceid =now()->format('md').$lastid;
            $invoice_no = "20".str_pad($invoiceid + 1, 5, "0", STR_PAD_LEFT);
            $data['code'] =$invoice_no;
        };
        $data = ChartOfAccount::create($data);
        Session::flash('message','Added  Successfully');
        return redirect('/chartofaccounts'); 
    }

    public function show(ChartOfAccount $chartofaccount)
    {
        $data = ChartOfAccount::find($chartofaccount->id);
        return response()->json($data);
    }

    public function edit(ChartOfAccount $chartofaccount)
    {
        //
    }

    public function update(Request $request, ChartOfAccount $chartofaccount)
    {
        $data = $request->all();
        $chartofaccount->update($data);
        Session::flash('message','Succesfully updated');
        return redirect('/chartofaccounts'); 
    }

    public function destroy(ChartOfAccount $chartofaccount)
    {
        $chartofaccount->delete();
        Session::flash('message', 'Successfully Deleted');
        return redirect('/chartofaccounts');
    }
}
