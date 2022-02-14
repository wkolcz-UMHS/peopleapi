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
        Schema::create('applicants',function (Blueprint $table){
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('position_id')->nullable(false);
            $table->string('status')->default('open');
            $table->string('created_by')->nullable(false);
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
        //
    }
};
