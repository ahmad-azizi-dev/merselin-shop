<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#100DD1">

@stack('head')

<!-- icon-->
    <link rel="icon" href="https://placehold.it/35x35">

    <!-- Stylesheet-->
    <link rel="stylesheet" href="{{asset('style.css')}}">

</head>
<body>
<!-- Preloader-->
<div class="preloader" id="preloader">
    <div class="spinner-grow text-secondary" role="status">
        <div class="sr-only">@lang('mainFrontend.Preloader')</div>
    </div>
</div>

{{$slot}}

@stack('modal')
</body>

<!-- All JavaScript Files-->
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

@stack('script')

<script src="{{asset('js/dark-mode-switch.js')}}"></script>
<script src="{{asset('js/active.js')}}"></script>

</html>
