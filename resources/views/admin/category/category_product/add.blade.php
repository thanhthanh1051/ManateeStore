@extends('admin.layouts.master')

@section('title', 'Add a new category product')

@section('content')
        <div class="card-header py-3">
            <a class="m-0 font-weight-bold text-primary" href="{{route('admin.categories.listCategoryProduct')}}">
                List of Categories Value
            </a>
        </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="" method="POST">
                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control w-50" placeholder="Category Name..." autocomplete value="{{old('name')}}">
                        @error('name')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    {{-- <div class="mb-3">
                        <label for="">Category Parent</label>
                        <select class="form-control w-50" required name="category_parent">
                            <option value="0">Open this select menu</option>
                            @if (!empty(getCategoryParent()))
                                @foreach(getCategoryParent() as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('category')
                          <span style="color: red">{{$message}}</span>
                        @enderror
                    </div> --}}
                <button type="submit" class="btn btn-primary">Add New</button>
                @csrf
            </form>
            @if (session('msg'))
            <div class="alert alert-success">{{session('msg')}}</div>
            @endif
        </div>
    </div>
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
@endsection
