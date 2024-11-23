@extends('panel.master')

@section('title')
Licence Type List
@endsection

@section('content')
<div class="dd-content">

    @include('panel.partials.header')

    <section class="container-fluid">
        @php
        $permission_edit_licence_type = DB::table('permission_roles')
        ->where('role_id',Auth::user()->role_id)
        ->join('permissions','permission_roles.permission_id','=','permissions.id')
        ->where('permissions.slug','editlicencetype')
        ->select('permissions.name')
        ->first();

        $permission_delete_licence_type = DB::table('permission_roles')
        ->where('role_id',Auth::user()->role_id)
        ->join('permissions','permission_roles.permission_id','=','permissions.id')
        ->where('permissions.slug','deletelicencetype')
        ->select('permissions.name')
        ->first();

        $permission_create_licence_type = DB::table('permission_roles')
        ->where('role_id',Auth::user()->role_id)
        ->join('permissions','permission_roles.permission_id','=','permissions.id')
        ->where('permissions.slug','createlicencetype')
        ->select('permissions.name')
        ->first();
        @endphp
      <div class="card">
        <div class="card-header mb-4">
          <h5 class="card-title">Licence Type List</h5>
          <div style="float: right;">
            @if (!empty($permission_create_licence_type ))
                <a href="{{ route('licencetype.create') }}" class="btn btn-primary btn-sm">
                    <i class="las la-plus-square"></i>Create New
                </a>
            @endif
          </div>
        </div>
        @if(count($licencetypes)>0)
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-">
            <thead>
              <tr>
                <th scope="col">Sl.</th>
                <th scope="col">Name</th>
                  <th scope="col" width="120">
                    @if (!empty($permission_edit_licence_type || $permission_delete_licence_type))
                    Action
                    @endif
                  </th>

              </tr>
            </thead>
            <tbody>
                @foreach ($licencetypes as $key=>$row)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $row->name }}</td>

                        <td>
                           @if (!empty($permission_edit_licence_type ))
                             <a href="{{ route('licencetype.edit',$row->id) }}" class="btn btn-info btn-sm" title="Edit">
                                <i class="las la-pencil-alt"></i>
                            </a>
                           @endif

                           @if (!empty($permission_delete_licence_type ))
                           <a href="{{ route('licencetype.delete',$row->id) }}" class="btn btn-danger btn-sm" title="Delete" onclick="confirmation(event)">
                            <i class="las la-trash"></i>
                        </a>
                           @endif

                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        @else
            <div class="card">
                <div class="card-body">
                    <h4 class="text-danger text-center">No data available....</h4>
                </div>
            </div>
        @endif
      </div>
    </section>
   </div>
@endsection
