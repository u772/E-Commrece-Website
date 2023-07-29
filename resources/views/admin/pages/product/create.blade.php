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

                                        <form action="{{ route('product-store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
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


                                                    <div class=" mb-3">
                                                        <label class=" mb-3">Select Catagory </label>
                                                        <div class=" mb-3">
                                                            <label class=" mb-3">Select Category</label>
                                                            <select class="form-select" name="category_id" id="floatingSelect" aria-label="Floating label select example" required>
                                                                <option value="">---Select Category Here--</option>
                                                                @foreach ($category as $cat)
                                                                    <option value="{{ $cat->id }}">{{ $cat->tittle }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('category_id')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        

                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Product Name</label>
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ old('name') }}">
                                                        @error('name')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>


                                                    <div class="mb-3">
                                                        <label class=" mb-3">Select Brand </label>
                                                        <select class="form-select" name="brand" id="floatingSelect"
                                                            aria-label="Floating label select example" required>
                                                            <option value="">---Select Brand Here-- </option>
                                                            @foreach ($brand as $brand)
                                                                <option value="{{ $brand->name }}"
                                                                    @if (old('brand') == $brand->name) selected @endif>
                                                                    {{ $brand->name }}</option>
                                                            @endforeach
                                                        </select>

                                                        @error('brand')
                                                            <div class="text-danger text-sm"><small>{{ $message }}</small>
                                                            </div>
                                                        @enderror
                                                    </div>


                                                    <div class=" mb-3">
                                                        <label>Product small Description</label>
                                                        <textarea class="form-control" name="small_description" style="height: 150px;" required>{{ old('small_description') }}</textarea>

                                                        @error('small_description')
                                                            <div class="text-danger text-sm"><small>{{ $message }}</small>
                                                            </div>
                                                        @enderror

                                                    </div>


                                                    <div class=" mb-3">
                                                        <label>Product Description</label>
                                                        <textarea class="form-control" name="description" style="height: 150px;"required>{{ old('description') }}</textarea>
                                                        @error('description')
                                                            <div class="text-danger text-sm"><small>{{ $message }}</small>
                                                            </div>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="tab-pane fade border p-3" id="seo" role="tabpanel"
                                                    aria-labelledby="seo-tab">
                                                    <div class="mb-3">
                                                        <label class="form-label">Meta Tittle</label>
                                                        <input type="text" name="meta_title" class="form-control"
                                                            value="{{ old('meta_title') }}">
                                                        @error('meta_title')
                                                            <div class="text-danger text-sm">
                                                                <small>{{ $message }}</small></div>
                                                        @enderror
                                                    </div>
                                                    <div class=" mb-3">
                                                        <label>Meta Description</label>
                                                        <textarea class="form-control" name="meta_description" style="height: 150px;"required>{{ old('meta_description') }}</textarea>
                                                        @error('meta_description')
                                                            <div class="text-danger text-sm">
                                                                <small>{{ $message }}</small></div>
                                                        @enderror
                                                    </div>

                                                    <div class=" mb-3">
                                                        <label>Meta keywords</label>
                                                        <textarea class="form-control" name="meta_keyword" style="height: 150px;"required>{{ old('meta_keyword') }}</textarea>
                                                        @error('meta_keyword')
                                                            <div class="text-danger text-sm">
                                                                <small>{{ $message }}</small></div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade border p-3" id="details" role="tabpanel"
                                                    aria-labelledby="details-tab">
                                                    <div class="mb-3">
                                                        <label class="form-label">Product Price</label>
                                                        <input type="number" name="original_price" class="form-control"
                                                            value="{{ old('original_price') }}">
                                                        @error('original_price')
                                                            <div class="text-danger text-sm">
                                                                <small>{{ $message }}</small></div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Selling Price</label>
                                                        <input type="number" name="selling_price" class="form-control"
                                                            value="{{ old('selling_price') }}">
                                                        @error('selling_price')
                                                            <div class="text-danger text-sm">
                                                                <small>{{ $message }}</small></div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Product Quantity</label>
                                                        <input type="number" min="1" name="quantity"
                                                            class="form-control" value="{{ old('quantity') }}">
                                                        @error('quantity')
                                                            <div class="text-danger text-sm">
                                                                <small>{{ $message }}</small></div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Upload Images</label>
                                                        <input type="file" multiple name="image[]" required>
                                                        @error('image')
                                                            <div class="text-danger text-sm">
                                                                <small>{{ $message }}</small></div>
                                                        @enderror
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
                                                    Add Brand
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
