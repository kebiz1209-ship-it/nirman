<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierMaterialAssignment extends Model
{
    protected $table = 'supplier_material_assignments';

    protected $fillable = [
        'supplier_id',
        'raw_material_id',
        'packaging_id'
    ];
}