<?php

namespace App\Http\Controllers;

use App\StockLedger;
use App\Product;
use App\Order;
use App\OrderProduct;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Input;
use DB;
use Auth;
use App\User;
use GuzzleHttp\Client;
use App\Mail\OrderSubmit;
use Mail;

class CartController extends Controller
{
    public function showCart()
    {
        $data = [];
        $data['cart'] = session()->has('cart') ? session()->get('cart') : [];
        $data['total'] = array_sum(array_column($data['cart'], 'total_price'));
        return view('frontend.cart', $data);
    }
    public function addToCart(Request $request)
    {
        $product = DB::table('vw_productdetails')
            ->where('product_id', '=', $request->product_id)
            ->get();

        $cart = session()->has('cart') ? session()->get('cart') : [];
        if (array_key_exists($product[0]->product_id, $cart)) {
            $cart[$product[0]->product_id]['quantity']++;
            $cart[$product[0]->product_id]['total_price']=$cart[$product[0]->product_id]['quantity']*$cart[$product[0]->product_id]['sales_price'];
        } else {
            $cart[$product[0]->product_id] = [
                'id' => $product[0]->product_id,
                'product_id' => $product[0]->product_id,
                'supplier_id' => $product[0]->supplier_id,
                'title' => $product[0]->title,
                'image' => $product[0]->image,
                'size' => $product[0]->size,
                'quantity' => 1,
                'price' => $product[0]->sales_price,
                'sales_price' => $product[0]->sales_price,
                'purchase_price' => $product[0]->purchase_price,
                'total_price' => $product[0]->sales_price,
            ];
        }
        session(['cart' => $cart]);
        $data = [];
        $data['cart'] = session()->has('cart') ? session()->get('cart') : [];
        return response()->json($data);
    }

    public function removeFromCart(Request $request)
    {
        $cart = session()->has('cart') ? session()->get('cart') : [];
        unset($cart[$request->input('product_id')]);
        session(['cart' => $cart]);
        $data = [];
        $data['cart'] = session()->has('cart') ? session()->get('cart') : [];
        return response()->json($data);
    }
    public function clearCart()
    {
        session(['cart' => []]);
        return redirect()->back();
    }
    
    public function checkout()
    {
        $data = [];
        $data['cart'] = session()->has('cart') ? session()->get('cart') : [];
        $data['total'] = array_sum(array_column($data['cart'], 'total_price'));
        $data['city'] = DB::table('shipments')->distinct()->select('city')->get();
        if(!empty($data['cart'])) {
            return view('frontend.checkout', $data);
        }else{
            return redirect('/cart');
        }
    }


    public function getShippingFee(Request $request)
    {
        $data = DB::table('shipments')
            ->select('fee')
            ->where('city', '=', $request->id)
            ->get();
        return response()->json($data);
    }


    public function processOrder(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'customer_name' => 'required',
            'customer_mobile' => 'required|min:11|max:15',
            'address' => 'required',
            'city' => 'required',
            'accept-terms' =>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if(request()->input('register')==true){
            $validator = Validator::make(request()->all(), [
                'customer_mobile' => 'required|min:11|max:15|unique:users,mobile',
                'customer_email' => 'required|unique:users,email',
                'password'=> 'required_if:password,on|min:6',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $member = User::create([
                'name' => request()->input('customer_name'),
                'email' => request()->input('customer_email'),
                'mobile' => request()->input('customer_mobile'),
                'password' => bcrypt(request()->input('password')),
            ]);
            $user=$member->id;
        }elseif(Auth::check()) {
            $user=auth()->user()->id;
        }else{
            $user=0;
        }
        $data=DB::transaction(function () use ($request,$user) {
            $cart = session()->has('cart') ? session()->get('cart') : [];
            $total = array_sum(array_column($cart, 'total_price'));
            $lastid = DB::table('orders')->pluck('id')->last()+1;
            $invoiceid =now()->format('ymd').$lastid;
            $invoice_no = "SI".str_pad($invoiceid + 1, 6, "0", STR_PAD_LEFT);
            $order = Order::create([
                'user_id' => $user,
                'invoice_no' => $invoice_no,
                'invoice_date' => now()->format('Y-m-d'),
                'customer_name' => request()->input('customer_name'),
                'customer_mobile' => request()->input('customer_mobile'),
                'customer_email' => request()->input('customer_email'),
                'address' => request()->input('address'),
                'city' => request()->input('city'),
                'total_amount' => $total,
                'shipping_fee' => request()->input('shipping_fee'),
                'paid_amount' => 0,
                'payment_details' => 'cash on delivery',
            ]);
            foreach ($cart as $product_id => $product) {
                $order->products()->create([
                    'product_id' => $product['product_id'],
                    'quantity' => $product['quantity'],
                    'price' => $product['sales_price'],
                    'purchase_price' => $product['purchase_price'],
                ]);
            }

            foreach ($cart as $product_id =>$product) {
                $data = new StockLedger();
                $data->invoice_no = $invoice_no;
                $data->tr_no = $invoice_no;
                $data->invoice_date = now()->format('Y-m-d');
                $data->supplier_id = $product['supplier_id'];
                $data->product_id = $product['product_id'];
                $data->purchase_price = $product['purchase_price'];
                $data->sale_price = $product['sales_price'];
                $data->stock_status = 2;
                $data->outqty = $product['quantity'];
                $data->save();
            }
            return $order->id;
        });

        // if($order->customer_email!=null){
        //     Mail::to($order->customer_email)->cc(env('MAIL_FROM_ADDRESS'))->send(new OrderSubmit($order));
        // }
        session()->forget(['cart']);
        //session()->forget(['otp']);
        session()->flash('message', 'Order placed successfully.');
        return redirect()->route('order.details',$data);
    }

    public function showOrder($id)
    {
        $data = [];
        $data['order'] = Order::with(['products', 'products.product','products.product.brand','products.product.color','products.product.size'])->findOrFail($id);
        //dd($data['order']->toArray());
        return view('admin.order.view', $data);
    }

    public function orderList()
    {
        $data = Order::orderBy('created_at', 'desc')->where('user_id', Auth()->user()->id)->paginate(10);
        //dd($data);
        return view('frontend.profile.orders', compact('data'));
    }


    public function cancelOrder(Order $order)
    {
        $orders = Order::whereId($order->id)->update([
            'operational_status' => 'cancel',
        ]);
        DB::table("stock_ledgers")->where("invoice_no", $order->invoice_no)->delete();
        session()->flash('message', 'Order Update successfully.');
        //return redirect()->route('order.details', $order->id);
        return redirect('/order-list');

    }
}