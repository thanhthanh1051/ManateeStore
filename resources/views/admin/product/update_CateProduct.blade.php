@extends('admin.layouts.master')

@section('title', 'Add a new product')


@section('content')

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{route('admin.products.postUpdateCateProduct',['id'=>$id])}}" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="">Category Parent</label>
                    <select class="form-control w-50" required name="categoryparent" id="category_parent">
                        @if(isset($cateParent))
                        <option value="{{$cateParent}}">{{getNameCategoryParent($cateParent)}}</option>
                        @endif
                    </select>
                    @error('category')
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
                </div>
                <button type="submit" class="btn btn-primary">Add New</button>
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

