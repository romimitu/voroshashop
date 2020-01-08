<?php

namespace App\Http\Controllers;
use File;
use DB;
use App\Product;
use App\Category;
use App\Size;
use App\Image;
use App\Color;
use App\Brand;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:product-list');
        $this->middleware('permission:product-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data = Product::with('category','brand','color','image')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.product.index', compact('data'));
    }

    public function create()
    {
        $category=Category::orderBy('created_at', 'desc')->get();
        $sizes=Size::orderBy('created_at', 'desc')->get();
        $colors=Color::orderBy('created_at', 'desc')->get();
        $brands=Brand::orderBy('created_at', 'desc')->get();
        return view('admin.product.create', compact('category','sizes','colors','brands'));
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create([
            'cat_id' => request()->input('cat_id'),
            'title' => request()->input('title'),
            'description' => request()->input('description'),
            'sku' => request()->input('sku'),
            'brand_id' => request()->input('brand_id'),
            'size_id' => request()->input('size_id'),
            'color_id' => request()->input('color_id')!=0?request()->input('color_id'):0,
            'status' => request()->input('status'),
            'sales_price' => request()->input('sales_price'),
        ]);


        foreach ($request->files as $image) {
            foreach ($image as $key => $data) {
                $data = $request->file('files')[$key];
                $data->move('uploads/product/', time().'-'.$data->getClientOriginalName());
                Image::create([
                    'product_id' => $product->id,
                    'image' => time().'-'.$data->getClientOriginalName()
                ]);
            }
        }
        Session::flash('message','Added  Successfully');
        return redirect('/products');
    }

    public function show($id)
    {

    }
    public function edit(Product $product)
    {
        $category=Category::orderBy('created_at', 'desc')->get();
        $sizes=Size::orderBy('created_at', 'desc')->get();
        $colors=Color::orderBy('created_at', 'desc')->get();
        $brands=Brand::orderBy('created_at', 'desc')->get();
        $product = Product::with('category','brand','color','image')->find($product->id);
        return view('admin.product.edit', compact('product','category','sizes','colors','brands'));
    }

    public function update(ProductRequest $request, product $product)
    {
        $product = Product::whereId($product->id)->update([
            'cat_id' => request()->input('cat_id'),
            'title' => request()->input('title'),
            'description' => request()->input('description'),
            'sku' => request()->input('sku'),
            'brand_id' => request()->input('brand_id'),
            'size_id' => request()->input('size_id'),
            'color_id' => request()->input('color_id')!=0?request()->input('color_id'):0,
            'status' => request()->input('status'),
            'sales_price' => request()->input('sales_price'),
        ]);
        

        if ($request->hasFile('files')){
            foreach ($request->files as $image) {
                foreach ($image as $key => $data) {
                    $data = $request->file('files')[$key];
                    $data->move('uploads/product/', time().'-'.$data->getClientOriginalName());
                    Image::create([
                        'product_id' => $request->product_id,
                        'image' => time().'-'.$data->getClientOriginalName()
                    ]);
                }
            }
        }
        Session::flash('message', 'Succesfully updated');
        return redirect('/products');
    }

    public function destroy(Product $product)
    {
        foreach($product->image as $key=>$image){
            $image=$product->image[$key]->image;
            $image_path = public_path().'/uploads/product/'.$image;

            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        }
        $product->delete();
        Session::flash('message', 'Successfully Deleted');
        return redirect('/products');
    }


    public function imageDestroy(Request $request)
    {
        if(isset($request->id)){
            $todo = Image::findOrFail($request->id);
            $image=$todo->image;

            $image_path = public_path().'/uploads/product/'.$image;
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $todo->delete();
            return response(['msg' => 'Image deleted', 'status' => 'success']);
        }
    }

    public function productInfo($id)
    {
        $data = Product::where('id', $id)->get();
        return response()->json($data);
    }
}
