@extends('cozastore.layouts.layout')
@section('content')

<body class="">

    @if(Session::has('success'))
<div class="alert alert-success">
	{{ Session::get('success') }}
	@php
		Session::forget('success');
	@endphp
</div>
@endif

   <!-- Product -->
   <div class="bg0 m-t-23 p-b-140" style="margin-top: 100px">
    <div class="container">
        <div class="row">
            
            <div class="col-md-6 col-lg-7 p-b-30">
                <div class="p-l-25 p-r-30 p-lr-0-lg">
                    <div class="wrap-slick3 flex-sb flex-w">
                       
                        <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                        <div class="slick3 gallery-lb">
                            <div class="wrap-pic-w pos-relative">
                                <img src="{{asset($product->productImages[0]->image)}}" alt="{{ $product->name }}">
                            </div>

                       
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-5 p-b-30">
                <div class="p-r-50 p-t-5 p-lr-0-lg">
                    <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                        {{$product->name}}   
                    </h4>

                    <span class="mtext-106 cl2">
                       Price: ${{$product->selling_price}}
                    </span>
                    <div>
                        <h6 class="mtext-106 cl2 mt-4">
                            Product Small Description:
                        </h6>
                        <p class="stext-102 cl3">
                            {!!$product->small_description!!}
                        </p>
                    </div>
                  

                    <div class="p-t-33">
                     

                       

                        <div class="flex-w flex-r-m p-b-10">
                            <div class="size-204 flex-w flex-m respon6-next">
                                {{-- <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                    </div>

                                    <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                    </div>
                                </div>

                                <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                    Add to cart
                                </button> --}}

                                <form action="{{url('add_cart',['id'=>$product->id])}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6"> 
                                            <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                                <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m minus">
                                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                                </div>
                                                <input class="mtext-104 cl3 txt-center num-product" type="number" name="quantity" value="1" step="1" min="1" max="" title="Qty" class="input-text qty text" size="4" pattern="" inputmode="">
                                                <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m plus">
                                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail" style="margin-top:3px">
                                                Add to cart
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>

                 

                    
                </div>


               
            </div>

            <div>
                <h6 class="mtext-106 cl2">
                    Product Description:
                </h6>
                <p class="stext-102 cl3">
                    {!!$product->description!!}
                </p>
            </div>
        </div>
    </div>
</div>

</body>



@endsection
