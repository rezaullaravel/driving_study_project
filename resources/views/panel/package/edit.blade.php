@extends('panel.master')

@section('title')
Edit Package
@endsection

@section('content')
<div class="dd-content">

    @include('panel.partials.header')

    <section class="container-fluid">
       <div class="row">
         <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 style="display: inline;">Edit Package</h5>
                    <div style="float: right;">
                        <a href="{{ route('package.index') }}" class="btn btn-primary btn-sm"><i class="las la-arrow-circle-left"></i>Back</a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('package.update',$package->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <strong>Name <span class="text-danger">*</span> </strong>
                                    <input type="text" name="name" value="{{ $package->name }}" class="form-control form-control-sm mt-2">

                                    @error('name')
                                      <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <strong>Banner <span class="text-danger"></span> </strong>
                                    <input type="file" name="banner" class="form-control form-control-sm mt-2">
                                </div>
                             </div>
                        </div>{{-- row --}}


                        <div class="row mt-4">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <strong>Description <span class="text-danger">*</span> </strong>
                                    <textarea name="description"  class="form-control form-control-sm mt-2" rows="5">{{ $package->description }}</textarea>

                                    @error('description')
                                      <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>{{-- row --}}


                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <strong>Price <span class="text-danger">*</span> </strong>
                                    <input type="number" name="price" value="{{ $package->price }}"  class="form-control form-control-sm mt-2">

                                    @error('price')
                                      <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-sm-6">
                                <div class="form-group">
                                    <strong>Selling Price <span class="text-danger">*</span> </strong>
                                    <input type="number" name="selling_price" value="{{ $package->selling_price }}"  class="form-control form-control-sm mt-2">

                                    @error('selling_price')
                                      <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>


                        </div>{{-- row --}}


                        <div class="row mt-4">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <strong>Duration Value <span class="text-danger">*</span> </strong>
                                    <input type="number" name="duration_value" value="{{ $package->duration_value }}"  class="form-control form-control-sm mt-2">

                                    @error('duration_value')
                                      <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <strong>Duration Unit <span class="text-danger">*</span> </strong>
                                    <select name="duration_unit"  class="form-select form-select-sm mt-2">
                                        <option value="" selected disabled>Select</option>
                                        <option value="day" {{ $package->duration_unit=='day' ? 'selected':'' }}>Day</option>
                                        <option value="month" {{ $package->duration_unit=='month' ? 'selected':'' }}>Month</option>
                                        <option value="year" {{ $package->duration_unit=='year' ? 'selected':'' }}>Year</option>
                                    </select>

                                    @error('duration_unit')
                                      <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                        </div>{{-- row --}}


                        <div class="row mt-4">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <strong>Status <span class="text-danger">*</span> </strong>
                                    <select name="status"  class="form-select form-select-sm mt-2">
                                        <option value="" selected disabled>Select</option>
                                        <option value="1" {{ $package->status=='1' ? 'selected':'' }}>Active</option>
                                        <option value="0" {{ $package->status=='0' ? 'selected':'' }}>Inactive</option>
                                    </select>

                                    @error('status')
                                      <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>{{-- row --}}

                        <button type="submit" class="btn btn-primary btn-sm mt-4">Update</button>
                    </form>
                </div>
              </div>
         </div>
       </div>{{-- row --}}
    </section>
   </div>
@endsection
