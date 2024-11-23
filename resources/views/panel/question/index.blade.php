@extends('panel.master')

@section('title')
Question List
@endsection

@section('content')
<div class="dd-content">

    @include('panel.partials.header')

    <section class="container-fluid">
        @php
            $permission_question_edit = DB::table('permission_roles')
            ->where('role_id',Auth::user()->role_id)
            ->join('permissions','permission_roles.permission_id','=','permissions.id')
            ->where('permissions.slug','editquestion')
            ->select('permissions.name')
            ->first();

            $permission_question_view = DB::table('permission_roles')
            ->where('role_id',Auth::user()->role_id)
            ->join('permissions','permission_roles.permission_id','=','permissions.id')
            ->where('permissions.slug','viewquestion')
            ->select('permissions.name')
            ->first();

            $permission_question_create = DB::table('permission_roles')
            ->where('role_id',Auth::user()->role_id)
            ->join('permissions','permission_roles.permission_id','=','permissions.id')
            ->where('permissions.slug','createquestion')
            ->select('permissions.name')
            ->first();

            $permission_question_delete = DB::table('permission_roles')
            ->where('role_id',Auth::user()->role_id)
            ->join('permissions','permission_roles.permission_id','=','permissions.id')
            ->where('permissions.slug','deletequestion')
            ->select('permissions.name')
            ->first();
        @endphp
      <div class="card">
        <div class="card-header mb-4">
          <h5 class="card-title">Question List</h5>

          <div style="float: right;">
             @if (!empty($permission_question_create))
                  <a href="{{ route('question.create') }}" class="btn btn-primary btn-sm">
                    <i class="las la-plus-square"></i>Create Question
                </a>
             @endif
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-">
            <thead>
              <tr>
                <th scope="col">Sl.</th>
                <th scope="col">Licence Type</th>
                <th scope="col">Topic</th>
                <th scope="col">Chapter</th>
                <th scope="col">Lession</th>
                <th scope="col">Language</th>
                <th scope="col">Question</th>
                <th scope="col">Status</th>

                  <th scope="col" width="200">
                     @if (!empty($permission_question_edit || $permission_question_delete  || $permission_question_view ))
                       Action
                    @endif
                  </th>


              </tr>
            </thead>
            <tbody>

                 @foreach ($questions as $key=>$row)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $row->licence_type_name }}</td>
                        <td>{{ $row->topic_name }}</td>
                        <td>{{ $row->chapter_name }}</td>
                        <td>{{ $row->lesson }}</td>
                        <td>{{ $row->language_name }}</td>
                        <td>{{ $row->question_text }}</td>
                        <td>
                            @if ($row->paid_status=='1')
                                <span>Paid</span>
                            @else
                              <span>Free</span>
                            @endif
                        </td>

                        <td>

                            @if (!empty($permission_question_view))
                                <a href="{{ route('question.view',$row->id) }}" class="btn btn-success btn-sm" title="View Details">
                                    <i class="las la-eye"></i>
                                </a>
                            @endif
                            @if (!empty($permission_question_edit))
                              <a href="{{ route('question.edit',$row->id) }}" class="btn btn-primary btn-sm" title="Edit">
                                <i class="las la-pencil-alt"></i>
                              </a>
                            @endif

                            @if (!empty($permission_question_delete))
                            <a href="{{ route('question.delete',$row->id) }}" class="btn btn-danger btn-sm" onclick="confirmation(event)" title="Delete">
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
