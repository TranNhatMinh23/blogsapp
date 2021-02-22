@extends('layouts.app')


@section('content')
<div class="container background">
    <div class="row">
        <div class="col-md-8 layout-main">
            @yield('content-master')
        </div>
        <div class="col-md-4 layout-sidebar">
            @include('partials.sidebar')
        </div>
    </div>
</div>
@endsection