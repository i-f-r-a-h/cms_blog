<?php
$campuses = sae_campus::find_all();


?>

<thead>
    <tr>
        <th>
            Campus Id
        </th>
        <th>
            Campus name
        </th>
        <th>
            Campus address
        </th>
        <th>
            actions
        </th>
    </tr>
</thead>
<tbody>

    <?php foreach ($campuses  as $campus) : ?>


        <tr>
            <td>
                <?php echo $campus->id ?>
            </td>
            <?php if (isset($_GET['id']) && $_GET['id'] == $campus->id) {


                //updatetion
                if (isset($_POST['update'])) {
                    $update = sae_campus::find_by_id($_GET['id']);
                    if ($update) {
                        $campus_name = sae_campus::find_all_where('campus_name', $_POST['campus_name']);
                        if (!isset($_POST['campus_address'], $_POST['campus_name']) || empty($_POST['campus_address']) || empty($_POST['campus_name'])) {
                            header('Location:' . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
                            $session->message("<h3 class='bg-danger p-2 text-white'>Fields cannot be blank</h3>");
                        } else if ($_POST['campus_name'] !== $update->campus_name && $campus_name) {
                            $session->message("<h4 class='p-3 text-white bg-danger'>Campus name " . $_POST['campus_name'] . " already exists</h4>");
                            redirect($_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
                        } else {
                            $update->campus_name = $_POST['campus_name'];
                            $update->campus_address = $_POST['campus_address'];
                            $update->save();
                            redirect("sae_information.php");
                            $session->message("<h4 class='p-3 text-white bg-success'>Campus $update->campus_name has been updated </h4>");
                        }
                    } else {
                        $session->message("Something went wrong. Please try again. ");
                        redirect("sae_information.php");
                    }
                }

                if ($_GET['del'] == 'campus') {
                    $campus = sae_campus::find_by_id($_GET['id']);
                    if ($campus) {
                        $campus->delete();
                        $session->message("<h3 class='bg-success p-2 text-white'>The campus with id:{$campus->id} has been deleted</h3>");
                        redirect("sae_information.php");
                    } else {
                        redirect("sae_information.php");
                    }
                }

            ?>
                <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <td>
                        <div class="form-group">
                            <input type="text" name="campus_name" class="form-control" value="<?php echo $campus->campus_name; ?>">
                        </div>

                    <td>
                        <div class="form-group"> <textarea class="form-control" name="campus_address" id="" rows="3"><?php echo $campus->campus_address; ?></textarea>
                    </td>
                    <td>
                        <button type="submit" name="update" class="btn btn-primary me-2 text-white">Update</button>
                    </td>
                </form>



            <?php } else { ?>
                <td>
                    <?php echo $campus->campus_name; ?>
                </td>
                <td>
                    <?php echo $campus->campus_address; ?>
                </td>
            <?php } ?>
            <td>
                <a href="sae_information.php?id=<?php echo $campus->id; ?>"><i class="fa-solid fa-pencil"></i></a>
                <a href="sae_information.php?id=<?php echo $campus->id; ?>&del=campus"><i class="fa-solid fa-trash-can"></i></a>
            </td>
        </tr>
    <?php
    endforeach;
    ?>
    <?php if (isset($_GET['add']) && $_GET['add'] == 'campus') {
        //updatetion
        if (isset($_POST['new'])) {
            $update = new sae_campus();
            $campus_name = sae_campus::find_all_where('campus_name', $_POST['campus_name2']);
            if (!isset($_POST['campus_address2']) || !isset($_POST['campus_name2'])) {
                header('Location:' . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
                $session->message("<h3 class='bg-danger p-2 text-white'>Fields cannot be blank</h3>");
            } else if ($_POST['campus_name'] !== $update->campus_name && $category_name) {
                $session->message("<h4 class='p-3 text-white bg-danger'>Campus name" . $_POST['campus_name2'] . " already exists</h4>");
                redirect($_SERVER['PHP_SELF']);
            } else {
                $update->campus_name = $_POST['campus_name2'];
                $update->campus_address = $_POST['campus_address2'];
                $update->save();
                redirect("sae_information.php");
                $session->message("<h4 class='p-3 text-white bg-success'>Campus $update->campus_name has been updated </h4>");
            }
            if (!$update->save()) {
                $session->message("Something went wrong. Please try again. ");
                redirect("sae_information.php");
            }
        }
    ?>
        <tr>

            <form class="forms-sample" method="post" enctype="multipart/form-data">
                <td>

                </td>
                <td>
                    <div class="form-group">
                        <input type="text" name="campus_name2" class="form-control">
                    </div>
                </td>
                <td>
                    <div class="form-group"> <textarea class="form-control" name="campus_address2" id="" rows="3"></textarea>
                </td>
                <td>
                    <button type="submit" name="new" class="btn btn-primary me-2 text-white">Add Campus</button>
                </td>
            </form>
        </tr>
    <?php } ?>



</tbody>