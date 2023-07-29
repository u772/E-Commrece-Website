@extends('admin.layouts.layout')
@section('content')
    <div id="main">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="container ">
            <div class="page-heading">
                <section id="basic-vertical-layouts">
                    <div class="row match-height">
                        <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Slider Form</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form form-vertical" action="{{ url('slider-update',$slider->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="tittle">Title</label>
                                                            <input type="text" class="form-control" name="title"
                                                                placeholder="Tittle" value="{{$slider->title }}" />
                                                           
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="heading">Heading</label>
                                                            <input type="text" class="form-control" name="heading"
                                                                placeholder="Heading" value="{{$slider->heading }}" />
                                                          
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="image">Image</label>
                                                            <input type="file" multiple name="image[]" class="form-control" name="image"
                                                                placeholder="Image"  />
                                                                <div class="mb-3">
                                                                    @if ($slider->sliderImages)
                                                                        <div class="row">
                                                                            @foreach ($slider->sliderImages as $key1 => $image)
                                                                                <div class="col-md-2">
                                                                                    <img src="{{ asset($image['image']) }}"
                                                                                        style="width: 80px;height:80px"
                                                                                        class="me-4" />
                                                                                    <a href="{{ route('slider-delete_image', ['id' => $image->id]) }}"
                                                                                        class="d-block">Remove</a>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    @else
                                                                        <h3>No image Added</h3>
                                                                    @endif
                                                                </div>
                                                        </div>
                                                    </div>

                                                   



                                                    <div class="col-12 d-flex justify-content-end">
                                                        <button type="submit" name="submit"
                                                            class="btn btn-primary me-1 mb-1">
                                                            Update Slider
                                                        </button>
                                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                                                            Reset
                                                        </button>
                                                    </div>
                                                </div>
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
