@extends('layouts.layout')

@section('title',"Create Article")

@section('content')
@php
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\Input;
@endphp
<!-- create article -->
<h4>Add Article</h4>
<hr>
{!! Form::open(array('route' => 'articles.store', 'files' => true)) !!}
    <div class="form-group">
        <label class="">Article Title:</label>
        <input name="articleTitle" class="form-control input-lg" value="{{ old('articleTitle') }}">
    </div>
    <div class="form-group">
        <!-- categories for articles-->
        <label class="form-spacing-top">Category:</label>
        <select class="form-control" name="category" >
            <option disabled selected value> -- select a category -- </option>
            @foreach($articlecategories as $category)
                <option value="{{ $category->categoryID }}" {{ (Input::old("category") == $category->categoryID ? "selected":"") }}>{{ $category->category }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label class="">Slug:</label>
        <input name="slug" class="form-control input-lg"  value="{{ old('slug') }}">
        <small  class="form-text text-muted">
            The slug - i.e. {{ route('userarticles.show', '') }}/<u><em>this part</em></u>
        </small>
    </div>
    <div class="form-group">
        <label name="articleContent" class="form-spacing-top">Body:</label>
        <textarea class="form-control" name="articleContent">{!! old('articleContent') !!}</textarea>
    </div>
    {{ csrf_field() }}
    <div class="form-group">
        <input type="submit" class="btn btn-success" value="Save as Draft" name="status">
        <input type="submit" class="btn btn-primary" value="Publish" name="status">
        <button value="back" name="status" class="btn btn-danger ">Cancel</button>
    </div>
{!! Form::close() !!}




<!-- html editor-->
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


      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name+'&lang='+ tinymce.settings.language;
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
