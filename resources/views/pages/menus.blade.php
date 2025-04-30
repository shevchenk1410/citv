<?php
use function Laravel\Folio\name;

name('menus.index');
?>
@extends('layouts.app')
@section('title', 'Menú')
@section('content')
<div id="menus-page"></div>
@endsection
@section('custom-js')
@vite('resources/vue/pages/menus/menus.page.js')
@endsection