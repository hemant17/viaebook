<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Packt\Facedes\Packt;
use Illuminate\Support\Facades\Storage;
use Gloudemans\Shoppingcart\Facades\Cart;

class BooksCatlogs extends Component
{
    public function addToCart($product){
        Cart::add($product['id'],$product['title'],1,$product['price']['ebook']['INR']);
        $this->emit('cart_updated');
    }

    public function removeFromCart($rowId)
    {
        Cart::remove($rowId);
        $this->emit('cart_updated');
    }
    
    public function render()
    {
        $products = Packt::products(1,8);
        return view('livewire.books-catlogs',[
            'productData' => $products,
            'cart' => Cart::content()
        ]);
    }

    protected function storeImage($products, $images)
    {
        foreach ($products['products'] as $product) {
            Storage::disk('local')->put('public/' . $product['id'] . '.png', (string)$images[$product['id']]->body());
        }
    }
}
