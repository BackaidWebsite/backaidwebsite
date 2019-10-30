@extends('layouts.layout')

@section('title',"Add Thread")

@section('content')
@php
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\Input;
@endphp
<!-- Create thread for admins -->
<h4>Add Thread</h4>
<hr>
{!! Form::open(array('route' => 'forum.store', 'files' => true)) !!}
    <div class="form-group">
        <label class="">Thread Topic:</label>
        <input name="threadTopic" class="form-control input-lg" value="{{ old('threadTopic') }}">
    </div>
    <div class="form-group">
        <label class="form-spacing-top">Category:</label>
        <select class="form-control" name="category">
            <option disabled selected value> -- select a category -- </option>
            @foreach($threadcategories as $category)
                <option value="{{ $category->categoryID }}" {{ (Input::old("category") == $category->categoryID ? "selected":"") }}>{{ $category->category }}</option>
             @endforeach
        </select>
    </div>
    <div class="form-group">
        <label name="articleContent" class="form-spacing-top">Thread Content:</label>
        <textarea class="form-control" id="new_thread" name="threadContent">{!! old('threadContent') !!}</textarea>
    </div>
    {{ csrf_field() }}
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Publish" name="status">
    </div>
{!! Form::close() !!}

<!-- html editor-->
<script>
tinymce.init
({
  path_absolute : "/",
  menubar: false,
  selector: '#new_thread',
  plugins: [
    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
    "searchreplace wordcount visualblocks visualchars code fullscreen",
    "insertdatetime media nonbreaking save table contextmenu directionality",
    "template paste textcolor colorpicker textpattern autoresize"
  ],
  toolbar: "bold italic | bullist numlist emoticons | link insertdatetime",
  relative_urls: false,


 });
</script>
@endsection
