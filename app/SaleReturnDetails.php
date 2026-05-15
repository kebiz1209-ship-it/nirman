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
  # This is SaleReturnDetails Model
  ##############################################################################
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasOutlet;

class SaleReturnDetails extends Model
{
    use HasOutlet;

    protected $table = 'tbl_sale_return_details';
    public $timestamps = true;

    protected $fillable = [
        'sale_return_id',
        'sale_id',
        'sale_detail_id',
        'product_id',
        'manufacture_id',
        'unit_price',
        'product_quantity',
        'total_amount',
        'return_note',
        'del_status',
        'outlet_id'
    ];

    /**
     * Relationship with Sale Return
     */
    public function saleReturn()
    {
        return $this->belongsTo('App\SaleReturn', 'sale_return_id');
    }

    /**
     * Relationship with Sale
     */
    public function sale()
    {
        return $this->belongsTo('App\Sales', 'sale_id');
    }

    /**
     * Relationship with Sale Detail
     */
    public function saleDetail()
    {
        return $this->belongsTo('App\SaleDetail', 'sale_detail_id');
    }

    /**
     * Relationship with Finished Product
     */
    public function product()
    {
        return $this->belongsTo('App\FinishedProduct', 'product_id');
    }

    /**
     * Relationship with Manufacture (optional)
     */
    public function manufacture()
    {
        return $this->belongsTo('App\Manufacture', 'manufacture_id');
    }
}
