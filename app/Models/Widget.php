<?php

namespace App\Models;

use App\Enum\WidgetEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Widget extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name',
        'status',
    ];

    protected $casts = [
        'status' => WidgetEnum::class,
    ];

    public function Products()
    {
        return $this->hasMany(Product::class, 'widgets_id', 'id');
    }
}
