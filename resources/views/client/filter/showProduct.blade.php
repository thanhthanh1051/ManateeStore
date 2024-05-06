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
            @if(!empty($products))
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
                            <p class="price">{{$item->price_buy}}</p>
                        </div>
                        <div class="panel-body text-center">
                            <h4>
                                <a href="#" class="pro-title">
                                    {{$item->name}}
                                </a>
                            </h4>
                            <p class="price">{{$item->price_buy}}</p>
                        </div>
                    </section>
                </div>
            @endforeach
            @endif
        </div>
</div>
@endsection

 

