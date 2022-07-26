<?php

namespace App\Jobs;

use App\Models\Product;
use App\Packt\Facedes\Packt;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProcessProductApi implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $product;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $res = Packt::product($this->product->name);
        $res['prices'] = Packt::getPrice($this->product->name);
        $this->product->product_data = $res;
        $this->product->save();
        $cover = Packt::getCover($this->product->name,'small','body');
        $this->storeImage($this->product->name,$cover);
    }

    protected function storeImage($id, $images)
    {
            Storage::disk('local')->put('public/' . $id . '.png', (string)$images);
    }

}
