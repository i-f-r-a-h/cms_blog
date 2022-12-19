<?php



class sae_level_of_study extends Db_object
{

	protected static $db_table = "sae_level_of_study";
	protected static $db_table_fields = array('', 'level');
	public $id;
	public $level;
}



class sae_courses extends Db_object
{

	protected static $db_table = "sae_courses";
	protected static $db_table_fields = array('', 'course_name', 'course_duration', 'course_type');
	public $id;
	public $course_name;
	public $course_duration;
	public $course_type;
}

class sae_campus extends Db_object
{

	protected static $db_table = "sae_campus";
	protected static $db_table_fields = array('', 'campus_name', 'campus_address');
	public $id;
	public $campus_name;
	public $campus_address;
}
