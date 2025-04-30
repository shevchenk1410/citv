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
        Schema::create('usuario', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sucursal_id')->default(0);
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
            $table->char('dni', 8)->unique();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
