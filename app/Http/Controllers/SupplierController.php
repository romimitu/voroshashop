<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class SupplierController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:supplier-list');
        $this->middleware('permission:supplier-create', ['only' => ['create','store']]);
        $this->middleware('permission:supplier-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:supplier-delete', ['only' => ['destroy']]);
    }
    
    public function index()
    {
        $data = Supplier::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.attribute.suppliers', compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'mobile' => 'required|min:11|max:15',
            'address' => 'required',
        ]);
        $data = $request->all(); 
        $data = Supplier::create($data);
        Session::flash('message','Added  Successfully');
        return redirect('/suppliers');  
    }

    public function show(Supplier $supplier)
    {
        $data = Supplier::find($supplier->id);
        return response()->json($data);
    }

    public function edit(Supplier $supplier)
    {
        //
    }

    public function update(Request $request, Supplier $supplier)
    {
        $data = $request->all();
        $supplier->update($data);
        Session::flash('message','Succesfully updated');
        return redirect('/suppliers'); 
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        Session::flash('message', 'Successfully Deleted');
        return redirect('/suppliers');
    }
}
