<?php
if (empty($_GET['id'])) {
    redirect("index.php");
}

$Post = Post::find_by_id($_GET['id']);
$user = user::find_by_id($Post->author);
$FirstId = Post::first_id();
$LastId = Post::last_id();
//paginate
$next = 1;
$previous = 1;
$nextPost = Post::find_by_id($Post->id + $next);
$previousPost = Post::find_by_id($Post->id - $previous);

while (!$nextPost) {
    if ($Post->id == $LastId->id) {
        break;
    }
    $nextPost = Post::find_by_id($Post->id + $next++);
}

while (!$previousPost) {
    if ($Post->id == $FirstId->id) {
        break;
    }
    $previousPost = Post::find_by_id($Post->id - $previous++);
}

$Post->view_count = $Post->view_count + 1;
$Post->save();
//comments
if (isset($_POST['submit'])) {
    $author = $session->user_id;
    $new_comment = Comment::create_comment($Post->id, $author, $body = $_POST['body']);
    if ($new_comment) {
        $session->message("Your comment has been added");
    } else {
        $session->message("Comment cannot be blank");
    }
}
$comments = Comment::find_the_comments($Post->id);



//likes
$likes = new Like();
if (isset($_POST['liked'])) {
    $Post->likes = $Post->likes + 1;
    $Post->save();

    $likes->user_id = $session->user_id;
    $likes->post_id = $Post->id;
    $likes->save();
}

if (isset($_POST['unlike'])) {
    $Post->likes = $Post->likes - 1;
    $likes::deletelike($session->user_id, $Post->id);
    $Post->save();
}
