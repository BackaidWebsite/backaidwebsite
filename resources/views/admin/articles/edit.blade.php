@extends('layouts.layout')

@section('title',"Edit Article")

@section('content')
<!-- Edit Article -->
<h4>Edit Article</h4>

<hr>
    {!! Form::model($article, ['route' => ['articles.update', $article->articleID], 'method' => 'PUT', 'files' => true]) !!}

            <div class="form-group">
                <label>Title:</label>
                <input name="articleTitle" value = "{{ $article->articleTitle }}" class="form-control input-lg"></input>
            </div>
            <div class="form-group">

			{{ Form::label('categoryID', "Category:", ['class' => 'form-spacing-top']) }}
			{{ Form::select('categoryID', $categories, null, ['class' => 'form-control']) }}
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="">Slug:</label>
                        <input name="slug" value="{{ $article->slug }}" class="form-control input-lg">
                        <small  class="form-text text-muted">
                            The slug - i.e. {{ route('userarticles.show', '') }}/<u><em>this part</em></u>
                        </small>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="">Created at:</label>
                        <input  value="{{ date('M j, Y h:ia', strtotime($article->created_at)) }}" class="form-control input-lg" disabled>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="">Last Updated:</label>
                        <input  value="{{ date('M j, Y h:ia', strtotime($article->updated_at)) }}" class="form-control input-lg" disabled>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="form-spacing-top">Body:</label>
                <textarea class="form-control" name="articleContent" rows="100">{!! $article->articleContent !!}</textarea>
            </div>

             @method('PUT')
            {{ csrf_field() }}
            @if($article->status == 'Draft')
            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Save Draft" name="status">
                <input type="submit" class="btn btn-primary " value="Publish" name="status">
                <button value="back" name="status" class="btn btn-danger ">Cancel</button>
            </div>
            @else
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Save Changes" name="status"></input>
                <button value="back" name="status" class="btn btn-danger ">Cancel</button>
                </div>
            @endif
</form>


<!-- html editor -->
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
  var editor_config = {
    path_absolute : "/",
    selector: "textarea",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern autoresize"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
</script>
@endsection
