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
        Schema::create('shipping_address', function (Blueprint $table) {
            $table->id();
            $table->string('consignee', 50);
            $table->string('phone', 10);
            $table->string('address', 50);
            $table->date('date_deveiced')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_address');
    }
};
