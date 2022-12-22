<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		@include('include.client.head')
		@yield('css')
	</head>
	<body>

		@include('include.client.loader')

		<div id="pcoded" class="pcoded">
			
			<div class="pcoded-container">
					
				@include('include.client.navbar')
				
				<div class="pcoded-main-container">

					@include('include.client.navbar2')
				
					@yield('content')
					
				</div>
					
			</div>
		</div>
			@include('include.client.footer')

			@yield('js')
	</body>

</html