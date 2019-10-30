@extends('layouts.layout')

@section('title', 'Create thread')

@section('content')

<!-- create thread page for users/admins -->
<h1 name="h1centre">Create Thread</h1>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            {!! Form::open(array('route' => 'forums.store', 'files' => true)) !!}
                <div class="form-group">
                    <label class="">Thread Topic:</label>
                    <input name="threadTopic" class="form-control input-lg" value="{{ old('threadTopic') }}">
                </div>
                <div class="form-group">
                    <label class="form-spacing-top">Category:</label>
                    <select class="form-control" name="category">
                        <option disabled selected value> -- select a category -- </option>
                         @foreach($threadcategories as $category)
                             <option value='{{ $category->categoryID }}'>{{ $category->category }}</option>
                         @endforeach
                     </select>
                </div>
                <div class="form-group">
                    <label class="form-spacing-top">Thread Content:</label>
                    <textarea class="form-control" id="user_thread" name="threadContent">{!! old('threadContent') !!}</textarea>
                </div>
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Publish" name="status">
                    <button value="back" name="status" class="btn btn-danger">Cancel</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<!-- html editor-->

<script>
tinymce.init
({
  path_absolute : "/",
  menubar: false,
  selector: '#user_thread',
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
