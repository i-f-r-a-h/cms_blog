<?php



class User extends Db_object
{

	protected static $db_table = "users";
	protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'user_image', 'user_code', 'user_email', 'user_dob', 'user_tel', 'level_of_study', 'profession', 'course', 'campus', 'user_gender', 'user_role');
	public $id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;
	public $user_image;
	public $user_code;
	public $user_email;
	public $user_dob;
	public $user_tel;
	public $level_of_study;
	public $profession;
	public $course;
	public $campus;
	public $user_gender;
	public $tmp_path;
	public $user_role;
	public $upload_directory = "images";
	public $image_placeholder = "placeholder.jpeg";



	public function set_file($file)
	{

		if (empty($file) || !$file || !is_array($file)) {
			$this->errors[] = "There was no file uploaded here";
			return false;
		} elseif ($file['error'] != 0) {

			$this->errors[] = $this->upload_errors_array[$file['error']];
			return false;
		} else {


			$this->filename =  basename($file['name']);
			$this->tmp_path = $file['tmp_name'];
		}
	}


	public function upload_photo()
	{
		if (!empty($this->errors)) {

			return false;
		}

		if (empty($this->user_image) || empty($this->tmp_path)) {
			$this->errors[] = "the file was not available";
			return false;
		}

		$target_path = SITE_ROOT . DS . $this->upload_directory . DS . $this->user_image;


		if (file_exists($target_path)) {
			$this->errors[] = "The file {$this->user_image} already exists";
			return false;
		}

		if (move_uploaded_file($this->tmp_path, $target_path)) {
			unset($this->tmp_path);
			return true;
		} else {

			$this->errors[] = "the file directory probably does not have permission";
			return false;
		}
	}












	public function image_path_and_placeholder()
	{

		return empty($this->user_image) ? $this->upload_directory . DS . $this->image_placeholder : $this->upload_directory . DS . $this->user_image;
	}




	public static function verify_user($username)
	{
		global $database;
		$the_result_array = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE username = '$username' LIMIT 1");

		return !empty($the_result_array) ? array_shift($the_result_array) : false;
	}

	public static function email_exists($email)
	{
		global $database;

		$email = $database->escape_string($email);

		$sql = "SELECT * FROM " . self::$db_table . " WHERE ";
		$sql .= "user_email = '{$email}' ";
		$sql .= "LIMIT 1";

		$the_result_array = self::find_by_query($sql);

		return !empty($the_result_array) ? array_shift($the_result_array) : false;
	}

	public static function username_exists($username)
	{
		global $database;

		$username = $database->escape_string($username);

		$sql = "SELECT * FROM " . self::$db_table . " WHERE ";
		$sql .= "username = '$username' ";
		$sql .= "LIMIT 1";

		$the_result_array = self::find_by_query($sql);

		return !empty($the_result_array) ? array_shift($the_result_array) : false;
	}

	public static function generate_unique_username($username)
	{
		$isAvailable = false; //initialize available with false
		// loop through randomized usernames
		do {
			$availableUserName = $username . rand(1, 1000);
			$isAvailable = self::username_exists($availableUserName);
			if (!$isAvailable) {
				break;
			}
		} while ($isAvailable);
		return $availableUserName;
	}

	public function ajax_save_user_image($user_image, $user_id)
	{


		global $database;

		$user_image = $database->escape_string($user_image);
		$user_id = $database->escape_string($user_id);

		$this->user_image = $user_image;
		$this->id         = $user_id;
		$sql  = "UPDATE " . self::$db_table . " SET user_image = '{$this->user_image}' ";
		$sql .= " WHERE id = {$this->id} ";
		$update_image = $database->query($sql);


		echo $this->image_path_and_placeholder();
	}




	public function delete_photo()
	{


		if ($this->delete()) {

			$target_path = SITE_ROOT . DS . 'portal' . DS . $this->upload_directory . DS . $this->user_image;

			return unlink($target_path) ? true : false;
		} else {

			return false;
		}
	}
} // End of Class User
