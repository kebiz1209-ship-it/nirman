<?php
/*
##############################################################################
# iProduction - Production and Manufacture Management
##############################################################################
# AUTHOR:        Door Soft
##############################################################################
# EMAIL:        info@doorsoft.co
##############################################################################
# COPYRIGHT:        RESERVED BY Door Soft
##############################################################################
# WEBSITE:        https://www.doorsoft.co
##############################################################################
# This is RawMaterial Model
##############################################################################
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    protected $table = "tbl_rawmaterials";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $append = ['current_stock_final', 'current_stock'];

    /**
     * Relationship with Raw Material Category
     */
    public function category()
    {
        return $this->belongsTo('App\RawMaterialCategory', 'category');
    }
    /**
     * Relationship with Raw Material Consumption Unit
     */
    public function products()
    {
        return $this->hasMany('App\FPrmitem', 'rmaterials_id')->where('del_status', 'Live');
    }
    /**
     * Relationship with Raw Material Purchase
     */
    public function purchase()
    {
        return $this->hasMany('App\RMPurchase_model', 'rmaterials_id')->where('del_status', 'Live');
    }

    /**
     * Relationship with Unit
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit')->where('del_status', 'Live');
    }

    /**
     * Relationship with Waste
     */
    public function waste()
    {
        return $this->hasMany('App\RMWasteItem_model', 'rmaterials_id')->where('del_status', 'Live');
    }

    /**
     * Relationship with Purchase Returns
     */
    public function purchaseReturns()
    {
        return $this->hasMany('App\PurchaseReturnDetails', 'item_id')->where('del_status', 'Live');
    }

    /**
     * Relationship with Transfer Details
     */
    public function transfers()
    {
        return $this->hasMany(RawMaterialTransferDetails::class, 'raw_material_id')->where('del_status', 'Live');
    }

    /**
     * Get Current Stock Final
     */
    public function getCurrentStockFinalAttribute()
    {
        if ($this->consumption_check == 1) {
            //Check the purchase relation under the purchase status is Final
            $totalPurchase = $this->purchase->map(function ($purchase) {
                return optional($purchase->purchase)->status === 'Final' ? $purchase->quantity_amount : 0;
            })->sum();
            $totalWaste = $this->waste->sum('waste_amount');
            // Subtract purchase returns (only finalized returns)
            $totalReturns = $this->purchaseReturns()
                ->whereHas('purchaseReturn', function($q) {
                    $q->where('return_status', 'Final')->where('del_status', 'Live');
                })
                ->sum('return_quantity_amount');
            $totalStock = $totalPurchase - $totalWaste - $totalReturns;
            $totalStock = getAdjustData($totalStock, $this->id);

            $totalStockToConvert = $totalStock * $this->conversion_rate;
            $openingStock        = $this->opening_stock;
            $manufacturedStock   = getRawMaterialUseInManufacture($this->id);
            $totalStock          = $totalStockToConvert + $openingStock - $manufacturedStock;
            $totalStock          = convertUnit($totalStock, $this->conversion_rate, getRMUnitById($this->unit), getRMUnitById($this->consumption_unit));
            return $totalStock;
        } else {
            $totalPurchase = $this->purchase->map(function ($purchase) {
                return optional($purchase->purchase)->status === 'Final' ? $purchase->quantity_amount : 0;
            })->sum();

            $totalWaste        = $this->waste->sum('waste_amount');
            // Subtract purchase returns (only finalized returns)
            $totalReturns = $this->purchaseReturns()
                ->whereHas('purchaseReturn', function($q) {
                    $q->where('return_status', 'Final')->where('del_status', 'Live');
                })
                ->sum('return_quantity_amount');
            $totalStock        = $totalPurchase - $totalWaste - $totalReturns + $this->opening_stock;
            $totalStock        = getAdjustData($totalStock, $this->id);
            $manufacturedStock = getRawMaterialUseInManufacture($this->id);
            $totalStock        = $totalStock - $manufacturedStock;
            return $totalStock;
        }
    }

    /**
     * Get Current Stock
     */
    public function getCurrentStockAttribute()
    {
        if ($this->consumption_check == 1) {
            $totalPurchase = $this->purchase->map(function ($purchase) {
                if (! $purchase->purchase) {
                    return 0;
                }
                return $purchase->purchase->status == 'Final' ? $purchase->quantity_amount : 0;
            })->sum();
            $totalWaste = $this->waste->sum('waste_amount');
            // Subtract purchase returns (only finalized returns)
            $totalReturns = $this->purchaseReturns()
                ->whereHas('purchaseReturn', function($q) {
                    $q->where('return_status', 'Final')->where('del_status', 'Live');
                })
                ->sum('return_quantity_amount');
            $totalStock = $totalPurchase - $totalWaste - $totalReturns;
            $totalStock = getAdjustData($totalStock, $this->id);

            $totalStockToConvert = $totalStock * $this->conversion_rate;
            $openingStock        = $this->opening_stock;
            $manufacturedStock   = getRawMaterialUseInManufacture($this->id);
            $totalStock          = $totalStockToConvert + $openingStock - $manufacturedStock;
            $conversion_rate     = (isset($this->conversion_rate) && ($this->conversion_rate > 0) ? $this->conversion_rate : 1);
            return ($totalStock / $conversion_rate);
        } else {
            $totalPurchase = $this->purchase->map(function ($purchase) {
                if (! $purchase->purchase) {
                    return 0;
                }
                return $purchase->purchase->status == 'Final' ? $purchase->quantity_amount : 0;
            })->sum();
            $totalWaste        = $this->waste->sum('waste_amount');
            // Subtract purchase returns (only finalized returns)
            $totalReturns = $this->purchaseReturns()
                ->whereHas('purchaseReturn', function($q) {
                    $q->where('return_status', 'Final')->where('del_status', 'Live');
                })
                ->sum('return_quantity_amount');
            $totalStock        = $totalPurchase - $totalWaste - $totalReturns + $this->opening_stock;
            $totalStock        = getAdjustData($totalStock, $this->id);
            $manufacturedStock = getRawMaterialUseInManufacture($this->id);
            $totalStock        = $totalStock - $manufacturedStock;
            return $totalStock;
        }
    }

    public function suppliers()
{
    return $this->hasMany(
        SupplierMaterial::class,
        'material_id'
    )->where('material_type', 'raw');
}

}
