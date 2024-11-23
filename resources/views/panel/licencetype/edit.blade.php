@extends('panel.master')

@section('title')
Edit Licence Type
@endsection

@section('content')
<div class="dd-content">

    @include('panel.partials.header')

    <section class="container-fluid">
       <div class="row">
         <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 style="display: inline;">Edit Licence Type</h5>
                    <div style="float: right;">
                        <a href="{{ route('licencetype.index') }}" class="btn btn-primary btn-sm"><i class="las la-arrow-circle-left"></i>Back</a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('licencetype.update',$licencetype->id ) }}" method="post">
                        @csrf
                        <div class="col-sm-6">
                            <div class="form-group">
                                <strong>Licence Type Name <span class="text-danger">*</span> </strong>
                                <input type="text" name="name" value="{{ $licencetype->name }}" class="form-control form-control-sm mt-2" placeholder="Enter Licence Type Name">

                                @error('name')
                                  <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm mt-4">Update</button>
                    </form>
                </div>
              </div>
         </div>
       </div>{{-- row --}}
    </section>
   </div>
@endsection
