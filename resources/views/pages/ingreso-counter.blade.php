<?php
use function Laravel\Folio\{name, middleware};

middleware('auth');
name('ingreso_counter.index');
?>
@extends('layouts.app')
@section('title', 'Ingreso al Counter')
@section('content')
<div id="ingreso-counter-page"></div>
@endsection
@section('custom-js')
@vite('resources/vue/pages/ingreso-counter/ingreso-counter.page.js')
@endsection