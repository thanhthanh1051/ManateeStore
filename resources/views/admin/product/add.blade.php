@extends('admin.layouts.master')

@section('title', 'Add a new product')


@section('content')

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{route('admin.products.postAdd')}}" method="POST" enctype="multipart/form-data">
                <div style="display: grid; grid-template-columns: repeat(2, 1fr)">
                    <div class="mb-3">
                        <label for="" style="color: red">Category Parent *</label>
                        <select class="form-control w-50" required name="categoryparent" id="category_parent">
                            <option value="{{$cateParent}}">{{getNameCategoryParent($cateParent)}}</option>
                        </select>
                        @error('categoryparent')
                          <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Code</label>
                        <input type="text" name="code" class="form-control w-50" placeholder="Product Code..." value="{{old('code')}}">
                        @error('code')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" style="color: red">Category Product *</label>
                        <select class="form-control w-50" required name="categoryproduct" id="category_product">
                            <option value="{{$cateProduct}}">{{getNameCategoryProduct($cateProduct)}}</option>
                        </select>
                        @error('categoryproduct')
                          <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Amount</label>
                        <input type="number" name="amount" class="form-control w-50" placeholder="Product Amount" min="1" max="1000" value="{{old('amount')}}">
                        @error('amount')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" style="color: red">Category Value *</label>
                        <select class="form-control w-50" required name="categoryvalue" id="category_value">
                            <option value="0">Open this select menu</option>
                            @if(isset($cateParent))
                            @if(isset($cateProduct))
                            @if (!empty(getCategoryValueofProduct($cateParent,$cateProduct)))
                                @foreach(getCategoryValueofProduct($cateParent,$cateProduct) as $item)
                                    <option value="{{$item->id}}">{{getNameCategoryValue($item->id)}}</option>
                                @endforeach
                            @endif
                            @endif
                            @endif
                        </select> 
                        @error('categoryvalue')
                          <span style="color: red">{{$message}}</span>                        
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control w-50" placeholder="Product Name..." value="{{old('name')}}">
                        @error('name')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="">Size</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="size[]" value="1" id="sizeS">
                            <label class="form-check-label" for="sizeS">S</label><br>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="size[]" value="2" id="sizeM">
                            <label class="form-check-label" for="sizeM">M</label><br>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="size[]" value="3" id="sizeL">
                            <label class="form-check-label" for="sizeL">L</label><br>
                        </div>
                        @error('size')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Buying Prices</label>
                        <input type="number" name="price_buy" class="form-control w-50" placeholder="Product Buying..." value="{{old('price_buy')}}">
                        @error('price_buy')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Image</label>
                        <input type="file" name="image" class="form-control w-50" placeholder="Product Imgae..." value="{{old('image')}}">
                        @error('image')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="">Selling Prices</label>
                        <input type="number" name="price_sell" class="form-control w-50" placeholder="Product Selling..." value="{{old('price_sell')}}">
                        @error('price_sell')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Colors</label>
                        <input type="color" name="color" class="form-control w-50" placeholder="Product Selling..." value="{{old('sell')}}">
                        @error('color')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Description</label>
                        <input type="text" name="description" class="form-control w-50" placeholder="Description..." value="{{old('description')}}">
                        @error('description')
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
    <script>
        document.getElementById('category_parent').onchange = function(){
            var categoryParentId = this.value;
    
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function(){
                if(xhr.readyState === XMLHttpRequest.DONE){
                    if(xhr.status === 200){
                        var data = JSON.parse(xhr.responseText);
                        var options = '';
                        data.forEach(function(item) {
                            options += '<option value="' + item.id + '">' + item.name + '</option>';
                        });
                        document.getElementById('category_product').innerHTML = options;
                    } else {
                        console.log('Request failed!');
                    }
                }
            };
            xhr.open('GET','/admin/products/get-category-products/' + categoryParentId, true);
            xhr.send();
        };
    
        document.getElementById('category_product').onchange = function(){
            var categoryProductId = this.value;
            var categoryParentId = this.value;
    
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function(){
                if(xhr.readyState === XMLHttpRequest.DONE){
                    if(xhr.status === 200){
                        var data = JSON.parse(xhr.responseText);
                        var options = '';
                        data.forEach(function(item) {
                            options += '<option value="' + item.id + '">' + item.name + '</option>';
                        });
                        document.getElementById('category_value').innerHTML = options;
                    } else {
                        console.log('Request failed!');
                    }
                }
            };
            xhr.open('GET','/admin/products/get-category-values/' + categoryParentId + '/' + categoryProductId, true);
            xhr.send(); 
        };
    </script>
    
@endsection

