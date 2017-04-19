<?php

if (isset($_GET['uId'])) {

    //convert into a variable
    $uId = $_GET['uId'];

    $selectUserById = selectUserById($uId);

    while ($row = mysqli_fetch_assoc($selectUserById)) {
        $userId = $row['user_id'];
        $username = $row['username'];
        $userEmail = $row['email'];
        $userPassword = $row['password'];
        $firstName = $row['first_name'];
        $lastName = $row['last_name'];
        $userRole = $row['role'];
        $dateSubscribed = $row['date_subscribed'];
    }

    if (isset($_POST['submit'])) {

        $username = $_POST['username'];
        $userEmail = $_POST['email'];
        $userPassword = $_POST['password'];
        $hashPassword = password_hash($userPassword, PASSWORD_BCRYPT, array('cost' => 10));
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $userRole = $_POST['user_role'];
//    $postImage = $_FILES['image']['name'];
//    $postImgTemp = $_FILES['image']['tmp_name'];
        $dateEdited = date('d-m-y');

//    move_uploaded_file($postImgTemp, "../images/$postImage");

//    if we didn't change the image to show old one:
//    if (empty($postImage)){
//
//        $query = "SELECT * FROM posts WHERE post_id={$postId}";
//        $selectImage = mysqli_query($connection, $query);
//
//        while ($row = mysqli_fetch_assoc($selectImage)){
//            $postImage = $row['post_image'];
//        }
//    }
        $query = "UPDATE users SET ";
        $query .= "username = '{$username}', ";
        $query .= "email = '{$userEmail}', ";
        $query .= "password = '{$hashPassword}', ";
        $query .= "first_name = '{$firstName}', ";
        $query .= "last_name = '{$lastName}', ";
        $query .= "role = '{$userRole}' ";
        $query .= "WHERE user_id = {$userId}";

        $editUser = mysqli_query($connection, $query);

        confirmQuery($editUser);

        echo "<p class='bg-success'>User was successfully updated.  <a href='users.php'>View All Users</a></p>";


    }
}else {
    header("location : index.php");
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
        <input class="btn btn-primary" type="submit" name="submit" value="Edit User">
    </div>
</form>