<?php

namespace App\Http\Livewire;

use Cart;
use App\Models\Sale;
use Livewire\Component;

class CartComponent extends Component
{
    public function render()
    {
        $sale = Sale::find(1);
        return view('livewire.cart-component', compact('sale'))->layout('layouts.base');
    }

    public function increaseQuantity($rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product->qty + 1;
        Cart::update($rowId, $qty);
    }

    public function decreaseQuantity($rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product->qty - 1;
        Cart::update($rowId, $qty);
    }

    public function deleteProduct($rowId)
    {
        Cart::remove($rowId);
        session()->flash('success_message','Item has been deleted.');
    }
    
    public function deleteAllProduct()
    {
        Cart::destroy();
        session()->flash('success_message','Cart has been deleted.');
    }
}
