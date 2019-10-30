
<div id="DeleteModal" class="modal modal-danger fade" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <form action="" id="deleteForm" method="post">
              <div class="modal-content">
                  <div class="modal-header bg-danger">
                      <div class="container" name="prompt">
                          <h4 class="modal-title text-center">DELETE CONFIRMATION</h4>
                      </div>
                  </div>
                  <div class="modal-body">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <p class="text-center">Are You Sure You Want To Delete ?</p>
                  </div>
                  <div class="modal-footer">
                      <div class="container" name="prompt">
                          <button type="button" class="btn btn-danger text-center" data-dismiss="modal">No, Cancel</button>
                          <button type="submit" name="" class="btn btn-success" data-dismiss="modal" onclick="formSubmit()">Yes, Delete</button>
                      </div>
                  </div>
            </div>
            </form>
        </div>
    </div>
 </div>
