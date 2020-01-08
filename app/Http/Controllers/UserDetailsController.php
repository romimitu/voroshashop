<?php
namespace App\Http\Controllers;
use Auth;
use App\User;
use App\UserDetails;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DB;
class UserDetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function index()
    {
        $city = DB::table('shipments')->distinct()->select('city')->get();
        $data = User::with('userdetails')->find(Auth()->user()->id);
        // return response()->json($data);
        return view('frontend.profile.profile', compact('data','city','zone'));
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function show(UserDetails $userDetails)
    {
        //
    }
    public function edit(UserDetails $userDetails)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $user = User::whereId($id)->update([
            'name' => request()->input('name'),
            'mobile' => request()->input('mobile'),
            'email' => request()->input('email'),
        ]);
        UserDetails::where('user_id', $id)->update([
            'address' => request()->input('address'),
            'area' => request()->input('area'),
            'thana' => request()->input('thana'),
            'city' => request()->input('city'),
            'postal_code' => request()->input('postal_code'),
        ]);
        Session::flash('message', 'Succesfully updated');
        return redirect('/user/profile');
    }
    public function destroy(UserDetails $userDetails)
    {
        //
    }
}