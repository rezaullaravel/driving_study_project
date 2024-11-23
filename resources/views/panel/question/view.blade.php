@extends('panel.master')

@section('title')
Question Details
@endsection

@section('content')
<div class="dd-content">

    @include('panel.partials.header')

    <section class="container-fluid">
      <div class="card">
        <div class="card-header mb-4">
          <h5 class="card-title">Question Details</h5>

          <div style="float: right;">

                  <a href="{{ route('question.index') }}" class="btn btn-primary btn-sm">
                    <i class="las la-arrow-circle-left"></i>Back
                 </a>

          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-">
            <tbody>
                <tr>
                    <th width="300" class="text-center">Licence Type</th>
                    <td>{{ $question->licence_type_name }}</td>
                </tr>

                <tr>
                    <th width="300" class="text-center">Topic</th>
                    <td>{{ $question->topic_name }}</td>
                </tr>

                <tr>
                    <th width="300" class="text-center">Chapter</th>
                    <td>{{ $question->chapter_name }}</td>
                </tr>

                <tr>
                    <th width="300" class="text-center">Lesson</th>
                    <td>{{ $question->lesson }}</td>
                </tr>

                <tr>
                    <th width="300" class="text-center">Language</th>
                    <td>{{ $question->language_name }}</td>
                </tr>



                <tr>
                    <th width="300" class="text-center">Question</th>
                    <td>{!! $question->question_text !!}</td>
                </tr>

                <tr>
                    <th width="300" class="text-center">Option1</th>
                    <td>{!! $question->option1 !!}</td>
                </tr>

                <tr>
                    <th width="300" class="text-center">Option2</th>
                    <td>{!! $question->option2 !!}</td>
                </tr>

                <tr>
                    <th width="300" class="text-center">Option3</th>
                    <td>{!! $question->option3 !!}</td>
                </tr>

                <tr>
                    <th width="300" class="text-center">Option4</th>
                    <td>{!! $question->option4 !!}</td>
                </tr>

                <tr>
                    <th width="300" class="text-center">Correct Ans</th>
                    <td>{!! $question->correct_ans !!}</td>
                </tr>



            </tbody>
          </table>
        </div>
      </div>
    </section>
   </div>
@endsection
