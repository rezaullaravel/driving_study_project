@extends('panel.master')

@section('title')
Package List
@endsection

@section('content')
<div class="dd-content">

    @include('panel.partials.header')

    <section class="container-fluid">
        @php
            $permission_package_edit = DB::table('permission_roles')
            ->where('role_id',Auth::user()->role_id)
            ->join('permissions','permission_roles.permission_id','=','permissions.id')
            ->where('permissions.slug','editpackage')
            ->select('permissions.name')
            ->first();

            $permission_package_create = DB::table('permission_roles')
            ->where('role_id',Auth::user()->role_id)
            ->join('permissions','permission_roles.permission_id','=','permissions.id')
            ->where('permissions.slug','createpackage')
            ->select('permissions.name')
            ->first();

            $permission_package_delete = DB::table('permission_roles')
            ->where('role_id',Auth::user()->role_id)
            ->join('permissions','permission_roles.permission_id','=','permissions.id')
            ->where('permissions.slug','deletepackage')
            ->select('permissions.name')
            ->first();

            $permission_package_view = DB::table('permission_roles')
            ->where('role_id',Auth::user()->role_id)
            ->join('permissions','permission_roles.permission_id','=','permissions.id')
            ->where('permissions.slug','viewpackage')
            ->select('permissions.name')
            ->first();
        @endphp
      <div class="card">
        <div class="card-header mb-4">
          <h5 class="card-title">Package List</h5>

          <div style="float: right;">
             @if (!empty($permission_package_create))
                  <a href="{{ route('package.create') }}" class="btn btn-primary btn-sm">
                    <i class="las la-plus-square"></i>Create Package
                </a>
             @endif
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-">
            <thead>
              <tr>
                <th scope="col">Sl.</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Selling Price</th>
                <th scope="col">Duration</th>
                <th scope="col">Banner</th>
                <th scope="col">Status</th>

                <th scope="col" width="180">
                    @if (!empty($permission_package_edit || $permission_package_delete ||$permission_package_view))
                    Action
                    @endif
                </th>


              </tr>
            </thead>
            <tbody>

                 @foreach ($packages as $key=>$row)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->price }} &nbsp; TK.</td>
                        <td>{{ $row->selling_price }} &nbsp; TK.</td>
                        <td>{{ $row->duration_value  }} &nbsp; {{ $row->duration_unit }}</td>
                        <td>
                            <img src="{{ asset($row->banner) }}" alt="" style="height: 80px; width:80px;" >
                        </td>
                        <td>
                            @if ($row->status=='1')
                            <span class="badge bg-primary">Active</span>
                            @endif

                            @if ($row->status=='0')
                            <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>

                            @if (!empty($permission_package_view))
                                <a href="{{ route('package.view',$row->id) }}" class="btn btn-success btn-sm" title="View Details">
                                    <i class="las la-eye"></i>
                                </a>
                            @endif

                            @if (!empty($permission_package_edit))
                              <a href="{{ route('package.edit',$row->id) }}" class="btn btn-primary btn-sm" title="Edit">
                                <i class="las la-pencil-alt"></i>
                              </a>
                            @endif

                            @if (!empty($permission_package_delete ))
                            <a href="{{ route('package.delete',$row->id) }}" class="btn btn-danger btn-sm" onclick="confirmation(event)" title="Delete">
                                <i class="las la-trash"></i></a>
                            @endif

                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </section>
   </div>
@endsection
