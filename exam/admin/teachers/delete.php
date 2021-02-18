<?php include '../../config.php';?>

<?php
if(!isset($_GET['id'])) {
    die("<h2>404 - Page Not Found</h2>");
}
$_SESSION['message'] = "Teacher deleted successfully.";
$qry = "DELETE FROM user WHERE id='" . $_GET['id'] . "' AND type='Teacher'";
mysqli_query($con,$qry);
header('location:'.$url.'admin/index.php');

?>