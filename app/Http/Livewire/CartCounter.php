<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartCounter extends Component
{
    protected $listeners = ['cart_updated' => '$refresh'];

    public function render()
    {
        return view('livewire.cart-counter',[
            'cartCount' => Cart::content()->count()
        ]);
    }
}
