<?php
use function Laravel\Folio\name;

name('tipos-servicio.index');
?>
@extends('layouts.app')
@section('title', 'Tipos de Servicio')
@section('content')
<livewire:masters.basic-table-component table="tipo_servicio" title="Tipos de Servicio" :model="'\App\Models\TipoServicio'" />
@endsection