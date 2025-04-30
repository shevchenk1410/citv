<?php
use function Laravel\Folio\name;

name('tipos-ambito.index');
?>
@extends('layouts.app')
@section('title', 'Tipos de Ambito')
@section('content')
<livewire:masters.basic-table-component table="tipo_ambito" title="Tipos de Ambito" :model="'\App\Models\TipoAmbito'" />
@endsection