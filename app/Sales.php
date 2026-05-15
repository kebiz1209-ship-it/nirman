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
  # This is Sales Model
  ##############################################################################
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasOutlet;

class Sales extends Model
{
    use HasOutlet;

    protected $table = "tbl_sales";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reference_no',
        'customer_id',
        'sale_date',
        'status',
        'product_quantity',
        'subtotal',
        'other',
        'discount',
        'grand_total',
        'account_id',
        'paid',
        'due',
        'note',
        'added_by',
        'quotation_id',
        'company_id',
        'converted_currency_id',
        'converted_amount',
        'manufacture_details',
        'del_status',
        'outlet_id',
    ];

    protected $appends = ['cost_of_goods', 'cost_of_transferred', 'total_tax'];

    /**
     * Relationship with Customer
     */
    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }

    /**
     * Relationship with Sale Details
     */
    public function details()
    {
        return $this->hasMany('App\SaleDetail', 'sale_id');
    }

    /**
     * Relationship with Sale Returns
     */
    public function saleReturns()
    {
        return $this->hasMany('App\SaleReturn', 'sale_id');
    }

    /**
     * Define scope for date filter
     */
    public function scopeDateFilter($query, $from, $to)
    {
        if($from && $to && $from != '' && $to != '')
        {
            return $query->whereBetween('created_at', [$from, $to]);
        }
    }
    /**
     * Define scope for single date filter
     */
    public function scopeSingleDate($query, $date)
    {
        if($date && $date != '')
        {
            return $query->whereDate('sale_date', $date);
        }
    }

    /**
     * Get Cost of Goods
     */
    public function getCostOfGoodsAttribute()
    {
        return $this->getCost();
    }
    /**
     * Get Cost of Transferred
     */
    public function getCostOfTransferredAttribute()
    {
        return $this->costOfTransferred();
    }
    /**
     * Get Total Tax
     */
    public function getTotalTaxAttribute()
    {
        $total = 0;
        foreach($this->details as $detail)
        {
            $total += $detail->product->tax_amount;
        }
        return $total;
    }
    /**
     * Get Cost of Goods
     */
    public function getCost()
    {
        $total = 0;
        foreach($this->details as $detail)
        {
            $total += $detail->product->rmcost_total;
        }
        return $total;
    }

    /**
     * Get Cost of Transferred
     */
    public function costOfTransferred()
    {
        $total = 0;
        foreach($this->details as $detail)
        {
            $total += $detail->product->noninitem_total;
        }
        return $total;
    }

    /**
     * Quotation Relationship (if sales was created from quotation)
     */
    public function quotation()
    {
        return $this->belongsTo(Quotation::class, 'quotation_id', 'id');
    }
}
