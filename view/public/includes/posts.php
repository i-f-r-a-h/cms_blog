        <?php include('../../controller/public/paginate.php'); ?>
        <main class="posts-listing col-lg-8">
            <div class="container">
                <div id="display-search-result">

                </div>
                <div class="row" id="default-search">
                    <!-- post -->
                    <?php foreach ($posts as $Post) :  ?>
                        <div class="post col-xl-6">

                            <div class="post-thumbnail"><a href="post.php?id=<?php echo $Post->id; ?>"><img src="../<?php echo $Post->picture_path(); ?>" alt="..." class="img-fluid"></a></div>
                            <div class="post-details">
                                <div class="post-meta d-flex justify-content-between">
                                    <div class="date meta-last"><?php echo $Post->post_date;
                                                                ?></div>
                                    <div class="category"><a href="blog.php?cat=<?php echo $Post->category_id; ?>"><?php $cat = Category::find_by_id($Post->category_id);
                                                                                                                    echo $cat ? $cat->category_title : '[category removed]';
                                                                                                                    ?></a></div>
                                </div><a href="post.php?id=<?php echo $Post->id; ?>">
                                    <h3 class="h4"><?php echo $Post->title;

                                                    ?></h3>
                                </a>
                                <p class="text-muted"><?php echo  strlen($Post->content) > 80 ? substr($Post->content, 0, 80) . "..." : substr($Post->content, 0, 80); ?> </p>
                                <footer class="post-footer d-flex align-items-center"><a href="blog.php?author=<?php echo $Post->author; ?>" class="author d-flex align-items-center flex-wrap">
                                        <div class="avatar"><img src="/blog/<?php $user = User::find_by_id($Post->author);
                                                                            echo isset($user->user_image) ? $user->image_path_and_placeholder()  : 'view/images/placeholder.jpeg'; ?>" alt="..." class="img-fluid"></div>
                                        <div class="title"><span><?php
                                                                    echo $user ? $user->username : '[user removed]';;
                                                                    ?></span></div>
                                    </a>
                                    <div class="date"><i class="fa-solid fa-thumbs-up"></i><?php echo $Post->likes == null ? 0 : $Post->likes; ?></div>
                                    <div class="comments meta-last"><i class="icon-comment"></i>
                                        <?php
                                        $comments = Comment::find_the_comments($Post->id);
                                        echo count($comments);
                                        ?></div>
                                </footer>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <!-- Pagination -->
                    <nav aria-label="Page navigation example">
                        <ul class="pagination pager pagination-template d-flex justify-content-center">
                            <?php
                            if ($paginate->page_total() > 1) {
                                if ($paginate->has_previous()) {
                                    echo "<li class='page-item'><a href='blog.php?page=" . $paginate->previous() . "' class='page-link'> <i class='fa fa-angle-left'></i></a></li>";
                                }

                                for ($i = 1; $i <= $paginate->page_total(); $i++) {
                                    if ($i == $paginate->current_page) {
                                        echo  "<li class='page-item'><a href='blog.php?page={$i}' class='page-link active'>{$i}</a></li>";
                                    } else {

                                        echo  "<li class='page-item'><a href='blog.php?page={$i}' class='page-link'>{$i}</a></li>";
                                    }
                                }

                                if ($paginate->has_next()) {
                                    echo "<li class='page-item'><a href='blog.php?page=" . $paginate->next() . "' class='page-link'> <i class='fa fa-angle-right'></i></a></li>";
                                }
                            }
                            ?>
                        </ul>
                    </nav>
                </div>
        </main>