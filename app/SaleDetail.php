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
  # This is SaleDetail Model
  ##############################################################################
 */
namespace App;

use App\Traits\HasOutlet;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasOutlet;

    protected $table = 'tbl_sale_details';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sale_id',
        'product_id',
        'manufacture_id',
        'unit_price',
        'product_quantity',
        'total_amount',
        'del_status',
        'company_id',
        'outlet_id',
    ];

    /**
     * Relation with Finished Product
     */
    public function product()
    {
        return $this->belongsTo('App\FinishedProduct', 'product_id');
    }
    /**
     * Relation with Sale
     */
    public function sale()
    {
        return $this->belongsTo('App\Sales', 'sale_id');
    }

    /**
     * Relationship with Sale Return Details
     */
    public function saleReturnDetails()
    {
        return $this->hasMany('App\SaleReturnDetails', 'sale_detail_id');
    }
}
