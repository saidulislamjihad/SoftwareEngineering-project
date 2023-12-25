<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="icon" href="{!! asset('setting/binnomart icon.png') !!}"/>
    <!-- Pavicon ICon -->
    @include('frontend.v-2.includes.style')
    {!! $code->head_script !!}
</head>

<body>
    {!! $code->body_script !!}
    @include('frontend.v-2.includes.header')

    <main>
        <!-- Home Slider -->
        @yield('content-v2')
        <!-- /Footer top -->
    </main>

    <!-- Footer -->
    @include('frontend.v-2.includes.footer')
    <!-- /Footer -->

    <!-- Jquery CDN -->
    @include('frontend.v-2.includes.script')
    @stack('script')
</body>

</html>
