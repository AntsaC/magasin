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
        Schema::create('laptops', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->double('ram');
            $table->double('storage');
            $table->double('size');
            $table->foreignIdFor(\App\Models\Serie::class)->constrained();
            $table->foreignIdFor(\App\Models\Processor::class)->constrained();
            $table->foreignIdFor(\App\Models\Operating::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laptops');
    }
};
