<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form action="" id="update" method="post">
          <div class="modal-content">

              <div class="modal-body">
                  @method('PUT')
                  {{ csrf_field() }}
                  @if(Auth::user()->isSuperAdmin())
                  <div class="form-group">
                      <label>Name:</label>
                      <input name="name" value = "" id="name" class="form-control" disabled></input>
                  </div>
                  <div class="form-group">
                      <label>Email:</label>
                      <input id="email" name="email" value = ""  class="form-control" disabled></input>
                  </div>
                  <div class="form-group">
                      <label class="form-spacing-top">Comment:</label>
                      <textarea class="form-control" rows="5" id="content_comment" name="comment"></textarea>
                  </div>
                  @else
                   <input id="name" type="hidden">
                      <input id="email" type="hidden">
                  <div class="form-group">
                      <label class="form-spacing-top">Comment:</label>
                      <textarea class="form-control" rows="5" id="content_comment" name="comment"></textarea>
                  </div>
                  @endif
              </div>
              <div class="modal-footer">
                  <div class="container" name="prompt">
                      <button type="button" class="btn btn-danger text-center" data-dismiss="modal">Cancel</button>
                      <button type="submit" name="" class="btn btn-primary" data-dismiss="modal" onclick="formSubmit_comment()">Edit Comment</button>
                  </div>
              </div>
            </div>
        </form>
        </div>
    </div>
</div>

<script>
$('#edit').on('shown.bs.modal', function() {
   tinymce.init
   ({
     path_absolute : "/",
     menubar: false,
     selector : '#content_comment',
     plugins: [
       "advlist autolink lists link image charmap print preview hr anchor pagebreak",
       "searchreplace wordcount visualblocks visualchars code fullscreen",
       "insertdatetime media nonbreaking save table contextmenu directionality",
       "template paste textcolor colorpicker textpattern autoresize"
     ],
     toolbar: "bold italic | bullist numlist emoticons | link insertdatetime",
     relative_urls: false,

    });
});
</script>
