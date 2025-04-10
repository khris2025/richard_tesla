<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teslabuy', function (Blueprint $table) {
            $table->id();
            $table->string('car_name');
            $table->string('car_year');
            $table->string('fullname');
            $table->string('email');
            $table->string('status')->default('pending');

            $table->integer('price');
            $table->string('ptype');
            $table->string('transid');
            $table->string('proof')->nullable();
            $table->dateTime('dateadd'); // Use timestamp() instead of timestamps()
            $table->timestamps(); // This line is for created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teslabuy');
    }
};
