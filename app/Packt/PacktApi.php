<?php

namespace App\Packt;

use Illuminate\Support\Arr;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PacktApi
{
    const APIVERISION = 'v1/';
    const APIURL = 'https://api.packt.com/api/' . self::APIVERISION;
   
    public function httpRequest($req,$param = [])
    {
        $url = str(self::APIURL)->append($req);
        if($param)
        {
            $query = Arr::query($param);
            $url = $url->append('?'.$query);
        }
        return Http::withToken(env('PACKT_TOKEN'))->get($url);
    }

    public function test($method = 'json')
    {
        return $this->httpRequest('test')->$method();
    }
    public function product($id,$method = 'json')
    {
        return $this->httpRequest('products/'.$id)->$method();
    }

    public function products($page = 1, $limit = 12, $method = 'json')
    {   
        $param = [
            'page' => $page,
            'limit' => $limit,
        ];
        return Cache::remember('products', 86400, function () use ($param,$method) {
            $response = $this->httpRequest('products',$param)->$method();
            $prices = self::getAllAttribute($response['products']);
                $products = [];
                foreach ($response['products'] as $key => $product) {
                    $product['price'] = $prices['price-'.$product['id']]->json()['prices'];
                    isset($prices['cover-'.$product['id']]) ? Storage::disk('local')->put('public/' . $product['id'] . '.png', (string)$prices['cover-'.$product['id']]->body()): '';
                    $products[] = $product;
                }
             $response['products'] = $products;
             return $response;
        });
    }

    public function getCover($id,$size = 'small',$method = 'json')
    {
        return $this->httpRequest('products/'.$id.'/cover/'.$size)->$method();
    }

    public function getAllCover($products)
    {
        $fn = function(Pool $pool) use ($products){
            $poolArr = [];
            foreach ($products as $key => $product) {
                if(!Storage::disk('local')->exists('public/'.$product['id'].'.png')){
                $poolArr[] = $pool->as($product['id'])->withToken(env('PACKT_TOKEN'))->get(str(self::APIURL)->append('products/'.$product['id'].'/cover/small'));
                }
            }
            return $poolArr;
        };
        return Http::pool($fn);
    }
    public function getAllAttribute($products)
    {
        $fn = function(Pool $pool) use ($products){
            $poolArr = [];
            foreach ($products as $key => $product) {
                if(!Storage::disk('local')->exists('public/'.$product['id'].'.png')){
                $poolArr[] = $pool->as('cover-'.$product['id'])->withToken(env('PACKT_TOKEN'))->get(str(self::APIURL)->append('products/'.$product['id'].'/cover/small'));
                }
                $poolArr[] = $pool->as('price-'.$product['id'])->withToken(env('PACKT_TOKEN'))->get(str(self::APIURL)->append('products/'.$product['id'].'/price/INR'));
            }
            return $poolArr;
        };
        return Http::pool($fn);
    }

    public function getPrice($id,$method = 'json')
    {
        return $this->httpRequest('products/'.$id.'/price/INR')->$method();
    }

    public function getAllPrice($products)
    {
        $fn = function(Pool $pool) use ($products){
            $poolArr = [];
            foreach ($products as $key => $product) {
                $poolArr[] = $pool->as($product['id'])->withToken(env('PACKT_TOKEN'))->get(str(self::APIURL)->append('products/'.$product['id'].'/price/INR'));
            }
            return $poolArr;
        };
        return Http::pool($fn);
    }
}
