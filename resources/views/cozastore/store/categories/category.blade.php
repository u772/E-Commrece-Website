@extends('cozastore.layouts.layout')
@section('content')


<body class="">
	
    <!-- Product -->
	<div class="bg0 m-t-23 p-b-140 " style="margin-top: 100px">
        <div class="sec-banner bg0 p-t-80 p-b-50">

            <div class="container">
                <div class="p-b-10 ">
                    <h3 class="ltext-103 cl5">
                        Our Categories
                    </h3>
                </div>
                <div class="row mt-4">

                    @forelse ($category as $categoritem)
                        <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                            <!-- Block1 -->
                            <div class="block1 wrap-pic-w">



                                <img src="{{ asset('/uploads/category/' . $categoritem->image) }}" alt="IMG-BANNER">

                                <a href="{{url('/collections/'.$categoritem->slug)}}"
                                    class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                                    <div class="block1-txt-child1 flex-col-l">
                                        <span class="block1-name ltext-102 trans-04 p-b-8">
                                            {{ $categoritem->tittle }}
                                        </span>

                                       
                                    </div>

                                    <div class="block1-txt-child2 p-b-4 trans-05">
                                        <div class="block1-link stext-101 cl0 trans-09">
                                            Shop Now
                                        </div>
                                    </div>
                                </a>

                            </div>
                        </div>

                    @empty
                        <p>No Category Available</p>
                    @endforelse

                </div>
            </div>
        </div>
	</div>


</body>


@endsection