@extends('panel.master')

@section('title')
Profile
@endsection

@section('content')
<div class="dd-content">

    @include('panel.partials.header')

    <!-- Breadcrumb Start Here -->
             <section class="breadcrumb-section m-0">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcrumb-wrapper">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item active"><a href="{{ url('/dashboard') }}" class="breadcrumb-link">Home</a>
                                    </li>
                                    <li class="breadcrumb-icon"><i class="fa-solid fa-slash"></i></li>
                                    <li class="breadcrumb-item"><span class="breadcrumb-item-text">Profile
                                        </span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

            <!-- Breadcrumb End Here -->

         {{-- profile start --}}
         <section class="container-fluid">
            <div class="row gy-4 justify-content-center">
                <div class="col-lg-4">
                    <div class=" card dashboard_profile-card p-0">
                        <div class="user-profile text-center">
                            <div class="dashboard_profile_wrap">
                                <div class="profile_photo mb-2">
                                    @if (Auth::user()->image)
                                      <img src="{{ asset($user->image) }}" alt="user">
                                    @else
                                      <img src="{{ asset('/') }}panel/assets/img/user/u1.jpg" alt="user">
                                    @endif

                                    <div class="photo_upload">
                                        <label for="photo_upload"><i class="fa-regular fa-image"></i></label>
                                        <input id="photo_upload" type="file" class="upload_file">
                                    </div>
                                </div>
                                {{-- <div class="profile-details">
                                    <ul>
                                        <li>
                                            <p class="user-name text--black">any@1998</p>
                                        </li>
                                    </ul>
                                </div> --}}
                            </div>
                        </div>
                        <div class="contact-info">
                            <div class="info-wrap">
                                <div class="info">
                                    <i class="fa-regular fa-envelope"></i>
                                    <p>Email Address</p>
                                </div>
                                <span>{{ $user->email }}</span>
                            </div>
                        </div>
                        <div class="contact-info">
                            <div class="info-wrap">
                                <div class="info">
                                    <i class="fa-solid fa-phone"></i>
                                    <p>Mobile Number</p>
                                </div>
                                <span>{{ $user->mobile_number }}</span>
                            </div>
                        </div>
                        <div class="contact-info">
                            <div class="info-wrap border-bottom--none">
                                <div class="info">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <p>Address</p>
                                </div>
                                <span>{{ $user->address }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 justify-content-center">
                    <div class="card">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row gy-3">
                                <div class="col-lg-12">
                                    <h4 class="mb-1">Personal Information</h4>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label mb-3">  Name</label>
                                        <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="name" placeholder="Full Name">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label mb-2">Email</label>
                                        <input type="email" name="email" value="{{ $user->email }}" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="country" class="form-label mb-2">Country</label>
                                        <input type="text" name="country" value="{{ $user->country }}" class="form-control" id="country" placeholder="Country">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="zip-code" class="form-label mb-2">Zip Code</label>
                                        <input type="text" name="zipcode" value="{{ $user->zipcode }}" class="form-control" id="zip-code"
                                            placeholder="Zip Code">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label for="country" class="form-label mb-2">Mobile Number</label>
                                        <input type="text" name="mobile_number" value="{{ $user->mobile_number }}" class="form-control" id="country">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label for="country" class="form-label mb-2">Profile Photo</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label for="country" class="form-label mb-2">Address</label>
                                        <textarea  name="address"  class="form-control" rows="5">{{ $user->address }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-base btn-lg w-100">Save
                                        Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
         {{-- profile end --}}
   </div>
@endsection
