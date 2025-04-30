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
        Schema::create('operacion_diaria', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sucursal_id');
            $table->date('fecha')->comment('Fecha de inicio de operación diaria');
            $table->time('hora_inicio');
            $table->time('hora_fin')->nullable();
            $table->string('CODENTIDA')->comment('Código de la entidad');
            $table->string('CODLOCAL')->comment('Código del local');
            $table->string('CODIV')->comment('Codigo identificador de validacion por el MTC');
            $table->string('CIOD_CITV')->nullable()->comment('Codigo de inicio de operacion diaria');
            $table->string('MENSAJE')->nullable()->comment('Mensaje de respuesta del web service');
            $table->integer('NUMTRADIA')->default(0)->comment('Numero de transacciones exitosas realizadas en el día');
            $table->integer('NUMCERTI')->default(0)->comment('Numero de certificados generados');
            $table->integer('NUMINFOR')->default(0)->comment('Numero de informes generados');
            $table->integer('NUMANUL')->default(0)->comment('Numero de anulaciones realizadas');
            $table->integer('ucierre')->default(0)->comment('Indica en timestamp la fecha y hora de cierre de la operación diaria');
            //$table->tinyInteger('estado')->default(1)->comment('Estado de la operación diaria');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inicio_operacion_diaria');
    }
};
