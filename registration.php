<?php  include "includes/db.php"; ?>
<?php  include "admin/functions.php"; ?>
<?php  include "includes/header.php"; ?>
<!-- Navigation -->
<?php  include "includes/nav.php"; ?>
<!-- Registration -->
<?php

// checking the server variable to see if we have the post request
if ($_SERVER['REQUEST_METHOD'] == "POST"){
// the best way to avoid a couple of complications

$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);

$error = [
        'username' => '',
        'email' => '',
        'password' => ''
];

// username validation:
// how many character field has
    if (strlen($username) < 5){
        $error['username'] = 'the username needs to be at least 5 characters long';
    }
    if ($username == ''){
        $error['username'] = 'the username is required';
    }
    if (usernameExist($username)){
        $error['username'] = 'This username is already taken';
    }

//    email validation
    if ($email == ''){
        $error['email'] = 'the email is required';
    }
    if (dataExist('users', 'email', $email)){
        $error['email'] = 'This email is already registered, please try to <a href="index.php"> login</a>';
    }

//    password validation
    if (strlen($password) < 3){
        $error['password'] = 'the password needs to be at least 10 characters long';
    }
    if ($password == ''){
        $error['password'] = 'the password is required';
    }

    foreach($error as $key => $value){

        if (empty($value)){
            unset($error[$key]); // we unset the key if everything is all right
        }
    } // foreach

    if (empty($error)){
        registerUser($username, $email,$password);

        loginUser($username, $password);
    }
}
?>

    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" autocomplete="on" value="<?php echo isset($username) ? $username: ''; ?>">

                            <p><?php echo isset($error['username']) ? $error['username'] : ''; ?></p>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" autocomplete="on" value="<?php echo isset($email) ? $email : '' ?>">

                             <p><?php echo isset($error['email']) ? $error['email'] : ''; ?></p>
                         </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password" >
                             <p><?php echo isset($error['password']) ? $error['password'] : ''; ?></p>

                         </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
