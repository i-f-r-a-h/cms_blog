      <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">


          <div class="row mb-5">

              <div class="card-deck m-0 p-0">
                  <div class="card bg-dark bg-gradient ">
                      <div class="card-body d-flex flex-row align-items-end gap-3 justify-content-around">
                          <i class="fa fa-newspaper fa-4x text-white"></i>
                          <div>
                              <p class="text-white fw-bolder h2 mb-0"><?php $post = Post::find_all_where('author', $session->user_id);
                                                                        echo count($post); ?></p>
                              <p class="text-white">Posts written</p>
                          </div>
                      </div>
                  </div>

                  <div class="card bg-info bg-gradient">
                      <div class="card-body d-flex flex-row align-items-end gap-3 justify-content-around">
                          <i class="fa fa-eye fa-4x text-white"></i>
                          <div>
                              <p class="text-white fw-bolder h2 mb-0"><?php
                                                                        global $database;
                                                                        $result = mysqli_query($database->connection, "SELECT sum(view_count) as total FROM posts WHERE author = $session->user_id");
                                                                        $row = mysqli_fetch_assoc($result);
                                                                        echo $row['total'];
                                                                        ?></p>
                              <p class="text-white">Post views</p>
                          </div>
                      </div>
                  </div>

                  <div class="card bg-warning bg-gradient">
                      <div class="card-body d-flex flex-row align-items-end gap-2 justify-content-around">
                          <i class="fa fa-comments fa-4x text-white"></i>
                          <div>
                              <p class="text-white fw-bolder h2 mb-0"><?php $result = mysqli_query($database->connection, "select count(*) as total from posts inner join comments on posts.id = comments.post_id where posts.author = $session->user_id");
                                                                        $row = mysqli_fetch_assoc($result);
                                                                        echo $row['total']; ?></p>
                              <p class="text-white">Post comments</p>
                          </div>
                      </div>
                  </div>

                  <div class="card bg-primary bg-gradient">
                      <div class="card-body d-flex flex-row align-items-end gap-2 justify-content-around">
                          <i class="fa fa-thumbs-up fa-4x text-white"></i>
                          <div>
                              <p class="text-white fw-bolder h2 mb-0"><?php $result = mysqli_query($database->connection, "select count(*) as total from posts inner join likes on posts.id = likes.post_id where posts.author = $session->user_id");
                                                                        $row = mysqli_fetch_assoc($result);
                                                                        echo $row['total']; ?> </p>
                              <p class="text-white">Post likes</p>
                          </div>
                      </div>
                  </div>




              </div>
          </div>

          <div class=" row">

              <div class="col-lg-12 d-flex flex-column">
                  <div class="column flex-grow">
                      <div class="col-12 grid-margin stretch-card ml-0 mr-0 p-0">
                          <div class="card card-rounded">
                              <div class="card-body">
                                  <div class="d-sm-flex justify-content-between align-items-start">
                                      <div>
                                          <h2 class="card-title card-title-dash fs-4">My Recent Posts</h2>
                                          <p class="card-subtitle card-subtitle-dash">These are the posts that you have recently added to the blog</p>
                                      </div>
                                      <a href="/blog/view/portal/pages/posts.php" class=" btn btn-secondary">View All</a>
                                  </div>
                                  <div class="table-responsive   mt-1">
                                      <table class=" table table-sm select-table  ">
                                          <thead>
                                              <tr>
                                                  <th>Thumbnail</th>
                                                  <th>Post content</th>
                                                  <th>Post engagement</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <?php $recentPosts =  post::find_all_where("author", $session->user_id, ' ORDER BY id DESC LIMIT 5');
                                                foreach ($recentPosts as $posts) {

                                                ?>
                                                  <tr>
                                                      <td>

                                                          <img class="img-fluid img-thumbnail user_dash_image" src=" /blog/view/<?php
                                                                                                                                echo $posts->picture_path();
                                                                                                                                ?> " alt="">

                                                      </td>

                                                      <td class="wrapping ">
                                                          <h3><a href="/blog/view/public/post.php?id=<?php echo $posts->id; ?>" class="fw-bolder text-primary"><?php echo $posts->title;  ?></a></h3>
                                                          <div class="d-flex flex-row gap-3 mt-2">
                                                              <p class="h4 text-black fw-bolder"><b>Published on:</b> <?php echo substr($posts->post_date, 0, 10);  ?></p>
                                                              <p class="h4 text-black fw-bolder"><b>Category:</b> <?php
                                                                                                                    $cat = Category::find_by_id($posts->category_id);
                                                                                                                    echo $cat ? $cat->category_title : '[category removed]'; ?></p>

                                                          </div>

                                                      </td>
                                                      <td>
                                                          <div class="d-flex flex-row gap-3 mt-2">
                                                              <p class="h4 text-black fw-bolder"><i class="fa-solid fa-heart mr-1"></i><?php echo $posts->likes == null ? 0 : $posts->likes; ?> likes</p>
                                                              <p class="h4 text-black fw-bolder"><i class="fa-solid fa-comment mr-1"></i><?php
                                                                                                                                            $comments = Comment::find_the_comments($posts->id);
                                                                                                                                            echo count($comments); ?> comments</p>
                                                              <p class="h4 text-black fw-bolder"><i class="fa-solid fa-eye mr-1"></i><?php
                                                                                                                                        echo $posts->view_count == null ? 0 : $posts->view_count;  ?> views</p>

                                                          </div>
                                                      </td>

                                                  </tr>
                                              <?php

                                                } ?>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

          </div>

      </div>