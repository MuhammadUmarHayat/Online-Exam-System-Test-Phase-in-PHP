<?php include '../../config.php';?>
<?php
checkAuth('Admin');

$name = "";
$email = "";
$password = "";
$nameErr = "";
$emailErr = "";
$passErr = "";

if(!isset($_GET['id'])) {
    die("<h2>404 - Page Not Found</h2>");
}

$id = $_GET['id'];
$qry = "SELECT * from user where id='$id' AND type='Teacher'";
$result = mysqli_query($con, $qry);

if ($result != false) {
    $result = mysqli_fetch_assoc($result);
    $name = $result['name'];
    $email = $result['email'];
    $password = $result['password'];
}  else {
    die("<h2>404 - Page Not Found</h2>");
}

if (!empty($_POST)) {
    if (!empty($_POST['name'])) {
        if (!empty($_POST['email'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];

            $qry = "SELECT * FROM user where email ='$email' AND id != '$id'";

            $result = mysqli_query($con, $qry);
            if ($result->num_rows < 1) {

                $passwordQ = "";
                if (!empty($_POST['password'])) {
                    $passwordQ = ", password='" . $_POST['password'] . "' ";
                }

                $qry = "UPDATE user SET name='$name', email='$email' $passwordQ WHERE id='$id' AND type='Teacher'";

                if (mysqli_query($con, $qry)) {
                    $_SESSION['message'] = "Teacher updated successfully.";
                    header('location:'.$url.'admin/index.php');
                }

            } else {
                $emailErr = "Email already exist.";
            }
        } else {
            $emailErr = "Email field is empty.";
        }
    } else {
        $nameErr = "Name field is empty.";
    }
}

?>
<?php include "../header.php";?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 text-secondary"><span class="text-success">E</span>dit Teacher</h1>
    </div>
    <div class="container mt-5">
        <div class="px-4 py-2">
            <div class="row">
                <div class="col-12 col-lg-8 mx-auto">
                    <form method="POST">
                        <a href="<?php echo $url . 'admin/index.php'; ?>" class="btn backbutton w-25 rounded-pill">Back</a>
                        <div class="form-group p-1 pt-5">
                            <p class="text-danger mb-0 ml-2"><?php echo $nameErr?></p>
                            <input type="text" name="name" class="form-control border-success rounded-pill" id="name" aria-describedby="emailHelp" placeholder="Name" value="<?php echo $name; ?>" required>
                        </div>
                        <div class="form-group p-1 pb-3">
                            <p class="text-danger mb-0 ml-2"><?php echo $emailErr?></p>
                            <input type="email" name="email" class="form-control border-success rounded-pill" id="email" aria-describedby="emailHelp" placeholder="E-mail" value="<?php echo $email; ?>" required>
                        </div>
                        <div class="form-group p-1 pb-3">
                            <p class="text-danger mb-0 ml-2"><?php echo $passErr?></p>
                            <input type="password" name="password" class="form-control border-success rounded-pill" id="password" placeholder="Password" value="<?php echo $password; ?>">
                        </div>
                        <button type="submit" class="float-right btn btn-success w-100 rounded-pill">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include "../footer.php";?>