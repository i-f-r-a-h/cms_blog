      <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">


          <div class="row">

              <div class="col-lg-8 d-flex flex-column">
                  <div class="row flex-grow">
                      <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                          <div class="card card-rounded">
                              <div class="card-body">
                                  <p>User Locations</p>
                                  <div id="regions_div" style="width: 100%; height: 100%;"></div>

                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 d-flex flex-column">
                  <div class="row flex-grow">
                      <div class="col-12 grid-margin stretch-card">
                          <div class="card card-rounded">



                              <p class="ml-4 mt-3">Overview of key areas</p>

                              <div id="donutchart" style="width: 100%; height: 100%;"></div>



                          </div>
                      </div>
                  </div>
                  <div class="row flex-grow">
                      <div class="col-12 grid-margin stretch-card">
                          <div class="card card-rounded">
                              <div class="card-body">
                                  <div class="row">
                                      <div class="panel-heading">
                                          <div class="row">
                                              <div class="col-xs-3">
                                                  <i class="fa fa-photo fa-5x"></i>
                                              </div>
                                              <div class="col-xs-9 text-right">
                                                  <div class="huge"><?php echo Post::count_all(); ?></div>
                                                  <div>posts</div>
                                              </div>
                                          </div>
                                      </div>
                                      <a href="posts.php">
                                          <div class="panel-footer">
                                              <span class="pull-left">Total posts in Gallery</span>
                                              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                              <div class="clearfix"></div>
                                          </div>
                                      </a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>



          </div>


          <div class="row">

              <div class="col-lg-8 d-flex flex-column">
                  <div class="row flex-grow">
                      <div class="col-12 grid-margin stretch-card">
                          <div class="card card-rounded">
                              <div class="card-body">
                                  <div class="d-sm-flex justify-content-between align-items-start">
                                      <div>
                                          <h4 class="card-title card-title-dash">Top Performers</h4>
                                          <p class="card-subtitle card-subtitle-dash">These are the top five performers on the blog in terms of engagement</p>
                                      </div>

                                  </div>
                                  <div class="table-responsive  mt-1">
                                      <table class="table select-table">
                                          <thead>
                                              <tr>
                                                  <th>Profile</th>
                                                  <th>Contact</th>
                                                  <th>Posts</th>
                                                  <th>Top Category</th>

                                              </tr>
                                          </thead>
                                          <tbody>
                                              <?php $topPosts =  post::find_by_query("select author, count(*) from posts  group by author order by count(*) desc LIMIT 5");
                                                foreach ($topPosts as $top) {
                                                    $users = user::find_all_where('id', $top->author);

                                                ?>
                                                  <tr>
                                                      <td>
                                                          <div class="d-flex ">
                                                              <img src="/blog/<?php foreach ($users as $user) {
                                                                                    $user = USER::find_by_id($user->id);
                                                                                    echo $user->image_path_and_placeholder();
                                                                                } ?> " alt="">
                                                              <div>
                                                                  <h6><?php echo $user->first_name . " " . $user->last_name;  ?></h6>
                                                                  <p><?php echo $user->username;  ?></p>
                                                              </div>
                                                          </div>
                                                      </td>

                                                      <td>
                                                          <h6><?php echo $user->user_email;  ?></h6>
                                                          <p><?php echo $user->user_tel;  ?></p>
                                                      </td>
                                                      <td>
                                                          <?php echo count(Post::find_all_where('author', $user->id)) . " articles posted"; ?>
                                                      </td>
                                                      <td>
                                                          <?php

                                                            $categories =  post::find_by_query("select category_id, count(*) from posts where author = $user->id group by author order by count(*) desc LIMIT 1");
                                                            foreach ($categories as $cat) {
                                                                $found = Category::find_by_id($cat->category_id);
                                                                if ($found) {
                                                                    echo "<div class='badge bg-info bg-gradient'>$found->category_title</div>";
                                                                }
                                                            }
                                                            ?>

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
              <div class="col-lg-4 d-flex flex-column">
                  <div class="row flex-grow">
                      <div class="col-12 grid-margin stretch-card">
                          <div class="card card-rounded">
                              <div class="card-body">
                                  <div class="row">
                                      <div class="panel-heading">
                                          <div class="row">
                                              <div class="col-xs-3">
                                                  <i class="fa fa-user fa-5x"></i>
                                              </div>
                                              <div class="col-xs-9 text-right">
                                                  <div class="huge"><?php echo User::count_all(); ?>

                                                  </div>

                                                  <div>Users</div>
                                              </div>
                                          </div>
                                      </div>
                                      <a href="users.php">
                                          <div class="panel-footer">
                                              <span class="pull-left">Total Users</span>
                                              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                              <div class="clearfix"></div>
                                          </div>
                                      </a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row flex-grow">
                      <div class="col-12 grid-margin stretch-card">
                          <div class="card card-rounded">
                              <div class="card-body">
                                  <div class="row">
                                      <div class="panel-heading">
                                          <div class="row">
                                              <div class="col-xs-3">
                                                  <i class="fa fa-support fa-5x"></i>
                                              </div>
                                              <div class="col-xs-9 text-right">
                                                  <div class="huge"><?php echo Comment::count_all(); ?>

                                                  </div>
                                                  <div>Comments</div>
                                              </div>
                                          </div>
                                      </div>
                                      <a href="comments.php">
                                          <div class="panel-footer">
                                              <span class="pull-left">Total Comments</span>
                                              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                              <div class="clearfix"></div>
                                          </div>
                                      </a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

      </div>