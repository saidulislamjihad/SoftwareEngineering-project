<!DOCTYPE html>
<html>
<head>
    <meta name="facebook-domain-verification" content="ekpptzvsgtie29yxdpz3grflfnq0qh" />
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5XCS3KGR');</script>
<!-- End Google Tag Manager -->
	<title>@yield('title')</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	@if (Auth::guard('web')->check())
        <meta name="user_name" content="{{ Auth::guard('web')->user()->full_name }}">
        <meta name="user_id" content="{{ Auth::guard('web')->user()->id }}">
    @else
        <meta name="user_name" content="">
        <meta name="user_id" content="">
    @endif

		<!-- Favicon icon link -->
	 @include('frontend.includes.style')

     @stack('style')


</head>
<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5XCS3KGR"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) --> 
	@include('frontend.includes.header')
    <main class="main-section" id="app">
		<add-cart></add-cart>
        <flash message=""></flash>
        @yield('content')
    </main>

	@include('frontend.includes.footer')

<!-- Jquery CDN-->
@include('frontend.includes.script')
@stack('script')
</body>
</html>
