
<?php if (!$session->is_signed_in()) {
    redirect("login.php");
}

if (isset($_GET['id'])) {
    $update = Category::find_by_id($_GET['id']);


    if (isset($_POST['update-cat'])) {
        if ($update) {
            $category_name = Category::find_all_where('category_title', $_POST['cat-title']);
            if (!isset($_POST['cat-title'])) {
                header('Location:' . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
                $session->message("<h3 class='bg-danger p-2 text-white'>Category cannot be blank</h3>");
            } else if ($_POST['cat-title'] !== $update->category_title && $category_name) {
                $session->message("<h4 class='p-3 text-white bg-danger'>Category " . $_POST['cat-title'] . " already exists</h4>");
                redirect($_SERVER['PHP_SELF']);
            } else {
                $update->category_title = $_POST['cat-title'];
                $update->save();
                redirect("categories.php");
                $session->message("<h4 class='p-3 text-white bg-success'>Category $update->category_title has been updated </h4>");
            }
        } else {
            $session->message("Something went wrong. Please try again. ");
            redirect("categories.php");
        }
    }
}
