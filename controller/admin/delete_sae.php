<?php

if (!$session->is_signed_in()) {
    redirect("login.php");
}



// function deleteSaeInfo()
// {
//     if ($_GET['del'] == 'campus') {
//         $campus = Comment::find_by_id($_GET['id']);
//         if ($campus) {
//             $campus->delete();
//             $session->message("<h3 class='bg-success p-2 text-white'>The campus with id:{$campus->id} has been deleted</h3>");
//             redirect("../../view/portal/pages/sae_information.php?source");
//         } else {
//             redirect("../../view/portal/pages/sae_information.php?source");
//         }
//     }
// }
