<div id="register" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Register</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="" name="regForm" id="regForm">
            <div id="alert_register">
            </div>
            <div class="form-group">
              <label for="runame">Username</label>
              <input class="form-control" placeholder="Enter Username" name="runame" type="text" value="" id="runame" autofocus>
            </div>
            <div class="form-group">
              <label for="rpassword">Password</label>
              <input class="form-control" placeholder="Enter Password" name="rpassword" type="password" value="" id="rpassword">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input class="form-control" placeholder="Enter Email Address" name="email" type="text" value="" id="email">
            </div>
            <button class="btn btn-primary" id="regsub" type="button">Register</button>
        </form>
      </div>
    </div>
  </div>
</div>
