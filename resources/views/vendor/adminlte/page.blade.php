@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')
@inject('preloaderHelper', 'JeroenNoten\LaravelAdminLte\Helpers\PreloaderHelper')

@php
use Illuminate\Support\Facades\Session;
@endphp

@section('adminlte_css')
@stack('css')
@yield('css')
<style type="text/css">
    .zoomP {
        border: 1px solid #c0c0c0;
        box-shadow: #c0c0c0 0px 5px 5px 0px;
    }
</style>
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
<div class="wrapper">

    {{-- Preloader Animation (fullscreen mode) --}}
    @if($preloaderHelper->isPreloaderEnabled())
    @include('adminlte::partials.common.preloader')
    @endif

    {{-- Top Navbar --}}
    @if($layoutHelper->isLayoutTopnavEnabled())
    @include('adminlte::partials.navbar.navbar-layout-topnav')
    @else
    @include('adminlte::partials.navbar.navbar')
    @endif

    {{-- Left Main Sidebar --}}
    @if(!$layoutHelper->isLayoutTopnavEnabled())
    @include('adminlte::partials.sidebar.left-sidebar')
    @endif

    {{-- Content Wrapper --}}
    @empty($iFrameEnabled)
    @include('adminlte::partials.cwrapper.cwrapper-default')
    @else
    @include('adminlte::partials.cwrapper.cwrapper-iframe')
    @endempty

    {{-- Footer --}}
    @hasSection('footer')
    @include('adminlte::partials.footer.footer')
    @endif

    {{-- Right Control Sidebar --}}
    @if($layoutHelper->isRightSidebarEnabled())
    @include('adminlte::partials.sidebar.right-sidebar')
    @endif

</div>
@stop

@section('adminlte_js')
@stack('js')
@yield('js')
@if (($mensaje = Session::get('mensaje')) && ($icono = Session::get('icono')))
<script>
    Swal.fire({
        position: "top-end",
        icon: "{{$icono}}",
        title: "{{$mensaje}}",
        showConfirmButton: false,
        timer: 4000
    });
</script>
@endif
@stop