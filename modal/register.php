<?php



class Register extends Db_object
{

	//empty or unset fields
	public function issetCheck($value)
	{
		if (!isset($_POST['' . $value . '']) || empty($_POST['' . $value . ''])) {
			return true;
		} else {
			return false;
		}
	}


	public function validateUsername()
	{
		if (USER::username_exists($_POST['username'])) {
			return  "<li>The name " . $_POST['username'] . " is taken. Try " . User::generate_unique_username($_POST['username']) . " instead.</li>";
		} else {
			return false;
		}
	}

	public static function validatePassword()
	{
		if (preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $_POST['user_password']) === 0) {
			return "<li>Invalid password.</li>";
		} else {
			return false;
		}
	}

	public static function validateTel()
	{
		if (preg_match('/^((\+44(\s\(0\)\s|\s0\s|\s)?)|0)7\d{3}(\s)?\d{6}$/', $_POST['user_tel']) === 0) {
			return "<li>Invalid phone number.</li>";
		} else {
			return false;
		}
	}
	public static function validateEmail()
	{
		$email_found = User::email_exists($_POST['user_email']);

		if ($email_found) {
			return "<li>This email is already registered <a href='login.php'>login here </a></li>";
		} else {
			return false;
		}

		if (preg_match('/^([a-zA-Z0-9\._-]+)@([a-zA-Z0-9\._-]+).([a-z]{2,5})$/', $_POST['user_email']) === 0) {
			return "<li>Invalid email address </li>";
		} else {
			return false;
		}
	}

	public static function insertRegister()
	{
		$register = new User();
		$register->first_name = $_POST['first_name'];
		$register->last_name = $_POST['last_name'];
		$date = $_POST['user_dob'];
		$user_date = date("Y-m-d", strtotime($date));
		$register->user_dob = $user_date;
		$register->user_gender = $_POST['user_gender'];
		$register->course = $_POST['course'];
		$register->campus = $_POST['campus'];
		$register->profession = $_POST['profession'];
		$register->level_of_study = $_POST['level_of_study'];
		$register->user_email = $_POST['user_email'];
		$register->username = $_POST['username'];
		$register->user_tel = $_POST['user_tel'];
		$register->set_file($_FILES['profile-pic']);
		$register->password = password_hash($_POST['user_password'], PASSWORD_BCRYPT, array('cost' => 12));
		$register->save();
		header("Refresh:3; url=login.php");
	}


	public static function updateRegister($id)
	{
		$register = User::find_by_id($id);
		$register->first_name = $_POST['first_name'];
		$register->last_name = $_POST['last_name'];
		$date = $_POST['user_dob'];
		$user_date = date("Y-m-d", strtotime($date));
		$register->user_dob = $user_date;
		$register->user_gender = $_POST['user_gender'];
		$register->course = $_POST['course'];
		$register->campus = $_POST['campus'];
		$register->profession = $_POST['profession'];
		$register->level_of_study = $_POST['level_of_study'];
		$register->user_tel = $_POST['user_tel'];
		$register->save();
		redirect('index.php');
	}


	protected function insertAccount()
	{
		$currentInfo = User::find_by_id($_GET['id']);
		$currentInfo->username = $_POST['username'];
		$currentInfo->password = $_POST['password'];
		$currentInfo->save();
		header('Location:' . $_SERVER['PHP_SELF'] . '?id=' . $currentInfo->id . '&token=' . $currentInfo->username);
	}
} // End of Class Like
