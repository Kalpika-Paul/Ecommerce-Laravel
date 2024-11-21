<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\StripeClient;

class OrdersController extends Controller
{
    public function index(){
        return view('checkout');
    }

    public function checkoutData(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'pincode' => 'required',
            'phone' => 'required',
        ]);
    
        $cartItems = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select(
                'carts.product_id',
                DB::raw("count(*) as quantity"),
                'products.price','products.title'
            )
            ->where('carts.user_id', auth()->user()->id)
            ->groupBy(
                'carts.product_id',
                'products.price', 'products.title'
            )
            ->get();
    
        if ($cartItems->isEmpty()) {
            return redirect()->route('product.showCart')->with('error', 'The cart is empty');
        }
    
        $productIds = [];
        $quantities = [];
        $totalPrice = 0;
        $lineItems =[];
        foreach ($cartItems as $cartItem) {
            $productIds[] = $cartItem->product_id; // Use [] to store multiple IDs
            $quantities[] = $cartItem->quantity; // Store multiple quantities
            $totalPrice += $cartItem->price * $cartItem->quantity;
            $lineItems[] = [
                'price_data'=>[
                    'currency'=>'usd',
                     'product_data'=>[
                        'name'=>$cartItem->title
                    ],
                    'unit_amount'=> $cartItem->price * 100,
                ],

               'quantity'=>$cartItem->quantity,
            ];
        }
    
        $checkout = new Order();
        $checkout->user_id = auth()->user()->id;
        $checkout->address = $request->address;
        $checkout->phone = $request->phone;
        $checkout->pincode = $request->pincode;
        $checkout->product_id = json_encode($productIds);
        $checkout->total_price = $totalPrice;
        $checkout->quantity = json_encode($quantities);
    
        if ($checkout->save()) {
            DB::table('carts')->where('user_id', auth()->user()->id)->delete();
            // return redirect()->route('product.showCart')->with('success', 'Order Placed');

            $stripe = new StripeClient(config('app.STRIPE_KEY'));
            $checkoutSession = $stripe->checkout->sessions->create([
                'success_url' => route('payment.success', ['order_id' => $checkout->id]),
                'cancel_url' => route('payment.error'),
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'customer_email' => auth()->user()->email,
                'metadata' => [
                    'order_id' => $checkout->id,
                ],
            ]);
       return redirect($checkoutSession->url);
        }
    
        return redirect()->route('product.showCart')->with('error', 'There is an error');
    }

    public function paymentSuccess($order_id){
        return 'success' . $order_id ;
    }
    
    public function paymentError(){
        return "error";
    }
}
