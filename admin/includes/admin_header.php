<?php
include "../includes/db.php";
include 'functions.php';
ob_start(); // redirecting users in the future
session_start(); // we can use value from the session

//checking if the user role is admin
if (!isset($_SESSION['user_role'])) {

    header("Location: ../index.php");

}else{

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet" type="text/css">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<!--    Custom CSS -->
    <link href="css/style.css" rel="stylesheet" type="text/css">



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <!--for google column chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="//cloud.tinymce.com/stable/tinymce.min.js?apiKey=xy2qkqv9e126do9lgo6ckex0ari5cfbl7aq7ucp2dbs57sx4"></script>


    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <![endif]-->

</head>

<body>
