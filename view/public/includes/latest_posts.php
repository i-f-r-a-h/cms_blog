       <?php include('../../controller/public/latest_post.php'); ?>
       <div class="widget latest-posts">
           <header>
               <h3 class="h6">Latest Posts</h3>
           </header>
           <div class="blog-posts">
               <?php foreach ($posts as $Post) :  ?>
                   <a href="Post.php?id=<?php echo $Post->id; ?>">
                       <div class="item d-flex align-items-center">
                           <div class="image"><img src="../<?php echo $Post->picture_path(); ?>" alt="..." class="w-100"></div>
                           <div class="title"><strong><?php echo $Post->title;
                                                        ?></strong>
                               <div class="d-flex align-items-center">
                                   <div class="views"><i class="fa-solid fa-thumbs-up"></i><?php echo $Post->likes == null ? 0 : $Post->likes; ?></div>
                                   <div class="comments"><i class="icon-comment"></i> <?php
                                                                                        $comments = Comment::find_the_comments($Post->id);
                                                                                        echo count($comments);
                                                                                        ?></div>
                               </div>
                           </div>
                       </div>
                   </a>

               <?php endforeach; ?>
           </div>
       </div>