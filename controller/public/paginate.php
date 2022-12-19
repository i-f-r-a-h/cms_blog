<?php




$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;


$items_per_page = 4;


$items_total_count = Post::count_all();



$paginate = new Paginate($page, $items_per_page, $items_total_count);


$sql = "SELECT * FROM posts WHERE post_status = 'published' ";
$sql .= "LIMIT {$items_per_page} ";
$sql .= "OFFSET " . $paginate->offset() . "  ";
$posts = Post::find_by_query($sql);



// $posts = Post::find_all();
