<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('form') }}/fonts/icomoon/style.css">

    <link rel="stylesheet" href="{{ asset('form') }}/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('form') }}/css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('form') }}/css/style.css">

    <title> Signup </title>
</head>

<body>


    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-2" style="background-image: url({{ asset('images/bg_1.jpg') }});"></div>
        <div class="contents order-2 order-md-1">

            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7">
                        <h3>SigIN to <strong>CozaStore</strong></h3>

                        <form action="{{route("user-login")}}" method="POST" >
                            @csrf
                
                            <div class="form-group last mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Your Email" value="{{ old('email') }}">
                                @error('email')
                                <div class="text-danger text-sm"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="form-group last mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Your Password"  >
                                @error('password')
                                <div class="text-danger text-sm"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                          
    

                            <div class="d-flex mb-5 align-items-center">
                                <label class="control control--checkbox mb-0">

                                    <a class="txt2 " href="{{ route('user-signup') }}">
                                       Dont Have an Account
                                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                                    </a>
                                </label>

          
                            </div>

                            {{-- <input type="submit" name="submit" value="Log In" class="btn btn-block btn-primary"> --}}
                            <button class="btn btn-block btn-primary" type="submit"name="submit">
                                SignIn
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>



    <script src="{{ asset('form') }}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('form') }}/js/popper.min.js"></script>
    <script src="{{ asset('form') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('form') }}/js/main.js"></script>
</body>

</html>
