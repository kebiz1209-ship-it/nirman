<?php
/*
  ##############################################################################
  # iProduction - Production and Manufacture Management
  ##############################################################################
  # AUTHOR:		Door Soft
  ##############################################################################
  # EMAIL:		info@doorsoft.co
  ##############################################################################
  # COPYRIGHT:		RESERVED BY Door Soft
  ##############################################################################
  # WEBSITE:		https://www.doorsoft.co
  ##############################################################################
  # This is RawMaterialTransferDetails Model
  ##############################################################################
 */
namespace App;

use App\Traits\HasOutlet;
use Illuminate\Database\Eloquent\Model;

class RawMaterialTransferDetails extends Model
{
    use HasOutlet;

    protected $table = 'tbl_raw_material_transfer_details';

    protected $fillable = [
        'transfer_id',
        'raw_material_id',
        'quantity',
        'unit_price',
        'total_amount',
        'note',
        'del_status',
        'outlet_id'
    ];

    /**
     * Relationship with Transfer
     */
    public function transfer()
    {
        return $this->belongsTo(RawMaterialTransfer::class, 'transfer_id');
    }

    /**
     * Relationship with Raw Material
     */
    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class, 'raw_material_id');
    }
}

