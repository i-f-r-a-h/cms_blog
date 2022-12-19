<?php


if (isset($_GET['profile'])) {
    $profile =  $_GET['profile'];
} else {
    $profile =  $session->user_id;
}

//own profile information
$user = USER::find_by_id($profile);
//your comments
$comments = Comment::find_all_where('author', $profile, ' ORDER BY id DESC LIMIT 5');

$comment_count = count($comments);
//your posts
$posts = Post::find_all_where('author', $profile);
$post_count = count($posts);

//campus
$campus = sae_campus::find_by_id($user->campus);
