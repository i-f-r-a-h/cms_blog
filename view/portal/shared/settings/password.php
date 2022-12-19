   <?php require_once("../../../../controller/account/settings/change_password.php"); ?>
   <div class="col-lg-8 d-flex flex-column">
       <h2 class="mb-3 fs-3">Set new password</h2>
       <!-- comments -->
       <div class="row flex-grow">
           <div class="col-12 grid-margin stretch-card">
               <div class="card card-rounded">
                   <div class="card-body">
                       <?php echo $message; ?>
                       <p>Make sure your new password meets the following requirements</p>
                       <ol class="list-unstyled">
                           <li><span class="text-primary text-medium">1. </span>Longer than 8 characters</li>
                           <li><span class="text-primary text-medium">2. </span>Contains at least special character</li>
                           <li><span class="text-primary text-medium">3. </span>Contains at least one number</li>
                       </ol>
                       <form class="forms-sample" method="post" enctype="multipart/form-data">
                           <div class="form-group">
                               <label for="password">Password</label>
                               <div class="input-group">
                                   <span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>
                                   <input id="password" name="password" placeholder="Enter password" class="form-control" type="password">
                               </div>
                           </div>

                           <div class="form-group">
                               <label for="confirmPassword">Confirm New Password</label>
                               <div class="input-group">
                                   <span class="input-group-addon"><i class="glyphicon glyphicon-ok color-blue"></i></span>
                                   <input id="confirmPassword" name="confirmPassword" placeholder="Confirm password" class="form-control" type="password">
                               </div>
                           </div>
                           <button type="submit" name="complete" class="btn btn-primary me-2">Update password</button>
                       </form>
                   </div>
               </div>
           </div>



       </div>

   </div>