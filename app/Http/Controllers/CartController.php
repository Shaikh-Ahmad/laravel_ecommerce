<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $cart = Cart::content();
        // return $cart ;   
       return view('cart.index');
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
        $duplicate = Cart::search(function ($cartItem, $rowId) use($request) {
            return $cartItem->id === $request->id;
        });
        if($duplicate->isNotEmpty()){
            return redirect()->route('cart.index')->with('success', 'Item already exist in your cart');
        }
        Cart::add($request->id, $request->title , 1, $request->price)->associate('App\Product');
        return redirect()->route('cart.index')->with('success','Item was successfully added to your cart');
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
        $rowId = $id;
        Cart::remove($rowId);
        return redirect()->back()->with('success','Item was successfully removed from your cart');;
    }

       /**
     * save items fo later / wishlist
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function wishlist($id)
    {
        $item = Cart::get($id);
        Cart::remove($id);


        $duplicate = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use($id) {
            return $rowId === $id;
        });
        if($duplicate->isNotEmpty()){
            return redirect()->route('cart.index')->with('success', 'Item already in wishlist');
        }

        Cart::instance('wishlist')->add($item->id, $item->name , 1, $item->price)->associate('App\Product');
        return redirect()->route('cart.index')->with('success','Item was successfully added to your Wishlist');
    }

    /**
     * Remove item from wishlist.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyWishlist($id)
    {
        $rowId = $id;
        Cart::instance('wishlist')->remove($rowId);
        return redirect()->back()->with('success','Item was successfully removed from your wishlist');;
    }

        /**
     * moves items from wishlist to cart
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function switchToCartFromWishlist($id)
    {
        $item = Cart::instance('wishlist')->get($id);
        Cart::instance('wishlist')->remove($id);


        $duplicate = Cart::instance('default')->search(function ($cartItem, $rowId) use($id) {
            return $rowId === $id;
        });
        if($duplicate->isNotEmpty()){
            return redirect()->route('cart.index')->with('success', 'Item already in you rcart');
        }

        Cart::instance('default')->add($item->id, $item->name , 1, $item->price)->associate('App\Product');
        return redirect()->route('cart.index')->with('success','Item was successfully moved to your cart');
    }

}
