@extends('admin.layouts.master')

@section('title', 'Category Value')

@section('content')
<div class="card shadow mb-4">
    @if (session('msg'))
    <div class="alert alert-success">{{session('msg')}}</div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
    @endif
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List of Categories Value</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category Product</th>
                        <th width="20%">Created_At</th>
                        <th width="20%">Updated_At</th>
                        <th width ="2%"></th>
                        <th width ="2%"></th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($list))
                        @if(count($list) > 0)
                            @foreach ($list as $item)
                                <tr>
                                    <td>{{$item -> name}}</td>
                                    <td>{{getNameCategoryProduct($item -> category_product)}}</td>
                                    <td>{{$item -> created_at}}</td>
                                    <td>{{$item -> updated_at}}</td>
                                    <td><a href="{{route('admin.categories.getUpdateCategoryValue',['id'=>$item->id])}}" class="btn btn-warning" style="cursor: pointer">Sửa</a></td>
                                    <td><a href="{{route('admin.categories.deleteCateValue',['id'=>$item->id])}}" class="btn btn-danger" style="cursor: pointer">Xóa</a></td>
                                    {{-- <td><a onclick="deleteCateProduct({{$item->id}})" class="btn btn-danger" style="cursor: pointer">Xóa</a></td> --}}
                                </tr>
                            @endforeach
                        @else
                            <td colspan="6">Data is not available</td>
                        @endif
                    @else   
                        <td colspan="6">Server error responses</td>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
     function deleteCateProduct(id) {
            $.ajax({
                url:'categories/deleteCateProduct/'+id,
                type:'GET',
            }).done(function(response){
                Swal.fire(
                    'Item of cart was deleted successful',
                    'You clicked the button!',
                    'success'
                ).then((result) => {
                    if(result.isConfirmed){
                        location.reload();
                    }
                })
            });
        }
</script>

<!-- Bootstrap core JavaScript-->
<script src="{{asset ('admins')}}/vendor/jquery/jquery.min.js"></script>
<script src="{{asset ('admins')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset ('admins')}}/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset ('admins')}}/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="{{asset ('admins')}}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset ('admins')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{asset ('admins')}}/js/demo/datatables-demo.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>

@endsection
