<?php



class Notification extends Db_object
{

	protected static $db_table = "notifications";
	protected static $db_table_fields = array('', 'sender_id', 'receiver_id', 'status', 'notification_message', 'action', '');
	public $id;
	public $sender_id;
	public $receiver_id;
	public $status;
	public $notification_message;
	public $action;
	public $date_sent;



	public static function create_notification($sender_id, $receiver_id, $notification_message, $action)
	{
		$notification = new Notification();
		$notification->sender_id = $sender_id;
		$notification->receiver_id = $receiver_id;
		$notification->status = 0;
		$notification->notification_message = $notification_message;
		$notification->action = $action;
		$notification->save();
		return $notification;
	}



	public static function notification($status, $user_id)
	{

		global $database;

		$sql  = "SELECT * FROM " . self::$db_table;
		$sql .= " WHERE status = " . $database->escape_string($status);
		$sql .= " AND receiver_id = " . $database->escape_string($user_id) . " ORDER BY id DESC LIMIT 5";

		return self::find_by_query($sql);
	}

	public static function notification_count($user_id)
	{
		global $database;
		$sql  = "SELECT * FROM " . self::$db_table;
		$sql .= " WHERE status = 0 ";
		$sql .= " AND receiver_id = " . $database->escape_string($user_id) . " ORDER BY id DESC";
		$count = self::find_by_query($sql);
		return count($count);
	}
} // End of Class User
