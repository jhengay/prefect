
<?php
include "db_conn.php";

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  
  // Copy the record to archive table
  $copyQuery = "INSERT INTO archied_records (id, full_name, tcname, n_section, cause_prefect, gender, t_record, tdate, i_law, narative)
                SELECT id, full_name, tcname, n_section, cause_prefect, gender, t_record, tdate, i_law, narative FROM crud WHERE id = $id";
  $copyResult = mysqli_query($conn, $copyQuery);

  if ($copyResult) {
    // If copy is successful, delete the original record
    $deleteQuery = "DELETE FROM crud WHERE id = $id";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult) {
      header("Location: index.php?msg=Record moved to Deleted Records successfully");
    } else {
      echo "Error deleting record: " . mysqli_error($conn);
    }
  } else {
    echo "Error copying record to archive: " . mysqli_error($conn);
  }
} else {
  header("Location: index.php?msg=No record ID provided");
}
?>

