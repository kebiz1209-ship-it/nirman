<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Packaging extends Model
{
    protected $table = 'packagings';

    protected $fillable = [
        'category_id',
        'name',
        'code',
        'size',
        'weight',
        'height',
        'fill_qty',
        'level',
        'unit',
        'rate_per_unit',
        'opening_stock',
        'alert_level',
        'status',
    ];

   public function category()
{
    return $this->belongsTo(PackagingCategory::class, 'category_id');
}
}