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
                main
            </main>
        </div>
    </div>
</div>
@stop
