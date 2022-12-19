<?php include("../includes/header.php"); ?>
<?php require_once("../../controller/account/forgot-password.php"); ?>

<!-- Page Content -->

<div class="container padding-bottom-5x mb-5 pb-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="forgot">

                <h2>Forgot your password?</h2>
                <p>Change your password in three easy steps. This will help you to secure your password!</p>
                <ol class="list-unstyled">
                    <li><span class="text-primary text-medium">1. </span>Enter your email address below.</li>
                    <li><span class="text-primary text-medium">2. </span>Our system will send you a temporary link</li>
                    <li><span class="text-primary text-medium">3. </span>Use the link to reset your password</li>
                </ol>

                <?php echo $message; ?>


            </div>

            <form method="POST" class="card mt-4">
                <div class="card-body">
                    <?php if (empty($_GET['id'])) { ?>
                        <div class="form-group">
                            <label for="email-for-pass">Enter your email address</label>
                            <input class="form-control" type="text" name="email" id="email-for-pass" placeholder="email address">
                        </div>
                        <div class="card-footer">
                            <input class="btn btn-success" name="recover-submit" type="submit" value="Get New Password">
                            <a href="./login.php" class="btn btn-danger" type="submit">Back to Login</a>
                        </div>
                    <?php } elseif ($_GET['id'] == $user->id && $_GET['token'] == $user->user_code) { ?>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>
                                <input id="password" name="password" placeholder="Enter password" class="form-control" type="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-ok color-blue"></i></span>
                                <input id="confirmPassword" name="confirmPassword" placeholder="Confirm password" class="form-control" type="password">
                            </div>
                        </div>
                        <div class="card-footer">
                            <input class="btn btn-success" name="complete" type="submit" value="Get New Password">
                            <a href="./login.php" class="btn btn-danger" type="submit">Back to Login</a>
                        </div>
                    <?php } else { ?>
                        <h4>Invalid code, please try again or contact the support team</h4>
                        <div class="form-group">
                            <label for="email-for-pass">Enter your email address</label>
                            <input class="form-control" type="text" name="email" id="email-for-pass" placeholder="email address">
                        </div>
                    <?php } ?>
                </div>

                <input type="hidden" class="hide" name="token" id="token" value="">
            </form>
        </div>
    </div>
</div>


<?php include("../includes/footer.php"); ?>