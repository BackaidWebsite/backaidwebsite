<div class="modal fade" id="user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

      <form action="" id="update_user" method="post">
          <div class="modal-content">
              <div class="modal-body">
                  @method('PUT')
                  {{ csrf_field() }}
                  <div class="form-group">
                      <label>Name:</label>
                      <input name="name" value = "" id="name_user" class="form-control"></input>
                  </div>
                  <div class="form-group">
                      <label>Email:</label>
                      <input id="email_user" name="email" value = ""  class="form-control" disabled></input>
                  </div>
              </div>
              <div class="modal-footer">
                  <div class="container" name="prompt">
                      <button type="button" class="btn btn-danger text-center" data-dismiss="modal">Cancel</button>
                      <button type="submit" name="" class="btn btn-primary" data-dismiss="modal" onclick="formSubmit_user()">Edit User</button>
                  </div>
              </div>
            </div>
      </form>
    </div>
</div>
</div>
