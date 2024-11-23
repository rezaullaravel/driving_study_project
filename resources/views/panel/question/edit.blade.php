@extends('panel.master')

@section('title')
Question Edit
@endsection

@section('content')
<div class="dd-content">

    @include('panel.partials.header')

    <section class="container-fluid">
       <div class="row">
          <div class="col-sm-12">
            <div class="card">
                <div class="card-header mb-4">
                  <h5 class="card-title">Question Edit</h5>

                  <div style="float: right;">
                          <a href="{{ route('question.index') }}" class="btn btn-primary btn-sm">
                            <i class="las la-arrow-circle-left"></i>Back
                        </a>
                  </div>
                </div>

                <div>
                    <h6 class="text-danger">*Please Edit Question In Selected Language</h6>
                </div>
                <form action="{{route('question.update',$question->id)}}" method="POST" class="mt-3">
                    @csrf
                    <div class="form-group">
                        <label for="book_id">Topic Name</label>
                        <select name="book_id" id="book_id" class="form-select form-select-sm mt-2" required>
                            <option value="">Select a Topic</option>
                            @foreach($books as $book)
                                <option value="{{ $book->id }}" {{ $question->book_id==$book->id ? 'selected':'' }}>{{ $book->topic_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mt-4">
                        <label for="chapter_name">Chapter Name</label>
                        <input type="text" name="chapter_name" value="{{ $question->chapter_name }}" id="chapter_name" class="form-control form-control-sm mt-2" required readonly>
                        <input type="hidden" name="chapter_id" value="{{ $question->chapter_id }}" id="chapter_id">
                    </div>

                    <div class="form-group mt-4">
                        <label for="language_name">Language</label>
                        <input type="text" name="language_name" value="{{ $question->language_name }}" id="language_name" class="form-control form-control-sm mt-2" required readonly>
                        <input type="hidden" name="language_id" value="{{ $question->language_id }}" id="language_id">
                    </div>


                    <div class="form-group mt-4">
                        <label for="language_name">Licence Type</label>
                        <input type="text" name="licence_type_name" value="{{ $question->licence_type_name }}" id="licence_type_name" class="form-control form-control-sm mt-2" required readonly>
                        <input type="hidden" name="licence_type_id" value="{{ $question->licence_type_id }}" id="licence_type_id">
                    </div>

                    <div class="form-group mt-4">
                        <label for="lesson">Lesson</label>
                        <input type="text" name="lesson" value="{{ $question->lesson }}" id="lesson" class="form-control form-control-sm mt-2" required readonly>
                    </div>

                    <div class="form-group mt-4">
                        <label for="question_text">Question Text</label>
                        <textarea name="question_text" id="question_text" class="form-control form-control-sm mt-2" required>{{ $question->question_text }}</textarea>
                    </div>

                    <div class="form-group mt-4">
                        <label for="option1">Option 1</label>
                        <input type="text" name="option1" value="{{ $question->option1 }}" id="option1" class="form-control form-control-sm mt-2" required>
                    </div>

                    <div class="form-group mt-4">
                        <label for="option2">Option 2</label>
                        <input type="text" name="option2" value="{{ $question->option2 }}" id="option2" class="form-control form-control-sm mt-2" required>
                    </div>

                    <div class="form-group mt-4">
                        <label for="option3">Option 3</label>
                        <input type="text" name="option3" value="{{ $question->option3 }}" id="option3" class="form-control form-control-sm mt-2" required>
                    </div>

                    <div class="form-group mt-4">
                        <label for="option4">Option 4</label>
                        <input type="text" name="option4" value="{{ $question->option4 }}" id="option4" class="form-control form-control-sm mt-2" required>
                    </div>

                    <div class="form-group mt-4">
                        <label for="correct_ans">Correct Answer</label>
                        <select name="correct_ans" id="correct_ans" class="form-select form-select-sm mt-2" required>
                            <option value="" selected disabled>Select</option>
                            <option value="option1" {{ $question->correct_ans=='option1'? 'selected':'' }}>Option 1</option>
                            <option value="option2" {{ $question->correct_ans=='option2'? 'selected':'' }}>Option 2</option>
                            <option value="option3" {{ $question->correct_ans=='option3'? 'selected':'' }}>Option 3</option>
                            <option value="option4" {{ $question->correct_ans=='option4'? 'selected':'' }}>Option 4</option>
                        </select>
                    </div>

                    <div class="form-group mt-4">
                        <label for="difficulty_level">Difficulty Level</label>
                        <select name="difficulty_level" id="difficulty_level" class="form-select form-select-sm mt-2" required>
                            <option value="" selected disabled>Select</option>
                            <option value="easy" {{ $question->difficulty_level=='easy' ? 'selected':'' }}>Easy</option>
                            <option value="medium" {{ $question->difficulty_level=='medium' ? 'selected':'' }}>Medium</option>
                            <option value="hard" {{ $question->difficulty_level=='hard' ? 'selected':'' }}>Hard</option>
                        </select>
                    </div>

                    <div class="form-group mt-4">
                        <label for="is_active">Paid Status</label>
                        <select name="paid_status" id="paid_status" class="form-select form-select-sm mt-2" required>
                            <option value="" selected disabled>Select</option>
                            <option value="1" {{ $question->paid_status=='1'? 'selected':'' }}>Yes</option>
                            <option value="0" {{ $question->paid_status=='0'? 'selected':'' }}>No</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm mt-3">Update Question</button>
                </form>
              </div>{{-- end card --}}
          </div>
       </div>{{-- row --}}
    </section>
   </div>

   <script>
    $(document).ready(function() {
        $('#book_id').change(function() {
            var book_id = $(this).val();
            //alert(book_id);
            if (book_id) {
                $.ajax({
                    url: '{{ route("question.getBookDetails") }}',
                    type: 'GET',
                    data: { book_id: book_id },
                    success: function(data) {
                        //console.log(data);
                        $('#chapter_name').val(data.chapter_name);
                        $('#chapter_id').val(data.chapter_id);
                        $('#language_name').val(data.language_name);
                        $('#language_id').val(data.language_id);
                        $('#licence_type_name').val(data.licence_type_name);
                        $('#licence_type_id').val(data.licence_type_id);
                        $('#lesson').val(data.lesson);
                    }
                });
            }
        });
    });
</script>
@endsection
