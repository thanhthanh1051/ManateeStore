@extends('client.profile.account')
@section('profile-content')
    <div class="row" style="display:flex; justify-content:center">
        <div class="profile-tags" style="width:95%; align-content:center;">
            <h2 style="margin: 5% 0 0 10px; float: left;">
                Account
            </h2>
        </div>

        <fieldset>
                <div class="form-group" style="margin: 10px 0 0 0">
                    <form action="{{route('postAccount')}}" method="POST" style="width:100%" enctype="multipart/form-data">
                        <div class="information" style="margin:0 15px 0 0;">
                            <div style="display: inline-block; width:100%">
                                <div class="mb-4">
                                    <label for="name">User Name: </label>
                                    <input name="name" style="font-size:15px" class="form-control" type="text" value="{{Auth::user()->name}}" disabled>
                                    @error('name')
                                        <span style="color: red; float: left; margin-top:5px">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="email">Email: </label>
                                    <input name="email" style="font-size:15px" class="form-control" type="email" value="{{Auth::user()->email ?? null}}" disabled>
                                    @error('email')
                                        <span style="color: red; float: left; margin-top:5px">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label>Phone: </label>
                                    <input name="phone" style="font-size:15px" class="form-control" type="tel" name="phone" pattern="0[0-9]{2}[0-9]{3}[0-9]{4}" value="{{Auth::user()->phone ?? null}}" placeholder="Type your phone number..." disabled>
                                </div>
                            </div>
                        </div>

                        <div class="information">
                            <div style="display: inline-block; width:100%">
                                <div class="mb-4">
                                    <label>Date Of Birth: </label>
                                    <input name="dob" style="font-size:15px" class="form-control" type="date" value="{{Auth::user()->dob ?? null}}" disabled>
                                    @error('dob')
                                        <span style="color: red; float: left; margin-top:5px">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label>Gender: </label>
                                    <select name="gender" style="font-size:15px" class="form-control" name="gender" disabled>
                                        <option value="">Choose your gender...</option>
                                        <option {{ (Auth::user()->gender ?? '') === 0 ? 'selected' : '' }} value="0">Male</option>
                                        <option {{ (Auth::user()->gender ?? '') === 1 ? 'selected' : '' }} value="1">Female</option>
                                        <option {{ (Auth::user()->gender ?? '') === 2 ? 'selected' : '' }} value="2">Other</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label>Address: </label>
                                    <input name="address" style="font-size:15px" class="form-control" type="text" value="{{Auth::user()->address ?? null}}" placeholder="Type your address..." disabled>
                                </div>
                            </div>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @csrf
                        <div class="change" style="float: left; margin: 15px 0 20px 0">
                            <a onclick="changeInfo()" class="btn btn-warning" style="font-size:15px; float: left;">Change Information</a>
                            <button id="btn-save" type="submit" class="btn btn-primary" style="font-size:15px; float: left; display:none; ">Save Change</button>
                        </div>
                    </form>
                </div>
        </fieldset>


    </div>

    <script>
        function changeInfo() {
            var inputFields = document.querySelectorAll('input[disabled]');
            for (var i = 0; i < inputFields.length; i++) {
                inputFields[i].style.cursor = 'auto';
                inputFields[i].style.pointerEvents = 'auto';
                inputFields[i].disabled = false;
            }
            document.querySelectorAll('select[disabled]')[0].disabled = false;
            document.getElementById("btn-save").style.display = "block";
        }
    </script>

@endsection

<style>
    {{include'../resources/css/client/account/info_profile.css'}}
</style>

