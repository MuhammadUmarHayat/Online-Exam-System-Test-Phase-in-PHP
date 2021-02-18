<?php include '../../config.php';?>
<?php
checkAuth('Admin');

$name = "";
$nameErr = "";

if(!empty($_POST)) {
    if (!empty($_POST['name'])) {

        $name = $_POST['name'];
        $qry = "SELECT * FROM subjects where name ='$name'";
        $result = mysqli_query($con, $qry);
        if ($result->num_rows < 1) {
            $qry = "INSERT INTO subjects(name) VALUES ('$name')";
            if(mysqli_query($con,$qry)){
                $_SESSION['message'] = "Subject created successfully.";
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
<?php include '../header.php'; ?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 text-secondary"><span class="text-success">C</span>reate Subject</h1>
    </div>
    <div class="container mt-5">
        <div class="px-4 py-2">
            <div class="row">
                <div class="col-12 col-lg-8 mx-auto">
                    <form method="POST">
                        <a href="<?php echo $url . 'admin/subjects.php'; ?>" class="btn backbutton w-25 rounded-pill">Back</a>
                        <div class="form-group p-1 pt-5">
                            <p class="text-danger mb-0 ml-2"><?php echo $nameErr?></p>
                            <input type="text" name="name" class="form-control border-success rounded-pill" id="name" aria-describedby="emailHelp" value="<?php echo $name; ?>" placeholder="Name" required>
                        </div>
                        <button type="submit" class="float-right btn btn-success w-100 rounded-pill">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include '../footer.php'; ?>