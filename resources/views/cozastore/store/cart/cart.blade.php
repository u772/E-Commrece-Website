@extends('cozastore.layouts.layout')
@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <body class="animsition">

        <!-- breadcrumb -->
        <div class="container " style="margin-top: 100px">
            <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
                <a href="{{ route('home') }}" class="stext-109 cl8 hov-cl1 trans-04">
                    Home
                    <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
                </a>

                <span class="stext-109 cl4">
                    Shopping Cart
                </span>
            </div>
        </div>

        <!-- Shopping Cart -->
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="wrap-table-shopping-cart">
                            <table class="table-shopping-cart">
                                <tr class="table_head">
                                    <th class="column-1">Product</th>
                                    <th class="column-2"></th>
                                    <th class="column-3">Price</th>
                                    <th class="column-4">Quantity</th>
                                    <th class="column-5">Total</th>
                                    <th class="column-6">Action</th>
                                </tr>
        
                                @forelse ($cart as $item)
                                    <tr class="table_row">
                                        <td class="column-1">
                                            <div class="how-itemcart1">
                                                <img src="{{ $item->image }}" alt="IMG">
                                            </div>
                                        </td>
                                        <td class="column-2">{{ $item->product->name }}</td>
                                        <td class="column-3">${{ $item->product->selling_price }}</td>
                                        <td class="column-4">
                                            <span>{{ $item->quantity }}</span>
                                        </td>
                                        <td class="column-5">${{ $item->total }}</td>
                                        <td class="column-6">
                                            <a href="{{ route('delete_cart',['id'=>$item->id]) }}" onclick="confirmation(event)">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <h4>No products here</h4>
                                        </td>
                                    </tr>
                                @endforelse
                            </table>
                            <div class="d-flex justify-content-center">
                                {!! $cart->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
        
                <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                        <h4 class="mtext-109 cl2 p-b-30">
                            Cart Totals
                        </h4>
        
                        <div class="flex-w flex-t bor12 p-b-13">
                            <div class="size-208">
                                <span class="stext-110 cl2">
                                    Subtotal:
                                </span>
                            </div>
        
                            <div class="size-209">
                                <span class="mtext-110 cl2" id="subtotal">
                                    ${{ $cart->sum('total') }}
                                </span>
                            </div>
                        </div>
        
                        <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                            <div class="size-208 w-full-ssm">
                                <span class="stext-110 cl2">
                                    Shipping:
                                </span>
                            </div>
        
                            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                <p class="stext-111 cl6 p-t-2">
                                    There are no shipping methods available. Please double check your address, or contact us if you need any help.
                                </p>
                            </div>
                        </div>
        
                        <div class="flex-w flex-t p-t-27 p-b-33">
                            <div class="size-208">
                                <span class="mtext-101 cl2">
                                    Total:
                                </span>
                            </div>
        
                            <div class="size-209 p-t-1">
                                <span class="mtext-110 cl2" id="total">
                                    ${{ $cart->sum('total') }}
                                </span>
                            </div>
                        </div>
        
                        <a class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" href="{{url('cash_order')}}">
                            Cash on Delivery
                        </a>
                      
<br>
<br>
                        <a class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" href="{{url('stripe', $cart->sum('total'))}}">
                           Pay with Card
                        </a>
                    </div>
                </div>
            </div>
        </div>
        



<script>
    function confirmation(ev) {
      ev.preventDefault();
      var urlToRedirect = ev.currentTarget.getAttribute('href');  
      console.log(urlToRedirect); 
      swal({
          title: "Are you want to Remove Product From Cart",
          text: "You will not be able to revert this!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willCancel) => {
          if (willCancel) {
              window.location.href = urlToRedirect;
          }  
      });
  }
</script>
    @endsection
