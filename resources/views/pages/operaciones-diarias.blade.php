<?php
use function Laravel\Folio\{name, middleware};

middleware('auth');
name('operaciones_diarias.index');
?>
@extends('layouts.app')
@section('title', 'Operaciones Diarias')
@section('content')
<div id="operaciones-diarias-page"></div>
@endsection
@section('custom-js')
@vite('resources/vue/pages/operaciones-diarias/operaciones-diarias.page.js')
@endsection