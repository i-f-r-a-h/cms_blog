<div class="modal fade" id="photo-library">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Gallery System Library</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

      </div>
      <div class="modal-body">
        <div class="col-md-9">
          <div class="d-flex flex-row gap-4 ">

            <!-- PHP LOOP HERE CODE HERE-->

            <?php $photo = User_photo::find_all();
            foreach ($photo as $photo) : ?>

              <div class="col-xs-2">
                <a role="checkbox" aria-checked="false" tabindex="0" id="" href="#" class="thumbnail">
                  <img class="modal_thumbnails img-responsive" src="/<?php echo $photo->picture_path(); ?>" data="<?php echo $photo->id; ?>">
                </a>
                <div class="photo-id hidden"></div>

              </div>

            <?php endforeach; ?>

            <!-- PHP LOOP HERE CODE HERE-->

          </div>
        </div>
        <!--col-md-9 -->

        <div class="col-md-3">
          <div id="modal_sidebar"></div>
        </div>

      </div>
      <!--Modal Body-->
      <div class="modal-footer">
        <div class="row">
          <!--Closes Modal-->
          <button id="set_user_image" type="button" class="btn btn-primary" disabled="true" data-dismiss="modal">Apply Selection</button>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->