<?php



class Comment extends Db_object
{

	protected static $db_table = "comments";
	protected static $db_table_fields = array('', 'post_id', 'author', 'body', 'comment_status');
	public $id;
	public $post_id;
	public $author;
	public $body;
	public $comment_date;
	public $comment_status;


	public static function create_comment($post_id, $author, $body)
	{


		if (!empty($post_id) && !empty($author) && !empty($body)) {

			$comment = new Comment();

			$comment->post_id = (int)$post_id;
			$comment->author   = $author;
			$comment->body     = $body;
			$comment->comment_status = 'approved';
			$comment->comment_date;
			$comment->save();
			return $comment;
		} else {
			return false;
		}
	}



	public static function find_the_comments($photo_id = 0)
	{

		global $database;

		$sql  = "SELECT * FROM " . self::$db_table;
		$sql .= " WHERE post_id = " . $database->escape_string($photo_id);
		$sql .= " AND comment_status='approved' ORDER BY post_id ASC";

		return self::find_by_query($sql);
	}

	public static function comment_count($photo_id)
	{
		global $database;
		$sql  = "SELECT * FROM " . self::$db_table;
		$sql .= " WHERE post_id = " . $database->escape_string($photo_id);
		$sql .= " ORDER BY post_id ASC";
		$count = self::find_by_query($sql);
		return count($count);
	}
} // End of Class User
