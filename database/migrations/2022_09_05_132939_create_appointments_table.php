<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id');
            $table->string('client_id');
            $table->string('nurse_id')->nullable();
            $table->string('appointment_date');
            $table->string('service_id');
            $table->integer('unit_count');
            $table->boolean('emergency')->defualt(0);
            $table->string('client_phone');
            $table->string('client_address');
            $table->string('appointment_status');
            $table->integer('rating')->nullable();
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
        Schema::dropIfExists('appointments');
    }
}
