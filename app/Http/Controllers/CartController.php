<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Variant;
use Cart;

class CartController extends Controller
{
    public function index() {
        $cart = Cart::content();

        foreach($cart as $item) {
            $item->model->load('values');
        }

        return response()->json(compact('cart'));
    }

    public function store(Request $request) {
        $id = $request->get('id');
        $name = $request->get('name');
        $amount = $request->get('amount');
        $price = $request->get('price');
        $item = Cart::add($id, $name, $amount, $price)->associate(Variant::class);
        $cart = Cart::content();

        foreach($cart as $item) {
            $item->model->load('values');
        }

        return response()->json(compact('cart'));
    }

    public function destroy($id) {
        Cart::remove($id);
        $cart = Cart::content();

        foreach($cart as $item) {
            $item->model->load('values');
        }

        return response()->json(compact('cart'));
    }
}
