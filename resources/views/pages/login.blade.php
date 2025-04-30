<?php
use Illuminate\View\View;
use function Laravel\Folio\{name, render};

name('login');

render(function(view $view){
    $sucursales = \App\Models\Sucursal::where('estado',1)->get(['id','nombre']);
    return $view->with(compact('sucursales'));
})
?>
@extends('layouts.guest')
@section('title', 'Iniciar Sesión')
@section('content')
<div class="stretch-card">
    <div class="card">
        <div class="card-body">
        <div class="text-center">
            <h3 class="mt-3">Bienvenido de Vuelta</h3>
            <h6>Comencemos el día con el pie derecho :)</h6>
        </div>
        <form id="login-form" class="p-4" method="post" action="{{ route('do-login') }}">
            @csrf
            <div class="mb-3">
                <label for="sucursal_id">Sucursal</label>
                <select class="form-control" name="sucursal_id" id="sucursal_id">
                    <option value="0">Sin Sucursal</option>
                    @foreach($sucursales as $sucursal)
                        <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="input-dni">Documento de Identidad</label>
                <input type="text" class="form-control" name="dni" id="input-dni" placeholder="Username" required="required" aria-label="Username" value="00000000">
            </div>
            <div class="mb-3">
                <label for="input-password">Contraseña</label>
                <input type="password" class="form-control" name="password" id="input-password" placeholder="Password" required="required"  aria-label="Password" value="admin">
            </div>
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <label class="form-check-label text-tertiary">
                    <input type="checkbox" class="form-check-input" name="remember_token" value="1"> Recordar mi contraseña</label>
                </div>
                <!--<a href="/recover-password" class="auth-link text-info">Olvidaste tu contraseña</a>-->
            </div>
            <div class="mb-3 d-grid">
                <button type="submit" class="btn btn-primary auth-form-btn">Inicia Sesión</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection