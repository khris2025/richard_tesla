<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('teslas', function (Blueprint $table) {
            $table->id();
            $table->string('car_name');
            $table->decimal('price', 10, 2);
            $table->year('year');
            $table->text('features');
            $table->string('car_img');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teslas');
    }
};
