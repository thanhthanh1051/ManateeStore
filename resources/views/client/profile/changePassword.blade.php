@extends('client.profile.account')
@section('profile-content')
<div class="row" style="display:flex; justify-content:center">
    <div style="width:95%">
        <h2 style="float: left; margin-top: 5%; font-size:25px">Change Password</h2>
    </div>
    <div class="password" style="width:95%">
        <fieldset id="change">
            <form action="{{route('changePassword')}}" method="POST" enctype="multipart/form-data" style="margin-left: 20px; font-size:20px">
                <div class="mb-4">
                    <label>Current Password:</label>
                    <input type="password" name="currentPassword" style="font-size:15px" class="form-control" placeholder="Type your current password...">
                    @error('currentPassword')
                        <span>{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>New Password:</label>
                    <input type="password" name="newPassword" style="font-size:15px" class="form-control" placeholder="Type your new password...">
                    @error('newPassword')
                        <span>{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>Confirm New Password:</label>
                    <input type="password" name="confirmPassword" style="font-size:15px" class="form-control" placeholder="Type your confirm password...">
                    @error('confirmPassword')
                        <span>{{$message}}</span>
                    @enderror
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
                <button id="btn-save" type="submit" class="btn btn-primary" style="float: left; margin: 10px 0 8px 0; font-size:15px">Save Change</button>
            </form>
        </fieldset>
    </div>
</div>

@endsection
<style>
    {{include'../resources/css/client/account/changePassword.css'}}
</style>
