@extends('admin.master')

@section('title', 'Dashboard')

@push('css')
    @css('admin/main.css')
@endpush

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('admin.sublayouts.sidebar')
            <main class="main">
                @include('admin.sublayouts.header')
                <div class="content">
                    @yield('breads')
                </div>
            </main>
        </div>
    </div>
</div>
@include('admin.sublayouts.settings-sidebar')
@stop
