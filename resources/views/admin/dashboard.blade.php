@extends('admin.master')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-2 p-0">
            @include('admin.sublayouts.sidebar')
        </div>
        <div class="col-md-10">
            main
        </div>
    </div>
</div>
@stop
