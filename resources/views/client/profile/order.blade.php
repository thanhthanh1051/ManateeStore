@extends('client.profile.account')
@section('profile-content')
  <div class="row" style="display:flex; justify-content:center;">
    <div class="navbar navbar-light  rounded">
      <form class="form-inline">
        <a href="{{ route('get-pending') }}" class="btn btn-outline-success mr-3 ml-0" type="button" style="font-size:20px">Pending</a>
        <a href="{{ route('get-processing') }}" class="btn btn-outline-success mr-3 ml-3" type="button" style="font-size:20px">Processing</a>
        <a href="{{ route('get-ontheway') }}" class="btn btn-outline-success mr-3 ml-3" type="button" style="font-size:20px">On the way</a>
        <a href="{{ route('get-intransit') }}" class="btn btn-outline-success mr-3 ml-3" type="button" style="font-size:20px">In Transit</a>
        <a href="{{ route('get-cancelled') }}" class="btn btn-outline-success mr-0 ml-3" type="button" style="font-size:20px">Cancelled</a>
        {{-- <button class="btn btn-sm btn-outline-secondary" type="button">Smaller button</button> --}}
      </form>
    </div>
    <div class="container mt-2">
      @yield('order-content')
  </div>
@endsection
<style>
    {{include'../resources/css/client/account/order.css'}}
</style>