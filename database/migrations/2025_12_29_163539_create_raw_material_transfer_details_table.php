<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_raw_material_transfer_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transfer_id');
            $table->unsignedBigInteger('raw_material_id');
            $table->decimal('quantity', 10, 2);
            $table->decimal('unit_price', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->text('note')->nullable();
            $table->enum('del_status', ['Live', 'Deleted'])->default('Live');
            $table->unsignedBigInteger('outlet_id')->nullable();
            $table->timestamps();

            $table->foreign('transfer_id')->references('id')->on('tbl_raw_material_transfers')->onDelete('cascade');
            $table->foreign('raw_material_id')->references('id')->on('tbl_rawmaterials');
            $table->index('transfer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_raw_material_transfer_details');
    }
};
