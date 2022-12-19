<?php if (!$session->is_signed_in()) {
    redirect("login.php");
} ?>

<?php



$category = new Category();

if (isset($_POST['add_cat'])) {
    if ($category) {
        $category_name = Category::find_all_where('category_title', $_POST['title']);
        if ($category_name) {
            $session->message("<h4 class='p-3 text-white bg-danger'>Category " . $_POST['title'] . " already exists</h4>");
            redirect($_SERVER['PHP_SELF']);
        } else {
            $category->category_title = $_POST['title'];
            $category->save();
            $session->message("<h4 class='p-3 text-white bg-success'>Category $category->category_title has been created </h4>");

            redirect($_SERVER['PHP_SELF']);
        }
    }
}
