<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Supplier;
use App\PurchaseLedger;
use App\StockLedger;
use DB;
use Carbon\Carbon;
use Auth;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:report-list');
        $this->middleware('permission:report-create', ['only' => ['create','store']]);
        $this->middleware('permission:report-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:report-delete', ['only' => ['destroy']]);
    }

    public function reportPage()
    {
        $data = Supplier::orderBy('created_at', 'desc')->get();
        return view('admin.report', compact('data'));
    }

    public function accReportPage()
    {
        return view('admin.acc-report');
    }

    public function getReports(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'reportType' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $condition = '';
        $request->supplier==0?$condition='':$condition=' and supplier_id='.$request->supplier.'';

        $title = $request->reportType;
        $daterange = $request->dateFrom.' - '.$request->dateTo;
        switch ($request->reportType) {
            case 'Stock Report':
                $data = [];
                $data['order'] = DB::select('select title,sales_price,purchase_price,category,brand,size,balqty from vw_productdetails where balqty<>0 and status=1 '.$condition.' order by category desc');

                $data['totalQty'] = array_sum(array_column($data['order'], 'balqty'));
                return view('admin.report.stock', compact(['data','title','daterange']));
                break;


            case 'Date Wise Purchase':
                $data = [];
                $data['order'] = DB::select('select a.invoice_date,a.invoice_no,b.name as supplier_name,a.paid_amount,c.name as processed_by from purchase_ledgers a left join suppliers b on a.supplier_id=b.id left join users c on a.processed_by=c.id where a.paid_amount>0 and a.status="purchase" and a.invoice_date between "'.$request->dateFrom.'" and "'.$request->dateTo.'" '.$condition.' order by a.invoice_date desc');

                $data['totalAmt'] = array_sum(array_column($data['order'], 'paid_amount'));
                return view('admin.report.datewisepurchase', compact(['data','title','daterange']));
                break;


            case 'Item Wise Purchase':
                $data = [];
                $data['order'] = DB::select('select a.invoice_date,a.invoice_no,b.name as supplier_name,d.title as product_name,d.sku,a.purchase_price,a.inqty as qty,c.name as processed_by from stock_ledgers a left join suppliers b on a.supplier_id=b.id left join users c on a.processed_by=c.id left join products d on a.product_id=d.id where a.stock_status=1 and invoice_date between "'.$request->dateFrom.'" and "'.$request->dateTo.'" '.$condition.' order by a.invoice_date desc');
                
                $data['totalAmt'] = array_sum(array_column($data['order'], 'purchase_price'));
                //dd($data);
                return view('admin.report.itemwisepurchase', compact(['data','title','daterange']));
                break;


            case 'Date Wise Collection':
                $data = [];
                $data['order'] = DB::select('select a.updated_at,a.invoice_date,a.invoice_no,a.customer_name,a.paid_amount,b.name from orders a left join users b on a.processed_by=b.id where a.paid_amount>0 and a.updated_at between "'.$request->dateFrom.' 00:00:01" and "'.$request->dateTo.' 23:59:59"  order by a.updated_at desc');
                
                $data['totalAmt'] = array_sum(array_column($data['order'], 'paid_amount'));
                return view('admin.report.datewisecollection', compact(['data','title','daterange']));
                break;


            case 'Item Wise Sales':
                $data = [];
                $data['order'] = DB::select('select a.invoice_date,a.invoice_no,a.customer_name,c.title as product_name,c.sku,b.quantity,b.price,b.discount_amount from orders a left join order_products b on b.order_id=a.id left join products c on b.product_id=c.id where a.invoice_date between "'.$request->dateFrom.'" and "'.$request->dateTo.'"  order by a.invoice_date desc');
                
                return view('admin.report.itemwisesales', compact(['data','title','daterange']));
                break;


            case 'Gross Profit':
                $data = [];
                $data['order'] = DB::select('select a.updated_at,a.invoice_date,a.invoice_no,a.customer_name,c.title as product_name,c.sku,b.quantity,b.price,b.discount_amount,b.purchase_price from orders a left join order_products b on b.order_id=a.id left join products c on b.product_id=c.id where a.paid_amount>0 and a.updated_at between "'.$request->dateFrom.' 00:00:01" and "'.$request->dateTo.' 23:59:59"  order by a.updated_at desc');
                
                return view('admin.report.grossprofit', compact(['data','title','daterange']));
                break;

            case 'Manufacturing A/C':
                $data = DB::delete('delete from tmp_trading_accs');
                $data = DB::insert('insert into tmp_trading_accs select 1 as slno," " AS code, "O/B" AS particulars,ifnull(SUM(inqty*purchase_price-outqty*purchase_price+srtn_qty*purchase_price-prtn_qty*purchase_price),0) AS bal, 1 AS status from stock_ledgers where invoice_date< "'.$request->dateFrom.'" UNION ALL select 2,b.code,concat("Add ",b.title) AS particulars,ifnull(SUM(a.debit-a.credit),0) AS bal ,1 AS status from transacts a , chart_of_accounts b where a.chart_of_account_id = b.id and b.type= "Manufacturing A/C" and a.tr_date between "'.$request->dateFrom.'" AND "'.$request->dateTo.'" GROUP BY b.code,b.title UNION ALL select 3," ","Less C/S" AS particulars,ifnull(SUM(inqty*purchase_price-outqty*purchase_price+srtn_qty*purchase_price-prtn_qty*purchase_price),0) AS bal, (-1) AS status from stock_ledgers where invoice_date<="'.$request->dateTo.'" ');
                $data = DB::select('select slno,code,particulars,bal from tmp_trading_accs UNION ALL select 4," ","Cost Of Goods Sold" , SUM(bal*status) from tmp_trading_accs');
                
                return response()->json($data);
                break;

            case 'Profit & Loss A/C':
                $data = DB::delete('delete from tmp_profitlossaccs');
                $data = DB::insert('insert into tmp_profitlossaccs select 1 as slno,b.code,b.title,SUM(a.credit-a.debit) as bal, 1 as status from transacts a, chart_of_accounts b where a.chart_of_account_id=b.id and b.type="Profit And Loss A/C" and SUBSTRING(b.code,1,1) IN ("3") and a.tr_date BETWEEN "'.$request->dateFrom.'" AND "'.$request->dateTo.'" group by b.code ,b.title UNION ALL select 2 as slno,b.code,b.title,SUM(a.debit-a.credit) as bal , (-1) as status from transacts a, chart_of_accounts b where a.chart_of_account_id=b.id and b.type="Profit And Loss A/C" and SUBSTRING(b.code,1,1) IN ("4") and a.tr_date BETWEEN "'.$request->dateFrom.'" AND "'.$request->dateTo.'" group by b.code,b.title UNION ALL select 4," ",  "LESS Cost Of Goods Sold", SUM(bal*status) , (-1) from tmp_trading_accs');
                $data = DB::delete('delete from tmpfinal_profitaccs');
                $data = DB::insert('insert into tmpfinal_profitaccs select slno,code,particulars,bal from tmp_profitlossaccs UNION ALL select 5," ","NET PROFIT/LOSS" , SUM(bal*status) from tmp_profitlossaccs');
                $data = DB::select('select * from tmpfinal_profitaccs');

                return response()->json($data);
                break;
        }
     }

}
