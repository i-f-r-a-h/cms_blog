<?php



class Like extends Db_object
{

	protected static $db_table = "likes";
	protected static $db_table_fields = array('', 'user_id', 'post_id');
	public $id;
	public $user_id;
	public $post_id;



	public function userLikedThisPost($user_id, $post_id)
	{
		global $database;
		$sql = ("SELECT * FROM " . self::$db_table . " WHERE user_id={$user_id} AND post_id={$post_id} ");
		$result = $database->query($sql);
		return mysqli_num_rows($result) >= 1 ? true : false;
	}

	public static function deletelike($user_id, $post_id)
	{
		global $database;
		$sql = ("DELETE FROM " . self::$db_table . " WHERE user_id={$user_id} AND post_id={$post_id} ");
		$result = $database->query($sql);
		return mysqli_num_rows($result) >= 1 ? true : false;
	}
} // End of Class Like
