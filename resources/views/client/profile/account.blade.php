@extends('client.layouts.master')
@section('content')
    <div class="container" style="max-width: 1270px">

        <div class="row">
            <div class="menu-profile" style="position: fixed; top:20%; height:435px; width: 260px; background-color:white; border-radius: 0 25px 25px 0;">
                <div style="border-bottom: 1px solid lightgrey; align-items:center">
                    <div style="display: flex; justify-content:center">
                        <i class="fas fa-user-circle" style="color: black; margin: 25px 15px; font-size:60px; display:block"></i>
                    </div>
                    <div style="display: flex; justify-content:center">
                        <h4 style="font-weight: bold; color: black;">{{Auth::user()->name}}</h4>
                    </div>
                </div>

                <div style="width:260px">
                    <div class="profile_option">
                        <span id="icon" class="material-symbols-outlined">
                            person
                        </span>
                        <a href="">Account Detail</a>
                    </div>

                    <div class="profile_option">
                        <span id="icon" class="material-symbols-outlined">
                            shopping_cart
                        </span>
                        <a href="">Order</a>
                    </div>

                    <div class="profile_option">
                        <span id="icon" class="material-symbols-outlined">
                            manage_accounts
                        </span>
                        <a href="">Change Password</a>
                    </div>

                    <form id="option-logout" action="" method="POST" style="margin-bottom: 0">
                        <div class="profile_option">
                            <span id="icon" class="material-symbols-outlined">
                                logout
                            </span>
                            <a href="#" id="submit-form-profile">Logout</a>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>

            <div class="center-content">
                <div class="user-icon">
                    <div class="user" style="border-bottom: 1px solid lightgrey;">
                        <i class="fas fa-user-circle" style="color: white; margin: 25px 15px"></i>
                        <h4 style="font-weight: bold; color: white;">{{Auth::user()->name}}</h4>
                    </div>
 
                    <div class="menu">
                        <div class="option">
                            <span id="icon" class="material-symbols-outlined">
                                person
                            </span>
                            <a href="">Account Detail</a>
                        </div>

                        <div class="option">
                            <span id="icon" class="material-symbols-outlined">
                                shopping_cart
                            </span>
                            <a href="{{route('get-pending')}}">Order</a>
                        </div>
                        <div class="option">
                            <span id="icon" class="material-symbols-outlined">
                                manage_accounts
                            </span>
                            <a href="">Change Password</a>
                        </div>

                        <form id="logout" action="{{route('logout')}}" method="POST" style="margin-bottom: 0">
                            <div class="option">
                                <span id="icon" class="material-symbols-outlined">
                                    logout
                                </span>
                                <a id="submit-form" href="#">Logout</a>
                            </div>
                            @csrf
                        </form>
                    </div>
                </div>
                <div class="info">
                    @yield('profile-content')
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('submit-form').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('logout').submit();
        });

        document.getElementById('submit-form-profile').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('logout').submit();
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var menuVisible = false;

            $('.menu__profile__toggle').click(function() {
                if (menuVisible) {
                    $('.menu-profile').animate({ left: '-500px' });
                } else {
                    $('.menu-profile').animate({ left: '0px' });
                }
                menuVisible = !menuVisible;
            });

            $(document).click(function(event) {
                if (menuVisible && !$(event.target).closest('.menu-profile').length && !$(event.target).closest('.menu__profile__toggle').length) {
                    $('.menu-profile').animate({ left: '-500px' });
                    menuVisible = false;
                }
            });
        });
    </script>
@endsection
<style>
    {{include'../resources/css/client/account/master-profile.css'}}
</style>

