<?php include("./partials/header.php"); ?>


<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div id="display-search-result">
    </div>
    <div class="row" id="default-search">
      <div class="col-sm-12">
        <div class="home-tab">
          <h1 class="page-header">
            <small>Dashboard</small>
          </h1>
          <div class="tab-content tab-content-basic">
            <?php $session->user_role == 'admin' ? include('./partials/admin_dashboard.php') : include('./partials/user_dashboard.php'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<?php include("./partials/footer.php"); ?>