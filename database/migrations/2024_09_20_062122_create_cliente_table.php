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
        Schema::create('cliente', function (Blueprint $table) {
            $table->id();
            $table->integer('tipo_documento_id');
            $table->string('numero_documento', 15)->unique();
            $table->string('nombres')->comment('Para RUC sera la razon social');
            $table->string('apellidos');
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
            $table->string('whatsapp')->nullable();
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
};
