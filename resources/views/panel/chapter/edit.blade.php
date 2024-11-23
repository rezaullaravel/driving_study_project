@extends('panel.master')

@section('title')
Chapter Edit
@endsection

@section('content')
<div class="dd-content">

    @include('panel.partials.header')

    <section class="container-fluid">
       <div class="row">
         <div class="col-sm-8 offset-sm-2">
            <div class="card">
                <div class="card-header">
                    <h5 style="display: inline;">Chapter Edit</h5>
                    <div style="float: right;">
                        <a href="{{ route('chapter.index') }}" class="btn btn-primary btn-sm"><i class="las la-arrow-circle-left"></i>Back</a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('chapter.update',$chapter->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="chapter_id" value="{{ $chapter->chapter_id }}">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <strong>Chapter Name <span class="text-danger">*</span> </strong>
                                <input type="text" name="name" value="{{ $chapter->name }}" class="form-control form-control-sm mt-2" placeholder="Enter Chapter Name">

                                @error('name')
                                   <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <strong>Language <span class="text-danger">*</span> </strong>
                                <select name="language_id" class="form-select form-select-sm mt-2">
                                    <option value="" selected disabled>Select</option>
                                    @foreach ($languages as $language)
                                        <option value="{{ $language->id }}" {{ $chapter->language_id == $language->id ?'selected':'' }}>{{ $language->name }}</option>
                                    @endforeach
                                </select>

                                @error('language_id')
                                  <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mt-3">Update</button>
                    </form>
                </div>
              </div>
         </div>
       </div>{{-- row --}}
    </section>
   </div>
@endsection
