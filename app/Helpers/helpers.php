<?php
use Illuminate\Support\Facades\DB;
use App\Transact;
use Illuminate\Http\Request;

function rowList($array,$arraykey)
{

    return (($array->currentPage()-1) * $array->perPage() + $arraykey + 1);
}

function uploadFile($file,$request,$path='',$title='')
{
    if($request->$file!=null)
    {
        $fileName = str_slug($title,'-').'-'.time() . '-' . $request->$file->getClientOriginalName();
        $request->$file->move(public_path($path), $fileName);
        return $path.$fileName;
    }
}

function make_slug($string) {
    return preg_replace('/\s+/u', '-', trim($string));
}


function insertIntoTransact($tr_id, $type, $debit, $credit, $details, $ref_no, $remark) {        
    $lastid = DB::table('transacts')->pluck('id')->last()+1;
    $invoiceid =now()->format('ymd').$lastid;
    $invoice_no = "TR".str_pad($invoiceid + 1, 6, "0", STR_PAD_LEFT);

    $data = new Transact();
    $data->tr_no = $invoice_no;
    $data->tr_date = now()->format('Y-m-d');
    $data->chart_of_account_id = $tr_id;
    $data->voucher_type = $type;
    $data->debit = $debit;
    $data->credit = $credit;
    $data->details = $details;
    $data->ref_no = $ref_no;
    $data->remark = $remark;
    $data->save();
}


