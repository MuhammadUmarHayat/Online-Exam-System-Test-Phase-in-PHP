<?php include '../../config.php'; ?>
<?php
checkAuth('Admin');

if(!isset($_GET['id'])) {
    die("<h2>404 - Page Not Found</h2>");
}

$id = $_GET['id'];


$teacher = [];
$qry = "SELECT * from user where id = '$id' AND type = 'Teacher'";
$result = mysqli_query($con, $qry);
if($result == false){
    die("<h2>404 - Page Not Found</h2>");
}
$teacher = mysqli_fetch_assoc($result);


if (!empty($_POST)) {
    $qry = "DELETE FROM teacher_subjects WHERE teacher_id='$id'";
    $result = mysqli_query($con, $qry);
    if (!empty($_POST['subjects'])) {
        foreach($_POST['subjects'] as $subject){
            $qry = "INSERT INTO teacher_subjects (teacher_id, subject_id) VALUES('$id','$subject')";
            mysqli_query($con, $qry);
        }
    }
    $_SESSION['message'] = "Subject assigned successfully.";
    header('location:'.$url.'admin/index.php');
}

$selectedSubjectIds = [];

$qry = "SELECT subject_id from teacher_subjects where teacher_id = '$id'";
$result = mysqli_query($con, $qry);
if($result != false){
    foreach($result as $subject){
        $selectedSubjectIds[] = $subject['subject_id'];
    }
}
//var_dump($selectedSubjectIds);

?>
<?php include '../header.php' ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-secondary"><span class="text-success">A</span>ssign Subjects to Teacher (<?php echo $teacher['name'];?>)</h1>
</div>
<div class="container mt-5">
    <div class="px-4 py-2">
        <a href="<?php echo $url . 'admin/index.php'; ?>" class="btn backbutton w-25 mb-5 rounded-pill">Back</a>
        <?php
        $qry = "SELECT * from subjects";
        $result = mysqli_query($con, $qry);

        if($result->num_rows > 0){
            ?>
            <form method="post">
                <?php
                foreach($result as $sub){
                    $checked = "";
                    if(in_array($sub['id'], $selectedSubjectIds))
                        $checked = " checked";
                    ?>
                    <p><label><input type='checkbox' name="subjects[]" <?php echo $checked;?> value="<?php echo $sub['id'];?>"> <?php echo $sub['name'];?></label></p>
                    <?php
                }
                ?>

                <button class="btn btn-success">Save</button>
            </form>
            <?php
        } else {
            echo "<h4>No Subject Available.</h4>";
        }
        ?>
    </div>
</div>
<?php include '../footer.php'; ?>
