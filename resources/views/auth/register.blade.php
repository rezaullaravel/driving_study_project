<!-- template top -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>User Registration</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/') }}panel/assets/images/logo/Faavicon.png">
    <!-- Apple touch icon -->
    <link rel="apple-touch-icon" href="{{ asset('/') }}panel/assets/images/logo/Faavicon.png">
    <link
    rel="shortcut icon"
    type="image/x-icon"
    href="{{ asset('/') }}panel/assets/img/logo/favicon.png"
  />

  <!-- swiper css -->
  <link
    rel="stylesheet"
    href="{{ asset('/') }}panel/assets/plugin/swiperjs/swiper-bundle.min.css"
  />

  <!-- icon  -->
  <script src="{{ asset('/') }}panel/assets/plugin/iconify/iconify-icon.min.js"></script>

  <!-- bootstrap -->
  <link
    rel="stylesheet"
    href="{{ asset('/') }}panel/assets/css/fontawesome-all.min.css"
  />
  <!-- font awsome -->

  <link
  rel="stylesheet"
  href="{{ asset('/') }}panel/assets/plugin/bootstrap/css/bootstrap.min.css"
/>

  <!-- css -->
  <link rel="stylesheet" href="{{ asset('/') }}panel/assets/css/main.css" />

</head>

<body>

    <!--==================== Preloader Start ====================-->
    {{-- <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <span class="loader"></span>
            </div>
        </div>
    </div>

    <div class="sidebar-overlay"></div> --}}

    <!--==================== Preloader End ====================-->





<!-- login section -->
<section class="login-section">
    <div class="container px-0">
        <div class="row justify-content-center mx-0">
            <div class="col-xl-7 col-lg-6 px-0 d-none d-lg-block">
                <div class="login-left-section flex-column">
                    <div class="logo-wrap mb-5">
                        <a href="index.html">
                            <img src="{{ asset('/') }}panel/assets/img/logo/logo.png" alt="Logo">
                        </a>
                    </div>

                    <div class="thumb--wrap">
                        <img src="{{ asset('/') }}panel/assets/img/login/login-bg.png" alt="...">
                    </div>

                </div>

            </div>


            <div class="col-xl-5 col-lg-6 col-md-8 px-0">
                <div class="login-box">

                    <div class="home--btn bg--base radius--50 d-lg-none d-flex justify-content-center align-items-center">
                        <i class="fa-solid fa-house "></i>
                    </div>


                    <div class="icon-wrap">
                        <div class="icon">
                            <i class="fa-solid fa-user"></i>
                        </div>
                    </div>
                    <h4 class="title fw--300">Register For Free.</h4>


                    {{-- <div class="social-option mb-4">
                        <ul>
                            <li><a href="#" class="btn"><img class="me-2"
                                        src="{{ asset('/') }}panel/assets/img/login/icon8.png" alt="...">Google</a></li>
                            <li><a href="#" class="btn"><img class="me-2"
                                        src="{{ asset('/') }}panel/assets/img/login/icon9.png" alt="...">Facebook</a></li>
                        </ul>

                        <div class="text">
                            <h6>OR</h6>
                        </div>

                    </div> --}}


                  <form action="{{ route('user.register') }}" method="post">
                    @csrf
                        <div class="mb-4 form-group">
                            <label class="mb-2 form--label">Name <span class="text-danger">*</span> </label>
                            <input type="text" name="name" value="{{ old('name') }}"  class="form-control" placeholder="User name">
                            @error('name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="mb-4 form-group">
                            <label class="mb-2 form--label">Email <span class="text-danger">*</span> </label>
                            <input type="email" name="email" value="{{ old('email') }}"  class="form-control" placeholder="User email">
                            @error('email')
                                 <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-group">
                                <label class="mb-2 form--label text--white">Password</label>
                                <div class="input--group position-relative">
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Passwords" >
                                    <div class="password-show-hide fas toggle-password-change text--white fa-eye-slash" data-target="password"></div>
                                </div>

                                @error('password')
                                 <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-group">
                                <label class="mb-2 form--label text--white">Confirm Password</label>
                                <div class="input--group position-relative">
                                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm Passwords" >
                                    <div class="password-show-hide fas toggle-password-change text--white fa-eye-slash" data-target="password_confirmation"></div>
                                </div>

                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-group">
                                <label class="mb-2 form--label text--white">Licence Type</label>
                                   <div class="input--group position-relative">
                                        <select name="licence_type_id" class="form-select mt-2">
                                            <option value="" selected disabled>Select</option>
                                            @foreach ($licencetypes as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('licence_type_id')
                                        <strong class="text-danger">{{ $message }}</strong>
                                        @enderror

                                    </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-group">
                                <label class="mb-2 form--label text--white">Language</label>
                                   <div class="input--group position-relative">
                                        <select name="language_id" class="form-select mt-2">
                                            <option value="" selected disabled>Select</option>
                                            @foreach ($languages as $lang)
                                                <option value="{{ $lang->id }}">{{ $lang->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('language_id')
                                        <strong class="text-danger">{{ $message }}</strong>
                                        @enderror

                                    </div>
                            </div>
                        </div>


                    {{-- <div class="login-meta d-flex flex-nowrap mb-4" data-wow-delay="0.5s">
                        <div class="form-check">
                            <input class="form-check-input" id="1" type="checkbox" value="">
                        </div>
                        <div class="condition-text">
                            <label for="1">I agree with Company, <a href="#">Privacy Policy</a> and <a href="#">Terms of
                                    Service</a>
                            </label>
                        </div>
                    </div> --}}

                     <button type="submit" class="btn btn-base btn-lg w-100">Register</button>
                  </form>

                    <div class="mt-5 text-center">
                        <p>Already have an account ? <a href="{{ url('/') }}" class="text-success">Please  login here..</a></p>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>






<!-- template bottom -->
   <!-- jquery  -->
   <script src="{{ asset('/') }}panel/assets/plugin/jquery/jquery-3.7.1.min.js"></script>

   <!-- bootstrap -->
   <script src="{{ asset('/') }}panel/assets/plugin/bootstrap/js/bootstrap.bundle.min.js"></script>

   <!-- js  -->
   <script src="{{ asset('/') }}panel/assets/js/script.js"></script>

</body>

</html>
