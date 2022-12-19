<?php include("../partials/header.php"); ?>

<!-- partial -->
<div class="main-panel">
  <div id="display-search-result">

  </div>
  <div class="row" id="default-search">


    <!-- table -->

    <div class="row flex-grow mt-3">
      <div class="col-12 grid-margin stretch-card">
        <div class="card card-rounded">
          <div class="card-body">
            <div class="align-center">
              <h2 class="float-left">You have <?php $notify = Notification::find_all_where('receiver_id', $session->user_id, ' ORDER BY id DESC');
                                              echo count($notify) > 0 ?  count($notify) : "0"; ?> notification(s)</h2>
              <a class="float-right btn btn-primary" href="../../../controller/user/delete_notification.php?id=all">Delete All</a>

            </div>

            <div class="table-responsive  mt-1">
              <table class="table select-table">
                <thead>
                  <tr>

                    <th>Sent By</th>
                    <th>Notification</th>
                    <th>Date</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (count($notify) > 0) {
                    if (isset($_GET['view'])) {
                      $view = Notification::find_by_id($_GET['view']);
                      $highlight = $view->id;
                  ?>
                      <tr class="table-warning">
                        <td>
                          <div class="d-flex ">
                            <img src="/blog/<?php $user = USER::find_by_id($view->sender_id);
                                            echo $user->image_path_and_placeholder() ?> " alt="image of user">
                            <div>
                              <h6><?php
                                  $sender = User::find_by_id($view->sender_id);
                                  echo $sender->username . " " . $view->action
                                  ?> </h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <?php echo $view->notification_message
                          ?>
                        </td>
                        <td>
                          <?php echo $view->date_sent
                          ?>
                        </td>
                        <td>
                          <a href="../../../controller/user/delete_notification.php?id=<?php echo $notification_message->id; ?>"><i class="fa-solid fa-trash-can"></i></a>

                        </td>
                      </tr>

                      <?php     } else {
                      $highlight = 0;
                    }
                    foreach ($notify as $notification_message) {
                      if ($notification_message->id !== $highlight) {
                      ?>
                        <tr>
                          <td>
                            <div class="d-flex ">
                              <img src="/blog/<?php $user = USER::find_by_id($notification_message->sender_id);
                                              echo $user->image_path_and_placeholder() ?> " alt="image of user">
                              <div>
                                <h6><?php
                                    $sender = User::find_by_id($notification_message->sender_id);
                                    echo $sender->username . " " . $notification_message->action
                                    ?> </h6>
                              </div>
                            </div>
                          </td>
                          <td>
                            <?php echo $notification_message->notification_message
                            ?>
                          </td>
                          <td>
                            <?php echo $notification_message->date_sent
                            ?>
                          </td>
                          <td>
                            <a href="../../../controller/user/delete_notification.php?id=<?php echo $notification_message->id; ?>"><i class="fa-solid fa-trash-can"></i></a>

                          </td>
                        </tr>
                    <?php }
                    }
                  } else {  ?>
                    <tr>
                      <td>You have no notifications </td>
                    </tr>
                  <?php } ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<?php include("../partials/footer.php"); ?>