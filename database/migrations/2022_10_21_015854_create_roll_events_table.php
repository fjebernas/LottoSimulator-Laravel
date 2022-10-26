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
        Schema::create('roll_events', function (Blueprint $table) {
            $table->id();
            $table->string('lotto_type');
            $table->integer('rolls_left')->nullable();
            $table->boolean('is_finished')->default(false)->nullable();
            $table->integer('money_awarded')->default(0);
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
        Schema::dropIfExists('roll_events');
    }
};
