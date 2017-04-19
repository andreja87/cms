<table class="table table-bordered table-hover">
    <thead>
    <tr>
    <th>Id</th>
        <th>User Image</th>
        <th>Username</th>
    <th>Email</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Role</th>
    <th>Date </th>
    <th>Edit </th>
    <th>Admin</th>
    <th>Subscriber</th>
    <th>Delete</th>
    </tr>
    </thead>
    <tbody>

    <?php

    $query = "SELECT * FROM users";
    $selectAllUsers = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($selectAllUsers)){

        $userId = $row['user_id'];
        $username = $row['username'];
        $userEmail = $row['email'];
        $firstName = $row['first_name'];
        $lastName = $row['last_name'];
        $userImage = $row['user_image'];
        $userRole = $row['role'];
        $dateSubscribed = $row['date_subscribed'];


        echo "<tr>";
        echo "<td>{$userId}</td>";
        echo "<td><img width='100' src='../images/$userImage'></td>";
        echo "<td>{$username}</td>";
        echo "<td>{$userEmail}</td>";
        echo "<td>{$firstName}</td>";
        echo "<td>{$lastName}</td>";
        echo "<td>{$userRole}</td>";
        echo "<td>{$dateSubscribed}</td>";
        echo "<td><a href='users.php?source=edit_user&uId={$userId}'>Edit</a></td>";
        // first source parameter is the name of the page which we included in the switch statement, second is the user id

        echo "<td><a href='users.php?change_to_admin={$userId}'>Admin</a></td>";
        echo "<td><a href='users.php?change_to_subscriber={$userId}'>Subscriber</a></td>";
        echo "<td><a href='users.php?delete={$userId}'>Delete</a></td>";

        echo "</tr>";
    }
    ?>

    </tbody>
</table>

<?php
// approve
if (isset($_GET['change_to_admin'])){

    $changeToAdminId = $_GET['change_to_admin'];
    $query = "UPDATE users SET role='admin' WHERE user_id={$changeToAdminId}";
    $changeToAdmin = mysqli_query($connection, $query);

    confirmQuery($changeToAdmin);

    header("Location: users.php?source=view_all_users");
}

//undo approve
if (isset($_GET['change_to_subscriber'])){

    $changeToSubscriberId = $_GET['change_to_subscriber'];
    $query = "UPDATE users SET role='subscriber' WHERE user_id={$changeToSubscriberId}";
    $changeToSubscriber = mysqli_query($connection, $query);

    confirmQuery($changeToSubscriber);

    header("Location: users.php?source=view_all_users");
}


// delete comments
if (isset($_GET['delete'])){

    // this code will prevent anybody to come and execute the code from url
    if (isset($_SESSION['user_role'])) {
        if($_SESSION['user_role'] === 'admin') {

            $deleteUserId = mysqli_real_escape_string($connection, $_GET['delete']);

            $query = "DELETE FROM users WHERE user_id={$deleteUserId}";
            $deleteUser = mysqli_query($connection, $query);

            confirmQuery($deleteUser);

            header("Location: users.php?source=view_all_users");


        }else{
            echo 'error';
        }
    }
}
