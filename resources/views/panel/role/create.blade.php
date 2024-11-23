@extends('panel.master')

@section('title')
Role Create
@endsection

@section('content')
<div class="dd-content">

    @include('panel.partials.header')

    <section class="container-fluid">
       <div class="row">
         <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 style="display: inline;">Role Create</h5>
                    <div style="float: right;">
                        <a href="{{ route('roles') }}" class="btn btn-primary btn-sm"><i class="las la-arrow-circle-left"></i>Back</a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('role.store') }}" method="post">
                        @csrf
                        <div class="col-sm-6">
                            <div class="form-group">
                                <strong>Role <span class="text-danger">*</span> </strong>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control form-control-sm mt-2" placeholder="Enter Role Name">

                                @error('name')
                                   <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 mt-4">
                            <strong>Permissions</strong>
                            @foreach($permissions as $permissionGroup)
                                <div class="form-group mt-2">
                                    @php
                                        $ids = explode(',', $permissionGroup->ids);
                                        $names = explode(',', $permissionGroup->names);
                                        $slugs = explode(',', $permissionGroup->slugs);
                                    @endphp

                                    @foreach($ids as $index => $id)
                                        <div class="form-check form-check-inline mb-2">
                                            <input class="form-check-input" type="checkbox" id="permission-{{ $id }}" name="permissions[]" value="{{ $id }}">
                                            <label class="form-check-label" for="permission-{{ $id }}">
                                                {{ $names[$index] }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm mt-4">Submit</button>
                    </form>
                </div>
              </div>
         </div>
       </div>{{-- row --}}
    </section>
   </div>
@endsection
