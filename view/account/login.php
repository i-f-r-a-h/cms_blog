<?php include("../includes/header.php"); ?>

<?php require_once("../../controller/account/login.php"); ?>

<div class="vh-100">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-6 text-black">



				<div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 ">

					<form method="POST" style="width: 23rem;">

						<h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>
						<?php echo $the_message; ?>
						<?php echo "<p class='bg-success'>$message</p>" ?>
						<div class="form-outline mb-4">
							<label class="form-label" for="username">Username</label>
							<input type="text" class="form-control form-control-lg" name="username" value="<?php echo htmlentities($username); ?>">
						</div>

						<div class="form-outline mb-4">
							<label lass="form-label" for="password">Password</label>
							<input type="password" class="form-control form-control-lg" name="password" value="<?php echo htmlentities($password); ?>">
						</div>

						<div class="pt-1 mb-4">
							<input type="submit" name="submit" value="Submit" class="btn btn-info btn-lg btn-block">
						</div>

						<p class="small mb-5 pb-lg-2"><a class="text-muted" href="./forgot-password.php">Forgot password?</a></p>
						<p>Don't have an account? <a href="./register.php" class="link-info">Register here</a></p>

					</form>

				</div>

			</div>
			<div class="col-sm-6 px-0 d-none d-sm-block">
				<img src="../images/login.jpg" alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
			</div>
		</div>
	</div>
</div>



<?php include("../includes/footer.php"); ?>