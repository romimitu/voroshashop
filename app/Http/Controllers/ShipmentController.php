<?php

namespace App\Http\Controllers;

use App\Shipment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class ShipmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:shipment-list');
        $this->middleware('permission:shipment-create', ['only' => ['create','store']]);
        $this->middleware('permission:shipment-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:shipment-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data = Shipment::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.attribute.shipment', compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'fee' => 'required',
        ]);
        $data = $request->all(); 
        $data = Shipment::create($data);
        Session::flash('message','Added  Successfully');
        return redirect('/shipments');  
    }

    public function show(Shipment $shipment)
    {
        $data = Shipment::find($shipment->id);
        return response()->json($data);
    }

    public function edit(Shipment $shipment)
    {
        //
    }

    public function update(Request $request, Shipment $shipment)
    {
        $data = $request->all();
        $shipment->update($data);
        Session::flash('message','Succesfully updated');
        return redirect('/shipments');  
    }

    public function destroy(Shipment $shipment)
    {
        $shipment->delete();
        Session::flash('message', 'Successfully Deleted');
        return redirect('/shipments');
    }
}
