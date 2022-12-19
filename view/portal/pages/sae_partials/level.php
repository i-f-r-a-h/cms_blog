<?php
$levels = sae_level_of_study::find_all();


?>

<thead>
    <tr>
        <th>
            Level of Study Id
        </th>
        <th>
            Level of Study Id Name
        </th>
        <th>
            actions
        </th>
    </tr>
</thead>
<tbody>

    <?php foreach ($levels  as $level) : ?>


        <tr>
            <td>
                <?php echo $level->id ?>
            </td>
            <?php if (isset($_GET['id']) && $_GET['id'] == $level->id) {


                //updatetion
                if (isset($_POST['update'])) {
                    $update = sae_level_of_study::find_by_id($_GET['id']);
                    if ($update) {
                        $level = sae_level_of_study::find_all_where('level', $_POST['level']);
                        if (!isset($_POST['level']) || empty($_POST['level'])) {
                            header('Location:' . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
                            $session->message("<h3 class='bg-danger p-2 text-white'>Fields cannot be blank</h3>");
                        } else if ($_POST['level'] !== $update->level && $level) {
                            $session->message("<h4 class='p-3 text-white bg-danger'> Name " . $_POST['level'] . " already exists</h4>");
                            redirect($_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
                        } else {
                            $update->level = $_POST['level'];
                            $update->save();
                            redirect("sae_information.php?source=level");
                            $session->message("<h4 class='p-3 text-white bg-success'>Level of Study $update->level has been updated </h4>");
                        }
                    } else {
                        $session->message("Something went wrong. Please try again. ");
                        redirect("sae_information.php?source=level");
                    }
                }

                if (isset($_GET['del']) && $_GET['del'] == 'level') {
                    $course = sae_level_of_study::find_by_id($_GET['id']);
                    if ($course) {
                        $course->delete();
                        $session->message("<h3 class='bg-success p-2 text-white'>The Level of Study with id:{$course->id} has been deleted</h3>");
                        redirect("sae_information.php?source=level");
                    } else {
                        redirect("sae_information.php?source=level");
                    }
                }

            ?>
                <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <td>
                        <div class="form-group">
                            <input type="text" name="level" class="form-control" value="<?php echo $level->level; ?>">
                        </div>
                    </td>
                    <td>
                        <button type="submit" name="update" class="btn btn-primary me-2 text-white">Update</button>
                    </td>
                </form>



            <?php } else { ?>
                <td>
                    <?php echo $level->level; ?>
                </td>
            <?php } ?>
            <td>
                <a href="sae_information.php?source=level&id=<?php echo $level->id; ?>"><i class="fa-solid fa-pencil"></i></a>
                <a href="sae_information.php?source=level&id=<?php echo $level->id; ?>&del=level"><i class="fa-solid fa-trash-can"></i></a>
            </td>
        </tr>
    <?php
    endforeach;
    ?>
    <?php if (isset($_GET['add']) && $_GET['add'] == 'level') {
        //updatetion
        if (isset($_POST['new'])) {
            $update = new sae_level_of_study();
            $level = sae_level_of_study::find_all_where('level', $_POST['level2']);

            if (!isset($_POST['level2']) || empty($_POST['level2'])) {
                header('Location:' . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
                $session->message("<h3 class='bg-danger p-2 text-white'>Fields cannot be blank</h3>");
            } else if ($_POST['level2'] !== $update->level && $level) {
                $session->message("<h4 class='p-3 text-white bg-danger'> Name " . $_POST['level2'] . " already exists</h4>");
                redirect($_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
            } else {
                $update->level = $_POST['level2'];
                $update->save();
                redirect("sae_information.php?source=level");
                $session->message("<h4 class='p-3 text-white bg-success'>Level of Study $update->level has been added </h4>");
            }
        }
    ?>
        <tr>

            <form class="forms-sample" method="post" enctype="multipart/form-data">
                <td>

                </td>
                <td>
                    <div class="form-group">
                        <input type="text" name="level2" class="form-control">
                    </div>
                </td>



                <td>
                    <button type="submit" name="new" class="btn btn-primary me-2 text-white">Add Level</button>
                </td>
            </form>
        </tr>
    <?php } ?>



</tbody>