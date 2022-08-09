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
        Schema::create('services_orders', function (Blueprint $table) {
            $table->id();
            $table->text('firstname', 55);
            $table->text('lastname', 55);
            $table->bigInteger('phone');
            $table->string('email')->nullable();
            $table->text('interes', 2500);
            $table->softDeletes();
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
        Schema::dropIfExists('services_orders');
    }
};
