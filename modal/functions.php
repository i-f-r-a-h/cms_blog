<?php

function classAutoLoader($class)
{

	$class = strtolower($class);

	// $the_path = "includes/{$class}.php";

	$the_path = INCLUDES_PATH . DS . "{$class}.php";




	if (is_file($the_path) && !class_exists($class)) {
		require_once($the_path);
	} else {
		die("This file named {$class}.php was not found....");
	}
}

spl_autoload_register("classAutoLoader");
function redirect($location)
{


	header("Location: {$location}");
}




function output_message($message)
{


	return $message;
}
