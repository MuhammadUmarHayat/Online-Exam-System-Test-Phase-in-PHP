<?php include '../../config.php';?>

<?php
checkAuth('Teacher');

if(!isset($_GET['id'])) {
    die("<h2>404 - Page Not Found</h2>");
}
$_SESSION['message'] = "Question deleted successfully.";
$qry = "DELETE FROM questions WHERE id='" . $_GET['id'] . "'";
mysqli_query($con,$qry);
$qry = "DELETE FROM question_options WHERE question_id='" . $_GET['id'] . "'";
mysqli_query($con,$qry);
header('location:'.$url.'teacher/index.php');

?>