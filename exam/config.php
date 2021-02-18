<?php
session_start();
$con = mysqli_connect('localhost','root');
mysqli_select_db($con,'examsystem2');
if(mysqli_connect_error())
{
    die("DB Connection Failed");
}


$url = 'http://localhost/exam/';
// Redirecting User
function redirectUser($user){
    if ($user['type'] == 'Admin')
        header('Location:'.$GLOBALS['url'].'admin/index.php');
    elseif ($user['type'] == 'Teacher')
        header('Location:'.$GLOBALS['url'].'teacher/index.php');
    else
        header('Location:'.$GLOBALS['url'].'student/index.php');
}

// Checking Authentication
function checkAuth($type){
    if(!isset($_SESSION['auth'])){
        header('location:'.$GLOBALS['url'].'index.php');
    } else {
        $user = $_SESSION['auth'];
        if($user['type'] != $type){
            redirectUser($user);
        }
    }
}
