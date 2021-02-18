<?php include '../../config.php';?>
<?php
checkAuth('Admin');

$name = "";
$email = "";
$password = "";
$nameErr = "";
$emailErr = "";
$passErr = "";

if(!empty($_POST)) {
    if (!empty($_POST['name'])) {
        if (!empty($_POST['email'])) {
            if (!empty($_POST['password'])) {

                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                $qry = "SELECT * FROM user where email ='$email'";

                $result = mysqli_query($con,$qry);
                if($result->num_rows < 1){

                    $qry = "INSERT INTO user(name, email, type, password) VALUES ('$name','$email','Teacher','$password')";

                    if(mysqli_query($con,$qry)){
                        $_SESSION['message'] = "Teacher created successfully.";
                        header('location:'.$url.'admin/index.php');
                    }
                } else {
                    $emailErr = "Email already exist.";
                }
            } else {
                $passErr = "Password field is empty.";
            }
        } else {
            $emailErr = "Email field is empty.";
        }
    } else {
        $nameErr = "Name field is empty.";
    }
}
?>
<?php include '../header.php';?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 text-secondary"><span class="text-success">C</span>reate Teacher</h1>
    </div>
    <div class="container mt-5">
        <div class="px-4 py-2">
            <div class="row">
                <div class="col-12 col-lg-8 mx-auto">
                    <form method="POST">
                        <a href="<?php echo $url . 'admin/index.php'; ?>" class="btn backbutton w-25 rounded-pill">Back</a>
                        <div class="form-group p-1 pt-5">
                            <p class="text-danger mb-0 ml-2"><?php echo $nameErr?></p>
                            <input type="text" name="name" class="form-control border-success rounded-pill" id="name" aria-describedby="emailHelp" placeholder="Name" value="<?php echo $name?>" required>
                        </div>
                        <div class="form-group p-1 pb-3">
                            <p class="text-danger mb-0 ml-2"><?php echo $emailErr?></p>
                            <input type="email" name="email" class="form-control border-success rounded-pill" id="email" aria-describedby="emailHelp" value="<?php echo $email?>" placeholder="E-mail" required>
                        </div>
                        <div class="form-group p-1 pb-3">
                            <p class="text-danger mb-0 ml-2"><?php echo $passErr?></p>
                            <input type="password" name="password" class="form-control border-success rounded-pill" id="password" placeholder="Password" value="<?php echo $password?>" required>
                        </div>
                        <button type="submit" class="float-right btn btn-success w-100 rounded-pill">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include '../footer.php'; ?>