<?php
$courses = sae_courses::find_all();


?>

<thead>
    <tr>
        <th>
            Course Id
        </th>
        <th>
            Course name
        </th>
        <th>
            Course duration
        </th>
        <th>
            Course type
        </th>
        <th>
            actions
        </th>
    </tr>
</thead>
<tbody>

    <?php foreach ($courses  as $course) : ?>


        <tr>
            <td>
                <?php echo $course->id ?>
            </td>
            <?php if (isset($_GET['id']) && $_GET['id'] == $course->id) {


                //updatetion
                if (isset($_POST['update'])) {
                    $update = sae_courses::find_by_id($_GET['id']);
                    if ($update) {
                        $campus_name = sae_courses::find_all_where('course_name', $_POST['course_name']);
                        if (!isset($_POST['course_name'], $_POST['course_duration'], $_POST['course_type']) || empty($_POST['course_name']) || empty($_POST['course_type']) || empty($_POST['course_duration'])) {
                            header('Location:' . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
                            $session->message("<h3 class='bg-danger p-2 text-white'>Fields cannot be blank</h3>");
                        } else if ($_POST['course_name'] !== $update->course_name && $course_name) {
                            $session->message("<h4 class='p-3 text-white bg-danger'>Course name " . $_POST['campus_name'] . " already exists</h4>");
                            redirect($_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
                        } else {
                            $update->course_name = $_POST['course_name'];
                            $update->course_duration = $_POST['course_duration'];
                            $update->course_type = $_POST['course_type'];
                            $update->save();
                            redirect("sae_information.php?source=course");
                            $session->message("<h4 class='p-3 text-white bg-success'>Course $update->course_name has been updated </h4>");
                        }
                    } else {
                        $session->message("Something went wrong. Please try again. ");
                        redirect("sae_information.php?source=course");
                    }
                }

                if (isset($_GET['del']) && $_GET['del'] == 'course') {
                    $course = sae_courses::find_by_id($_GET['id']);
                    if ($course) {
                        $course->delete();
                        $session->message("<h3 class='bg-success p-2 text-white'>The course with id:{$course->id} has been deleted</h3>");
                        redirect("sae_information.php?source=course");
                    } else {
                        redirect("sae_information.php?source=course");
                    }
                }

            ?>
                <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <td>
                        <div class="form-group">
                            <input type="text" name="course_name" class="form-control" value="<?php echo $course->course_name; ?>">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" name="course_duration" class="form-control" value="<?php echo $course->course_duration; ?>">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" name="course_type" class="form-control" value="<?php echo $course->course_type; ?>">
                        </div>
                    </td>


                    <td>
                        <button type="submit" name="update" class="btn btn-primary me-2 text-white">Update</button>
                    </td>
                </form>



            <?php } else { ?>
                <td>
                    <?php echo $course->course_name; ?>
                </td>
                <td>
                    <?php echo $course->course_duration; ?>
                </td>
                <td>
                    <?php echo $course->course_type; ?>
                </td>
            <?php } ?>
            <td>
                <a href="sae_information.php?source=course&id=<?php echo $course->id; ?>"><i class="fa-solid fa-pencil"></i></a>
                <a href="sae_information.php?source=course&id=<?php echo $course->id; ?>&del=course"><i class="fa-solid fa-trash-can"></i></a>
            </td>
        </tr>
    <?php
    endforeach;
    ?>
    <?php if (isset($_GET['add']) && $_GET['add'] == 'course') {
        //updatetion
        if (isset($_POST['new'])) {
            $update = new sae_courses();
            $course_name = sae_courses::find_all_where('course_name', $_POST['course_name2']);
            if (!isset($_POST['course_name2'], $_POST['course_duration2'], $_POST['course_type2']) || empty($_POST['course_name2']) || empty($_POST['course_type2']) || empty($_POST['course_duration2'])) {
                header('Location:' . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
                $session->message("<h3 class='bg-danger p-2 text-white'>Fields cannot be blank</h3>");
            } else if ($_POST['course_name2'] !== $update->course_name && $course_name) {
                $session->message("<h4 class='p-3 text-white bg-danger'>Course name " . $_POST['campus_name2'] . " already exists</h4>");
                redirect($_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
            } else {
                $update->course_name = $_POST['course_name2'];
                $update->course_duration = $_POST['course_duration2'];
                $update->course_type = $_POST['course_type2'];
                $update->save();
                redirect("sae_information.php?source=course");
                $session->message("<h4 class='p-3 text-white bg-success'>Course $update->course_name has been updated </h4>");
            }
            if (!$update->save()) {
                $session->message("Something went wrong. Please try again. ");
                redirect("sae_information.php?source=course");
            }
        }
    ?>
        <tr>

            <form class="forms-sample" method="post" enctype="multipart/form-data">
                <td>

                </td>
                <td>
                    <div class="form-group">
                        <input type="text" name="course_name2" class="form-control">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input type="text" name="course_duration2" class="form-control">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input type="text" name="course_type2" class="form-control">
                    </div>
                </td>

                <td>
                    <button type="submit" name="new" class="btn btn-primary me-2 text-white">Add Course</button>
                </td>
            </form>
        </tr>
    <?php } ?>



</tbody>