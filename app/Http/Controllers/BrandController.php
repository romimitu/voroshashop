<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:brand-list');
        $this->middleware('permission:brand-create', ['only' => ['create','store']]);
        $this->middleware('permission:brand-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:brand-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data = Brand::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.attribute.brand', compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'origin' => 'required',
        ]);
        $data = $request->all(); 
        $data = Brand::create($data);
        Session::flash('message','Added  Successfully');
        return redirect('/brands');  
    }

    public function show(Brand $brand)
    {
        $data = Brand::find($brand->id);
        return response()->json($data);
    }

    public function edit(Brand $brand)
    {
        //
    }

    public function update(Request $request, Brand $brand)
    {
        $data = $request->all();
        $brand->update($data);
        Session::flash('message','Succesfully updated');
        return redirect('/brands');  
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        Session::flash('message', 'Successfully Deleted');
        return redirect('/brands');
    }
}
