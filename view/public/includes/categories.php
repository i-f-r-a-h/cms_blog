      <div class="widget categories">
          <header>
              <h3 class="h6">Categories</h3>
          </header>
          <?php $categories = Category::find_all();
            foreach ($categories as $category) { ?>
              <div class="item d-flex justify-content-between"><a href="blog.php?cat=<?php echo $category->id; ?>"><?php echo $category->category_title ?></a><span><?php echo $category->article_count($category->id) ?></span></div>
          <?php } ?>
      </div>