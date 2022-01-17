<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;

class PaymentController extends Controller
{
    public function Payment(Request $request)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['city'] = $request->city;
        $data['payment'] = $request->payment;
        // dd($data);

        if ($request->payment == 'stripe') {
            return view('pages.payment.stripe', compact('data'));
        } elseif ($request->payment == 'paypal') {
            # code...
            return view('pages.payment.paypal', compact('data'));
        } elseif ($request->payment == 'oncash') {
            return view('pages.payment.oncash', compact('data'));
        } else {
            echo "Cash On Delivery";
        }
    }


    public function StripeCharge(Request $request)
    {
        $email = Auth::user()->email;
        $total = $request->total;
        \Stripe\Stripe::setApiKey('sk_test_51KFh18Jnbx4GcaTfIqgjLXkF8UCB3a4DsKQZIHy9NYQEQVSMYnXDz8y43BihhKsNsKxlR6tBkO1bNPfDAG52KcjZ002jL2f4IB');
        $charge = \Stripe\Customer::create(array(
          'name' => 'test',
          'description' => 'Udemy Ecommerce Details',
          'metadata' => ['order_id' => uniqid()],
          'email' => $email,
          'source' => $request->input('stripeToken'),
           "address" => ["city" => "San Francisco", "country" => "US", "line1" => "510 Townsend St", "postal_code" => "98140", "state" => "CA"]

      ));
    
        $data = array();
        $data['user_id'] = Auth::id();
        $data['payment_id'] = 'A21AAFEpH4PsADK7qSS7750'.rand(99, 999);
        $data['paying_amount'] =  $total;
        $data['blnc_transaction'] = 'APP-80W284485P519543T257'. rand(99, 999);
        $data['stripe_order_id'] = $charge->metadata->order_id;
        $data['shipping'] = $request->shipping;
        $data['vat'] = $request->vat;
        $data['total'] = $request->total;
        $data['payment_type'] = $request->payment_type;
        $data['status_code'] = mt_rand(100000, 999999);

        if (Session::has('coupon')) {
            $data['subtotal'] = Session::get('coupon')['balance'];
        } else {
            $data['subtotal'] = Cart::Subtotal();
        }
        $data['status'] = 0;
        $data['date'] = date('d-m-y');
        $data['month'] = date('F');
        $data['year'] = date('Y');
        $order_id = DB::table('orders')->insertGetId($data);

        // Mail send to user for Invoice
        Mail::to($email)->send(new invoiceMail($data));


        /// Insert Shipping Table

        $shipping = array();
        $shipping['order_id'] = $order_id;
        $shipping['ship_name'] = $request->ship_name;
        $shipping['ship_phone'] = $request->ship_phone;
        $shipping['ship_email'] = $request->ship_email;
        $shipping['ship_address'] = $request->ship_address;
        $shipping['ship_city'] = $request->ship_city;
        DB::table('shipping')->insert($shipping);


        // Insert Order Details Table
    
        $content = Cart::content();
        $details = array();
        foreach ($content as $row) {
            $details['order_id'] = $order_id;
            $details['product_id'] = $row->id;
            $details['product_name'] = $row->name;
            $details['color'] = $row->options->color;
            $details['size'] = $row->options->size;
            $details['quantity'] = $row->qty;
            $details['singleprice'] = $row->price;
            $details['totalprice'] = $row->qty*$row->price;
            DB::table('order_details')->insert($details);
        }

        Cart::destroy();
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        $notification=array(
                        'messege'=>'Order Process Successfully Done',
                        'alert-type'=>'success'
                         );
        return Redirect()->to('/')->with($notification);
    }


    public function OnCash(Request $request)
    {
        $data = array();
        $data['user_id'] = Auth::id();
        $data['shipping'] = $request->shipping;
        $data['vat'] = $request->vat;
        $data['total'] = $request->total;
        $data['payment_type'] = $request->payment_type;
        $data['status_code'] = mt_rand(100000, 999999);
    
        if (Session::has('coupon')) {
            $data['subtotal'] = Session::get('coupon')['balance'];
        } else {
            $data['subtotal'] = Cart::Subtotal();
        }
        $data['payment_id'] = 'A21AAFEpH4PsADK7qSS7pS'.rand(1, 999);
        $data['blnc_transaction'] = 'APP-80W284485P519543T'.rand(1, 999);
        $data['paying_amount'] = Cart::Subtotal()+15;
        $data['status'] = 0;
        $data['date'] = date('d-m-y');
        $data['month'] = date('F');
        $data['year'] = date('Y');
        $order_id = DB::table('orders')->insertGetId($data);
    
       
        /// Insert Shipping Table
    
        $shipping = array();
        $shipping['order_id'] = $order_id;
        $shipping['ship_name'] = $request->ship_name;
        $shipping['ship_phone'] = $request->ship_phone;
        $shipping['ship_email'] = $request->ship_email;
        $shipping['ship_address'] = $request->ship_address;
        $shipping['ship_city'] = $request->ship_city;
        DB::table('shipping')->insert($shipping);
    
        // Insert Order Details Table
        
        $content = Cart::content();
        $details = array();
        foreach ($content as $row) {
            $details['order_id'] = $order_id;
            $details['product_id'] = $row->id;
            $details['product_name'] = $row->name;
            $details['color'] = $row->options->color;
            $details['size'] = $row->options->size;
            $details['quantity'] = $row->qty;
            $details['singleprice'] = $row->price;
            $details['totalprice'] = $row->qty*$row->price;
            DB::table('order_details')->insert($details);
        }
    
        Cart::destroy();
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        $notification=array(
                            'messege'=>'Order Process Successfully Done',
                            'alert-type'=>'success'
                             );
        return Redirect()->to('/')->with($notification);
    }

    public function SuccessList()
    {
        $order = DB::table('orders')->where('user_id', Auth::id())->where('status', 3)->orderBy('id', 'DESC')->limit(5)->get();
      
        return view('pages.returnorder', compact('order'));
    }
      
      
    public function RequestReturn($id)
    {
        DB::table('orders')->where('id', $id)->update(['return_order'=>1]);
        $notification=array(
                              'messege'=>'Order Request Done',
                              'alert-type'=>'success'
                               );
        return Redirect()->back()->with($notification);
    }
}
