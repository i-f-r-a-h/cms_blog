<?php


defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

define('SITE_ROOT', DS . 'Applications' . DS . 'XAMPP' . DS . 'xamppfiles' . DS . 'htdocs' . DS .  'blog');


defined('INCLUDES_MODAL') ? null : define('INCLUDES_PATH', SITE_ROOT . DS . 'modal');
defined('INCLUDES_ENGINE') ? null : define('INCLUDES_ENGINE', SITE_ROOT . DS . 'modal' . DS . 'engine');

defined('IMAGES_PATH') ? null : define('IMAGES_PATH', SITE_ROOT . DS . 'view' . DS .  'admin' . DS . 'images');

//database
require_once(INCLUDES_ENGINE . DS . "config.php");
require_once(INCLUDES_ENGINE . DS . "database.php");
require_once(INCLUDES_ENGINE . DS . "db_object.php");

require_once(INCLUDES_PATH . DS . "functions.php");
require_once(INCLUDES_PATH . DS . "user.php");
require_once(INCLUDES_PATH . DS . "posts.php");
require_once(INCLUDES_PATH . DS . "comment.php");
require_once(INCLUDES_PATH . DS . "session.php");
require_once(INCLUDES_PATH . DS . "paginate.php");
require_once(INCLUDES_PATH . DS . "register.php");
require_once(INCLUDES_PATH . DS . "like.php");
require_once(INCLUDES_PATH . DS . "sae.php");
require_once(INCLUDES_PATH . DS . "notification.php");
