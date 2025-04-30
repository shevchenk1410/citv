<?php
use function Laravel\Folio\{name};

name('sucursales.index');
?>
@extends('layouts.app')
@section('title', 'Sucursales')
@section('content')
<div id="sucursales-page"></div>
@endsection
@section('custom-js')
@vite('resources/vue/pages/sucursales/sucursales.page.js')
@endsection