@extends('layouts.app')


@section('content')
<div class="container background">
    <div class="banner__search">
        <div class="banner__search--background-img">
        </div>
        <h1>Welcome to our blog</h1>
        <p>We're happy to have you here. If you need help, please search before you post.</p>
        <form action="">
            <input type="text" name="" id="" placeholder="Tìm kiếm chủ đề, bài viết, danh mục bài viết">
            <button id="btnSearch">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </button>
        </form>
    </div>
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