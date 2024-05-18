@extends('client.layouts.master')
@section('content')
<div class="container bootdey">
    <div class="col-md-3">
        <section class="panel">
            <div class="panel-body">
                <input type="text" placeholder="Keyword Search" class="form-control" />
            </div>
        </section>
        <section class="panel">
            <header class="panel-heading">
                @if(!empty($id))
                    {{getNameCategoryProduct($id)}}
                    {{-- hiển thị cate product --}}
                @else
                    @if(!empty($productFilter))
                    {{-- hiển thị cate value của cate product thuộc parent --}}
                        @foreach($productFilter as $item)
                            {{getNameCategoryProduct($item->category_id)}}
                        @endforeach
                    @endif
                @endif
            </header>
            <div class="panel-body">
                <ul class="nav prod-cat">
                  @if(!empty($cateValue))
                  @foreach($cateValue as $item)
                    <li>
                        <a href="" class="active"><i class="fa fa-angle-right"></i>{{$item->name}}</a>
                    </li>
                  @endforeach
                  @else
                    <li>
                      <a href="#" class="active"><i class="fa fa-angle-right"></i>Empty</a>
                    </li>
                  @endif
                </ul>
            </div>
        </section>
        <section class="panel">
            <header class="panel-heading">
                Price Range
            </header>
            <div class="panel-body sliders">
                <div id="slider-range" class="slider"></div>
                <div class="slider-info">
                    <span id="slider-range-amount"></span>
                </div>
            </div>
        </section>
        <section class="panel">
            <header class="panel-heading">
                Filter
            </header>
            <div class="panel-body">
                <form action="" method="GET" role="form product-form">
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="category">
                            <option value="0">Open this select category</option>
                            @if(!empty(getCategoryValue()))
                            @foreach(getCategoryValue() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                            @endif
                        </select>
                        {{-- <span class="customSelect form-control" style="display: inline-block;"><span class="customSelectInner" style="width: 209px; display: inline-block;">Brand</span></span> --}}
                    </div>
                    <div class="form-group">
                        <label>Color</label>
                        <input type="color" name="color" class="form-control w-50" placeholder="Product Selling..." value="">
                    </div>
                    <div class="form-group">
                        <label for="">Size</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="size[]" value="1" id="sizeS">
                            <label class="form-check-label ml-4" for="sizeS">S</label><br>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="size[]" value="2" id="sizeM">
                            <label class="form-check-label ml-4" for="sizeM">M</label><br>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="size[]" value="3" id="sizeL">
                            <label class="form-check-label ml-4" for="sizeL">L</label><br>
                        </div>
                    </div>
                    {{-- <span class="customSelect form-control" style="display: inline-block;"><span class="customSelectInner" style="width: 209px; display: inline-block;">Small</span></span> --}}
                    <button class="btn btn-primary" type="submit">Filter</button>
                </form>
            </div>
        </section>
        <section class="panel">
            <header class="panel-heading">
                Best Seller
            </header>
            <div class="panel-body">
                <div class="best-seller">
                    <article class="media">
                        <a class="pull-left thumb p-thumb">
                            <img src="https://www.bootdey.com/image/250x220/FFB6C1/000000" />
                        </a>
                        <div class="media-body">
                            <a href="#" class="p-head">Item One Tittle</a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </article>
                    <article class="media">
                        <a class="pull-left thumb p-thumb">
                            <img src="https://www.bootdey.com/image/250x220/A2BE2/000000" />
                        </a>
                        <div class="media-body">
                            <a href="#" class="p-head">Item Two Tittle</a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </article>
                    <article class="media">
                        <a class="pull-left thumb p-thumb">
                            <img src="https://www.bootdey.com/image/250x220/6495ED/000000" />
                        </a>
                        <div class="media-body">
                            <a href="#" class="p-head">Item Three Tittle</a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </div>
    <div class="container bootdey">
        {{-- @yield('list-product') --}}
        @extends('client.navbar.index')
@section('list-product')
<div class="col-md-9">
    <div style="position: sticky">
        <section class="panel">
            <div class="panel-body">
                <div class="pull-right">
                    <ul class="pagination pagination-sm pro-page-list">
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">»</a></li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
        <div class="row product-list">
            @if(isset($products))
            @foreach($products as $item)
                <div class="col-md-4">
                    <section class="panel">
                        <div class="pro-img-box">
                            <img src="{{asset($item->images)}}" alt="" />
                            <a href="#" class="adtocart">
                                <i class="fa fa-shopping-cart"></i>
                            </a>
                        </div>
                        <div class="panel-body text-center">
                            <h4>
                                <a href="#" class="pro-title">
                                    {{$item->name}}
                                </a>
                            </h4>
                            <p class="price">Cost: {{$item->price_buy}}$</p>
                            <p class="price">Size: 
                                @php
                                $sizes = explode(',', $item->size); // Tách chuỗi thành mảng các giá trị
                                @endphp
                                @foreach($sizes as $size)
                                    {{typeSize($size)}} <!-- Hiển thị mỗi giá trị 'size' trên một dòng -->
                                @endforeach
                            </p>
                            <button class="btn btn-primary" type="submit">Buy now</button>
                        </div>
                    </section>
                </div>
            @endforeach
            @endif
        </div>
</div>
@endsection

 


    </div>
</div>
@endsection
<style>
    body{margin-top:20px;
background:#f1f2f7;
}

/*panel*/
.panel {
    border: none;
    box-shadow: none;
}

.panel-heading {
    border-color:#eff2f7 ;
    font-size: 16px;
    font-weight: 300;
}

.panel-title {
    color: #2A3542;
    font-size: 14px;
    font-weight: 400;
    margin-bottom: 0;
    margin-top: 0;
    font-family: 'Open Sans', sans-serif;
}


/*product list*/

.prod-cat li a{
    border-bottom: 1px dashed #d9d9d9;
}

.prod-cat li a {
    color: #3b3b3b;
}

.prod-cat li ul {
    margin-left: 30px;
}

.prod-cat li ul li a{
    border-bottom:none;
}
.prod-cat li ul li a:hover,.prod-cat li ul li a:focus, .prod-cat li ul li.active a , .prod-cat li a:hover,.prod-cat li a:focus, .prod-cat li a.active{
    background: none;
    color: #ff7261;
}

.pro-lab{
    margin-right: 20px;
    font-weight: normal;
}

.pro-sort {
    padding-right: 20px;
    float: left;
}

.pro-page-list {
    margin: 5px 0 0 0;
}

.product-list img{
    width: 100%;
    border-radius: 4px 4px 0 0;
    -webkit-border-radius: 4px 4px 0 0;
}

.product-list .pro-img-box {
    position: relative;
}
.adtocart {
    background: #fc5959;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    -webkit-border-radius: 50%;
    color: #fff;
    display: inline-block;
    text-align: center;
    border: 3px solid #fff;
    left: 45%;
    bottom: -25px;
    position: absolute;
}

.adtocart i{
    color: #fff;
    font-size: 25px;
    line-height: 42px;
}

.pro-title {
    color: #5A5A5A;
    display: inline-block;
    margin-top: 20px;
    font-size: 16px;
}

.product-list .price {
    color:#fc5959 ;
    font-size: 15px;
}

.pro-img-details {
    margin-left: -15px;
}

.pro-img-details img {
    width: 100%;
}

.pro-d-title {
    font-size: 16px;
    margin-top: 0;
}

.product_meta {
    border-top: 1px solid #eee;
    border-bottom: 1px solid #eee;
    padding: 10px 0;
    margin: 15px 0;
}

.product_meta span {
    display: block;
    margin-bottom: 10px;
}
.product_meta a, .pro-price{
    color:#fc5959 ;
}

.pro-price, .amount-old {
    font-size: 18px;
    padding: 0 10px;
}

.amount-old {
    text-decoration: line-through;
}

.quantity {
    width: 120px;
}

.pro-img-list {
    margin: 10px 0 0 -15px;
    width: 100%;
    display: inline-block;
}

.pro-img-list a {
    float: left;
    margin-right: 10px;
    margin-bottom: 10px;
}

.pro-d-head {
    font-size: 18px;
    font-weight: 300;
}
.form-check {
    margin-bottom: 10px; /* Thêm khoảng cách giữa các checkbox */
}
</style>
 

