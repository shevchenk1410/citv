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
        Schema::create('aseguradora', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->bigInteger('tipo_poliza_id')->unsigned();
            $table->boolean('estado')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aseguradora');
    }
};
