<?php
if (isset($_POST['data'])) {
    global $database;
    $file = '/Applications/XAMPP/xamppfiles/htdocs/blog/controller/account/settings/user_information.txt';
    $fh = fopen($file, 'w');



    //user details
    fwrite($fh, "User Details\n");
    $sql = "SELECT * FROM users WHERE id =" . $session->user_id . " ";
    $query = mysqli_query($database->connection, $sql);
    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $last = sizeof($row) - 1;
        $i = 0;
        foreach ($row as $field => $value) {
            fwrite($fh, $field . ": " . $value);
            if ($i != $last) {
                fwrite($fh, "\n");
            }
            $i++;
        }
        fwrite($fh, "\n");
    }
    fwrite($fh, "\n");
    fwrite($fh, "\n");
    //post details
    fwrite($fh, "Posts\n");
    $sql = "SELECT * FROM posts WHERE author =" . $session->user_id . " ";
    $query = mysqli_query($database->connection, $sql);
    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $last = sizeof($row) - 1;
        $i = 0;
        foreach ($row as $field => $value) {
            fwrite($fh, $field . ": " . $value);
            if ($i != $last) {
                fwrite($fh, "\n");
            }
            $i++;
        }
        fwrite($fh, "\n");
    }
    fwrite($fh, "\n");
    fwrite($fh, "\n");

    fwrite($fh, "Comments\n");
    $sql = "SELECT * FROM comments WHERE author =" . $session->user_id . " ";
    $query = mysqli_query($database->connection, $sql);
    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $last = sizeof($row) - 1;
        $i = 0;
        foreach ($row as $field => $value) {
            fwrite($fh, $field . ": " . $value);
            if ($i != $last) {
                fwrite($fh, "\n");
            }
            $i++;
        }
        fwrite($fh, "\n");
    }


    fclose($fh);
}
