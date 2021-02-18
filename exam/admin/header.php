<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!--Bootstrap Dashboard Link-->
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/dashboard/">
    <!--Icons Link-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!--Bootstrap Link-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--External StyleSheet-->
    <link rel="stylesheet" href="<?php echo $url?>assets/css/style.css">
    <title>Exam System</title>
</head>
<body class="bg-white">
<nav class="navbar navbar-light bg-white flex-md-nowrap p-3 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0 text-success" href="#">Exam System</a>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="text-decoration-none text-danger" href="<?php echo $url . "logout.php";?>"><i class="fa fa-sign-out-alt p-1"></i>LOGOUT</a>
        </li>
    </ul>
</nav>
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column pt-5">

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $url . "admin/index.php";?>">
                            <span data-feather="user"></span>
                            Teachers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $url . "admin/students.php";?>">
                            <span data-feather="user"></span>
                            Students
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $url . "admin/subjects.php";?>">
                            <span data-feather="file"></span>
                            Subjects
                        </a>
                    </li>
                </ul>
            </div>
        </nav>


        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">