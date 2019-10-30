<div class="modal fade" id="replies" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

      <form action="" id="update_reply" method="post">
          <div class="modal-content">
              <div class="modal-body">
                  @method('PUT')
                  {{ csrf_field() }}
                  @if(Auth::user()->isSuperAdmin())
                  <div class="form-group">
                      <label>Name:</label>
                      <input name="name" value = "" id="name_reply" class="form-control" disabled></input>
                  </div>
                  <div class="form-group">
                      <label>Email:</label>
                      <input id="email_reply" name="email" value = ""  class="form-control" disabled></input>
                  </div>
                  <div class="form-group">
                      <label class="form-spacing-top">Reply:</label>
                      <textarea class="form-control" rows="5" id="content_reply" name="reply"></textarea>
                  </div>
                  @else
                   <input id="name_reply" type="hidden">
                      <input id="email_reply" type="hidden">
                  <div class="form-group">
                      <label class="form-spacing-top">Reply:</label>
                      <textarea class="form-control" rows="5" id="content_reply" name="reply"></textarea>
                  </div>
                   @endif
              </div>
              <div class="modal-footer">
                  <div class="container" name="prompt">
                      <button type="button" class="btn btn-danger text-center" data-dismiss="modal">Cancel</button>
                      <button type="submit" name="" class="btn btn-primary" data-dismiss="modal" onclick="formSubmit_reply()">Edit Reply</button>
                  </div>
              </div>
            </div>
      </form>
    </div>
</div>
</div>

<script>
$('#replies').on('shown.bs.modal', function() {
   tinymce.init
   ({
     path_absolute : "/",
     menubar: false,
     selector : '#content_reply',
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
