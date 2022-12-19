<?php
include('../../modal/engine/init.php');

if (isset($_POST['search'])) {
    $Name = $_POST['search'];
    //Search query.

    //Query execution
    $sql = "SELECT * FROM posts WHERE post_status = 'published' && title LIKE '%$Name%' || post_status = 'published' && id LIKE '%$Name%'";
    $results = Post::find_by_query($sql);

    echo "<h2 class='mb-4'>" . count($results) . " Search results for: {$Name}</h2>";

    if ($results) {
        foreach ($results as $Post) {
            $cat = Category::find_by_id($Post->category_id);
            $cat ? $category = $cat->category_title : $category = '[category removed]';
            $comments = Comment::find_the_comments($Post->id);
            $user = User::find_by_id($Post->author);
            isset($user->user_image) ? $image = $user->image_path_and_placeholder()  : $image = 'view/images/placeholder.jpeg';
            $user ? $username =  $user->username : $username = '[user removed]';
            echo " <div class='post col-xl-6'>
               <div class='post-thumbnail'><a href='post.php?id=$Post->id'><img src='../" . $Post->picture_path() . "' alt='...' class='img-fluid'></a></div>
                   <div class='post-details'>
                                <div class='post-meta d-flex justify-content-between'>
                                    <div class='date meta-last'>$Post->post_date</div>
                                    <div class='category'><a href='blog.php?cat=$Post->category_id'>$category</a></div>
                                </div><a href='post.html'>
                                    <h3 class='h4'> $Post->title</h3>
                                </a>
                                <div class='d-flex flex-row gap-2 align-items-center'>
                               <div class='avatar'><img src='/blog/$image'> alt='...' class='img-fluid'></div>
                                        <div class='title'><span> $username  </span></div></div>
             
                            </div>
             </div>";
        }
    } else {
        echo "<h2>No results found for {$Name}</h2>";
    }
}
