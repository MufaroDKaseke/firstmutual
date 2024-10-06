<?php


require_once '../../vendor/autoload.php';
require_once '../../app/config/config.php';
require_once '../../app/models/db.model.php';
require_once '../../app/models/admin.model.php';

$db = new Database();


if (isset($_POST['delete_user'])) {
  $db->connect();
  $stmt = mysqli_prepare($db->db_conn, "DELETE FROM tbl_users WHERE user_id=?;");
  mysqli_stmt_bind_param($stmt, 's', $_POST['user_id']);
  if (mysqli_stmt_execute($stmt)) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> User deleted succesfully, please <a href="" class="fw-bold">reload</a> to see changes!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
  } else {
  ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong> Could not delete user</b>.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
  }
}

?>