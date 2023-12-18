<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\user;
use App\Models\phone_number;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Session;

use Stripe;
use App\Models\Comment;
use App\Models\Reply;

class HomeController extends Controller
{
    //
    public function redirect()
    {
        $usertype=Auth::user()->usertype;

        if($usertype==1)
        {
            $total_product=product::all()->count();
            $total_order=order::all()->count();
            $total_user=user::all()->count(); 
            $order=order::all();
            $total_revenue=0;
            $order_delivered=order::where('deliver_status','=','delivered')->get()->count();
            $order_processing=order::where('deliver_status','=','processing')->get()->count();
            foreach($order as $order)
            {

                $total_revenue=$total_revenue + $order->price;
                
                
            }
           
          
            return view('admin.home',compact('total_product','total_order','total_user','total_revenue','order_delivered','order_processing'));
        }
        else
        {
            $product=product::paginate(9);
            $comment=comment::orderby('id','desc')->get();
            $reply=reply::all();
            return view('home.userpage',compact('product','comment','reply'));
        }
    }
    public function index()
    {
        $product=product::paginate(9);
        $comment=comment::orderby('id','desc')->get();
        $reply=reply::all();
        return view('home.userpage',compact('product','comment','reply'));
    }
    public function product_details($id)
    {
        $product=product::find($id);
        return view('home.product_details',compact('product'));
    }
    public function add_cart(Request $request, $id)
    {
        if(Auth::id())
        {
           $user=Auth::user();
           $userid=$user->id;

           $product=product::find($id);
           $product_exist_id=cart::where('product_id','=',$id)->where('user_id','=',$userid)->get('id')->first();
           if($product_exist_id)
           {
            $cart=cart::find($product_exist_id)->first();
            $quantity=$cart->quantity;
            $cart->quantity=$quantity + $request->Quantity;
            if($product->discount_price!=null)
            {
              $cart->price=$product->discount_price * $cart->quantity;
            }
            else
            {
                $cart->price=$product->price * $cart->quantity;
            }
            $cart->save();
            return redirect()->back()->with('message','Product added successfully');
              


           }
           else
           {
            $cart=new cart;
            $cart->name=$user->name;
            $cart->email=$user->email;
            $cart->phone=$user->phone;
            $cart->address=$user->address;
            $cart->user_id=$user->id;
            $cart->product_title=$product->title;
            if($product->discount_price!=null)
            {
              $cart->price=$product->discount_price * $request->Quantity;
            }
            else
            {
                $cart->price=$product->price * $request->Quantity;
            }
            $cart->image=$product->image;
            $cart->product_id=$product->id;
            $cart->quantity=$request->Quantity;
 
            $cart->save();
            return redirect()->back()->with('message','Product added successfully');
 

           }
          

        }
        else
        {
            return redirect('login');
        }
    }
    public function show_cart()
    {
        if(Auth::id())
        {

         $id=Auth::user()->id;
        $cart=cart::where('user_id','=',$id)->get();
        return view('home.show_cart',compact('cart'));
        }
        else
        {
            return redirect('login');
        }
        
    }
    public function about_us()
    {
        return view('home.about_us');
    }
    public function remove_cart($id)
    {

        $cart=cart::find($id);
        $cart->delete();
        return redirect()->back();

    }
    public function cash_order()
    {
        $user=Auth::user();
        $userid=$user->id;
        $user = User::find($userid); // Retrieve the user
        $phone = Phone_number::where('user_id', $userid)->first();
        $data=cart::where('user_id','=',$userid)->get();
        
        foreach($data as $data)
        {

            $order=new order;
            $order->name=$data->name;
            $order->email=$data->email;
            if ($phone) {
                $order->phone = $phone->phone;
            }
            $order->address=$data->address;
            $order->user_id=$data->user_id;
            $order->product_title=$data->product_title;
            $order->price=$data->price;
            $order->quantity=$data->quantity;
            $order->image=$data->image;
            $order->product_id=$data->product_id;
            $order->payment_status='cash on delivery';
            $order->deliver_status='processing';
            $order->save();
            $cart_id=$data->id;
            $cart=cart::find($cart_id);
            $cart->delete();

        }
        return redirect()->back()->with('message','We have received Your Order. We will connect with you soon');


    }
    public function stripe($total_price)
    {
        return view('home.stripe',compact('total_price'));
    }
    public function stripePost(Request $request,$total_price)

    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    

