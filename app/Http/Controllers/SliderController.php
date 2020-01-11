<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:slider-list');
        $this->middleware('permission:slider-create', ['only' => ['create','store']]);
        $this->middleware('permission:slider-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:slider-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data = Slider::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.slider.slider', compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->except('image');
        $data['image']=uploadFile('image',$request,'uploads/slider/');
        $slider = Slider::create($data);
        Session::flash('message','Added  Successfully');
        return redirect('/sliders'); 
    }

    public function show(Slider $slider)
    {
        //
    }

    public function edit(Slider $slider)
    {
        $slider = Slider::find($slider->id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $data = $request->except('image'); 
        if ($request->hasFile('image')){
            $data['image']=uploadFile('image',$request,'uploads/slider/');
        }        
        $slider->update($data);
        Session::flash('message', 'Succesfully updated');
        return redirect('/sliders');
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();
        Session::flash('message', 'Successfully Deleted');
        return redirect('/sliders');
    }
}
