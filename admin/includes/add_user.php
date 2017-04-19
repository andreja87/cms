<?php
$newUser = addUser();
if($newUser){

    echo "The new user has been created - <a href='users.php'>View all users</a>";

}
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>

    <div class="form-group">
        <label for="first_name">First Name</label>
    <input type="text" class="form-control" name="first_name" id="first_name">
    </div>

    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" class="form-control" id="last_name" name="last_name">
    </div>

<!--    <div class="form-group">-->
<!--        <label for="image">Image</label>-->
<!--        <input type="file" name="image" id="image">-->
<!--    </div>-->

    <div class="form-group">
        <label for="role">Role</label><br>
        <select name="role" id="">

<!--consider option to pull out enum values from data base and display it in the option tags instead of hard coded values which are currently here bellow-->
            <option value="subscriber">Select Role</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="submit" value="Add User">
    </div>
</form>