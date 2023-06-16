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
        Schema::create('stock_pvs', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity')->default(0);
            $table->foreignIdFor(\App\Models\Laptop::class)->constrained();
            $table->foreignIdFor(\App\Models\SalePoint::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_pvs');
    }
};
