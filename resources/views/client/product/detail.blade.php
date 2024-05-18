@extends('client.layouts.master')
@section('content')
<section class="py-5">
    <div class="container">
      <div class="row gx-5">
        <aside class="col-lg-6">
          <div class="border rounded-4 mb-3 d-flex justify-content-center">
            <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image" href="">
              <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" src="{{asset($product->images)}}" />
            </a>
          </div>
          {{-- <div class="d-flex justify-content-center mb-3">
            <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="https://mdbcdn.b-cdn.net/img/bootstrap-ecommerce/items/detail1/big1.webp" class="item-thumb">
              <img width="60" height="60" class="rounded-2" src="https://mdbcdn.b-cdn.net/img/bootstrap-ecommerce/items/detail1/big1.webp" />
            </a>
            <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="https://mdbcdn.b-cdn.net/img/bootstrap-ecommerce/items/detail1/big2.webp" class="item-thumb">
              <img width="60" height="60" class="rounded-2" src="https://mdbcdn.b-cdn.net/img/bootstrap-ecommerce/items/detail1/big2.webp" />
            </a>
            <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="https://mdbcdn.b-cdn.net/img/bootstrap-ecommerce/items/detail1/big3.webp" class="item-thumb">
              <img width="60" height="60" class="rounded-2" src="https://mdbcdn.b-cdn.net/img/bootstrap-ecommerce/items/detail1/big3.webp" />
            </a>
            <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="https://mdbcdn.b-cdn.net/img/bootstrap-ecommerce/items/detail1/big4.webp" class="item-thumb">
              <img width="60" height="60" class="rounded-2" src="https://mdbcdn.b-cdn.net/img/bootstrap-ecommerce/items/detail1/big4.webp" />
            </a>
            <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="https://mdbcdn.b-cdn.net/img/bootstrap-ecommerce/items/detail1/big.webp" class="item-thumb">
              <img width="60" height="60" class="rounded-2" src="https://mdbcdn.b-cdn.net/img/bootstrap-ecommerce/items/detail1/big.webp" />
            </a>
          </div> --}}

          <!-- thumbs-wrap.// -->
          <!-- gallery-wrap .end// -->
        </aside>
        <main class="col-lg-6">
          <div class="ps-lg-3">
            <h4 class="title text-dark">
                @if(isset($product))
                    {{$product->name}}
                @endif 
            </h4>
            <div class="d-flex flex-row my-3">
              <div class="text-warning mb-1 me-2">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <span class="ms-1">
                  4.5
                </span>
              </div>
              <span class="text-muted"><i class="fas fa-shopping-basket fa-sm mx-1"></i>154 orders</span>
              <span class="text-success ms-2">In stock</span>
            </div>
  
            <div class="mb-3">
              <span class="h5">{{$product->price_sell}}</span>
              <span class="text-muted">/per box</span>
            </div>
  
            <p>
              {{$product->description}}
            </p>
  
            <div class="row">
              <dt class="col-3">Type</dt>
              <dd class="col-9">{{getNameCategoryProduct($product->category_product)}}</dd>
  
              <dt class="col-3">Material</dt>
              <dd class="col-9">{{getNameCategoryValue($product->category_value)}}</dd>
              
              <dt class="col-3">Color</dt>
              <dd class="col-9">Brown</dd>

              <dt class="col-3">Quantity</dt>
              <dd class="col-9">{{$product->amount}}</dd>
            </div>
  
            <hr />
  
            <div class="row mb-4">
              <div class="col-md-4 col-6">
                <label class="mb-2">Size</label>
                <select class="form-select border border-secondary" style="height: 35px;" id="product_size">
                    @php
                        $sizes = explode(',', $product->size); // Tách chuỗi thành mảng các giá trị
                    @endphp
                    @foreach($sizes as $size)
                    <option value={{$size}}>
                        {{typeSize($size)}}<br> <!-- Hiển thị mỗi giá trị 'size' trên một dòng -->
                    </option>
                    @endforeach
                </select>
              </div>
              <!-- col.// -->
              <div class="col-md-4 col-6 mb-3">
                <label class="mb-2 d-block">Quantity</label>
                <div class="input-group mb-3" style="width: 170px;">
                  <button class="btn btn-white border border-secondary px-3" type="button" id="button-addon1" data-mdb-ripple-color="dark" onclick="decreaseValue(this)">
                    <i class="fas fa-minus"></i>
                  </button>
                  <input id="amount_product" min="1" max="{{$product->amount}}" type="number" class="form-control text-center border border-secondary" placeholder="1" aria-label="Example text with button addon" aria-describedby="button-addon1" data-max-amount="{{$product->amount}}" oninput="checkValue(this)"/>
                  <button class="btn btn-white border border-secondary px-3" type="button" id="button-addon2" data-mdb-ripple-color="dark"onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                    <i class="fas fa-plus "></i>
                  </button>
                </div>
              </div>
            </div>
            <a href="#" class="btn btn-warning shadow-0"> Buy now </a>
            <a onclick="addToCart({{$product->id}})" href="javascript:" class="btn btn-primary shadow-0"> <i class="me-1 fa fa-shopping-basket"></i> Add to cart </a>
            <a href="#" class="btn btn-light border border-secondary py-2 icon-hover px-3"> <i class="me-1 fa fa-heart fa-lg"></i> Save </a>
          </div>
        </main>
      </div>
    </div>
  </section>
@endsection
<style>
    .icon-hover:hover {
  border-color: #3b71ca !important;
  background-color: white !important;
  color: #3b71ca !important;
}

.icon-hover:hover i {
  color: #3b71ca !important;
}
</style>
<script>
    function decreaseValue(button) {
    var input = button.parentNode.querySelector('input[type=number]');
    if (input.value > 1) {
        input.stepDown();
        }
    }

    function checkValue(input) {
      var maxAmount = input.getAttribute('data-max-amount');
      if (input.value < 1) {
          input.value = 1;
        }
      if (input.value > maxAmount) {
          input.value = maxAmount;
        }
    }
    function addToCart(idProduct){
      var inputElement = document.getElementById('amount_product');
      var selectedSize = document.getElementById('product_size').value;
      var inputAmount = inputElement.value;
      var idPro = idProduct;
      var idUser = {{Auth::user()->id}};
        $.ajax({
            url:'addCart/'+idUser+'/'+idPro+'/'+inputAmount+'/'+selectedSize+'/',
            type:'GET',
        }).done(function(respone){
            $("#icon-amount-orders").text(`${respone}`);
            Swal.fire(
                'Add to cart successfully',
                'You clicked the button!',
                'success'
            )
        }).fail(function(xhr, status, error) {
                console.error('Error:', error);
                Swal.fire(
                    'Error', 
                    'There was an error adding to the cart',
                    'error'
                );
            });
      }
</script>