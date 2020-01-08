<?php
namespace App\Http\ViewComposer;

use Spatie\Permission\Models\Role;
use App\Slider;
use App\Product;
use App\Blog;
use App\User;
use App\Category;
use App\About;
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

    public function getProductInfo(View $view, $id)
    {
        $productInfo = Product::orderBy('created_at', 'desc')->where('id',$id)->get();
        $view->with('productInfo', $productInfo);
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
        ->paginate(9);
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
