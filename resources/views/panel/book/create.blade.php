@extends('panel.master')

@section('title')
Create Book
@endsection

@section('content')
<div class="dd-content">

    @include('panel.partials.header')

    <section class="container-fluid">
       <div class="row">
         <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Create Book</h5>

                    <div style="float: right;">
                        <a href="{{ route('book.index') }}" class="btn btn-primary btn-sm"><i class="las la-arrow-circle-left"></i>Back</a>
                    </div>
                </div>

                <div>
                    <h6 class="text-danger">*Please Create Book In Selected Language</h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('book.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <strong>Licence Type <span class="text-danger">*</span> </strong>
                                    <select name="licence_type_id" class="form-select form-select-sm mt-2">
                                        <option value="" selected disabled>Select</option>
                                        @foreach ($licencetype as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('licence_type_id')
                                      <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>{{-- row --}}


                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <strong>Language <span class="text-danger">*</span> </strong>
                                    <select name="language_id" class="form-select form-select-sm mt-2">
                                        <option value="" selected disabled>Select Language</option>
                                        @foreach ($languages as $lang)
                                            <option value="{{ $lang->id }}">{{ $lang->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('language_id')
                                      <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-sm-6">
                                <div class="form-group">
                                    <strong>Chapter <span class="text-danger">*</span> </strong>
                                    <select name="chapter_id" class="form-select form-select-sm mt-2">
                                        <option value="" selected disabled>Select</option>

                                    </select>

                                    @error('chapter_id')
                                      <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>{{-- row --}}


                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <strong>Lesson <span class="text-danger">*</span> </strong>
                                    <input type="text" name="lesson" value="{{ old('lesson') }}" class="form-control form-control-sm mt-2" placeholder="Enter Lesson Name">

                                    @error('lesson')
                                      <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <strong>Topic <span class="text-danger">*</span> </strong>
                                    <input type="text" name="topic_name" value="{{ old('topic_name') }}" class="form-control form-control-sm mt-2" placeholder="Enter Topic Name">

                                    @error('topic_name')
                                      <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>{{-- row --}}

                        <div class="row mt-4">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <strong>Topic Description <span class="text-danger">*</span> </strong>
                                    <div class="mt-2"></div>
                                    <textarea name="topic_description" class="form-control form-control-sm mt-2" id="editor"></textarea>

                                    @error('topic_description')
                                      <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>{{-- row --}}


                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <strong>Video Embed Url <span class="text-danger"></span> </strong>
                                    <input type="text" name="video_url" class="form-control form-control-sm mt-2" placeholder="Enter Video Embed Url">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <strong> Paid Status <span class="text-danger">*</span> </strong>
                                    <select name="paid_status" class="form-select form-select-sm mt-2">
                                        <option value="" selected disabled>Select</option>
                                        <option value="1">Paid</option>
                                        <option value="0">Free</option>
                                    </select>
                                </div>
                            </div>
                        </div>{{-- row --}}

                        <button type="submit" class="btn btn-primary btn-sm mt-3">Submit</button>
                    </form>
                </div>
              </div>
         </div>
       </div>{{-- row --}}
    </section>
   </div>

<script src="{{ asset('ckeditor5/ckeditor.js') }}"></script>
<script>
    ClassicEditor
            .create( document.querySelector( '#editor' ),{

            } )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
</script>

{{-- js for chapter auto select start --}}
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="language_id"]').on('change',function(){
            var language_id=$(this).val();
            if(language_id){
                $.ajax({
                    url:"{{ url('/language/chapter/ajax') }}/"+language_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data){
                        var d=$('select[name="chapter_id"]').empty();
                        $.each(data,function(key,value){
                            $('select[name="chapter_id"]').append(
                                '<option value="'+value.chapter_id+'">'+
                                value.name+'</option>');
                        });
                    },
                });
            }else{
                alert('danger');
            }
        });
    });
</script>
{{-- js for chapter auto select end --}}
@endsection
