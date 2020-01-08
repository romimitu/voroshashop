<?php

namespace App\Http\Controllers;

use App\Category;
use App\SubCategory;
use App\MainCategory;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:category-list');
        $this->middleware('permission:category-create', ['only' => ['create','store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $categories = Category::where('parent_id', '=', 0)->get();
        $allCategories = Category::pluck('name','id')->all();
        return view('admin.categories.category', compact('categories', 'allCategories'));
    }

    public function create()
    {
        return view('admin.categories.category');
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->except('image'); 
        $data['image']=uploadFile('image',$request,'uploads/category/');
        $data['parent_id'] = empty($data['parent_id']) ? 0 : $data['parent_id'];
        $data['child_status'] = 1;
        $data = Category::create($data);
        $cat = Category::whereId(request()->input('parent_id'))->update([
            'child_status' => 0,
        ]);
        Session::flash('message','Added  Successfully');
        return redirect('/category');  
    }

    public function show($id)
    {
        // $data = Category::with('subcategory', 'maincategory')->find($id);
        // return response()->json($data);
    }
    public function edit(Category $category)
    {
        $datas = Category::orderBy('created_at', 'desc')->get();

        return view('admin.categories.edit-category', compact('category','datas'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->except('image'); 
        if ($request->hasFile('image')){
            $data['image']=uploadFile('image',$request,'uploads/category/');
        }
        $data['parent_id'] = empty($data['parent_id']) ? 0 : $data['parent_id'];
        $category->update($data);
        Session::flash('message', 'Succesfully updated');
        return redirect('/category');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        Session::flash('message', 'Successfully Deleted');
        return redirect('/category');
    }
}
