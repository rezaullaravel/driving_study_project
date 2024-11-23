@extends('panel.master')

@section('title')
Chapter List
@endsection

@section('content')
<div class="dd-content">

    @include('panel.partials.header')

    <section class="container-fluid">
        @php
        $permission_chapter_create = DB::table('permission_roles')
            ->where('role_id',Auth::user()->role_id)
            ->join('permissions','permission_roles.permission_id','=','permissions.id')
            ->where('permissions.slug','createchapter')
            ->select('permissions.name')
            ->first();

            $permission_chapter_group_create = DB::table('permission_roles')
            ->where('role_id',Auth::user()->role_id)
            ->join('permissions','permission_roles.permission_id','=','permissions.id')
            ->where('permissions.slug','createchaptergroup')
            ->select('permissions.name')
            ->first();

            $permission_chapter_edit = DB::table('permission_roles')
            ->where('role_id',Auth::user()->role_id)
            ->join('permissions','permission_roles.permission_id','=','permissions.id')
            ->where('permissions.slug','editchapter')
            ->select('permissions.name')
            ->first();


            $permission_chapter_delete = DB::table('permission_roles')
            ->where('role_id',Auth::user()->role_id)
            ->join('permissions','permission_roles.permission_id','=','permissions.id')
            ->where('permissions.slug','deletechapter')
            ->select('permissions.name')
            ->first();
        @endphp
      <div class="card">
        <div class="card-header mb-4">
          <h5 class="card-title">Chapter List</h5>

          <div style="float: right;">
             @if (!empty($permission_chapter_create))
                  <a href="{{ route('chapter.create') }}" class="btn btn-primary btn-sm">
                    <i class="las la-plus-square"></i>Create Chapter
                </a>
             @endif
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-">
            <thead>
              <tr>
                <th scope="col">Sl.</th>
                <th scope="col">Chapter Name</th>
                <th scope="col">Language</th>

                  <th scope="col" width="180">
                    @if (!empty($permission_chapter_edit || $permission_chapter_delete))
                     Action
                    @endif
                  </th>


              </tr>
            </thead>
            <tbody>

                @foreach ($chapters as $key => $row)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->language->name }}</td>
                        <td>
                            @if (!empty($permission_chapter_group_create))
                                <a href="{{ route('chapter-group.create',$row->id) }}" class="btn btn-success btn-sm" title="Create Chapter Group">
                                    <i class="las la-plus-square"></i>
                                </a>
                            @endif
                            @if (!empty($permission_chapter_edit))
                              <a href="{{ route('chapter.edit',$row->id) }}" class="btn btn-primary btn-sm" title="Edit">
                                <i class="las la-pencil-alt"></i>
                              </a>
                            @endif

                            @if (!empty($permission_chapter_delete ))
                            <a href="{{ route('chapter.delete',$row->id) }}" class="btn btn-danger btn-sm" onclick="confirmation(event)" title="Delete">
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
