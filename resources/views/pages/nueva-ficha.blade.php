<?php
use function Laravel\Folio\{name,middleware};

middleware('auth');
name('nueva-ficha.index');
?>
@extends('layouts.app')
@section('title', 'Ingreso al Counter - Registro')
@section('content')
<div id="nueva-ficha-page"></div>
@endsection
@section('custom-js')
@vite('resources/vue/pages/nueva-ficha/nueva-ficha.page.js')
@endsection