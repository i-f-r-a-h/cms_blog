<?php include("../partials/header.php"); ?>
<?php include('../../../controller/admin/add_sae.php'); ?>

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div id="display-search-result">

        </div>
        <div class="row" id="default-search">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link ps-0" href="sae_information.php?source" role="tab" aria-controls="overview" aria-selected="true">SAE Campuses</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="sae_information.php?source=course" role="tab" aria-selected="false">SAE Courses</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="sae_information.php?source=level" role="tab" aria-selected="false">SAE Level of study</a>
                            </li>
                        </ul>
                        <div>
                            <div class="btn-wrapper">
                                <a href="<?php echo $add_url ?>" class="btn btn-primary text-white me-0"><i class="icon-plus"></i>Add New</a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content tab-content-basic">

                        <div class="row">


                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><?php echo $page_title ?></h4>
                                        <p class="card-description">
                                            <?php echo $message; ?>
                                        </p>
                                        <div class="table-responsive">
                                            <table class="table table-striped">

                                                <?php

                                                if (isset($_GET['source'])) {
                                                    $source = $_GET['source'];
                                                } else {
                                                    $source = ''; // to remove errors
                                                }

                                                switch ($source) {
                                                    case 'course':
                                                        // deleteSaeInfo('course', 'sae_courses');
                                                        include("./sae_partials/courses.php");
                                                        break;
                                                    case 'level':
                                                        include("./sae_partials/level.php");
                                                        break;
                                                    default:
                                                        include("./sae_partials/campus.php");
                                                        break;
                                                }


                                                ?>


                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights reserved.</span>
        </div>
    </footer>
    <!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>

<!-- main-panel ends -->
<?php include("../partials/footer.php"); ?>