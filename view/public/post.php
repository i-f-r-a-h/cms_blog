<?php include("../includes/header.php"); ?>
<?php include('../../controller/post/post_actions.php'); ?>

<div class="container">
  <div id="display-search-result">

  </div>
  <div class="row" id="default-search">
    <!-- Latest Posts -->
    <main class="post blog-post col-lg-8">
      <div class="container">
        <div class="post-single">
          <div class="post-thumbnail"><img src="../<?php echo $Post->picture_path(); ?>" alt="..." class="img-fluid"></div>
          <div class="post-details">
            <div class="post-meta d-flex justify-content-between">
              <div class="category"><a href="blog.php?author=<?php echo $Post->author; ?>"><?php $cat = category::find_by_id($Post->category_id);
                                                                                            echo $cat->category_title
                                                                                            ?></a></div>
            </div>
            <h1><?php echo $Post->title; ?></h1>
            <div class="post-footer d-flex align-items-center flex-column flex-sm-row"><a href="blog.php?author=<?php echo $Post->author; ?>" class="author d-flex align-items-center flex-wrap">
                <div class="avatar"><img src="/blog/<?php echo isset($user->user_image) ? $user->image_path_and_placeholder()  : 'view/images/placeholder.jpeg'; ?> " alt="..." class="img-fluid"></div>
                <div class="title"><span><?php echo $user ? $user->username : '[ User removed ]'; ?></span></div>
              </a>
              <div class="d-flex align-items-center flex-wrap">
                <div class="date"><i class="icon-clock"></i> Posted on <?php echo substr($Post->post_date, 0, 10); ?></div>
                <div class="views"><i class="icon-eye"></i><?php echo $Post->view_count == null ? 0 : $Post->view_count; ?></div>
                <div class="comments meta-last"><i class="icon-comment"></i><?php echo Comment::comment_count($Post->id); ?></div>
              </div>
            </div>
            <div class="post-body">
              <p class="lead"> <?php echo $Post->content; ?></p>
              <?php echo $Post->description; ?>
            </div>
            <!-- blog likes -->
            <?php

            if ($session->is_signed_in()) { ?>


              <div class="row mt-4 pt-4">
                <p class="pull-right"><a class="<?php echo $likes->userLikedThisPost($session->user_id, $Post->id) ? 'unlike' : 'like'; ?>" href="/blog/view/public/post.php?id=<?php echo $Post->id; ?>"> <?php $likeCount =   $likes->find_all_where('post_id', $Post->id);
                                                                                                                                                                                                            echo count($likeCount); ?> <span data-placement="top" title="<?php echo $likes->userLikedThisPost($session->user_id, $Post->id) ? ' I liked this before' : 'Want to like it?'; ?>"><i class="fa-solid <?php echo $likes->userLikedThisPost($session->user_id, $Post->id) ? 'fa-thumbs-down' : 'fa-thumbs-up'; ?> "></i> <?php echo $likes->userLikedThisPost($session->user_id, $Post->id)  ? ' Unlike' : ' Like'; ?></span>
                  </a></p>
              </div>


            <?php  } else { ?>

              <div class="row mt-4 pt-4">
                <p class="pull-right login-to-post"><i class="fa-solid fa-thumbs-up"></i> You need to <a href="/cms/login.php">Login</a> to like this post </p>
              </div>


            <?php }


            ?>
            <div class="posts-nav d-flex justify-content-between align-items-stretch flex-column flex-md-row">
              <?php if ($previousPost) { ?>
                <a href="post.php?id=<?php echo $previousPost->id; ?>" class=" prev-post text-left d-flex align-items-center">

                  <div class="icon prev"><i class="fa fa-angle-left"></i></div>
                  <div class="text"><strong class="text-primary">Previous Post </strong>
                    <h6><?php echo $previousPost->title; ?></h6>
                  </div>
                </a>
              <?php } ?>
              <?php if ($nextPost) { ?>
                <a href="post.php?id=<?php echo $nextPost->id; ?>" class=" next-post text-right d-flex align-items-center justify-content-end">
                  <div class="text"><strong class="text-primary">Next Post </strong>
                    <h6><?php echo $nextPost->title; ?></h6>
                  </div>
                  <div class="icon next"><i class="fa fa-angle-right"> </i></div>
                </a>
              <?php } ?>
            </div>

            <div class="post-comments">

              <header>
                <h3 class="h6">Discussion <span class="no-of-comments">(<?php $comments = Comment::find_the_comments($Post->id);
                                                                        echo count($comments) ?>)</span></h3>
              </header>
              <!-- add comment -->
              <?php echo $message; ?>

              <div class="comment d-flex align-items-start mb-4">
                <?php if ($session->is_signed_in()) { ?>
                  <div class="comment-header d-flex justify-content-between">
                    <div class="user d-flex align-items-center">
                      <div class="image"><img src="/blog/<?php
                                                          $user = USER::find_by_id($session->user_id);
                                                          echo isset($user->user_image) ? $user->image_path_and_placeholder()  : 'view/images/placeholder.jpeg'; ?> " alt="..." class="img-fluid rounded-circle"></div>
                    </div>
                  </div>
                  <div class="add-comment ">
                    <form method="POST" class="commenting-form">
                      <div class="row">
                        <div class="form-group col-md-12">
                          <textarea placeholder="add to the discussion" id="usercomment" name="body" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-12 d-flex justify-content-end">
                          <input type="submit" name="submit" class="btn btn-dark d-flex rounded">

                        </div>
                      </div>
                    </form>
                  </div>
                <?php } else { ?>
                  <h4>You must login to leave a comment <a href=" ../account/login.php">Login here</a></h4>
                <?php } ?>
              </div>

              <!-- Display Comment -->
              <?php foreach ($comments as $comment) {
                $user = user::find_by_id($comment->author);

                if ($user) {
              ?>

                  <div class="comment">
                    <div class="comment-header d-flex justify-content-between">
                      <div class="user d-flex align-items-center">
                        <div class="image"><img src="/blog/<?php echo $user->image_path_and_placeholder() ?> " alt="..." class="img-fluid rounded-circle"></div>
                        <div class="title"><strong><?php echo  $user ? $user->username : '[ User removed ]'; ?></strong><span class="date"><?php echo $comment->comment_date; ?></span></div>
                      </div>
                    </div>
                    <div class="comment-body">
                      <p> <?php echo $comment->body; ?></p>
                    </div>
                  </div>

              <?php }
              } ?>


            </div>
          </div>
        </div>
      </div>


    </main>


    <aside class="col-lg-4">
      <!-- Widget [Latest Posts Widget]        -->
      <?php include("includes/latest_posts.php"); ?>
      <!-- Widget [Categories Widget]-->
      <?php include("includes/categories.php"); ?>
      <!-- Widget [Tags Cloud Widget]-->
    </aside>
  </div>
  <?php include("../includes/footer.php"); ?>
  <script>
    $(document).ready(function() {

      $("[data-toggle='tooltip']").tooltip();
      <?php $Post = Post::find_by_id($_GET['id']); ?>
      let post_id = <?php echo $Post->id; ?>;
      let user_id = <?php echo $session->user_id; ?>;

      // LIKING

      $('.like').click(function() {

        $.ajax({
          url: "/blog/view/public/post.php?id=<?php echo $Post->id; ?>",
          type: "POST",
          data: {
            'liked': 1,
            'post_id': post_id,
            'user_id': user_id
          }
        });
      });

      // UNLIKING

      $('.unlike').click(function() {

        $.ajax({

          url: "/blog/view/public/post.php?id=<?php echo $Post->id; ?>",
          type: "POST",
          data: {
            'unlike': 1,
            'post_id': post_id,
            'user_id': user_id

          }


        });

      });
    });
  </script>