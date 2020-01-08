<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Product;
use App\Category;
use App\Size;
use App\Blog;
use App\Photo;
use DB;
use Carbon\Carbon;
use Auth;
use App\User;
use App\OtpVerify;

class PublicController extends Controller
{

    public function ProductSearch(Request $request)
    {
        $products = DB::table('vw_productdetails')
        ->where('status', '1')
        ->where(function($query) use($request) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('sku', 'like', '%' . $request->search . '%');
        })
        ->orderBy('product_id', 'desc')
        ->paginate(20);
        return view('frontend.product', ['products' => $products]);
     }

    public function getProducts()
    {
        $products = DB::table('vw_productdetails')
        ->where('status', '1')
        ->orderBy('product_id', 'desc')
        ->paginate(20);
        return view('frontend.product', compact('products'));
    }
    
    public function getProductbyCategory($id, $slug)
    {
        $products = DB::table('vw_productdetails')
        ->where('cat_id', $id)
        ->where('status', 1)
        ->orderBy('product_id', 'desc')
        ->paginate(20);
        return view('frontend.product', compact('products'));
    }

    public function singleProduct($id, $slug)
    {
        $images = DB::table('images')
            ->select('*')
            ->where('images.product_id', '=', $id)
            ->get();
        $products = DB::table('vw_productdetails')
        ->where('product_id', $id)
        ->where('status', 1)
        ->get();
        $sameitem = DB::table('vw_productdetails')
        ->where('cat_id', $products[0]->cat_id)
        ->where('status', 1)
        ->inRandomOrder()
        ->paginate(10);
        return view('frontend.single-product', compact('images','products','sameitem'));
    }


    public function getproductBySize(Request $request)
    {
        $data = DB::table('product_details')
            ->select('*')
            ->where('product_details.product_id', '=', $request->product_id)
            ->where('product_details.size_id', '=', $request->size_id)
            ->get();
        return response()->json($data);
    }

    public function photoGallery()
    {
        $photos = Photo::orderBy('created_at', 'desc')->paginate(12);
        return view('frontend.pages.gallery', compact('photos'));
    }

    public function blogPost()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(12);
        return view('frontend.pages.blog', compact('blogs'));
    }
    public function singleBlog($id, $slug)
    {
        $blog = Blog::findOrfail($id);
        return view('frontend.pages.single-blog', compact('blog'));
    }

    public function orderTutsPage()
    {
        return view('frontend.pages.how-to-order');
    }
    public function termsPage()
    {
        return view('frontend.pages.terms');
    }
    public function policyPage()
    {
        return view('frontend.pages.policy');
    }
    public function contactPage()
    {
        return view('frontend.pages.contact');
    }
    public function otpVerify()
    {
        if(session()->has('cart')){
            if(Auth::check()) {
            return redirect('/checkout');
            }else{
                return view('frontend.pages.otp-verify');
            }
        }else{
            return view('frontend.cart');
        }
    }
    public function sendOtp(Request $request)
    {
        $data = OtpVerify::create([
            'mobile' => request()->input('mobile'),
            'code' => request()->input('code'),
        ]);
        return response()->json($data);
    }
    public function getOtpCode(Request $request)
    {
        $data = DB::table('otp_verifies')
            ->select('*')
            ->where('otp_verifies.mobile', '=', $request->mobile)
            ->where('otp_verifies.code', '=', $request->code)
            ->where('otp_verifies.verified_at', '=', null)
            ->get();
        return response()->json($data);
    }
    public function updateOtp(Request $request)
    {
        $id=request()->input('id');
        $data = OtpVerify::whereId($id)->update([
            'status' => 'verified',
            'verified_at' => Carbon::now(),
        ]);
        session(['otp' => $data]);
        return response()->json($data);
    }
}

