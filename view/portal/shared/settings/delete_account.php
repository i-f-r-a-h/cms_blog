      <?php require_once("../../../../controller/account/settings/delete_account.php"); ?>

      <div class="col-lg-8 d-flex flex-column">
          <h2 class="mb-3 fs-3 text-danger">Danger Zone</h2>
          <!-- comments -->
          <div class="row flex-grow mt-4">
              <div class="col-12 grid-margin">
                  <div class="card card-rounded">
                      <div class="card-body">
                          <?php echo $the_message ?>
                          <p>Delete account</p>
                          <ul>
                              <li>This is a irreversible process which means you will not be able to recover your account</li>
                              <li>Your username will become available to take by author users</li>
                              <li>All saved data linked to your account will be deleted</li>
                          </ul>
                          <form class="forms-sample" method="post" enctype="multipart/form-data">
                              <div class="form-group">
                                  <input type="hidden" id="delete_account" name="delete_account">

                                  <button type="submit" name="delete_account" class="btn btn-danger me-2">Delete account</button>
                          </form>
                      </div>
                  </div>
              </div>



          </div>

      </div>