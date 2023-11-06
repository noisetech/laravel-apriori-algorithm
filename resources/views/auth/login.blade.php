<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="9wXMj37iNeJIcn5FeNQpaMn123952wWinY90Fe1T">



    <link rel="stylesheet" href="{{ asset('bahan-login/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bahan-login/modules/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bahan-login/modules/bootstrap-social/bootstrap-social.css') }}">
    <link rel="stylesheet" href="{{ asset('bahan-login//css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('bahan-login/css/components.css') }}">


</head>

<body>

    <style>
        .login{
           background-size:  80vh;
            background-position: center;
            background-image: url('{{ asset('bg-login.jpg') }}');
           background-repeat: no-repeat;

        }
    </style>


    <div id="app">
        <section class="section">
            <div class="d-flex flex-wrap align-items-stretch">
                <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                    <div class="p-4 " style="margin-top: 100px;">
                        <h4 class="text-dark font-weight-normal">Welcome to <span class="font-weight-bold">Aporori Laravel
                            </span>
                        </h4>
                        <p class="text-muted">Before you get started, you must login or register if you don't already
                            have an account.</p>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control " name="email" tabindex="1"
                                    required autofocus>


                            </div>

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                </div>
                                <input id="password" type="password" class="form-control " name="password"
                                    tabindex="2" required>


                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                                        id="remember">
                                    <label class="custom-control-label" for="remember">Remember Me</label>
                                </div>
                            </div>

                            <div class="form-group text-right">
                                <a href="http://127.0.0.1:8000/password/reset" class="float-left mt-3">
                                    Forgot Password?
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right"
                                    tabindex="4">
                                    Login
                                </button>
                            </div>

                            <div class="mt-5 text-center">
                                Don't have an account? <a href="http://127.0.0.1:8000/register">Create new one</a>
                            </div>
                        </form>


                    </div>
                </div>

                <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-50 background-walk-y position-relative overlay-gradient-bottom login">
                    <div class="absolute-bottom-left index-2">
                        {{-- <div class="text-light p-5 pb-2">
                            <div class="mb-5 pb-3">
                                <h1 class="mb-2 display-4 font-weight-bold">Retention Basin</h1>
                                <h5 class="font-weight-normal text-muted-transparent">Semarang, Indonesia</h5>
                            </div>
                            Photo by <a class="text-light bb" target="_blank"
                                href="https://unsplash.com/photos/BdCl4IdiLWo">Sandro Meier</a> on <a
                                class="text-light bb" target="_blank" href="https://unsplash.com">Unsplash</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </section>
    </div>


    <script src="{{ asset('bahan-login/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('bahan-logn/modules/popper.js') }}"></script>
    <script src="{{ asset('bahan-login/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bahan-login/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('bahan-login/js/stisla.js') }}"></script>
    <script src="{{ asset('bahan-login/js/scripts.js') }}"></script>
    <script src="{{ asset('bahan-login/js/custom.js') }}"></script>
</body>

</html>