        Stripe\Charge::create ([

                "amount" => $total_price * 100,

                "currency" => "usd",

                "source" => $request->stripeToken,

                "description" => "Thanks For Payment" 

        ]);
        $user=Auth::user();
        $userid=$user->id;
        $data=cart::where('user_id','=',$userid)->get();
        foreach($data as $data)
        {

            $order=new order;
            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->user_id=$data->user_id;
            $order->product_title=$data->product_title;
            $order->price=$data->price;
            $order->quantity=$data->quantity;
            $order->image=$data->image;
            $order->product_id=$data->product_id;
            $order->payment_status='Paid';
            $order->deliver_status='processing';
            $order->save();
            $cart_id=$data->id;
            $cart=cart::find($cart_id);
            $cart->delete();

        }

      

        Session::flash('success', 'Payment successful!');

              

        return back();

    }
    public function show_order()
    {
        if(Auth::id())
        {
            $user=Auth::user();
            $userid=$user->id;
            $order=order::where('user_id','=',$userid)->get();
            return view('home.show_order',compact('order'));

        }

        else
        {
            return redirect('login');
        }
    }
    public function cancel_order($id)
    {

        $order=order::find($id);
      
        $order->deliver_status='cancel';
        $order->save();
        
        return redirect()->back();
    }
    public function add_comment(Request $request)
    {
        if(Auth::id())
        {
            $comment=new comment;
            $comment->name=Auth::user()->name;
            $comment->user_id=Auth::user()->id;
            $comment->comment=$request->comment;
            $comment->save();
            return redirect()->back();
          

        }
        else
        {
            return redirect('login');
        }
    }
    public function add_reply(Request $request)
    {
        if(Auth::id())
        {
            $reply=new reply;
            $reply->name=Auth::user()->name;
            $reply->user_id=Auth::user()->id;
            $reply->comment_id=$request->commentId;
            $reply->reply=$request->reply;
            $reply->save();
            return redirect()->back();


        }
        else
        {
            return redirect('login');
        }

    }
    public function product_search(Request $request)
    {
        $comment=comment::orderby('id','desc')->get();
        $reply=reply::all();

        $search_text=$request->search;
        $product=product::where('title','like',"%$search_text%")->orWhere('category','like',"%$search_text%")->paginate(9);
        return view('home.userpage',compact('product','comment','reply'));
        

    }
    public function products()
    {
        $product=product::paginate(9);
        return view('home.all_product',compact('product'));

    }
    public function search_product(Request $request)
    {
        $search_text=$request->search;
        $product=product::where('title','like',"%$search_text%")->orWhere('category','like',"%$search_text%")->paginate(9);
        return view('home.all_product',compact('product'));
    }
    public function show_profile()
    {
        if(Auth::id())
        {
            $user=Auth::user();
            $userid=$user->id;
            $phone=phone_number::where('user_id','=',$userid)->get();
            return view('home.profile',compact('user','phone'));

        }

        else
        {
            return redirect('login');
        }
    }
    public function savePhoneNumber(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'phone' => 'required'
    ]);

    $user=Auth::user();
    $userid=$user->id;

    // Create a new PhoneNumber instance
    $phoneNumber = new phone_number();
    $phoneNumber->user_id=$userid;
    $phoneNumber->phone = $validatedData['phone'];
    $phoneNumber->save();

    // Return a response indicating success
    return redirect('show_profile');
}
   
}

