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
  # This is RawMaterialTransfer Model
  ##############################################################################
 */
namespace App;

use App\Traits\HasOutlet;
use Illuminate\Database\Eloquent\Model;

class RawMaterialTransfer extends Model
{
    use HasOutlet;

    protected $table = 'tbl_raw_material_transfers';

    protected $fillable = [
        'transfer_reference_no',
        'from_outlet_id',
        'to_outlet_id',
        'transfer_date',
        'transfer_status',
        'note',
        'added_by',
        'approved_by',
        'approved_at',
        'received_by',
        'received_at',
        'del_status',
        'outlet_id'
    ];

    protected $dates = ['transfer_date', 'approved_at', 'received_at'];

    /**
     * Relationship with Transfer Details
     */
    public function transferDetails()
    {
        return $this->hasMany(RawMaterialTransferDetails::class, 'transfer_id')
            ->where('del_status', 'Live');
    }

    /**
     * Relationship with From Outlet
     */
    public function fromOutlet()
    {
        return $this->belongsTo(Outlet::class, 'from_outlet_id');
    }

    /**
     * Relationship with To Outlet
     */
    public function toOutlet()
    {
        return $this->belongsTo(Outlet::class, 'to_outlet_id');
    }

    /**
     * Relationship with User who created
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    /**
     * Relationship with User who approved
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Relationship with User who received
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    /**
     * Generate Transfer Reference Number
     */
    public static function generateReferenceNo()
    {
        $lastTransfer = self::orderBy('id', 'DESC')->first();
        $lastNumber = $lastTransfer ? (int) substr($lastTransfer->transfer_reference_no, 4) : 0;
        $newNumber = str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
        return 'RMT-' . $newNumber;
    }

    /**
     * Scope: Filter by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('transfer_status', $status);
    }

    /**
     * Scope: Filter by date range
     */
    public function scopeDateFilter($query, $from, $to)
    {
        return $query->whereBetween('transfer_date', [$from, $to]);
    }

    /**
     * Scope: Filter by from outlet
     */
    public function scopeFromOutlet($query, $outletId)
    {
        return $query->where('from_outlet_id', $outletId);
    }

    /**
     * Scope: Filter by to outlet
     */
    public function scopeToOutlet($query, $outletId)
    {
        return $query->where('to_outlet_id', $outletId);
    }

    /**
     * Check if transfer can be completed
     */
    public function canBeCompleted()
    {
        return $this->transfer_status === 'Pending' || $this->transfer_status === 'In Transit';
    }

    /**
     * Check if transfer can be cancelled
     */
    public function canBeCancelled()
    {
        return in_array($this->transfer_status, ['Draft', 'Pending']);
    }
}

