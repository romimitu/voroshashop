<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\About;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:about-list');
        $this->middleware('permission:about-create', ['only' => ['create','store']]);
        $this->middleware('permission:about-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:about-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $about = About::find($id);
        return view('admin.about', ['about' => $about]);
    }
    public function update(Request $request, $id)
    {
        $about = About::find($id);
        $data = $request->except('about_img','header_logo','footer_logo'); 
        if ($request->hasFile('about_img')){
            $data['about_img']=uploadFile('about_img',$request,'uploads/page/');
        }
        if ($request->hasFile('header_logo')){
            $data['header_logo']=uploadFile('header_logo',$request,'uploads/page/');
        } 
        if ($request->hasFile('footer_logo')){            
            $data['footer_logo']=uploadFile('footer_logo',$request,'uploads/page/');
        }
        $about->update($data);
        Session::flash('message', 'Succesfully updated');
        return redirect('/abouts/1/edit');
    }
    public function destroy($id)
    {
        //
    }
}
