<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRotaSlotStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rota_slot_staff', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rotaid');
            $table->tinyInteger('daynumber');
            $table->integer('staffid')->nullable();
            $table->string('slottype');
            $table->time('starttime')->nullable();
            $table->time('endtime')->nullable();
            $table->float('workhours');
            $table->integer('premiumminutes')->nullable();
            $table->integer('roletypeid')->nullable();
            $table->integer('freeminutes')->nullable();
            $table->integer('seniorcashierminutes')->nullable();
            $table->string('splitshifttimes')->nullable();
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
        Schema::dropIfExists('rota_slot_staff');
    }
}
