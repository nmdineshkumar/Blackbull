
<!doctype html>
<html class="no-js " lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

	<title>:: Blackbull Login ::</title>
	<link rel="shortcut icon" href="../assets/images/favicon.ico">

	<!-- Bootstrap Css -->
	<link href="../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
	<!-- Icons Css -->
	<link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<!-- App Css-->
	<link href="../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body class="theme-purple authentication sidebar-collapse">

	<body class="auth-body-bg">
		<div class="bg-overlay"></div>
		<div class="wrapper-page">
			<div class="container-fluid p-0">
				<div class="card">
	<div class="card-body">
		<div class="text-center mt-4">
			<div class="mb-3">
				<a href="" class="auth-logo">
					<img src="{{asset('imgs/login_logo.jpeg')}}" height="150" class="logo-dark mx-auto" alt="">
				</a>
			</div>
		</div>

		<h4 class="text-muted text-center font-size-18"><b>Sign In</b></h4>
		@error ('error')
			<div class="error text-center">{{ $message }}</div>
		@enderror
		<div class="p-3">
			<form class="form-horizontal needs-validation mt-3" novalidate method="POST" id="loginform" action="{{route('auth.login')}}">
                @csrf
				<div class="form-row mb-3 row">

					<div class="col-12">
						<input class="form-control @error('email') error @enderror" type="text" placeholder="Username" name="email" value="{{old('email')}}">
					</div>
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
				</div>

				<div class="form-row mb-3 row">
					<div class="col-12">
						<input class="form-control @error('password') error @enderror" type="password" placeholder="Password" name="password">
					</div>
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
				</div>
				<div class="form-group mb-3 row">
					<div class="col-12">
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="customCheck1">
							<label class="form-label ms-1" for="customCheck1">Remember me</label>
						</div>
					</div>
				</div>

				<div class="form-group mb-3 text-center row mt-3 pt-1">
					<div class="col-12">
						<button class="btn btn-info w-100 waves-effect waves-light" type="submit" name="login" value="Login">Log In</button>
					</div>
				</div>

				<div class="form-group mb-0 row mt-2">
					<div class="col-sm-7 mt-3">
						<a href="/forgot-pass" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
					</div>
				</div>
			</form>
		</div>
		<!-- end -->
	</div>
	<!-- end cardbody -->
</div>
			</div>
			<!-- end container -->
		</div>
		<!-- end -->


	</body>

</html>
