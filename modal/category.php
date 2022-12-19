<?php



class Category extends Db_object
{

	protected static $db_table = "post_categories";
	protected static $db_table_fields = array('', 'category_title');
	public $id;
	public $category_title;




	public static function category_exists($category)
	{
		global $database;

		$username = $database->escape_string($category);

		$sql = "SELECT * FROM " . self::$db_table . " WHERE ";
		$sql .= "category_title = '$category' ";
		$sql .= "LIMIT 1";

		$the_result_array = self::find_by_query($sql);

		return !empty($the_result_array) ? array_shift($the_result_array) : false;
	}



	public static function article_count($category)
	{
		global $database;

		$post = post::find_all_where('category_id', $category);
		return count($post);
	}
} // End of Class Like
