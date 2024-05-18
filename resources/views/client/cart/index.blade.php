@extends('client.layouts.master')
@section('content')
<section class="h-100 gradient-custom">
    <div class="container py-5">
      <div class="row d-flex justify-content-center my-4">
        <div class="col-md-8">
          <div class="card mb-4">
            <div class="card-header py-3">
              <p>Cart: <span id="total-item-cart" class="mb-0">{{getAmountCart()}}</span>-item</p>
            </div>
            <div class="card-body">
              <!-- Single item -->
              @if(isset($products))
              @foreach($products as $item)
                <div class="row" id="item-{{ $item->id }}">
                  <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                    <!-- Image -->
                    <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                      <img src="{{asset($item->images)}}"
                        class="w-100" alt="{{$item->name}}" />
                      <a href="#!">
                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                      </a>
                    </div>
                    <!-- Image -->
                  </div>
    
                  <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                    <!-- Data -->
                    <p><strong>{{$item->name}}</strong></p>
                    <p>Color: {{$item->color}}</p>

                    <p>Size: {{typeSize($item->cart_size)}}
                    {{-- @php
                    $sizes = explode(',', $item->size); // Tách chuỗi thành mảng các giá trị
                    @endphp
                    @foreach($sizes as $size)
                      {{typeSize($size)}} , <!-- Hiển thị mỗi giá trị 'size' trên một dòng -->
                    @endforeach --}}
                    </p>
                    <button onclick="removeCart({{$item->id}},{{$item->cart_size}})" type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-sm me-1 mb-2" data-mdb-tooltip-init
                      title="Remove item">
                      <i class="fas fa-trash"></i>
                  </button>
                    <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger btn-sm mb-2" data-mdb-tooltip-init
                      title="Move to the wish list">
                      <i class="fas fa-heart"></i>
                    </button>
                    <!-- Data -->
                  </div>
    
                  <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <!-- Quantity -->
                    <div class="d-flex mb-4" style="max-width: 300px">
                      <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary px-3 me-2"
                        onclick="decreaseValue(this)">
                        <i class="fas fa-minus"></i>
                      </button>
    
                      <div data-mdb-input-init class="form-outline">
                        <input id="form1" min="1" max="{{$item->amount}}" name="quantity" value="{{$item->cart_amount}}" type="number" class="form-control" data-price="{{$item->price_sell}}" data-size="{{ $item->cart_size }}" data-max-amount="{{$item->amount}}" data-item-id="{{$item->id}}" oninput="updateTotal(this)" />
                        <label class="form-label" for="form1">Quantity</label>
                      </div>
    
                      <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary px-3 ms-2"
                        onclick="increaseValue(this)">
                        <i class="fas fa-plus"></i>
                      </button>
                    </div>
                    <!-- Quantity -->
    
                    <!-- Price -->
                    <p class="text-start text-md-center">
                      <strong class="total_item">{{getItemAmountCart($item->id) * $item->price_sell}}</strong>
                    </p>
                    <!-- Price -->
                  </div>
                </div>
              @endforeach
              @endif
              <!-- Single item -->
  
              <hr class="my-4" />
            </div>
          </div>
          <div class="card mb-4">
            <div class="card-body">
              <p><strong>Expected shipping delivery</strong></p>
              <p class="mb-0">12.10.2020 - 14.10.2020</p>
            </div>
          </div>
          <div class="card mb-4 mb-lg-0">
            <div class="card-body">
              <p><strong>We accept</strong></p>
              <img class="me-2" width="45px"
                src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg"
                alt="Visa" />
              <img class="me-2" width="45px"
                src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg"
                alt="American Express" />
              <img class="me-2" width="45px"
                src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg"
                alt="Mastercard" />
              <img class="me-2" width="45px"
                src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce/includes/gateways/paypal/assets/images/paypal.webp"
                alt="PayPal acceptance mark" />
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-4">
            <div class="card-header py-3">
              <h5 class="mb-0">Summary</h5>
            </div>
            <div class="card-body">
              <ul class="list-group list-group-flush">
                <li
                  class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                  Products
                  <span>$53.98</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                  Shipping
                  <span>Gratis</span>
                </li>
                <li
                  class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                  <div>
                    <strong>Total amount</strong>
                    <strong>
                      <p class="mb-0">(including VAT)</p>
                    </strong>
                  </div>
                  <span><strong>$53.98</strong></span>
                </li>
              </ul>
  
              <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block">
                Go to checkout
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
<script>
  function decreaseValue(button) {
    var input = button.parentNode.querySelector('input[type=number]');
    if (input.value > 0) {
        input.stepDown();
        updateTotal(input);
    }
}

function increaseValue(button) {
    var input = button.parentNode.querySelector('input[type=number]');
        input.stepUp();
        updateTotal(input);
}

function updateTotal(input) {
    var quantity = input.value;
    var price = input.getAttribute('data-price');
    var total = quantity * price;
    var totalElement = input.closest('.col-lg-4').querySelector('.total_item');
    totalElement.textContent = total.toFixed(2);  // Làm tròn số đến 2 chữ số thập phân

    var itemId = input.getAttribute('data-item-id');
    var size = input.getAttribute('data-size');
    updateCartDatabase(itemId, size, quantity);
}

function checkValue(input) {
    var maxAmount = input.getAttribute('data-max-amount');
    if (input.value < 1) {
        input.value = 1;
    }
    if (input.value > maxAmount) {
        input.value = maxAmount;
    }
    updateTotal(input);
}
function updateCartDatabase(itemId, size, quantity) {
    $.ajax({
        url: '/update-cart',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}', // Laravel CSRF token
            item_id: itemId,
            size:size,
            quantity: quantity
        },
        success: function(response) {
            console.log('Cart updated successfully');
            updateCartIcon(response.totalAmount); // Cập nhật biểu tượng giỏ hàng
        },
        error: function(xhr, status, error) {
            console.error('Error updating cart:', error);
        }
    });
}
function updateCartIcon(totalAmount) {
    var cartIcon = document.getElementById('icon-amount-orders');
    var totalItemCart = document.getElementById('total-item-cart');
    cartIcon.textContent = totalAmount;
    totalItemCart.textContent = totalAmount;
}
function removeCart(itemId, itemSize){
  $.ajax({
        url: '/remove-cart',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}', // Laravel CSRF token
            item_id: itemId,
            item_size: itemSize
        },
        success: function(response) {
         
                $('#item-' + itemId).remove();
                updateCartIcon(response.totalAmount);
            
        },
        error: function(xhr, status, error) {
            console.error('Error updating cart:', error);
        }
    });
}
</script>