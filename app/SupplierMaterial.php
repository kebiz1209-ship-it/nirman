<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierMaterial extends Model
{
    protected $table = 'supplier_materials';

    protected $fillable = [
        'supplier_id',
        'material_type',
        'material_id',
        'status'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}