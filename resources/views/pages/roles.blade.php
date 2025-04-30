<?php
use function Laravel\Folio\name;

name('roles.index');
?>
@extends('layouts.app')
@section('title', 'Roles')
@section('content')
<div id="roles-page"></div>
@endsection
@section('custom-js')
@vite('resources/vue/pages/roles/roles.page.js')
@endsection