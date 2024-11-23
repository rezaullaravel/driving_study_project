@extends('panel.master')

@section('title')
Role List
@endsection

@section('content')
<div class="dd-content">

    @include('panel.partials.header')

    <section class="container-fluid">
        @php
            $permission_role_edit = DB::table('permission_roles')
            ->where('role_id',Auth::user()->role_id)
            ->join('permissions','permission_roles.permission_id','=','permissions.id')
            ->where('permissions.slug','editrole')
            ->select('permissions.name')
            ->first();

            $permission_role_create = DB::table('permission_roles')
            ->where('role_id',Auth::user()->role_id)
            ->join('permissions','permission_roles.permission_id','=','permissions.id')
            ->where('permissions.slug','createrole')
            ->select('permissions.name')
            ->first();

            $permission_role_delete = DB::table('permission_roles')
            ->where('role_id',Auth::user()->role_id)
            ->join('permissions','permission_roles.permission_id','=','permissions.id')
            ->where('permissions.slug','deleterole')
            ->select('permissions.name')
            ->first();
        @endphp
      <div class="card">
        <div class="card-header mb-4">
          <h5 class="card-title">Role List</h5>

          <div style="float: right;">
             @if (!empty($permission_role_create))
                  <a href="{{ route('role.create') }}" class="btn btn-primary btn-sm">
                    <i class="las la-plus-square"></i>Create Role
                </a>
             @endif
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-">
            <thead>
              <tr>
                <th scope="col">Sl.</th>
                <th scope="col">Role</th>

                <th scope="col" width="120">
                    @if (!empty($permission_role_edit || $permission_role_delete))
                    Action
                    @endif
                </th>


              </tr>
            </thead>
            <tbody>

                @foreach ($roles as $key=>$role)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            @if (!empty($permission_role_edit))
                              <a href="{{ route('role.edit',$role->id) }}" class="btn btn-primary btn-sm" title="Edit">
                                <i class="las la-pencil-alt"></i>
                              </a>
                            @endif

                            @if (!empty($permission_role_delete ))
                            <a href="{{ route('role.delete',$role->id) }}" class="btn btn-danger btn-sm" onclick="confirmation(event)" title="Delete">
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
