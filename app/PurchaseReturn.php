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
  # This is PurchaseReturn Model
  ##############################################################################
 */
namespace App;

use App\Traits\HasOutlet;
use Illuminate\Database\Eloquent\Model;

class PurchaseReturn extends Model
{
    use HasOutlet;
    
    protected $table = "tbl_purchase_return";
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reference_no', 'pur_ref_no', 'date', 'purchase_date', 'supplier_id',
        'return_status', 'total_return_amount', 'payment_method_id', 'payment_method_type',
        'account_type', 'note', 'added_date', 'user_id', 'company_id', 'del_status'
    ];

    /**
     * Define Scope for Single Date
     */
    public function scopeSingleDate($query, $date)
    {
        if($date && $date != '')
        {
            return $query->whereDate('date', $date);
        }
    }

    /**
     * Scope for filtering by supplier
     */
    public function scopeBySupplier($query, $supplierId)
    {
        if($supplierId && $supplierId != '')
        {
            return $query->where('supplier_id', $supplierId);
        }
    }

    /**
     * Scope for filtering by status
     */
    public function scopeByStatus($query, $status)
    {
        if($status && $status != '')
        {
            return $query->where('return_status', $status);
        }
    }

    /**
     * Relationship with Purchase Return Details
     */
    public function returnDetails()
    {
        return $this->hasMany(PurchaseReturnDetails::class, 'pur_return_id')->where('del_status', 'Live');
    }

    /**
     * Relationship with Supplier
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    /**
     * Relationship with Original Purchase
     */
    public function originalPurchase()
    {
        return $this->belongsTo(RawMaterialPurchase::class, 'pur_ref_no', 'reference_no');
    }

    /**
     * Relationship with User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get Formatted Total Attribute
     */
    public function getFormattedTotalAttribute()
    {
        return getCurrency($this->total_return_amount);
    }

    /**
     * Get Formatted Date Attribute
     */
    public function getFormattedDateAttribute()
    {
        return getDateFormat($this->date);
    }
}
