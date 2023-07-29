@extends('admin.layouts.layout')
@section('content')

<div id="main">
  @if(Session::has('success'))
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
                      <h4 class="card-title"> Edit Brands</h4>
                    </div>
                    <div class="card-content">
                      <div class="card-body">
                        <form class="form form-vertical" action="{{url('brand-update',$brand->id)}}" method="POST" >
                          @csrf
                          @method('PUT')
                          <div class="form-body">
                              <div class="row">
                                  <div class="col-12">
                                      <div class="form-group">
                                        <label class=" mb-3">Select Catagory </label>                  
                                        <select class="form-select" name="category_id" aria-label="Floating label select example">
                                            <option>---Select Category Here--</option>
                                            @foreach ($category as $category)
                                                <option value="{{$category->id}}">{{$category->tittle}}</option>
                                            @endforeach  
                                        </select>
                                        
                                        @error('category_id')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                    
                                      </div>
                                  </div>
                                  <input type="hidden" name="category_id" value="{{ $category->id }}">

                                  <div class="col-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Brand Name" value="{{ $brand->name }}" />
                                        @error('name')
                                        <div class="text-danger text-sm"><small>{{ $message }}</small></div>
                                        @enderror
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