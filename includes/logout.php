<?php
ob_start();
session_start(); // tells server to prepare the session ?>

<?php

$_SESSION['username'] = null;
$_SESSION['first_name'] = null;
$_SESSION['last_name'] = null;
$_SESSION['user_role'] = null;
// when user whant to log out we are cancelling sessions for that user and sent him to index.php

header("Location: ../index.php");

