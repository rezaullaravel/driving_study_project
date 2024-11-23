@extends('panel.master')

@section('title')
Package Details
@endsection

@section('content')
<div class="dd-content">

    @include('panel.partials.header')

    <section class="container-fluid">
      <div class="card">
        <div class="card-header mb-4">
          <h5 class="card-title">Package Details</h5>

          <div style="float: right;">

                  <a href="{{ route('package.index') }}" class="btn btn-primary btn-sm">
                    <i class="las la-arrow-circle-left"></i>Back
                 </a>

          </div>
        </div>
        <div class="table-responsive">
          <table class="table  table-hover table-">
            <tbody>
                <tr>
                    <th width="300" class="text-center">Package Name</th>
                    <td>{{ $package->name }}</td>
                </tr>

                <tr>
                    <th width="300" class="text-center">Price</th>
                    <td>{{ $package->price }} TK.</td>
                </tr>

                <tr>
                    <th width="300" class="text-center">Selling Price</th>
                    <td>{{ $package->selling_price }} TK.</td>
                </tr>

                <tr>
                    <th width="300" class="text-center">Duration</th>
                    <td>{{ $package->duration_value  }} &nbsp; {{ $package->duration_unit }} </td>
                </tr>

                <tr>
                    <th width="300" class="text-center">Description</th>
                    <td>{{ $package->description }} </td>
                </tr>

                <tr>
                    <th width="300" class="text-center">Banner</th>
                    <td>
                        <img src="{{ asset($package->banner) }}" alt="">
                    </td>
                </tr>

                <tr>
                    <th width="300" class="text-center">Status</th>
                    <td>
                        @if ($package->status=='1')
                            <span class="badge bg-primary">Active</span>
                            @endif

                            @if ($package->status=='0')
                            <span class="badge bg-danger">Inactive</span>
                            @endif
                    </td>
                </tr>



            </tbody>
          </table>
        </div>
      </div>
    </section>
   </div>
@endsection
