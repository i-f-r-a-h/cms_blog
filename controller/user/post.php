<?php
include('../../modal/engine/init.php');

if (isset($_POST['search'])) {
    $Name = $_POST['search'];
    //Search query.

    //Query execution
    $sql = "SELECT * FROM posts WHERE title LIKE '%$Name%' || id LIKE '%$Name%'";
    $results = Post::find_by_query($sql);

    echo "<h2>" . count($results) . " Search results for: {$Name}</h2>";

    if ($results) {
        foreach ($results as $Post) {
            $comments = Comment::find_the_comments($Post->id);
            echo " <div class='post col-xl-6'>
               <div class='post-thumbnail'><a href='post.html'><img src='../" . $Post->picture_path() . "' alt='...' class='img-fluid'></a></div>
                   <div class='post-details'>
                                <div class='post-meta d-flex justify-content-between'>
                                    <div class='date meta-last'></div>
                                    <div class='category'><a href='#'></a></div>
                                </div><a href='post.html'>
                                    <h3 class='h4'> $Post->title</h3>
                                </a>
                                <p class='text-muted'></p>
             
                            </div>
             </div>";
        }
    } else {
        echo "<h2>No results found for {$Name}</h2>";
    }
}
