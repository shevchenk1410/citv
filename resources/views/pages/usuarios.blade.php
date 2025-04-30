<?php
use function Laravel\Folio\{name};

name('usuarios.index');
?>
@extends('layouts.app')
@section('title', 'Usuarios')
@section('content')
<div id="usuarios-page"></div>
@endsection
@section('custom-js')
@vite('resources/vue/pages/usuarios/usuarios.page.js')
@endsection