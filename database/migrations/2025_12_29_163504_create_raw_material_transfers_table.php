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
        Schema::create('tbl_raw_material_transfers', function (Blueprint $table) {
            $table->id();
            $table->string('transfer_reference_no', 50)->unique();
            $table->unsignedBigInteger('from_outlet_id');
            $table->unsignedBigInteger('to_outlet_id');
            $table->date('transfer_date');
            $table->enum('transfer_status', ['Draft', 'Pending', 'In Transit', 'Completed', 'Cancelled'])->default('Draft');
            $table->text('note')->nullable();
            $table->unsignedBigInteger('added_by');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->unsignedBigInteger('received_by')->nullable();
            $table->timestamp('received_at')->nullable();
            $table->enum('del_status', ['Live', 'Deleted'])->default('Live');
            $table->unsignedBigInteger('outlet_id')->nullable();
            $table->timestamps();

            $table->foreign('from_outlet_id')->references('id')->on('tbl_outlets');
            $table->foreign('to_outlet_id')->references('id')->on('tbl_outlets');
            $table->foreign('added_by')->references('id')->on('tbl_users');
            $table->index('transfer_reference_no');
            $table->index('transfer_status');
            $table->index('transfer_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_raw_material_transfers');
    }
};
