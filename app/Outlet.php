<?php
namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;

    protected $table    = 'tbl_outlets';
    protected $fillable = ['outlet_code', 'outlet_name', 'outlet_address', 'outlet_phone', 'outlet_email', 'outlet_status', 'del_status', 'company_id'];

    /**
     * Generate outlet code
     * @return string
     */
    public static function generateOutletCode()
    {
        $outletCode = str_pad(self::count() + 1, 6, '0', STR_PAD_LEFT);
        return $outletCode;
    }

    /**
     * Relationship with Outgoing Transfers
     */
    public function outgoingTransfers()
    {
        return $this->hasMany(RawMaterialTransfer::class, 'from_outlet_id')->where('del_status', 'Live');
    }

    /**
     * Relationship with Incoming Transfers
     */
    public function incomingTransfers()
    {
        return $this->hasMany(RawMaterialTransfer::class, 'to_outlet_id')->where('del_status', 'Live');
    }
}
