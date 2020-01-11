<?php
namespace App\Http\ViewComposer;

use Spatie\Permission\Models\Role;
use App\Slider;
use App\Product;
use App\Blog;
use App\User;
use App\Category;
use App\About;
use App\Feature;
use Illuminate\View\View;
use DB;
use Auth;
class PublicComposer
{

    public function aboutInfo(View $view)
    {
        $aboutinfo = About::take(1)->get();
        $roles =Role::all();
        $view->with('aboutinfo', $aboutinfo)->with('roles', $roles);
    }

    public function getSlider(View $view)
    {
        $sliders = Slider::orderBy('created_at', 'desc')->where('status',1)->get();
        $view->with('sliders', $sliders);
    }
    
    public function getFeatures(View $view)
    {
        $features = Feature::orderBy('created_at', 'desc')->where('status',1)->paginate(2);
        $view->with('features', $features);
    }

    public function getRandomProduct(View $view)
    {
        $products = DB::table('vw_productdetails')
        ->where('status', '1')
        ->orderBy('product_id', 'desc')
        ->inRandomOrder()
        ->paginate(10);
        $view->with('products', $products);
    }
    public function getUser(View $view)
    {
        $user = User::with('userDetails')->findOrFail(Auth::user()->id);
        $view->with('user', $user);
    }
    public function getCategory(View $view)
    {
        $topcategory = Category::where('child_status',1)
        ->take(5)
        ->get();

        $categories = Category::where('child_status',1)
        ->where('status', 1)
        ->inRandomOrder()
        ->paginate(8);
        $allCategories = DB::table('categories')
        ->where('status', 1)
        ->where('child_status', 1)
        ->orderBy('created_at', 'desc')
        //->inRandomOrder()
        ->paginate(12);
        //$cat = Category::with('childs')->get()->toArray();
        //dd($allCategories);
        $view->with('categories', $categories)->with('allCategories', $allCategories)->with('topcategory', $topcategory);
    }

    public function getCartData(View $view)
    {
        $data = [];
        $data['cart'] = session()->has('cart') ? session()->get('cart') : [];
        $data['total'] = array_sum(array_column($data['cart'], 'total_price'));
        $view->with($data);
    }
}
