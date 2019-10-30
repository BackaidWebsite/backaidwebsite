@extends('layouts.layout')

@section('title', "Edit Thread")

@section('content')

<!-- edit thread page for users/admins -->
<h4>Edit Thread</h4>

<hr>

{!! Form::model($thread, ['route' => ['forums.update', $thread->threadID], 'method' => 'PUT']) !!}
    <div class="form-group">
        <label>Thread Topic:</label>
        <input name="threadTopic" value = "{{ $thread->threadTopic }}" class="form-control input-lg"></input>
    </div>
    <div class="form-group">
        {{ Form::label('categoryID', "Category:", ['class' => 'form-spacing-top']) }}
	    {{ Form::select('categoryID', $categories, null, ['class' => 'form-control']) }}
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="form-group">
                <label class="">Created at:</label>
                <input  value="{{ date('M j, Y h:ia', strtotime($thread->created_at)) }}" class="form-control input-lg" disabled>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="form-group">
                <label class="">Last Updated:</label>
                <input  value="{{ date('M j, Y h:ia', strtotime($thread->updated_at)) }}" class="form-control input-lg" disabled>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="form-spacing-top">Content:</label>
        <textarea class="form-control" name="threadContent" id="thread_body" rows="5">{!! $thread->threadContent !!}</textarea>
    </div>
    {{ csrf_field() }}
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Save Changes" name="status"></input>
        <button value="back" name="status" class="btn btn-danger ">Cancel</button>
    </div>
{!! Form::close() !!}

<!-- html editor -->
<script>
tinymce.init
({
  path_absolute : "/",
  menubar: false,
  selector: '#thread_body',
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
