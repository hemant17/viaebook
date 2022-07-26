<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductWidget extends Component
{
    public $name;
    public function render()
    {
        return view('livewire.product-widget',[
            'products' => Product::where('widget_id',$this->name)->whereNotNull('product_data')->get()
        ]);
    }
}
