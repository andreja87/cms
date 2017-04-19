<?php include 'includes/admin_header.php'; ?>
<div id="wrapper">

    <!-- Navigation -->
    <?php include 'includes/admin_nav.php'; ?>
<?php
//we have a two options for this stage:
//we can pull out user id and make a get request and trough a link pass a parameter $id for the request
//or we can use a session:

if (isset($_SESSION['user_id'])){

    $userId = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE user_id = {$userId}";

    $selectUser = mysqli_query($connection, $query);

    confirmQuery($selectUser);

    while($row = mysqli_fetch_assoc($selectUser)){

        $userId = $row['user_id'];
        $username = $row['username'];
        $userEmail = $row['email'];
        $userPassword = $row['password'];
        $firstName = $row['first_name'];
        $lastName = $row['last_name'];
        $userRole= $row['role'];

    }
}
?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
<!--                    page header  -->
                    <?php
                    $source = $_GET['source'];
                    issetGetSource($source);
                    ?>
                </div>

                <?php
                if (isset($_POST['submit'])){

                    $username = $_POST['username'];
                    $userEmail = $_POST['email'];
                    $userPassword = $_POST['password'];
                    $firstName = $_POST['first_name'];
                    $lastName = $_POST['last_name'];
                    $userRole = $_POST['user_role'];

                    $query = "UPDATE users SET ";
                    $query .= "username = '{$username}', ";
                    $query .= "email = '{$userEmail}', ";
                    $query .= "password = '{$userPassword}', ";
                    $query .= "first_name = '{$firstName}', ";
                    $query .= "last_name = '{$lastName}', ";
                    $query .= "role = '{$userRole}' ";
                    $query .= "WHERE user_id = {$userId}";

                    $editUser = mysqli_query($connection, $query);

                    confirmQuery($editUser);
                }
                ?>

                <form action="" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input value="<?php echo $username; ?>"type="text" class="form-control" id="username" name="username">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input value="<?php echo $userEmail; ?>"type="email" class="form-control" id="email" name="email">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" value="<?php echo $userPassword; ?>">
                    </div>

                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input value="<?php echo $firstName; ?>"type="text" class="form-control" id="first_name" name="first_name">
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input value="<?php echo $lastName; ?>"type="text" class="form-control" id="last_name" name="last_name">
                    </div>

                    <div class="form-group">
                        <label for="user_role">Role</label><br>
                        <select name="user_role" id="">

                            <option value="<?php echo $userRole; ?>"><?php echo $userRole; ?></option>

                            <?php
                            //              displaying dynamically select options for user role:
                            if($userRole == 'admin'){
                                echo '<option value="subscriber">subscriber</option>';
                            }else{
                                echo '<option value="admin">admin</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <!--    <div class="form-group">-->
                    <!--        <img width="100" src="../images/--><?php //echo  $postImage; ?><!--" alt="">-->
                    <!--        <input type="file" name="image" class="form-control" id="image">-->
                    <!--    </div>-->

                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="submit" value="Update Profile">
                    </div>
                </form>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include 'includes/admin_footer.php'; ?>

