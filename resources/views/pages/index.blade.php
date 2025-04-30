<?php
use function Laravel\Folio\{name,middleware};
middleware('auth');
name('home');
?>
@extends('layouts.app')
@section('content')
Soy el home
@endsection