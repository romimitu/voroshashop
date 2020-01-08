<?php

namespace App\Http\Controllers;

use App\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class ColorController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:color-list');
        $this->middleware('permission:color-create', ['only' => ['create','store']]);
        $this->middleware('permission:color-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:color-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data = Color::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.attribute.color', compact('data'));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $data = $request->all(); 
        $data = Color::create($data);
        Session::flash('message','Added  Successfully');
        return redirect('/colors');  
    }

    public function show(Color $color)
    {
        $data = Color::find($color->id);
        return response()->json($data);
    }

    public function edit(Color $color)
    {
        //
    }

    public function update(Request $request, Color $color)
    {
        $data = $request->all();
        $color->update($data);
        Session::flash('message','Succesfully updated');
        return redirect('/colors');
    }

    public function destroy(Color $color)
    {
        $color->delete();
        Session::flash('message', 'Successfully Deleted');
        return redirect('/colors');
    }
}
