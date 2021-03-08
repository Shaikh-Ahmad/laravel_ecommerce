<?php

namespace App\Http\Controllers;

use App\Product;
use Stripe\Charge;
use Stripe\Stripe;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->get( 'q' );
        $products= Product::latest()->where('title', 'LIKE', '%' . $q . '%')->paginate(25);
        return view('shop.index', compact('products'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * check out after shoping.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkout()
    {
        
        return view('checkout.index');
    }

    public function stripePayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        Charge::create ([
                "amount" =>  Intval(implode(explode(',', Cart::total()))) *100 ,
                "currency" => "usd",
                // "Adress" => $request->input('adress'),
                "source" => $request->stripeToken,
               
                "description" => "Test payment from Ahmed",
                "metadata" =>[
                    "order_id" => "6735",
                    // "Adress" => $request->input('adress')
                ]
        ]);
  
        return redirect()->route('products.index')->with('success', 'Order have been placed successfully');
     
        // dd($request->all());
    }


    
}
