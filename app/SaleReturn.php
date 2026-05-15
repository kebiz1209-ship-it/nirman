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
  # This is SaleReturn Model
  ##############################################################################
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasOutlet;

class SaleReturn extends Model
{
    use HasOutlet;

    protected $table = 'tbl_sale_return';
    public $timestamps = false;

    protected $fillable = [
        'reference_no',
        'sale_ref_no',
        'sale_id',
        'customer_id',
        'return_date',
        'sale_date',
        'return_status',
        'subtotal',
        'other',
        'discount',
        'grand_total',
        'account_id',
        'paid',
        'due',
        'note',
        'converted_currency_id',
        'converted_amount',
        'added_by',
        'del_status',
        'outlet_id'
    ];

    /**
     * Relationship with Sale Return Details
     */
    public function returnDetails()
    {
        return $this->hasMany('App\SaleReturnDetails', 'sale_return_id');
    }

    /**
     * Relationship with Sale
     */
    public function sale()
    {
        return $this->belongsTo('App\Sales', 'sale_id');
    }

    /**
     * Relationship with Customer
     */
    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }

    /**
     * Relationship with Account
     */
    public function account()
    {
        return $this->belongsTo('App\Account', 'account_id');
    }

    /**
     * Relationship with User
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'added_by');
    }

    /**
     * Define scope for date filter
     */
    public function scopeDateFilter($query, $from, $to)
    {
        if($from && $to && $from != '' && $to != '')
        {
            return $query->whereBetween('return_date', [$from, $to]);
        }
    }

    /**
     * Define scope for single date filter
     */
    public function scopeSingleDate($query, $date)
    {
        if($date && $date != '')
        {
            return $query->whereDate('return_date', $date);
        }
    }

    /**
     * Define scope for customer filter
     */
    public function scopeByCustomer($query, $customer_id)
    {
        if($customer_id && $customer_id != '')
        {
            return $query->where('customer_id', $customer_id);
        }
    }

    /**
     * Define scope for status filter
     */
    public function scopeByStatus($query, $status)
    {
        if($status && $status != '')
        {
            return $query->where('return_status', $status);
        }
    }

    /**
     * Get Total Return Quantity
     */
    public function getTotalReturnQuantity()
    {
        return $this->returnDetails()->sum('product_quantity');
    }
}
