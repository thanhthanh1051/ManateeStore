@extends('admin.layouts.master')

@section('title', 'Update category value')

@section('content')
        <div class="card-header py-3">
            <a class="m-0 font-weight-bold text-primary" href="{{route('admin.categories.categoryValueList')}}">
                List of Categories Value
            </a>
        </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{route('admin.categories.postUpdateCategoryValue',['id'=>$id])}}" method="POST">
                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control w-50" placeholder="Category Name..." autocomplete value="{{old('name') ?? $name}}">
                        @error('name')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Category Parent</label>
                        <select class="form-control w-50" required name="categoryparent" id="categoryparent">                        
                                <option value="{{$cateParent}}">{{getNameCategoryParent($cateParent)}}</option>                   
                        </select>
                        @error('categoryparent')
                          <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                   <div class="mb-3">
                        <label for="">Category Product</label>
                        <select class="form-control w-50" required name="categoryproduct" id="categoryproduct">
                            <option value="0">Open this select menu</option>
                            @if(isset($cateParent))
                            @if (!empty(getCategoryProductWParent($cateParent)))
                                @foreach(getCategoryProductWParent($cateParent) as $item)
                                    <option value="{{$item->category_product}}">{{getNameCategoryProduct($item->category_product)}}</option>
                                @endforeach
                            @endif
                            @endif
                        </select> 
                        @error('categoryparent')
                          <span style="color: red">{{$message}}</span>                        
                        @enderror
                    </div>
                <button type="submit" class="btn btn-primary">Update</button>
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
