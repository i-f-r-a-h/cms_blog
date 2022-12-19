<?php



$sql = "SELECT * FROM posts WHERE post_status = 'published' ";
$sql .= "ORDER BY id DESC ";
$sql .= "LIMIT 3";
$posts = Post::find_by_query($sql);
