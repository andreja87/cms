<?php  include "includes/db.php"; ?>
<?php  include "admin/functions.php"; ?>
<?php  include "includes/header.php"; ?>
<!-- Navigation -->
<?php  include "includes/nav.php"; ?>
<!-- Registration -->
<?php

if (isset($_POST['submit'])){

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($email) && !empty($password)){

        $username = mysqli_real_escape_string($connection,$username);
        $email = mysqli_real_escape_string($connection,$email);
        $password = mysqli_real_escape_string($connection,$password);

        $passwordHash = password_hash($password, PASSWORD_BCRYPT, array('cost' =>12));

//        //checking for a default value:
//        $query = "SELECT rand_salt FROM users";
//        $selectRandSalt = mysqli_query($connection, $query);
//
//        confirmQuery($selectRandSalt);
//        while($row = mysqli_fetch_array($selectRandSalt)){
//
//            $salt = $row['rand_salt'];
//        }
//
//        $saltPassword = crypt($password, $salt);

        $query = "INSERT INTO users(username, email, password) ";
        $query .= "VALUES('{$username}', '{$email}', '{$passwordHash}')";

        $registerUser = mysqli_query($connection, $query);

        confirmQuery($registerUser);
//        header("Location: index.php");

        $message = "Your registration has been submitted";
    }else {

        echo "<script>alert('Please Fill All Registration Fields')</script>";
    }
}else {
    $message = "";// this to prevent error of the user didn't click submit and page is refreshed the
    //var $message without defining as empty in else will occur error
}
?>

    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1 class="text-center">Contact</h1>
                    <h6 class="text-center"><?php echo $message; ?></h6>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">

                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Please enter your email" required>
                        </div>

                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Please enter the subject" required>
                        </div>

                        <div class="form-group">
                            <label for="message" class="sr-only">Message</label>
                            <textarea class="form-control" name="message" id="message" cols="50" rows="10" placeholder="Your message here..."></textarea>
                        </div>

                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Send Message">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
