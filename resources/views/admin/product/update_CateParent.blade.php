@extends('admin.layouts.master')

@section('title', 'Add a new product')


@section('content')

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{route('admin.products.postUpdateCateParent',['id'=>$id])}}" method="POST" enctype="multipart/form-data">
                <div style="display: grid; grid-template-columns: repeat(2, 1fr)">
                    <div class="mb-3">
                        <label for="">Category Parent</label>
                        <select class="form-control w-50" required name="categoryparent" id="category_parent">
                            <option value="{{$product->category_parent}}">{{getNameCategoryParent($product->category_parent)}}</option>
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
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                @csrf
            </form>
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

