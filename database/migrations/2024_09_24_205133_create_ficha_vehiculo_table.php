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
        Schema::create('ficha_vehiculo', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cliente_id');
            $table->bigInteger('cliente2_id');
            $table->bigInteger('sucursal_id');
            $table->bigInteger('usuario_id');
            $table->string('CIOD_CITV')->comment('Codigo de inicio de operacion diaria');
            $table->string('PLACA')->comment('Placa del vehiculo');
            $table->integer('CATEGORIA')->default(0);
            $table->integer('TIPSERVICIO')->default(0);
            $table->integer('TIPAMBITO')->default(0);
            $table->integer('TIPINSPECCION')->default(0);
            $table->string('NUM_FICHA');
            $table->string('CATEGORIA_DESC');
            $table->string('MARCA');
            $table->string('MODELO');
            $table->integer('ANOFAB');
            $table->string('COMBUSTIBLE');
            $table->string('VINSERCHA');
            $table->string('NUMEROMOTOR');
            $table->string('CARROCERIA');
            $table->integer('NUMEROEJES');
            $table->integer('NUMERORUEDAS');
            $table->integer('NUMEROASIENTOS');
            $table->integer('NUMEROPASAJEROS');
            $table->decimal('LARGO',8,2);
            $table->decimal('ANCHO',8,2);
            $table->decimal('ALTO',8,2);
            $table->string('COLOR');
            $table->decimal('PESONETO');
            $table->decimal('PESOBRUTO');
            $table->decimal('PESOUTIL');
            $table->string('NUMDOC_ULTREV')->nullable();
            $table->string('FECDOC_ULTREV')->nullable();
            $table->string('RAZSOCCITV_ULTREV')->nullable();
            $table->longtext('OBS_ULTREV')->nullable();
            $table->string('TIPPOLIZA')->nullable();
            $table->string('NUMPOLIZA')->nullable();
            $table->date('FECINIPOLIZA')->nullable();
            $table->date('FECFINPOLIZA')->nullable();
            $table->string('MENSAJE')->nullable();
            $table->integer('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ficha_vehiculo');
    }
};
