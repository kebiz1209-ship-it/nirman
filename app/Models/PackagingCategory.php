<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackagingCategory extends Model
{
    protected $table = 'packaging_categories';

    protected $fillable = [
        'category_name',
        'category_code',
        'description',
        'status',
        'added_by',
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function packagingMaterials()
{
    return $this->hasMany(Packaging::class, 'category_id');
}
}