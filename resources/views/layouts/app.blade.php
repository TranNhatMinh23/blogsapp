<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/config-light.css') }}" rel="stylesheet">
    <link href="{{ asset('css/config-dark.css') }}" rel="stylesheet">

    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/comment.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <link href="{{ asset('css/post.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/checkboxes.min.css') }}" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Monoton&display=swap" rel="stylesheet">
    
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}" ></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    
    
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/tinymce.min.js') }}" referrerpolicy="origin"></script>
        
    <script src="{{ asset('js/configEditor.js') }}"></script>
    <script src="{{ asset('js/slugString.js') }}"></script>
    <script src="{{ asset('js/toast.js') }}"></script>

</head>
<body>
    <div id="app" class="dark">
        
        @include('partials.header')
        <main class="py-4">
            <div class="container background">
    
            <div role="alert" aria-live="assertive"  style="z-index: 1111;position: fixed;right: 10px;bottom: 10px;" aria-atomic="true" class="toast" data-autohide="false">
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
                <div class="toast-body">
                    Hello, world! This is a toast message.
                </div>
            </div>
            
            @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
