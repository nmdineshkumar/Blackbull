<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller {
    public function addToCartAction( $id ) {
        $cart = '';
        //
        $cart = session()->get( 'cart', [] );
        if ( isset( $cart[ $id ] ) ) {
            $cart[$id]['quantity']++;
        }else{
            $cart[$id] = [
                "quantity" => 1
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product add to cart successfully!');
    }
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully removed!');
        }
    }
}
