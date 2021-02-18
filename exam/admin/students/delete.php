<?php include '../../config.php';?>

<?php
if(!isset($_GET['id'])) {
    die("<h2>404 - Page Not Found</h2>");
}
$_SESSION['message'] = "Student deleted successfully.";
$qry = "DELETE FROM user WHERE id='" . $_GET['id'] . "' AND type='Student'";
mysqli_query($con,$qry);
header('location:'.$url.'admin/students.php');

?>