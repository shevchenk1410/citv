<?php
use function Laravel\Folio\name;

name('aseguradoras.index');
?>
@extends('layouts.app')
@section('title', 'Aseguradoras')
@section('content')
<livewire:masters.aseguradora-component  />
@endsection