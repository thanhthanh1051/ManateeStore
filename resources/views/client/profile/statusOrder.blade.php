@extends('client.profile.order')
@section('order-content')

@if($orders->isEmpty())
             <table>
              <tbody >
                  <tr>
                  <td colspan="5" style="text-align: center; vertical-align: middle; align-items:center; ">
                      <h5 style="display:block text-align:center; font-size: 20px">No order has been made yet</h5>
                  </td>
                  </tr>
              </tbody>
          </table>
@else
  @foreach($orders as $order)
                        <div class="row d-flex justify-content-center align-items-center">
                          <div class="card" style="border-radius: 10px;margin-bottom:20px;border-color: #cacaca;box-shadow: 2px 2px 3px 3px #cacaca;">
                            <div class="card-body pb-2  ">
                              <div class="d-flex justify-content-between align-items-center mb-1">
                                <p class="fw-normal mb-0" style="color: #a8729a;">Name</p>
                                <p class="fw-normal mb-0" style="">{{$order->name}}</p>
                              </div>
                              <div class="d-flex justify-content-between align-items-center mb-1">
                                <p class="fw-normal mb-0" style="color: #a8729a;">Address</p>
                                <p class="fw-normal mb-0" style="">{{$order->address}}</p>
                              </div>
                              <div class="d-flex justify-content-between align-items-center mb-1">
                                <p class="fw-normal mb-0" style="color: #a8729a;">Phone</p>
                                <p class="fw-normal mb-0" style="">{{$order->phone}}</p>
                              </div>
                                  <div class="card shadow-0 border mb-4">
                                    <div class="card-body">
                                      <div class="row">
                                        <table class="table table-bordered" style="margin-top: 20px;">
                                          <thead>
                                            <tr>
                                              <th style="">Images</th>
                                              <th style="">Name</th>
                                              <th style="">Storage</th>
                                              <th style="">Color</th>
                                              <th style="">Quantity</th>
                                              <th style="">Price</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                                @foreach ( $order->orderDetails as $orderDetail )
                                                  <tr>
                                                    <td><img src="{{asset($orderDetail->product->images)}}" alt="" style="width: 100px; height:auto"></td>
                                                    <td>{{$orderDetail->product->name}}</td>
                                                    <td>{{$orderDetail->product->storage}}</td>
                                                    <td>{{$orderDetail->product->color}}</td>
                                                    <td>{{$orderDetail->amount}}</td>
                                                    <td>{{$orderDetail->price}}</td>
                                                  </tr>
                                                @endforeach
                                          </tbody>
                                        </table>
                                      </div>
                                      <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                                    </div>
                                  </div>
                                  <div class="d-flex justify-content-between pt-1">
                                    <p class="fw-bold mb-0">Total</p>
                                    <p class="text-muted mb-0"><span class="fw-bold me-4"></span>{{ $order->orderDetails->sum(fn($detail) => $detail->amount * $detail->price) }}</p>
                                  </div>
                            <div class="d-flex justify-content-between pt-1">
                              <p class="text-muted mb-0">Voucher</p>
                              <p class="text-muted mb-0"><span class="fw-bold me-4"></span> {{ $order->discount->price ?? 'No discount' }}</p>
                            </div>
                            {{-- <div class="d-flex justify-content-between pt-1">
                              <p class="text-muted mb-0">Discount rank</p>
                              <p class="text-muted mb-0"><span class="fw-bold me-4">{{getPriceRank($key->id, $key->total,$key->discount_id)}}</span></p>
                            </div> --}}
                          </div>
                          <div class="card-footer border-0 " style="background-color:white;">
                            <h5 class="d-flex align-items-center justify-content-end mb-0" style="font-weight: bold; color:red">Total paid: {{ $order->total }}
                            </h5>
                          </div>
                        @if( $order->status == 1 )
                          <div class="row border-0">
                            <div class="col-lg-8">
                              <div class="horizontal-timeline">
                                <ul class="justify-items-center">
                                    <li class="list-inline-item items-list">
                                      <a onclick="return confirm('don hang chac chan muon huy ?')" href="{{route( 'cancel',['id'=>$order->id])}}" class="py-1 px-2 rounded text-white" style="background-color: red;">Cancelled</a>
                                    </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        @endif
                      </div>
  @endforeach
@endif
    </div>
@endsection
<style>
        {{include'../resources/css/client/account/pending.css'}}
</style>
<script>
</script>
