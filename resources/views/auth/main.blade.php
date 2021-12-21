
<!DOCTYPE html>
<html lang="en">

	<head>
		
		@include('auth.layouts.head')

	</head>
	
	<body class="hold-transition login-page">
		
        @yield('content')

		@include('auth.layouts.footer')
        
	</body>
	
</html>