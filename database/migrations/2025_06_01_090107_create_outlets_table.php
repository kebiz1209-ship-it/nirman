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
        Schema::create('tbl_outlets', function (Blueprint $table) {
            $table->id();
            $table->string('outlet_code')->unique();
            $table->string('outlet_name');
            $table->string('outlet_address');
            $table->string('outlet_phone');
            $table->string('outlet_email')->nullable();
            $table->enum('outlet_status', ['active', 'inactive']);
            $table->enum('del_status', ['Live', 'Deleted'])->default('Live');
            $table->unsignedInteger('company_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_outlets');
    }
};
