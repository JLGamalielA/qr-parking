{{--
    Company: CETAM
    Project: QRP
    File: modules/admin/dashboard.blade.php
    Description: Vista principal del panel administrativo.
--}}

@extends('layouts.app')

@section('title', 'Panel de Control')

@section('content')
    {{-- 1. Encabezado y Breadcrumbs --}}
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item">
                        <a href="#">
                            <x-icon name="home" />
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Panel de Control</li>
                </ol>
            </nav>
            <h2 class="h4">Resumen General</h2>
            <p class="mb-0">Bienvenido, Gerente General.</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
             {{-- Aquí podrías poner botones de acción globales si los hubiera --}}
             <span class="badge bg-success text-white animate-pulse">
                <x-icon name="check" /> Sistema Online
             </span>
        </div>
    </div>

    {{-- 2. KPIs / Tarjetas Superiores --}}
    <div class="row">
        
        <!-- Ocupación Actual -->
        <div class="col-12 col-sm-6 col-xl-4 mb-4">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="row d-block d-xl-flex align-items-center">
                        <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                            <div class="icon-shape icon-shape-primary rounded me-4 me-sm-0">
                                <x-icon name="car" class="fs-2" />
                            </div>
                        </div>
                        <div class="col-12 col-xl-7 px-xl-0">
                            <div class="d-none d-sm-block">
                                <h2 class="h6 text-gray-400 mb-0">Ocupación Actual</h2>
                                <h3 class="fw-extrabold mb-2">45 <span class="fs-6 fw-normal text-gray-500">/ 60</span></h3>
                            </div>
                            <div class="small d-flex mt-1">
                                <div class="progress w-100" style="height: 6px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 75%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="60"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ganancias Hoy -->
        <div class="col-12 col-sm-6 col-xl-4 mb-4">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="row d-block d-xl-flex align-items-center">
                        <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                            <div class="icon-shape icon-shape-success rounded me-4 me-sm-0">
                                <x-icon name="money" class="fs-2" />
                            </div>
                        </div>
                        <div class="col-12 col-xl-7 px-xl-0">
                            <div class="d-none d-sm-block">
                                <h2 class="h6 text-gray-400 mb-0">Ganancias Hoy</h2>
                                <h3 class="fw-extrabold mb-2">$2,850.00</h3>
                            </div>
                            <div class="small d-flex mt-1">
                                <span class="text-success fw-bold">
                                    <x-icon name="chartUp" /> +12%
                                </span>
                                <span class="ms-2 text-gray-500">vs ayer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Solicitudes Pendientes -->
        <div class="col-12 col-sm-6 col-xl-4 mb-4">
            <!-- Nota: Se envuelve en <a> para mantener el enlace del diseño anterior -->
            <a href="/admin/solicitudes" class="text-decoration-none">
                <div class="card border-0 shadow hover:shadow-lg transition-all">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon-shape icon-shape-danger rounded me-4 me-sm-0">
                                    <x-icon name="notification" class="fs-2" />
                                </div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h6 text-danger mb-0">Solicitudes Pendientes</h2>
                                    <h3 class="fw-extrabold text-gray-900 mb-2">3 Solicitudes</h3>
                                </div>
                                <div class="small d-flex mt-1 text-muted">
                                    Proveedores esperando
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    {{-- 3. Sección Gráfica y Listado Reciente --}}
    <div class="row">
        {{-- Columna Gráfica --}}
        <div class="col-12 col-lg-6 mb-4">
            <div class="card border-0 shadow h-100">
                <div class="card-header border-bottom d-flex align-items-center justify-content-between">
                    <h2 class="fs-5 fw-bold mb-0">Flujo de Ocupación</h2>
                    <x-icon name="reportBar" class="text-gray-400 fs-4" />
                </div>
                <div class="card-body d-flex flex-column justify-content-center align-items-center" style="min-height: 300px;">
                    {{-- Aquí iría el componente de gráfica (Chartist/Apex) --}}
                    <div class="text-center text-muted">
                        <x-icon name="reportBar" class="fs-1 mb-3 d-block" />
                        <p>Gráfica de flujo de ocupación (Por horas)</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Columna Actividad Reciente --}}
        <div class="col-12 col-lg-6 mb-4">
            <div class="card border-0 shadow h-100">
                <div class="card-header border-bottom">
                    <h2 class="fs-5 fw-bold mb-0 text-uppercase text-gray-600 fs-6">Actividad Reciente</h2>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <!-- Item 1 -->
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-bottom-gray-200 py-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-shape icon-shape-success icon-xs rounded me-3">
                                    <x-icon name="login" />
                                </div>
                                <div>
                                    <span class="h6 mb-0 d-block">Entrada: ABC-123</span>
                                </div>
                            </div>
                            <span class="text-muted small">Hace 5 min</span>
                        </li>
                        <!-- Item 2 -->
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-bottom-gray-200 py-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-shape icon-shape-info icon-xs rounded me-3">
                                    <x-icon name="logout" />
                                </div>
                                <div>
                                    <span class="h6 mb-0 d-block">Salida: JKL-999</span>
                                </div>
                            </div>
                            <span class="text-muted small">Hace 12 min</span>
                        </li>
                        <!-- Item 3 -->
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-bottom-gray-200 py-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-shape icon-shape-warning icon-xs rounded me-3">
                                    <x-icon name="star" />
                                </div>
                                <div>
                                    <span class="h6 mb-0 d-block">Proveedor: Coca-Cola</span>
                                </div>
                            </div>
                            <span class="text-muted small">Hace 45 min</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection