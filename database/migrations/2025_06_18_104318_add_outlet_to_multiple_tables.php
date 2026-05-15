<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    /**
     * List of tables to update.
     */
    protected $tables = [
        'tbl_rmstock_adjustment_rmaterials',
        'tbl_salaries',
        'tbl_sales',
        'tbl_sale_details',
        'tbl_stock_adjust_logs',
        'tbl_supplier_payments',
        'tbl_wastes',
        'tbl_waste_materials',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->unsignedBigInteger('outlet_id')->nullable()->after('id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn('outlet_id');
            });
        }
    }
};
