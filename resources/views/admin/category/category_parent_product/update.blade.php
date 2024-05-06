@extends('admin.layouts.master')

@section('title', 'Update category parent product')

@section('content')
        <div class="card-header py-3">
            <a class="m-0 font-weight-bold text-primary" href="{{route('admin.categories.getCategoryParentProduct')}}">
                Update Categories Parent Product
            </a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                @if(!empty($category))
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="">Category Parent</label>
                            <select class="form-control w-50" required name="category_parent">
                                <option value="{{$category->category_parent ?? 0}}">{{getNameCategoryParent($category->category_parent) ?? "Open this select menu"}}</option>
                                @if (!empty(getCategoryParent())) 
                                    @foreach(getCategoryParent() as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                @endif 
                            </select> 
                            @error('category')
                              <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Category Product</label>
                            <select class="form-control w-50" required name="category_product">
                                <option value="{{$category->category_product ?? 0}}">{{getNameCategoryProduct($category->category_parent) ?? "Open this select menu"}}</option>
                                @if (!empty(getCategoryProduct())) 
                                    @foreach(getCategoryProduct() as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                @endif 
                            </select> 
                            @error('category')
                              <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                        <a href="{{route('admin.categories.getList')}}" class="btn btn-warning">Back</a>
                        <button class="btn btn-primary" type="submit">Update</button>
                        @csrf
                    </form>
                @else
                    <h2>Data is not available</h2>
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
