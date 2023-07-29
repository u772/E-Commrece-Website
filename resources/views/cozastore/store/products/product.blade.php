@extends('cozastore.layouts.layout')
@section('content')
@section('meta_title')
    {{ $category->meta_title }}
@endsection

@section('meta_keyword')
    {{ $category->meta_keyword }}
@endsection

@section('meta_description')
    {{ $category->meta_description }}
@endsection




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


        }
    </style>
    <!-- Product -->
    <div class="bg0 m-t-23 p-b-140 " style="margin-top: 100px">
        <div class="container">
            


            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <!-- Brands -->
                        <div class="card ">
                            <div class="card-body">
                                <h4 class="mtext-112 cl2 p-b-20">
                                    Brands
                                </h4>
                                @php
                                    $uniqueBrands = $products->unique('brand');
                                @endphp
                    
                                <ul class="">
                                    @foreach ($uniqueBrands as $product)
                                        <li class="">{{ $product->brand }}</li>
                                    @endforeach
                                </ul>

                              
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    
                    
                    <div class="col-lg-9">
                        <!-- Product cards -->
                        <div class="row isotope-grid">
                            @forelse ($products as $productsitem)
                                <div class="col-sm-6 col-md-4 col-lg-4 p-b-35 isotope-item ">
                                    <!-- Block2 -->
                                    <div class="block2">
                                        <div class="block2-pic hov-img0">
                                            <div class="stock-status">
                                                @if ($productsitem->quantity > 0)
                                                    <span class="stock-in">In Stock</span>
                                                @else
                                                    <span class="stock-out">Out of Stock</span>
                                                @endif
                                            </div>
                                            @if ($productsitem->productImages->count() > 0)
                                                <a
                                                    href="{{ '/collections/' . $productsitem->category->slug . '/' . $productsitem->slug }}">
                                                    <img src="{{ asset($productsitem->productImages[0]->image) }}"
                                                        alt="{{ $productsitem->name }}">
                                                </a>
                                            @endif
                                             <a href="{{ '/collections/' . $product->category->slug . '/' . $product->slug }}"
                                class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 ">
                                Quick View
                            </a>
                                        </div>
                                        <div class="block2-txt flex-w flex-t p-t-14">
                                            <div class="block2-txt-child1 flex-col-l">
                                                <a href="{{ '/collections/' . $productsitem->category->slug . '/' . $productsitem->slug }}"
                                                    class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                    {{ $productsitem->name }}
                                                </a>
                                                <span class="stext-105 cl3 bold">
                                                    Price: ${{ $productsitem->original_price }}
                                                </span>
                                                <span class="stext-105 cl3">
                                                    Brand: {{ $productsitem->brand }}
                                                </span>
                                            </div>

                                            <div class="block2-txt-child2 flex-r p-t-3">
                                                <a href="{{url('add_wishlist',['id'=>$productsitem->id])}}" >
                                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                                   
                                                </a>
                                            </div>
                                            
                                        </div>
                                    </div>

                                </div>
                            @empty
                                <p>No Products Available {{ $category->tittle }}</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    


        </div>
    </div>

 



  


    <!-- Load more -->
    <div class="flex-c-m flex-w w-full p-t-45">
        {{ $products->links() }}
    </div>
    </div>
    </div>


</body>


@endsection
