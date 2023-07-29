@extends('cozastore.layouts.layout')

@section('content')
@if(Session::has('success'))
<div class="alert alert-success">
    {{ Session::get('success') }}
    @php
        Session::forget('success');
    @endphp
</div>
@endif

<style>
    .stock-status {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 1;
    }

    .stock-in {
        display: inline-block;
        padding: 4px 8px;
        background-color: green;
        color: white;
        font-size: 12px;
        font-weight: bold;
        border-radius: 2px;
    }

    .stock-out {
        display: inline-block;
        padding: 4px 8px;
        background-color: red;
        color: white;
        font-size: 12px;
        font-weight: bold;
        border-radius: 2px;
    }

    .block2-txt {
        padding: 10px;
        border-top: 1px solid #ebebeb;
        text-align: center;
    }

    .block2-txt-child1 {
        margin-bottom: 10px;
    }

    .block2-txt-child1 a {
        text-decoration: none;
        color: #333;
        font-weight: bold;
    }

    .block2-txt-child1 a:hover {
        color: blue;
    }

    .block2-txt-child1 .product-price {
        font-size: 18px;
        margin-top: 5px;
    }

    .block2-txt-child1 .brand {
        font-size: 14px;
        color: #888;
    }

    .btn-addwish-b2 {
        text-decoration: none;
        color: #333;
        position: relative;
    }

    .btn-addwish-b2 img {
        width: 20px;
        height: 20px;
    }

    .btn-addwish-b2:hover .icon-heart1 {
        display: none;
    }

    .btn-addwish-b2:hover .icon-heart2 {
        display: block;
    }

    .icon-heart1,
    .icon-heart2 {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
    }

    .container {
        padding-top: 50px;
        /* Add space at the top for categories */
    }

    .row.isotope-grid {
        margin-left: -15px;
        margin-right: -15px;
    }

    .row.isotope-grid .col-lg-4 {
        padding-left: 15px;
        padding-right: 15px;
    }

    .product-image {
        width: 100%;
        height: 250px; /* Adjust the height as per your preference */
        object-fit: cover;
    }
</style>

<body class="animsition">
    <section class="section-slide">
        <div class="wrap-slick1">
            <div class="slick1">
                @foreach ($slider as $slideritem)
                <div class="item-slick1" style="background-image: url({{ asset($slideritem->sliderImages[0]->image) }});">
                    <div class="container h-full">
                        <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                            <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                                <span class="ltext-101 cl2 respon2">
                                    {{$slideritem->title}}
                                </span>
                            </div>

                            <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                                <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                    {{$slideritem->heading}}
                                </h2>
                            </div>

                            <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                                <a href="product.html"
                                    class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                    Shop Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Product -->
    <section class="bg0 p-t-23 p-b-140">
        <div class="container">
            <div class="p-b-10">
                <h3 class="ltext-103 cl5 mt-5">
                    Our Products
                </h3>
            </div>

            <div class="row isotope-grid mt-5">
                @forelse ($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-4 p-b-35 isotope-item">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <div class="stock-status">
                                @if ($product->quantity > 0)
                                <span class="stock-in">In Stock</span>
                                @else
                                <span class="stock-out">Out of Stock</span>
                                @endif
                            </div>
                            @if ($product->productImages->count() > 0)
                            <a href="{{ '/collections/' . $product->category->slug . '/' . $product->slug }}">
                                <img class="img-fluid product-image" src="{{ asset($product->productImages[0]->image) }}"
                                    alt="{{ $product->name }}">
                            </a>
                            @endif
                            <a href="{{ '/collections/' . $product->category->slug . '/' . $product->slug }}"
                                class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 ">
                                Quick View
                            </a>
                        </div>
                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l">
                                <a href="{{ '/collections/' . $product->category->slug . '/' . $product->slug }}"
                                    class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    {{ $product->name }}
                                </a>
                                <span class="stext-105 cl3 bold">
                                    Price: ${{ $product->original_price }}
                                </span>
                                <span class="stext-105 cl3">
                                    Brand: {{ $product->brand }}
                                </span>
                            </div>
                            <div class="block2-txt-child2 flex-r p-t-3">
                                <a href="{{url('add_wishlist',['id'=>$product->id])}}">
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <p>No Products Available</p>
                @endforelse
            </div>

            <div class="d-flex justify-content-center mt-4">
                {!! $products->links() !!}
            </div>
        </div>
    </section>
@endsection
