@extends('panel.master')

@section('title')
Create User
@endsection

@section('content')
<div class="dd-content">

    @include('panel.partials.header')

    <section class="container-fluid">
       <div class="row">
         <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 style="display: inline;">Create User</h5>
                    <div style="float: right;">
                        <a href="{{ route('users') }}" class="btn btn-primary btn-sm"><i class="las la-arrow-circle-left"></i>Back</a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <strong>Name <span class="text-danger">*</span> </strong>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control form-control-sm mt-2" placeholder="Enter User Name">

                                    @error('name')
                                      <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <strong>Email <span class="text-danger">*</span> </strong>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control form-control-sm mt-2" placeholder="Enter Email">

                                    @error('email')
                                      <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>{{-- row --}}


                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <strong>Password <span class="text-danger">*</span> </strong>
                                    <input type="text" name="password" value="{{ old('password') }}" class="form-control form-control-sm mt-2" placeholder="Enter Password">

                                    @error('password')
                                      <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                             </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <strong>Role <span class="text-danger">*</span> </strong>
                                    <select name="role_id" class="form-select form-select-sm mt-2">
                                        <option value="" selected disabled>Select</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('role_id')
                                      <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>{{-- row --}}


                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <strong>Language <span class="text-danger">*</span> </strong>
                                    <select name="language_id" class="form-select form-select-sm mt-2">
                                        <option value="" selected disabled>Select</option>
                                        @foreach ($languages as $language)
                                            <option value="{{ $language->id }}">{{ $language->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('language_id')
                                      <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <strong>Licence Type <span class="text-danger">*</span> </strong>
                                    <select name="licence_type_id" class="form-select form-select-sm mt-2">
                                        <option value="" selected disabled>Select</option>
                                        @foreach ($licencetypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('licence_type_id')
                                      <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>{{-- row --}}


                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <strong>Country <span class="text-danger"></span> </strong>
                                    <input type="text" name="country" value="{{ old('country') }}" class="form-control form-control-sm mt-2" placeholder="Enter Country">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <strong>Zip Code <span class="text-danger"></span> </strong>
                                    <input type="text" name="zipcode" value="{{ old('	zipcode') }}" class="form-control form-control-sm mt-2" placeholder="Enter Zip code">
                                </div>
                            </div>
                        </div>{{-- row --}}


                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <strong>Mobile Number <span class="text-danger"></span> </strong>
                                    <input type="text" name="mobile_number" value="{{ old('mobile_number') }}" class="form-control form-control-sm mt-2" placeholder="Enter Mobile Number">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <strong>Address <span class="text-danger"></span> </strong>
                                    <textarea name="address"  class="form-control form-control-sm mt-2" placeholder="Enter Address" rows="5"></textarea>
                                </div>
                            </div>
                        </div>{{-- row --}}


                        <div class="row mt-4">
                             <div class="col-sm-12">
                                <div class="form-group">
                                    <strong>Image </strong>
                                    <input type="file" name="image" class="form-control form-control-sm mt-2">
                                </div>
                             </div>
                        </div>{{-- row --}}

                        <button type="submit" class="btn btn-primary btn-sm mt-4">Submit</button>
                    </form>
                </div>
              </div>
         </div>
       </div>{{-- row --}}
    </section>
   </div>
@endsection
