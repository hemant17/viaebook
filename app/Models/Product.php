<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'product_data',
        'widget_id',
    ];
    protected $casts = [
        'product_data' => 'json'
    ];
    
    public function Widget()
    {
        return $this->hasOne(Widget::class,'id','widget_id');
    }
}
