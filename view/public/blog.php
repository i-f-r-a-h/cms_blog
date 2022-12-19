<?php include("../includes/header.php"); ?>
<div class="container">
  <div class="row">
    <!-- Latest Posts -->
    <?php if (isset($_GET['search'])) {
      include("includes/search.php");
    } else if (isset($_GET['cat'])) {
      include("includes/all_articles_category.php");
    } else if (isset($_GET['author'])) {
      include("includes/all_articles_author.php");
    } else {
      include("includes/posts.php");
    }
    ?>
    <aside class="col-lg-4">
      <!-- Widget [Search Bar Widget]-->

      <?php !isset($_GET['search']) ?? include("includes/search_bar.php"); ?>
      <!-- Widget [Latest Posts Widget]        -->
      <?php include("includes/latest_posts.php"); ?>
      <!-- Widget [Categories Widget]-->
      <?php include("includes/categories.php"); ?>
      <!-- Widget [Tags Cloud Widget]-->
    </aside>
  </div>
</div>
<!-- Page Footer-->
<?php include("../includes/footer.php"); ?>