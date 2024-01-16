<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PaytmWallet;

class OrderController extends Controller
{
    public function myOrder(){
        $order = Order::where([["status",true],["user_id",Auth::id()]])->first();
        $data['payment'] = Payment::where('order_id',$order->id)->first();
        $data['order'] = $order;

        return view('home.myOrder',$data);
    }


    public function addToCart(Request $request , $id){
        $product = Product::find($id);
        
        $user = Auth::user();

        if($product){
            $order = Order::where([["status",false],["user_id",$user->id]])->first();

            if($order){
                $orderItem = OrderItem::where("status",false)->where('product_id',$id)->where("order_id" , $order->id)->first();
                
                if($orderItem){
                    // if orderItem alredy in cart
                    $orderItem->qty += 1;
                    $orderItem->save();
                }
                else{
                    $oi = new OrderItem();
                    $oi->status = false;
                    $oi->product_id = $id;
                    $oi->order_id = $order->id;
                    $oi->save();
                }
            }
            else{
                // if order not exist in cart
                $o = new Order();
                $o->user_id = $user->id;
                $o->status = false;
                $o->save();

                
                $oi = new OrderItem();
                $oi->status = false;
                $oi->product_id = $id;
                $oi->order_id = $o->id;
                $oi->save();
            }
            return redirect()->route("cart")->with("success","product added or updated sucesfully");
        }
        else{
            return redirect()->route("home")->with("error" , "Product not found");
        }
        
    } 
    
    public function removeFromCart(Request $request , $id){
        $product = Product::find($id);
        
        $user = Auth::user();

        if($product){
            $order = Order::where([["status",false],["user_id",$user->id]])->first();

            if($order){
                $orderItem = OrderItem::where("status",false)->where('product_id',$id)->where("order_id" , $order->id)->first();
                if($orderItem){
                    // if orderItem alredy in cart
                    if($orderItem->qty > 1){
                        
                        $orderItem->qty -= 1;
                        $orderItem->save();
                    }
                    else{
                        $orderItem->delete();

                    }
                }
               
            }
            
            return redirect()->route("cart")->with("success","product updated sucesfully");
        }
        else{
            return redirect()->route("home")->with("error" , "Product not found");
        }
        
    }

    public function cart(){
        $data['order'] = Order::where([["user_id" , Auth::id()],["status",false]])->first();
        return view("home.cart",$data);     
    }
    
    public function checkout(Request $req){
        $data['addresses'] = Address::where('user_id',Auth::id())->get();
        if($req->isMethod("post")){
            $data = $req->validate([
                'street_name' => 'required',
                'landmark' => 'required',
                'area' => 'required',
                'city' => 'required',
                'state' => 'required',
                'type' => 'required',
                'pincode' => 'required',
            ]);
            $data['user_id'] = Auth::id();

            Address::create($data);
            return redirect()->back()->with("success","Address inserted successfylly");
        }
        return view("home.checkout",$data);     
    }




    public function manageCarts(){
        $data['totalCarts'] = Order::where("status",false)->get();
        $data['carts'] = Order::where('status',false)->orderBy('id','desc')->paginate(2);

        return view('admin.manageCart',$data);
    }


    

    public function order(Request $req)
    {


        $payment = PaytmWallet::with('receive');
        
       $order_id = rand(100,9999);


        // order fetching
        $order = Order::where([["status",false],["user_id",Auth::id()]])->first();

        $order->address_id = $req->address_id;
        $order->save();

        $record =[
            'order_id' => $order->id,
            'user_id' => Auth::id(),
            'ORDERID' => $order_id,
            'TXNAMOUNT' => $req->amount,
        ];

        Payment::create($record);
        

        $data = [
            'order' => $order_id,
            'user' => Auth::id(),
            'mobile_number' => 9546805580,
            'email' => Auth::user()->email,
            'amount' => $req->amount,
            'callback_url' => route("status")
          ];

        $payment->prepare($data);
        return $payment->receive();
    }



    public function paymentCallback()
    {
        $transaction = PaytmWallet::with('receive');
        
        $response = $transaction->response(); // To get raw response as array
        //Check out response parameters sent by paytm here -> http://paywithpaytm.com/developer/paytm_api_doc?target=interpreting-response-sent-by-paytm
        
        if($transaction->isSuccessful()){

            $payment = Payment::where('ORDERID', $transaction->getOrderId())->first();


            if($payment){
                $payment->BANKTXNID = $response['BANKTXNID'];
                $payment->CURRENCY = $response['CURRENCY'];
                $payment->GATEWAYNAME = $response['GATEWAYNAME'];
                $payment->PAYMENTMODE = $response['PAYMENTMODE'];
                $payment->RESPCODE = $response['RESPCODE'];
                $payment->STATUS = $response['STATUS'];
                $payment->TXNAMOUNT = $response['TXNAMOUNT'];
                $payment->TXNDATE = $response['TXNDATE'];
                $payment->TXNID = $response['TXNID'];

                $payment->save();
            }

            $order = Order::where([["status",false],["user_id",Auth::id()]])->first();
            $order->status = true;
            $order->save();

                

            return redirect()->route('home')->with('success','order placed successfully');
          //Transaction Successful
        }else if($transaction->isFailed()){
          //Transaction Failed
        }else if($transaction->isOpen()){
          //Transaction Open/Processing
        }
        $transaction->getResponseMessage(); //Get Response Message If Available
        //get important parameters via public methods
        $transaction->getOrderId(); // Get order id
        $transaction->getTransactionId(); // Get transaction id
    } 
}
