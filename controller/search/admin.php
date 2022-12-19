<?php


if (isset($_POST['search'])) {
    include('../../modal/engine/init.php');
    $Name = $_POST['search'];
    //Search query.

    //Posts
    $sql = "SELECT * FROM posts WHERE title LIKE '%$Name%' || id LIKE '%$Name%'";
    $results = Post::find_by_query($sql);
    //users
    $UserResults = User::find_by_query("SELECT * FROM users WHERE username LIKE '%$Name%' || id LIKE '%$Name%' || user_email LIKE '%$Name%' || user_tel LIKE '%$Name%' ");

    echo "<h2 class='mb-4'>" . count($results) + count($UserResults) . " Total results for: {$Name}</h2>";

    if ($results) {
        echo "<div class='col-lg-12 grid-margin stretch-card'>   
              <div class='card'>
                <div class='card-body'>
                  <h4 class='card-title'>" . count($results) . " Post results</h4>
                     <div class='table-responsive'>
                    <table class='table'>
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>title</th>
                          <th>author</th>
                          <th>View more</th>
                        </tr>
                      </thead>
                      <tbody>";
        foreach ($results as $post) {
            $user = user::find_by_id($post->author);
            $user ? $author = $user->username : $author = '[user removed]';;
            echo "    <tr>
                  <td>$post->id</td>
                          <td>$post->title</td>
                          <td>$author</td>
                          <td><a class='btn btn-secondary' href='/blog/view/portal/pages/all_posts.php?highlight=$post->id'>more info<a/></td>
               </tr>";
        }
        echo "       </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>";
    } else {
        echo "<h2 class='mt-3 mb-3 text-gray'>No post results found for {$Name}</h2>";
    }


    //users
    if ($UserResults) {
        echo "<div class='col-lg-12 grid-margin stretch-card'>   
              <div class='card'>
                <div class='card-body'>
                  <h4 class='card-title'>" . count($UserResults) . " User results</h4>
                     <div class='table-responsive'>
                    <table class='table'>
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Username</th>
                          <th>User_email</th>
                          <th>View more</th>
                        </tr>
                      </thead>
                      <tbody>";


        foreach ($UserResults as $user) {
            echo "    <tr>
                  <td>$user->id</td>
                          <td>$user->username</td>
                          <td>$user->user_email</td>
                          <td><a class='btn btn-secondary' href='/blog/view/portal/pages/all_users.php?highlight=$user->id'>more info<a/></td>
               </tr>";
        }


        echo "       </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>";
    } else {
        echo "<h2 class='mt-3 mb-3 text-gray'>No user results found for {$Name}</h2>";
    }
}
