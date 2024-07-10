<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
    <meta property="og:title" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
    <meta property="og:description" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
    <meta property="og:image" content="https://fillow.dexignlab.com/xhtml/social-image.png">
    <meta name="format-detection" content="telephone=no">
    
    
    <title>Login</title>
    
    
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Sign in to your account</h4>
                                    
                                    <!-- Laravel Login Form -->
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <!-- Session Status -->
                                        @if (session('status'))
                                            <div class="mb-4 text-green-600">
                                                {{ session('status') }}
                                            </div>
                                        @endif

                                        <!-- Email Address -->
                                        <div class="mb-3">
                                            <label for="email" class="mb-1"><strong>Email</strong></label>
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                                            @if ($errors->has('email'))
                                                <div class="mt-2 text-red-600">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>

                                        <!-- Password -->
                                        <div class="mb-3">
                                            <label for="password" class="mb-1"><strong>Password</strong></label>
                                            <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                                            @if ($errors->has('password'))
                                                <div class="mt-2 text-red-600">{{ $errors->first('password') }}</div>
                                            @endif
                                        </div>

                                        <!-- Remember Me -->
                                        <div class="row d-flex justify-content-between mt-4 mb-2">
                                            <div class="mb-3">
                                                <div class="form-check custom-checkbox ms-1">
                                                    <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                                                    <label class="form-check-label" for="remember_me">Remember me</label>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                 <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Forgot Password?</a>
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Sign Me In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Forgot your password?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Contact the clinic:</p>
                    <ul class="list-unstyled">
                        <li>Visit the clinic in person.</li>
                        <li>Contact us via telephone: <strong>+94512223218</strong></li>
                        <li>Email us: <strong>support@hcc.com</strong></li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <!-- You can add additional buttons if needed -->
                </div>
            </div>
        </div>
    </div>

    
    <script src="vendor/global/global.min.js"></script>
	<script src="vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>
	<script src="js/custom.min.js"></script>
	<script src="js/dlabnav-init.js"></script>
	<script src="js/demo.js"></script>
</body>
</html>
