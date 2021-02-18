<?php include '../../config.php';?>
<?php
checkAuth('Admin');

$name = "";
$nameErr = "";

if(!isset($_GET['id'])) {
    die("<h2>404 - Page Not Found</h2>");
}

$id = $_GET['id'];
$qry = "SELECT * from subjects where id='$id'";
$result = mysqli_query($con, $qry);

if ($result != false) {
    $result = mysqli_fetch_assoc($result);
    $name = $result['name'];
}  else {
    die("<h2>404 - Page Not Found</h2>");
}

if (!empty($_POST)) {
    if (!empty($_POST['name'])) {
        $name = $_POST['name'];
        $qry = "SELECT * FROM subjects where name ='$name' AND id != '$id'";
        $result = mysqli_query($con, $qry);
        if ($result->num_rows < 1) {
            $qry = "UPDATE subjects SET name='$name' WHERE id='$id'";

            if (mysqli_query($con, $qry)) {
                $_SESSION['message'] = "Subject updated successfully.";
                header('location:'.$url.'admin/subjects.php');
            }
        } else {
            $nameErr = "Subject already exist.";
        }
    } else {
        $nameErr = "Name field is empty.";
    }
}

?>
<?php include "../header.php";?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 text-secondary"><span class="text-success">U</span>pdate Subject</h1>
    </div>
    <div class="container mt-5">
        <div class="px-4 py-2">
            <div class="row">
                <div class="col-12 col-lg-8 mx-auto">
                    <form method="POST">
                        <a href="<?php echo $url . 'admin/subjects.php'; ?>" class="btn backbutton w-25 rounded-pill">Back</a>
                        <input class="" type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="form-group p-1 pt-5">
                            <p class="text-danger mb-0 ml-2"><?php echo $nameErr?></p>
                            <input type="text" name="name" class="form-control border-success rounded-pill" id="name" aria-describedby="emailHelp" placeholder="Name" value="<?php echo $name; ?>" required>
                        </div>
                        <button type="submit" class="float-right btn btn-success w-100 rounded-pill">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include "../footer.php";?>