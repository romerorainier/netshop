<div id="login" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="" id="log_form">
              <div id="alert_login">
              </div>
              <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" placeholder="Enter Username" name="username" type="text" value="" id="username" autofocus>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" placeholder="Enter Password" name="password" type="password" value="" id="password">
              </div>
              <input class="btn btn-primary" id="logsub" type="button" value="Login">
          </form>
      </div>
    </div>
  </div>
</div>
