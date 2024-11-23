@extends('panel.master')

@section('title')
Book Details
@endsection

@section('content')
<div class="dd-content">

    @include('panel.partials.header')

    <section class="container-fluid">
      <div class="card">
        <div class="card-header mb-4">
          <h5 class="card-title">Book Details</h5>

          <div style="float: right;">

                  <a href="{{ route('book.index') }}" class="btn btn-primary btn-sm">
                    <i class="las la-arrow-circle-left"></i>Back
                 </a>

          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-">
            <tbody>
                <tr>
                    <th width="300" class="text-center">Licence Type</th>
                    <td>{{ $book->licence_type_name }}</td>
                </tr>

                <tr>
                    <th width="300" class="text-center">Chapter</th>
                    <td>{{ $book->chapter_group_name }}</td>
                </tr>

                <tr>
                    <th width="300" class="text-center">Language</th>
                    <td>{{ $book->language_name }}</td>
                </tr>

                <tr>
                    <th width="300" class="text-center">Lesson</th>
                    <td>{{ $book->lesson }}</td>
                </tr>

                <tr>
                    <th width="300" class="text-center">Topic</th>
                    <td>{{ $book->topic_name }}</td>
                </tr>

                <tr>
                    <th width="300" class="text-center">Topic Description</th>
                    <td>{!! $book->topic_description !!}</td>
                </tr>

                <tr>
                    <th width="300" class="text-center">Video</th>
                     <td>
                        {!! $book->video_url !!}
                     </td>
                </tr>

            </tbody>
          </table>
        </div>
      </div>
    </section>
   </div>
@endsection
