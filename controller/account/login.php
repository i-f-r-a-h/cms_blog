<?php

$the_message = "";
if ($session->is_signed_in()) {
	redirect("../public/index.php");
}

if (isset($_POST['submit'])) {

	$username = trim($_POST['username']);
	$password = trim($_POST['password']);


	/// Method to check database user


	$user_found = User::verify_user($username);

	if ($user_found) {
		if (password_verify($password, $user_found->password)) {
			$session->login($user_found);
			header("Refresh:3; url=../portal/index.php");
			$the_message = '<h5 class="bg-success p-2 text-white"> login successful. Redirecting...</h5>';
		} else {
			$the_message = "<div class='bg-danger p-2 text-white'> <p class='mb-0'>Please correct the following error(s)</p><ul class='pl-5'>";
			if (empty($_POST['password']) || !isset($_POST['password'])) {
				$the_message .= "<li>Your password is required and cannot be blank</li>";		//check password
			} else {
				$the_message .= "<li>Your password or username are incorrect</li>";	   // check valid input
			}
			$the_message .= '</ul></p></div>';
		}
	} else {
		$the_message = "<div class='bg-danger p-2 text-white'> <p class='mb-0'>Please correct the following error(s)</p><ul class='pl-5'>";
		$the_message .= "<li>Your password or username are incorrect</li>";
		if (empty($_POST['username']) || !isset($_POST['username'])) {
			$the_message .= "<li>Your username is required and cannot be blank</li>";		//check username
		}

		$the_message .= '</ul></p></div>';
	}
} else {
	$the_message = "";
	$username = "";
	$password = "";
}
