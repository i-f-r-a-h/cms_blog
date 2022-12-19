<?php



if (isset($_GET['source'])) {
    $source = $_GET['source'];
} else {
    $source = ''; // to remove errors
}

switch ($source) {
    case 'course':
        $page_title = 'SAE Courses';
        $add_url = 'sae_information.php?source=course&add=course';
        break;
    case 'level':
        $page_title = 'SAE Levels of study';
        $add_url = 'sae_information.php?source=level&add=level';
        break;
    default:
        $page_title = 'SAE Campuses';
        $add_url = 'sae_information.php?source=campus&add=campus';
        break;
}
