<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		@include('include.admin.head')
		@yield('css')
	</head>
    <body>

        @include('include.admin.loader')

        <div id="page-container" class="page-container fade page-without-sidebar page-header-fixed page-with-top-menu">
            
            @include('include.admin.header')

            @include('include.admin.top_menu')

            @yield('content')

        </div>

        @include('include.admin.footer')

        @yield('js')

    </body>
</html>
