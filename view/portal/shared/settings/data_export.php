  <?php include('../../../../controller/account/settings/data_export.php'); ?>
  <!-- main content -->
  <div class="col-lg-8 d-flex flex-column">
      <h2 class="mb-3 fs-3 border-bottom pb-3">Download you data</h2>
      <!-- comments -->
      <div class="">
          <p class="w-75 fs-6 mb-4">You can request your information that is stored in the website. Please check your downloads for a user_information.txt file.</p>
          <form class="forms-sample" method="post" enctype="multipart/form-data">
              <input type="hidden" name="data">
              <button type="submit" name="data" class="btn btn-primary me-2" download>Request data</button>
          </form>
      </div>

  </div>