<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:blog-list');
        $this->middleware('permission:blog-create', ['only' => ['create','store']]);
        $this->middleware('permission:blog-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:blog-delete', ['only' => ['destroy']]);
    }
    
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.blog.index', ['blogs' => $blogs]);      }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $data = $request->except('image'); 
        $data['image']=uploadFile('image',$request,'uploads/blog/');
        $blog = Blog::create($data);
        Session::flash('message','Added  Successfully');
        return redirect('/blogs');
    }

    public function show(Blog $blog)
    {
        //
    }

    public function edit(Blog $blog)
    {
        return view('admin.blog.edit', ['blog' => $blog]);
    }

    public function update(Request $request, Blog $blog)
    {
        $data = $request->except('image'); 
        if ($request->hasFile('image')){
            $data['image']=uploadFile('image',$request,'uploads/blog/');
        }        
        $blog->update($data);
        Session::flash('message', 'Succesfully updated');
        return redirect('/blogs');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        Session::flash('message', 'Successfully Deleted');
        return redirect('/blogs');
    }
}
