<?php include 'config.php';?>
<?php
$userErr = "";
$passErr = "";
$email = "";
$password = "";

if(!empty($_POST)) {
    if(!empty($_POST['email'])){
        if(!empty($_POST['password'])){
            $email = $_POST['email'];
            $password = $_POST['password'];

            $qry = "Select * from user where email  = '$email' and password = '$password'";

            $results = mysqli_query($con, $qry);
            if ($results->num_rows > 0) {
                $user = mysqli_fetch_assoc($results);
                $_SESSION['auth'] = $user;
                redirectUser($user);
            } else {
                $userErr = "Invalid email or password.";
            }
        } else {
            $passErr = "Password field is empty.";
        }
    } else {
        $userErr = "Email field is empty.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Icons Link-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!--Bootstrap Link-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--External StyleSheet-->
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Login Form</title>
</head>
<body>
<div class="container p-0">
<h1 class="text-center text-secondary">Web Based Exam System| Test Phase By Iqra Mehmood </h1>
    <main class="m-auto shadow bg-white p-3 w-75 rounded">

        <div class="m-auto pt-5">
            <h2 class="text-center text-secondary">
LOGIN.</h2>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6 m-auto p-5">
                <form method="POST" action="index.php">

                    <div class="form-group p-1">
                        <p class="text-danger mb-0 ml-2"><?php echo $userErr?></p>
                        <input type="email" name="email" class="form-control border-success rounded-pill" id="email" aria-describedby="emailHelp" placeholder="E-mail" required>
                    </div>
                    <div class="form-group p-1 pb-3">
                        <p class="text-danger mb-0 ml-2"><?php echo $passErr?></p>
                        <input type="password" name="password" class="form-control border-success rounded-pill" id="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Submit</button>
                </form>
            </div>
        </div>
    </main>
</div>
<!--JQuery, Popper and Javascript Link-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>