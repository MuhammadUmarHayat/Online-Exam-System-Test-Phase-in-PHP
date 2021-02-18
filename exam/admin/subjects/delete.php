<?php include '../../config.php';?>

<?php
if(!isset($_GET['id'])) {
    die("<h2>404 - Page Not Found</h2>");
}
$_SESSION['message'] = "Subject deleted successfully.";
$qry = "DELETE FROM subjects WHERE id='" . $_GET['id'] . "'";
mysqli_query($con,$qry);
header('location:'.$url.'admin/subjects.php');

?>