<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{asset ('admins')}}/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="{{asset ('admins')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{asset('admins')}}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="shortcut icon" href="{{asset('/images/laravel-logo.png')}}">
    <link rel="stylesheet" href="resources/css/client/layout/master.css">
    {{-- list product navbar --}}
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

    <title>Manatee</title>
</head>
<body>
    <style>
      {{include'../resources/css/client/layout/master.css'}}
      
    </style>
    <div style="position: sticky">
        <header id="page-header">
            <div class="page-header-wrap">
                <div class="container" style="max-width: 1270px;">
                    <div class="header-wrap">
                        <div class="header-left header-col-start" style="flex: 1 1 0px;">
                            <div class="header-content-inner">
                                <div class="branding" style="padding: 8px 0 8px;">
                                    <div class="branding__logo">
                                        <a href="{{route('home')}}" rel="home">
                                        <img src="">
                                        </a>
                                    </div>
                                </div>
                                <div id="menu-toggle">
                                    <span class="material-symbols-outlined">menu</span>
                                </div>
                            </div>
                        </div>
                        <div class="header-center " style="flex-shrink: 0;">
                            <div class="header-content-inner">
                                <div class="header-search-form">
                                    <div class="search_wrap search_wrap_1">
                                        <form action="" method="POST" style="margin: 0">
                                            <div class="search_box">
                                                <input name="search" type="text" class="input" placeholder="Search something..." value="{{old('search') }}">
                                                <button class="btn btn_common">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="header-right" style="flex: 1 1 0px;">
                            <div class="header-content-inner" style=" justify-content:flex-end">
                                <span id="search-icon" class="material-symbols-outlined" style="margin:10px;">search</span>
                                @if (!Auth::user())
                                    <a href="javascript:" class="icon-wrap" id="init-login-form-1">
                                        <div class="icon">
                                            <span class="material-symbols-outlined">
                                            person
                                            </span>
                                            <span class="tooltiptext">Login</span>
                                        </div>
                                    </a>
                                    <a href="javascript:" class="icon-wrap" id="init-login-form-responsive">
                                        <div class="icon">
                                            <span class="material-symbols-outlined">
                                            person
                                            </span>
                                            <span class="tooltiptext">Login</span>
                                        </div>
                                    </a>
                                @else
                                    <a href="" class="icon-wrap">
                                        {{-- {{route('getUserProfile')}} --}}
                                        <div class="icon">
                                            <span class="material-symbols-outlined">
                                            person
                                            </span>
                                            <span class="tooltiptext">Account</span>
                                        </div>
                                    </a>
                                @endif
                                <a href="" class="icon-wrap">
                                    <div class="icon">
                                        <span class="material-symbols-outlined">
                                            favorite
                                        </span>
                                        <span id="icon-amount-favorite"></span>
                                        <span class="tooltiptext">Wishlist</span>
                                    </div>
                                 </a>
                                 @if (Auth::user())
                                    <a href="" class="icon-wrap">
                                        {{-- {{route('cart')}} --}}
                                        <div class="icon">
                                            <span class="material-symbols-outlined">
                                                shopping_bag
                                            </span>
                                            @if (!empty(Session::has('Cart')))
                                                <span id="icon-amount-orders">{{Session::get('Cart')->totalQuantity}}</span>
                                            @else
                                                <span id="icon-amount-orders">0</span>
                                            @endif
                                            <span class="tooltiptext">Cart</span>
                                        </div>
                                    </a>
                                 @else
                                    <a href="#" class="icon-wrap" id="init-login-form-2">
                                        <div class="icon">
                                            <span class="material-symbols-outlined">
                                                shopping_bag
                                            </span>
                                            @if (!empty(Session::has('Cart')))
                                                <span id="icon-amount-orders">{{Session::get('Cart')->totalQuantity}}</span>
                                            @else
                                                <span id="icon-amount-orders">0</span>
                                            @endif
                                            <span class="tooltiptext">Cart</span>
                                        </div>
                                    </a>
                                 @endif
                            </div>
                        </div>
                    </div>

                </div>
                <div class="header-below">
                    <div class="container" style="max-width: 1270px;">
                        <div class="header-below-wrap">
                            <div class="header-below-left">
                                <div class="header-content-inner">
                                    <div class="header-categories-nav">
                                        <div class="inner">
                                            <span class="nav-toggle-btn">
                                                Shop By Categories
                                            </span>
                                            <nav class="category-menu">
                                                <ul class="category-menu-list">
                                                    {{-- @if(!empty(getAllCategory()))
                                                    @foreach(getAllCategory() as $item=>$key)
                                                        <li class="category-menu-item">
                                                            <a href="{{route('getCategory',['data'=>"$key->name"])}}" class="cmi-link">
                                                                <div class="cmi-wrap">
                                                                        <span class="cmi-content">
                                                                            {{$key->name}}
                                                                        </span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                    @endif --}}
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="header-below-center">
                                <div class="header-content-inner" style="justify-content: center;">
                                    <div class="page-nav">
                                        <div class="menu">
                                            <ul class="menu-wrap">
                                                <li class="menu-item">
                                                    <a href="{{route('home')}}" class="rm-rf underline-hover-effect">
                                                        <div class="menu-item-wrap">
                                                            <span class="menu-item-title">Home</span>
                                                        </div>
                                                    </a>
                                                </li>
                                                @if(!empty(getCategoryParent()))
                                                    @foreach(getCategoryParent() as $item)
                                                    <li class="menu-item nav-item dropdown ">
                                                        <a href="" class="rm-rf underline-hover-effect " id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <div class="menu-item-wrap">
                                                                <span class="menu-item-title dropdown-toggle">{{$item->name}}</span>
                                                            </div>
                                                        </a>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            @if(!empty(cateProductFParent($item->id)))
                                                                @foreach(cateProductFParent($item->id) as $catepro)
                                                                    <li><a class="dropdown-item" href="{{route('navbar',['cateParent'=>$item->id,'catePro'=>$catepro->id])}}">{{$catepro->name}}</a></li>
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                    </li>
                                                    @endforeach
                                                @endif
                                                {{-- <li class="menu-item">
                                                    <a href="" class="rm-rf underline-hover-effect">
                                                        <div class="menu-item-wrap">
                                                            <span class="menu-item-title">Men</span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="menu-item">
                                                    <a href="{{route('kid')}}" class="rm-rf underline-hover-effect">
                                                        <div class="menu-item-wrap">
                                                            <span class="menu-item-title">Kids</span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="menu-item">
                                                    <a href="" class="rm-rf underline-hover-effect">
                                                        <div class="menu-item-wrap">
                                                            <span class="menu-item-title">Baby</span>
                                                        </div>
                                                    </a>
                                                </li> --}}
                                                {{-- <li class="menu-item">
                                                    <a href="{{route('more')}}" class="rm-rf underline-hover-effect">
                                                        <div class="menu-item-wrap">
                                                            <span class="menu-item-title">More</span>
                                                        </div>
                                                    </a>
                                                </li> --}}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="header-below-right">
                                <div class="header-content-inner">
                                    @if(Auth::user())
                                        <span style="margin-right:20px">Hello {{Auth::user()->name}} !</span>
                                    @else
                                        <span style="margin-right:20px">Vui lòng đăng nhập hoặc đăng kí !</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="page-content" style ="margin-top: 12px">
            @yield('content')
        </div>
    </div>

    <div id="menu" style="position: absolute; top:0; height:100%; width: 300px; background-color:white;">
        <div style="position: fixed; width:300px;">
            <div style="background-color: #f5f7f7">
                <img style="width: 50%; margin: 25px 20px;" src="{{asset('images/logo.png')}}">
                <div class="menu__nav" style="display: flex; justify-content:center; margin-top: 5px;">
                    <div id="menu_nav_option" class="menu_nav_option">Menu</div>
                    <div id="categories_nav_option" class="categories_nav_option">Categories</div>
                </div>
            </div>
            <div class="menu__container" style="background-color:white">
                <div class="menu_option">
                    <span style="font-size: 25px" class="material-symbols-outlined">home</span>
                    <a href="">Home</a>
                </div>
                <div class="menu_option">
                    <span class="material-symbols-outlined">storefront</span>
                    <a href="">Shop</a>
                </div>
                <div class="menu_option">
                    <span class="material-symbols-outlined">note_stack</span>
                    <a href="">About</a>
                </div>
                <div class="menu_option">
                    <span class="material-symbols-outlined">more_horiz</span>
                    <a href="">More</a>
                </div>
                @if (Auth::user())
                    <div style="margin: 45% 10px 10px 10px;">
                        <div>
                            <div style="display:flex; align-items:center;">
                                <span class="material-symbols-outlined" style="font-size: 30px; margin: 0 10px"> account_circle </span>
                                <h5 style="font-weight: bold; color: black; margin-bottom:0; display:inline">{{Auth::user()->name ?? null}}</h5>
                            </div>
                        </div>

                        <form id="form-logout" action="" method="POST" style="margin: 20px 20px 0 10px">
                            {{-- {{route('logout')}} --}}
                            <button class="btn btn-dark" type="submit" style="width: 100%; font-weight:bold">Logout</button>
                            @csrf
                        </form>
                    </div>
                @endif
            </div>
            <div class="categories__container">
                <div class="categories_option">
                    <a href="#">Phone</a>
                </div>
                <div class="categories_option">
                    <a href="#">Laptop</a>
                </div>
                <div class="categories_option">
                    <a href="#">Watch</a>
                </div>
            </div>
        </div>
    </div>

    <div id="sontran" style="position: absolute;top: 0;left: 0;bottom: 0;right: 0;background: #000; opacity: 0.5;">
    </div>
    <div id="sontran-responsive" style="position: absolute;top: 0;left: 0;bottom: 0;right: 0;background: #000; opacity: 0.5;">
    </div>
    @if (!Auth::user())
        <div id="login" class="login-form" role="dialog">
            <div class="login-form-dialog">
                <div class="login-form-content">
                    <div class="login-form-body">
                        <div class="container-login-form" id="container-id">
                            <div class="form-container-wrap sign-up-container">
                                <form action="{{route('register')}}" class="form-login" method="POST">
                                    <h1 class="title-login-form">Create Account</h1>
                                    <div class="social-container">
                                        <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                                        <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                    <span class="subtitle-login-forn">or use your email for registration</span>
                                    <input type="text" placeholder="Name"  class="inp-login-form" name="name" required/>
                                    <input type="email" placeholder="Email" class="inp-login-form" name="email" required/>
                                    <input type="password" placeholder="Password" class="inp-login-form" name="password" required/>
                                    <input type="password" placeholder="Confirm Password" class="inp-login-form" name="password_confirmation" required/>
                                    <button class="btn-login-form" type="submit">Sign Up</button>
                                    @csrf
                                </form>
                            </div>
                            <div class="form-container-wrap sign-in-container">
                                <form action="{{route('login')}}" class="form-sign-in" method="POST">
                                    <h1 class="title-login-form">Sign in</h1>
                                    <div class="social-container">
                                        <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                                        <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                    <span class="subtitle-login-forn">or use your account</span>
                                    <input type="email" placeholder="Email" class="inp-login-form" name="email"/>
                                    @error('email')
                                    <span style="color: red">{{$message}}</span>
                                    @enderror
                                    <input type="password" placeholder="Password" class="inp-login-form" name="password"/>
                                    @error('password')
                                    <span style="color: red">{{$message}}</span>
                                    @enderror
                                    <a class="forgot-pass-link" href="#">Forgot your password?</a>
                                    <button class="btn-login-form" type="submit">Sign In</button>
                                    @csrf
                                </form>
                            </div>
                            <div class="overlay-container">
                                <div class="overlay">
                                    <div class="overlay-panel overlay-left">
                                        <h1 class="title-login-form">Welcome Back!</h1>
                                        <p class="guide-login-form">To keep connected with us please login with your personal info</p>
                                        <button class="ghost btn-login-form" id="signIn">Sign In</button>
                                    </div>
                                    <div class="overlay-panel overlay-right">
                                        <h1 class="title-login-form">Hello, Friend!</h1>
                                        <p class="guide-login-form">Enter your personal details and start journey with us</p>
                                        <button class="ghost btn-login-form" id="signUp">Sign Up</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="login-responsive" style="position: absolute;">
            <div id="signIn-form" class="signIn-form-responsive">
                <form action="{{route('login')}}" class="form-sign-in-responsive" method="POST">
                    <h1 class="title-login-form">Sign in</h1>
                    <div class="social-container">
                        <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                        <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <span class="subtitle-login-forn">or use your account</span>
                    <input type="email" placeholder="Email" class="inp-login-form" name="email"/>
                    <input type="password" placeholder="Password" class="inp-login-form" name="password"/>
                    <a class="forgot-pass-link" href="#">Forgot your password?</a>
                    <div style="display: flex">
                        <button class="btn-login-form" type="submit">Sign In</button>
                        <a href="javascript:" class="btn-signUp-form">Sign Up</a>
                    </div>
                    @csrf
                </form>
            </div>

            <div id="signUp-form" class="signUp-form-responsive">
                <form action="{{route('register')}}" class="form-sign-up-responsive" method="POST">
                    <h1 class="title-login-form">Create Account</h1>
                    <div class="social-container">
                        <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                        <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <span class="subtitle-login-forn">or use your email for registration</span>
                    <input type="text" placeholder="Name"  class="inp-login-form" name="name"/>
                    <input type="email" placeholder="Email" class="inp-login-form" name="email"/>
                    <input type="password" placeholder="Password" class="inp-login-form" name="password"/>
                    <input type="password" placeholder="Confirm Password" class="inp-login-form" name="password_confirmation"/>
                    <div style="display: flex; margin-top: 10px;">
                        <a href="javascript:" class="btn-signIn-form" style="margin:0 10px 0 0;">Sign In</a>
                        <button class="btn-login-form" type="submit">Sign Up</button>
                    </div>
                    @csrf
                </form>
            </div>
        </div>
    @else
        <div id="vouchers-wrap">
            <span id="close-vouchers-wrap">X</span>
            <div class="head-content" style="margin-bottom: 24px;">
                <h5>Techstore vouchers</h5>
            </div>
            <div id="vouchers-block">
                <ul id="vouchers-list">
                        {{-- @foreach(getDiscountUser(Auth()->user()->rank_id) as $item)
                                <li class="voucher-item">
                                    <form method="POST" action="{{route('checkDiscountSelect')}}">
                                        <div class="row" style="align-items: center; margin-right:0; margin-left:0;">
                                            <p class="voucher-item-name">{{$item->name}}</p>
                                            <p class="voucher-item-name">{{$item->price}}</p>
                                            <input type="hidden" name="voucher" value="{{$item->code}}" class="voucher-item-name" readonly/>
                                            <div>
                                                <input type="hidden">
                                                <button class="btn btn-primary" type="submit">Add</button>
                                            </div>
                                        </div>
                                        @csrf                    
                                    </form>
                                    <hr>
                                </li>
                        @endforeach --}}
                </ul>
            </div>
        </div>
        {{-- <livewire:SelectVoucher :idProduct="$product['id']"> --}}
    @endif

    <script src="https://kit.fontawesome.com/f9275dded9.js" crossorigin="anonymous"></script>
    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container-id');
        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });
        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });

        var prevScrollpos = window.pageYOffset;
        window.onscroll = function() {
        var currentScrollPos = window.pageYOffset;
          if (prevScrollpos > currentScrollPos) {
            document.getElementById("page-header").style.position = "sticky";

            document.getElementById("page-header").style.top = "0";
          } else {
            document.getElementById("page-header").style.position = "";
            document.getElementById("page-header").style.top = "-133.6px"; /* adjust this value to the height of your header */
          }
          prevScrollpos = currentScrollPos;
        }

        const btnLoginForm1 = document.querySelector("#init-login-form-1");
        btnLoginForm1.addEventListener("click", () => {
            console.log(1);
            let loginForm = document.getElementById("login");
            let sontran = document.getElementById("sontran");

                loginForm.style.display = "block";
                loginForm.style.top = window.scrollY + window.innerHeight / 2 + "px";
                document.body.style.overflow = "hidden";
                sontran.style.display = "block";
                document.body.style.paddingRight = "17px";
                document.addEventListener("click", (e) => {
                    if (!loginForm.contains(e.target) && !btnLoginForm1.contains(e.target)) {
                        loginForm.style.display = "none";
                        loginForm.style.top = "36%";
                        document.body.style.overflow = "visible";
                        document.body.style.paddingRight = "0px";
                        sontran.style.display = "none";
                    }
                });
        });
        // btnLoginForm2.addEventListener("click", (event) => {
        //     event.preventDefault();
        //     console.log(2);
        //     btnLoginForm1.click();
        // })


    </script>


    <script>
        const btnSignUp = document.querySelector(".btn-signUp-form");
        const btnSignIn = document.querySelector(".btn-signIn-form");
        let signInForm = document.getElementById("signIn-form");
        let signUpForm = document.getElementById("signUp-form");
        btnSignUp.addEventListener("click", () => {
            signInForm.style.display = "none";
            signUpForm.style.display = "block";
        });
        btnSignIn.addEventListener("click", () => {
            signInForm.style.display = "block";
            signUpForm.style.display = "none";
        });
    </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
         $(document).ready(function() {
            var menuVisible = false;

            $('#menu-toggle').click(function() {
                if (menuVisible) {
                    $('#menu').animate({ left: '-250px' });
                } else {
                    $('#menu').animate({ left: '0px' });
                }
                menuVisible = !menuVisible;
            });

            $(document).click(function(event) {
                if (menuVisible && !$(event.target).closest('#menu').length && !$(event.target).closest('#menu-toggle').length) {
                    $('#menu').animate({ left: '-500px' });
                    menuVisible = false;
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.menu_nav_option').click(function() {
                $('.menu_nav_option').css('border-bottom', '2px solid black');
                $('.categories_nav_option').css('border-bottom', '0');
                $('.menu__container').css('display', 'block');
                $('.categories__container').css('display', 'none');
            })
        })
        $(document).ready(function() {
            $('.categories_nav_option').click(function() {
                $('.categories_nav_option').css('border-bottom', '2px solid black');
                $('.menu_nav_option').css('border-bottom', '0');
                $('.menu__container').css('display', 'none');
                $('.categories__container').css('display', 'block');
            })
        })

    </script>

    <script src="{{asset('admins')}}/vendor/jquery/jquery.min.js"></script>
    <script src="{{asset('admins')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('admins')}}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('admins')}}/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="{{asset('admins')}}/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('admins')}}/js/demo/chart-area-demo.js"></script>
    <script src="{{asset('admins')}}/js/demo/chart-pie-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>

    {{-- sliderJs --}}
    {{-- <script src="path-to-the-file/splide.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
</body>

</html>
