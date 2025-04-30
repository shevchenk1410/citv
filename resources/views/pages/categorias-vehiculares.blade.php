<?php
use function Laravel\Folio\name;

name('categorias-vehiculares.index');
?>
@extends('layouts.app')
@section('title', 'Categorias Vehiculares')
@section('content')
<livewire:masters.basic-table-component table="categoria_vehicular" title="Categorias Vehiculares" :model="'\App\Models\CategoriaVehicular'" />
@endsection