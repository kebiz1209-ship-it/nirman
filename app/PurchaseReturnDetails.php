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
  # This is PurchaseReturnDetails Model
  ##############################################################################
 */
namespace App;

use App\Traits\HasOutlet;
use Illuminate\Database\Eloquent\Model;

class PurchaseReturnDetails extends Model
{
    use HasOutlet;
    
    protected $table = "tbl_purchase_return_details";
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pur_return_id', 'item_id', 'item_type', 'expiry_imei_serial',
        'return_note', 'return_quantity_amount', 'unit_price', 'total',
        'return_status', 'user_id', 'company_id', 'del_status'
    ];

    /**
     * Relationship with Purchase Return
     */
    public function purchaseReturn()
    {
        return $this->belongsTo(PurchaseReturn::class, 'pur_return_id');
    }

    /**
     * Relationship with Raw Material
     */
    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class, 'item_id');
    }

    /**
     * Relationship with User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
