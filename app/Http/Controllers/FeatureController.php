<?php

namespace App\Http\Controllers;

use App\Feature;
use Imagick;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class FeatureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Feature::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.feature.index', compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->except('image');
        $data['image']=uploadFile('image',$request,'uploads/feature/');
        $feature = Feature::create($data);
        Session::flash('message','Added  Successfully');
        return redirect('/features');
    }

    public function show(Feature $feature)
    {
        //
    }

    public function edit(Feature $feature)
    {
        $feature = Feature::find($feature->id);
        return view('admin.feature.edit', compact('feature'));
    }

    public function update(Request $request, Feature $feature)
    {
        $data = $request->except('image'); 
        if ($request->hasFile('image')){
            $data['image']=uploadFile('image',$request,'uploads/feature/');
        }        
        $feature->update($data);
        Session::flash('message', 'Succesfully updated');
        return redirect('/features');
    }

    public function destroy(Feature $feature)
    {
        $feature->delete();
        Session::flash('message', 'Successfully Deleted');
        return redirect('/features');
    }
}
