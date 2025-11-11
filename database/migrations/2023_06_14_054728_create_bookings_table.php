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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('pickup_address');
            $table->integer('no_of_persons');
            $table->date('pickup_date');
            $table->time('pickup_time');
            $table->text('destination');
            $table->string('return_flight')->nullable();
            $table->string('flight_no_on_return')->nullable();
            $table->date('date_return_flight')->nullable();
            $table->text('optional_comment')->nullable();
            $table->string('status')->default('pending');
            $table->unsignedBigInteger('assign_id')->nullable();
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
        Schema::dropIfExists('bookings');
    }
};
