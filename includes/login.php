<?php session_start(); // tells server to prepare the session ?>
<?php include 'db.php'; ?>
<?php include '../admin/functions.php'; ?>


<?php

if (isset($_POST['submit'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    loginUser($username, $password);

} // if
