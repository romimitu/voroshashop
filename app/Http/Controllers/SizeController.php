<?php

namespace App\Http\Controllers;

use App\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class SizeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:size-list');
        $this->middleware('permission:size-create', ['only' => ['create','store']]);
        $this->middleware('permission:size-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:size-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data = Size::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.attribute.size', compact('data'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $data = $request->all();
        $data = Size::create($data);
        Session::flash('message','Added  Successfully');
        return redirect('/sizes');
    }


    public function show(Size $size)
    {
        $data = Size::find($size->id);
        return response()->json($data);
    }

    public function edit(Size $size)
    {
        //
    }

    public function update(Request $request, Size $size)
    {
        $data = $request->all();
        $size->update($data);
        Session::flash('message','Succesfully updated');
        return redirect('/sizes');
    }

    public function destroy(Size $size)
    {
        $size->delete();
        Session::flash('message', 'Successfully Deleted');
        return redirect('/sizes');
    }
}
