<!DOCTYPE html>
<html lang="en" class="wide wow-animation smoothscroll scrollTo">
<head>
	@include('layouts.head')
</head>
<body>

	<div class="page text-center">
		{{-- @include('layouts.loader') --}}
		@include('layouts.header')
		@yield('content')
		@include('layouts.footer')
	</div>
	@include('layouts.javascripts')

</body>
</html>