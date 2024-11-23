@extends('panel.master')

@section('title')
User List
@endsection

@section('content')
<div class="dd-content">

    @include('panel.partials.header')

    <section class="container-fluid">
        @php
        $permission_edit_user = DB::table('permission_roles')
        ->where('role_id',Auth::user()->role_id)
        ->join('permissions','permission_roles.permission_id','=','permissions.id')
        ->where('permissions.slug','edituser')
        ->select('permissions.name')
        ->first();

        $permission_delete_user = DB::table('permission_roles')
        ->where('role_id',Auth::user()->role_id)
        ->join('permissions','permission_roles.permission_id','=','permissions.id')
        ->where('permissions.slug','deleteuser')
        ->select('permissions.name')
        ->first();

        $permission_create_user = DB::table('permission_roles')
        ->where('role_id',Auth::user()->role_id)
        ->join('permissions','permission_roles.permission_id','=','permissions.id')
        ->where('permissions.slug','createuser')
        ->select('permissions.name')
        ->first();
     @endphp
      <div class="card">
        <div class="card-header mb-4">
          <h5 class="card-title">User List</h5>

            <div style="float: right;">
                @if (!empty($permission_create_user))
                    <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">
                        <i class="las la-plus-square"></i>Create New
                    </a>
                @endif
            </div>
        </div>
        <div class="table-responsive">

          <table id="example" class="table table-bordered table-hover table-">
            <thead>
              <tr>
                <th scope="col">Sl.</th>
                <th scope="col">Name</th>
                <th scope="col">Role</th>
                <th scope="col">Email</th>
                <th scope="col">Image</th>

                  <th scope="col" width="120">
                    @if (!empty($permission_edit_user || $permission_delete_user))
                    Action
                    @endif
                </th>


            </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <img src="{{ asset($user->image) }}" style="width:80px;height:80px;" alt="">
                        </td>

                        <td>
                            @if (!empty($permission_edit_user))
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-info btn-sm">
                                <i class="las la-pencil-alt"></i></a>
                            @endif

                            @if (!empty($permission_delete_user))
                            <a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger btn-sm" onclick="confirmation(event)">
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
</div> <!-- Missing closing div tag added here -->

<script>
    new DataTable('#example');
</script>
@endsection
