<main class="posts-listing col-lg-8">

    <div class="container">
        <div id="display-search-result">

        </div>
        <div class="row" id="default-search">
            <?php
            $cat = $_GET['cat'];
            $categoryName = Category::find_by_id($cat);
            $articles = Post::find_all_where('category_id', $cat); ?>
            <h1 class="mb-4">All articles with the category : <?php echo $categoryName ? $categoryName->category_title : '[category removed]' ?></h1>
            <!-- post -->
            <?php foreach ($articles as $Post) :  ?>
                <div class="post col-xl-6">

                    <div class="post-thumbnail"><a href="post.php?id=<?php echo $Post->id; ?>"><img src="../<?php echo $Post->picture_path(); ?>" alt="..." class="img-fluid"></a></div>
                    <div class="post-details">
                        <div class="post-meta d-flex justify-content-between">
                            <div class="date meta-last"><?php echo $Post->post_date;
                                                        ?></div>
                            <div class="category"><a href="#"><?php $cat2 = Category::find_by_id($Post->category_id);
                                                                echo $cat2 ? $cat2->category_title : '[category removed]';
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

        </div>
</main>