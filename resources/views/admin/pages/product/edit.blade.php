@extends('admin.layouts.layout')
@section('content')
    <div id="main">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Error!</strong> <br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container ">
            <div class="page-heading">
                <section id="basic-vertical-layouts">
                    <div class="row match-height">
                        <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Product Form</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card">

                                        <form action="{{ url('product-update', $product->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                                        data-bs-target="#home" type="button" role="tab"
                                                        aria-controls="home" aria-selected="true">
                                                        Home
                                                    </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="seo-tab" data-bs-toggle="tab"
                                                        data-bs-target="#seo" type="button" role="tab"
                                                        aria-controls="seo" aria-selected="false">
                                                        SEO TAGS
                                                    </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                                                        data-bs-target="#details" type="button" role="tab"
                                                        aria-controls="details" aria-selected="false">
                                                        DETAILS
                                                    </button>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade border p-3 show active" id="home"
                                                    role="tabpanel" aria-labelledby="home-tab">


                                                    <div class="mb-3">
                                                        <label class="mb-3">Select Category</label>
                                                        <select class="form-select" name="category_id" id="floatingSelect" aria-label="Floating label select example" required>
                                                            <option value="">---Select Category Here--</option>
                                                            @foreach ($category as $cat)
                                                                <option value="{{ $cat->id }}" {{ $cat->id == $product->category_id ? 'selected' : '' }}>
                                                                    {{ $cat->tittle }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    
                                                    
                                                    <div class="mb-3">
                                                        <label class="form-label">Product Name</label>
                                                        <input type="text" name="name" class="form-control"
                                                        value="{{ $product->name }}">
                                                       
                                                    </div>


                                                    <div class="mb-3">
                                                        <label class="mb-3">Select Brand</label>
                                                        <select class="form-select" name="brand" id="floatingSelect" aria-label="Floating label select example" required>
                                                            <option value="">---Select Brand Here--</option>
                                                            @foreach ($brand as $brandItem)
                                                                <option value="{{ $brandItem->name }}" {{ $brandItem->name == $product->brand ? 'selected' : '' }}>
                                                                    {{ $brandItem->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    
                                                    


                                                    <div class=" mb-3">
                                                        <label>Product small Description</label>
                                                        <textarea class="form-control" name="small_description" style="height: 150px;" required>{{ $product->small_description }}</textarea>



                                                    </div>


                                                    <div class=" mb-3">
                                                        <label>Product Description</label>
                                                        <textarea class="form-control" name="description" style="height: 150px;"required>{{ $product->description }}</textarea>
                                                   
                                                    </div>

                                                </div>
                                                <div class="tab-pane fade border p-3" id="seo" role="tabpanel"
                                                    aria-labelledby="seo-tab">
                                                    <div class="mb-3">
                                                        <label class="form-label">Meta Tittle</label>
                                                        <input type="text" name="meta_title" class="form-control"
                                                            value="{{$product->meta_title }}">
                                                      
                                                    </div>
                                                    <div class=" mb-3">
                                                        <label>Meta Description</label>
                                                        <textarea class="form-control" name="meta_description" style="height: 150px;"required>{{ $product->meta_description }}</textarea>
                                                       
                                                    </div>

                                                    <div class=" mb-3">
                                                        <label>Meta keywords</label>
                                                        <textarea class="form-control" name="meta_keyword" style="height: 150px;"required>{{ $product->meta_keyword }}</textarea>
                                                      
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade border p-3" id="details" role="tabpanel"
                                                    aria-labelledby="details-tab">
                                                    <div class="mb-3">
                                                        <label class="form-label">Product Price</label>
                                                        <input type="number" name="original_price" class="form-control"
                                                            value="{{ $product->original_price }}">
                                                       
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Selling Price</label>
                                                        <input type="number" name="selling_price" class="form-control"
                                                            value="{{ $product->selling_price }}">
                                                      
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Product Quantity</label>
                                                        <input type="number" min="1" name="quantity"
                                                            class="form-control" value="{{ $product->quantity }}">

                                                    </div>
                                                    <div class="mb-3">
                                                      <label class="form-label">Upload Images</label>
                                                      <input type="file" multiple name="image[]">
                                                  </div>
                                                  <div class="mb-3">
                                                      @if ($product->productImages)
                                                          <div class="row">
                                                              @foreach ($product->productImages as $key1 => $image)
                                                                  <div class="col-md-2">
                                                                      <img src="{{ asset($image['image']) }}"
                                                                          style="width: 80px;height:80px"
                                                                          class="me-4" />
                                                                      <a href="{{ route('product-delete_image', ['id' => $image->id]) }}"
                                                                          class="d-block">Remove</a>
                                                                  </div>
                                                              @endforeach
                                                          </div>
                                                      @else
                                                          <h3>No image Added</h3>
                                                      @endif
                                                  </div>

                                                    {{-- <div class="mb-3">
                                    <label for="">Select Color</label>
                                    <div class="row">
                                        @forelse ($colors as $colors)
                                        <div class="col-md-3">
                                            <div class="p-2 border mb-3">
                                                Colors:  <input type="checkbox" name="colors[{{$colors->id}}]" value="{{$colors->id}}">
                                                {{$colors->name}}
                                                <br>
                                            
                                                Quantity:  <input type="number" min="0" name="colorquantity[{{$colors->id}}]" style="width:50px; border:1px solid" >
                                            
                                            </div>
                                         
                                            </div>
                                        @empty
                                            <div class="col-md-12">
                                                <h1>NO Colors Found</h1>
                                            </div>
                                        @endforelse
                                       
                                    </div>
                                    
                                </div> --}}

                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" name="submit" class="btn btn-primary me-1 mb-1">
                                                    Update Brand
                                                </button>
                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                                                    Reset
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>

            </div>
        </div>




    </div>
@endsection
