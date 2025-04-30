<?php
use function Laravel\Folio\name;

name('tipos-inspeccion.index');
?>
@extends('layouts.app')
@section('title', 'Tipos de Inspección')
@section('content')
<livewire:masters.basic-table-component table="tipo_inspeccion" title="Tipos de Inspección" :model="'\App\Models\TipoInspeccion'" />
@endsection