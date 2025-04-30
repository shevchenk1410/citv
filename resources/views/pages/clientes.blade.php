<?php
use function Laravel\Folio\name;

name('clientes.index');
?>
@extends('layouts.app')
@section('title', 'Clientes')
@section('content')
<livewire:masters.cliente-component />
@endsection