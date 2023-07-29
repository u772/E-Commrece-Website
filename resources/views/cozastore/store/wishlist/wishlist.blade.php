@extends('cozastore.layouts.layout')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<body class="">

    @if(Session::has('success'))
<div class="alert alert-success">
	{{ Session::get('success') }}
	@php
		Session::forget('success');
	@endphp
</div>
@endif
  <style>
    .wishlist-table {
    border-collapse: collapse;
    width: 100%;
}

.wishlist-table th,
.wishlist-table td {
    border: 1px solid #ddd;
    padding: 8px;
}

.wishlist-table th {
    background-color: #f2f2f2;
}

.wishlist-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

  </style>
    <!-- Product -->
    <div class="bg0 m-t-23 p-b-140" style="margin-top: 100px">
        <div class="container">
          
            <section id="cart_items">
                <div class="container">
                    <div class="table-responsive cart_info">
                        <table class="table table-condensed wishlist-table">
                            <thead>
                                <tr class="cart_menu">
                                    <th class="image">Product Image</th>
                                    <th class="description">Product Name</th>
                                    <th class="price">Price</th>
                                    <th class="action">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($wishlist as $wishlistitem)
                                <tr>
                                    <td class="cart_product">
                                        <img src="{{$wishlistitem->product->productImages[0]->image}}" style="height:50px; width:50px;" alt="{{$wishlistitem->product->name}}">
                                    </td>
                                    <td class="cart_description">
                                        {{$wishlistitem->product->name}}
                                    </td>
                                    <td class="cart_price">
                                       $ {{$wishlistitem->product->selling_price}}
                                    </td>
                                    <td class="cart_delete">
                                        <a class="cart_quantity_delete" href="{{ route('delete_wishlist', ['id' => $wishlistitem->id]) }}" onclick="confirmation(event)">
                                            <i class="fa fa-times text-danger" style="font-size: 20px;"></i>
                                        </a>
                                    </td>
                                    
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">
                                        <p><span style="color: red">No Wishlist Items</span></p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section> 
        </div>
    </div>
</body>


<script>
    function confirmation(ev) {
      ev.preventDefault();
      var urlToRedirect = ev.currentTarget.getAttribute('href');  
      console.log(urlToRedirect); 
      swal({
          title: "Are you want to Remove Product From Wishlist",
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
