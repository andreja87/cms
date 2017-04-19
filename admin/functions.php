<?php
// get page id
function getPostId(){

    if (isset($_GET['pId'])){

        //convert into a variable
        $pId = $_GET['pId'];

        return $pId;

    }
}
// count Database Record in the table for the admin.index.php
function recordCount($tableName){
    global $connection;

    $query = "SELECT * FROM " . $tableName;
    $countRecord = mysqli_query($connection, $query);
    confirmQuery($countRecord);

    $recordCount = mysqli_num_rows($countRecord);
    return $recordCount;
}

// selecting all posts, comments or users with the same status for admin/index.php
function checkStatus($table,$column,$status){

    global $connection;
    $query = "SELECT * FROM " . $table . " WHERE " . $column . "='" . $status . "'";
    $checkStatus = mysqli_query($connection, $query);
    confirmQuery($checkStatus);

    $numOfRecords = mysqli_num_rows($checkStatus);
    return $numOfRecords;
}

// return session username
function sessionUsername(){
    if (isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        return $username;
    }
}

// is admin
function isAdmin($username = ""){

    global $connection;

    $query = "SELECT role FROM users WHERE username = '{$username}'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    $row = mysqli_fetch_assoc($result);
    if ($row['role'] == 'admin'){
        return true;
    }else{
        return false;
    }
}

// checking the username and email during the registration
/**
 * @param $table
 * @param $column
 * @param $data
 * @return bool
 */
function dataExist($table, $column, $data){

    global $connection;
    $query = "SELECT $column FROM $table WHERE $column='$data'";
//    $query = "SELECT" . $column . "FROM" . $table . "WHERE" . $column . "='{$data}'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    if (mysqli_num_rows($result) <= 0){
        return false;
    }else{
        return true;
    }

}

//username exist
function usernameExist($username){

    global $connection;
    $query = "SELECT username FROM users WHERE username='{$username}'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    if (mysqli_num_rows($result) <= 0){
        return false;
    }else{
        return true;
    }

}

// registration function
function registerUser($username, $email, $password){

    global $connection;

        $username = mysqli_real_escape_string($connection,$username);
        $email = mysqli_real_escape_string($connection,$email);
        $password = mysqli_real_escape_string($connection,$password);

        $passwordHash = password_hash($password, PASSWORD_BCRYPT, array('cost' =>12));

        $query = "INSERT INTO users(username, email, password) ";
        $query .= "VALUES('{$username}', '{$email}', '{$passwordHash}')";

        $result = mysqli_query($connection, $query);

        confirmQuery($result);



}

// login user
function loginUser($username, $password){

    global $connection;

    $username = trim($username);
    $password = trim($password);

    //cleaning data before we send it to database validation:
    $username = mysqli_real_escape_string($connection,$username);
    $password = mysqli_real_escape_string($connection,$password);

    $query = "SELECT * FROM users WHERE username='{$username}'";
    $result = mysqli_query($connection, $query);

    confirmQuery($result);

    while($row = mysqli_fetch_assoc($result)){

        $dbUserId = $row['user_id'];
        $dbUsername = $row['username'];
        $dbPassword = $row['password'];
        $dbFirstName = $row['first_name'];
        $dbLastName = $row['last_name'];
        $dbUserRole = $row['role'];

        //simple validation:
        if(password_verify($password, $dbPassword)) {

            $_SESSION['user_id'] = $dbUserId;
            $_SESSION['username'] = $dbUsername; // this username from the database
            //after the validation we assign to session
            $_SESSION['first_name'] = $dbFirstName;
            $_SESSION['last_name'] = $dbLastName;
            $_SESSION['user_role'] = $dbUserRole;

        }
        if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'){
            redirect("../admin");
        }
        elseif(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'subscriber'){
            redirect("../index.php");
        }else{
            echo "error";
        }
    }

} // loginUser

// function redirect
function redirect($location){
    return header("Location: " . $location);
}

// escape string
function escapeString($string){

    global $connection;
    $string = mysqli_real_escape_string($connection, trim($string));
    return $string;

}
// .includePages
function confirmQuery($result){
    global $connection;
    if (!$result){
        die("Query failed: " . mysqli_error($connection));
    }
    return $result;
}
// end confirmQuery

//add new user
function addUser(){

    global $connection;

    if (isset($_POST['submit'])) {

        $username = escapeString($_POST['username']);
        $password = escapeString($_POST['password']);
        $email = escapeString($_POST['email']);
        $firstName = escapeString($_POST['first_name']);
        $lastName = escapeString($_POST['last_name']);
        $userRole = escapeString($_POST['role']);

        $hashPassword = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));
//    $date = date("Y-m-d H:i:s");


//    $postImage = $_FILES['image']['name'];
//    $postImgTemp = $_FILES['image']['tmp_name'];

//    register = date('d-m-y');

        // we move image from temporary location into a folder images:
//    move_uploaded_file($postImgTemp, "../images/$postImage");

        // adding to database:
        $query = "INSERT INTO users(username,password,email,first_name,last_name,role,date_subscribed) ";
        $query .= "VALUES('{$username}','{$hashPassword}','{$email}','{$firstName}','{$lastName}','{$userRole}',now())";

        $addUser = mysqli_query($connection, $query);

        confirmQuery($addUser);
        return $addUser;
    }
}

// insert new post
function insertNewPost(){
    global $connection;

    $username = sessionUsername();
    if (isset($_POST['submit'])) {

        $postTitle = escapeString($_POST['title']);
        $postCategory = escapeString($_POST['post_category']);
        $postAuthor = escapeString($username);

        // we need different super global
        // also we have temporary location
        // we need to send it to temporary location when we submit a form

        $postImage = escapeString($_FILES['image']['name']);
        $postImgTemp = escapeString($_FILES['image']['tmp_name']);

        $postTags = escapeString($_POST['tags']);
        $postContent = escapeString($_POST['content']);
        $postStatus = escapeString($_POST['post_status']);
        $postDate = date('d-m-y');

        // we move image from temporary location into a folder images:
        move_uploaded_file($postImgTemp, "../images/$postImage");

        // adding to database:
        $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status) ";
        $query .= "VALUES({$postCategory},'{$postTitle}','{$postAuthor}',now(),'{$postImage}','{$postContent}','{$postTags}','{$postStatus}')";
        //for time value we send function, for category do not use '' because its an integer value

        $createPost = mysqli_query($connection, $query);

        confirmQuery($createPost);

        $InsertedPostId = mysqli_insert_id($connection);
        // will pull out the last created id in the table
        return $InsertedPostId;

    }

}// .insertNewPost
// select post by id edit_post.php
function selectPostsById(){

    global $connection;
    $pId = getPostId();

    $query = "SELECT * FROM posts WHERE post_id=$pId";
    $selectPostById = mysqli_query($connection, $query);
    confirmQuery($selectPostById);
    return $selectPostById;

}

// get category id update_categories.php
function getCatId(){
    if (isset($_GET['update'])){
        $catId = $_GET['update'];
        return $catId;
    }
}

// select category by id update_categories.php
function selectCategoryById(){

    global $connection;
    $categoryId = getCatId();

    $query = "SELECT * FROM categories WHERE cat_id='{$categoryId}'";
    $listAllCategories = mysqli_query($connection, $query);

    confirmQuery($listAllCategories);
    return $listAllCategories;

}

// update category update_categories.php
function updateCategory(){
    global $connection;
    $catId = getCatId();

    if (isset($_POST['update'])) {

        $updateCatTitle = $_POST['cat_title'];

        $stmt = mysqli_prepare($connection,"UPDATE categories SET cat_title=? WHERE cat_id=?");
        mysqli_stmt_bind_param($stmt,'si',$updateCatTitle,$catId);
        mysqli_stmt_execute($stmt);
        return $stmt;
        // a many secure application
    }
}

// if empty image in the update post
function emptyImage($postImage){

    if (empty($postImage)){

        global  $connection;
        $postId = getPostId();

        $query = "SELECT * FROM posts WHERE post_id={$postId}";
        $selectImage = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($selectImage)){
            $postImage = $row['post_image'];
            return$postImage;
        }
    }
}

// page header posts.php
function pageHeader($source){

    switch ($source){
        case'view_all_posts':
            echo "<h1 class='page-header'>All Posts</h1>";
            break;
        case'add_post':
            echo "<h1 class='page-header'>Add New Post </h1>";
            break;
        case'edit_post':
            echo "<h1 class='page-header'>Edit Post </h1>";
            break;
        case'view_all_categories':
            echo "<h1 class='page-header'>Categories</h1>";
            break;
        case'post_comments':
            echo "<h1 class='page-header'>Post Comments </h1>";
            break;
        case'view_all_comments':
            echo "<h1 class='page-header'>All Comments </h1>";
            break;
        case'view_all_users':
            echo "<h1 class='page-header'>All Users </h1>";
            break;
        case'add_user':
            echo "<h1 class='page-header'>Add New User </h1>";
            break;
        case'edit_user':
            echo "<h1 class='page-header'>Edit User </h1>";
            break;
        case'profile':
            echo "<h1 class='page=header'>Admin Profile</h1>";
            break;
        default:
            echo "<h1 class='page-header'>Welcome to Admin Dashboard </h1>";
            break;
    }
}
// .pageHeader

//comments bulk option
function commBulkOption(){

    global $connection;

    if (isset($_POST['checkBoxArray'])){
        //we check for checkBoxArray

        //looping around to the end of the array:
        foreach ($_POST['checkBoxArray'] as $checkBoxValue){

            $bulkOptions = $_POST['bulk_options']; // from select tag
            // it's change every time when we select option

            //switch statement - different states according to one condition
            switch ($bulkOptions){

                // we want to update posts according to option selection:
                case 'approve':
                    $query = "UPDATE comments SET comment_status='{$bulkOptions}' WHERE comment_id={$checkBoxValue}";
                    $approveComment = mysqli_query($connection, $query);
                    confirmQuery($approveComment);
                    break;
                case 'undo_approve':
                    $query = "UPDATE comments SET comment_status='{$bulkOptions}' WHERE comment_id={$checkBoxValue}";
                    $undoApproveComment = mysqli_query($connection, $query);
                    confirmQuery($undoApproveComment);
                    break;
                case 'delete':
                    $query = "DELETE FROM comments WHERE comment_id={$checkBoxValue}";
                    $deleteComment = mysqli_query($connection, $query);
                    confirmQuery($deleteComment);
                    break;
            }

        }
    }
}

// posts bulk options
function postBulkOption(){

    global $connection;


}
// isset get source
function issetGetSource($source){
    if (isset($source)){
        $pageHeader = pageHeader($source);
        return $pageHeader;
    }else{
        $source = "";
        return $source;
    }
} // .issetGetSource

function usersOnline (){

    if (isset($_GET['onlineUsers'])) {

        global $connection;

        if(!$connection){
            session_start();
            include("../includes/db.php");

            $session = session_id();
//when we start session the func will catching id of the session

            $time = time(); // using time to calculate if the person was on site more or less than 60sec
            $timeOutInSeconds = 05; // if the time is bigger that this then we know that they not active
            $timeOut = $time - $timeOutInSeconds;

            $query = "SELECT * FROM users_online WHERE session = '{$session}'";
            $sendQuery = mysqli_query($connection, $query);
            confirmQuery($sendQuery);
            $count = mysqli_num_rows($sendQuery);

            if ($count == NULL) {

                // == null, that means that new user is logged in we will insert logging data: session & time into db

                $query = "INSERT INTO users_online(session, time) VALUES('$session','$time')";
                $insertSession = mysqli_query($connection, $query);
                confirmQuery($insertSession);

            } else {

                // we already have user logged in before we will keep tracking user
                $query = "UPDATE users_online SET time=$time WHERE session='$session'";
                $updateSession = mysqli_query($connection, $query);
                confirmQuery($updateSession);

            }

            $query = "SELECT * FROM users_online WHERE time > '$timeOut'";
            $usersOnline = mysqli_query($connection, $query);
            confirmQuery($usersOnline);
            $countUsers = mysqli_num_rows($usersOnline);
            echo $countUsers;
        }


    } // get request isset()
}// end of the user count function
usersOnline();

function newCategory(){

    global $connection;
    if (isset($_POST['submit'])){

        $catTitle = $_POST['cat_title'];

        if (empty($catTitle) || $catTitle == ""){
            echo "Please enter a new category";
        }else{
            $stmt = mysqli_prepare($connection,"INSERT INTO categories(cat_title) VALUES (?) ");
            mysqli_stmt_bind_param($stmt,'s',$catTitle);
            mysqli_stmt_execute($stmt);

            if (!$stmt){
                echo "error: " . mysqli_error($connection);
            }

        }
    }
}   // end of the newCategory

function findAllCategories()
{

    global $connection;

    //find all categories query:
    $query = "SELECT * FROM categories";
    $selectAllCategories = mysqli_query($connection, $query);
    confirmQuery($selectAllCategories);
    return $selectAllCategories;
}
$selectAllCategories = findAllCategories();

// list categories in teh categories.php admin:
function listCategories(){

    global $selectAllCategories;

    while($row = mysqli_fetch_assoc($selectAllCategories)){

        $catId = $row['cat_id'];
        $catTitle = $row['cat_title'];

        echo "<tr>";
        echo "<td>{$catId}</td>";
        echo "<td>{$catTitle}</td>";
        echo "<td><a href='categories.php?delete={$catId}'>Delete</a></td>";
        echo "<td><a href='categories.php?update={$catId}'>Update</a></td>";
        echo "</tr>";   // use double quotes that you can use the {}

    }
} // end findAllCategories

function deleteCategory(){

    global $connection;

    if (isset($_GET['delete'])){

        $deleteCatId = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id='{$deleteCatId}'";
        $deleteCat = mysqli_query($connection, $query);

        confirmQuery($deleteCat);
        return $deleteCat;
    }
}
// end deleteCategory

// post by id
function findPostById($postId){

    global  $connection;

    $query = "SELECT * FROM posts WHERE post_id = {$postId}";
    $selectPostById = mysqli_query($connection, $query);
    confirmQuery($selectPostById);

    return $selectPostById;

}
// comments by post
function selectCommentsByPost($postId){

    global $connection;
    $query = "SELECT * FROM comments WHERE comment_post_id=$postId";
    $selectComments = mysqli_query($connection, $query);
    confirmQuery($selectComments);
    return $selectComments;
}

// comment count
function commentCount($postId){
    $selectComments = selectCommentsByPost($postId);
    $commentCount = mysqli_num_rows($selectComments);
    return $commentCount;

}

// select all active posts index.php
function activePosts(){

    global $connection;

    $query = "SELECT * FROM posts WHERE post_status = 'active'";
    $selectActivePosts = mysqli_query($connection, $query);

    confirmQuery($selectActivePosts);

    $activePostCounts = mysqli_num_rows($selectActivePosts);
    return $activePostCounts;
}

// drafted posts count index.php
function draftedPosts(){
    global  $connection;

    $query = "SELECT * FROM posts WHERE post_status = 'draft'";
    $selectDraftPosts = mysqli_query($connection, $query);

    confirmQuery($selectDraftPosts);

    $draftPostCounts = mysqli_num_rows($selectDraftPosts);
    return $draftPostCounts;
}

// unapproved comments index.php
function unapprovedComments(){
    global  $connection;

    $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
    $unapprovedComments = mysqli_query($connection, $query);

    confirmQuery($unapprovedComments);

    $unapprovedCommCount = mysqli_num_rows($unapprovedComments);
    return $unapprovedCommCount;
}

// select user by id edit_user.php
function selectUserById($uId){

    global $connection;
    $query = "SELECT * FROM users WHERE user_id=$uId";
    $selectUserById = mysqli_query($connection, $query);

    confirmQuery($selectUserById);
    return$selectUserById;
}

// subscribed users count index.php
function subscribedUsers(){

    global $connection;

    $query = "SELECT * FROM users WHERE role = 'subscriber'";
    $subscribedUsers = mysqli_query($connection, $query);

    confirmQuery($subscribedUsers);

    $subscribedUsersCount = mysqli_num_rows($subscribedUsers);
    return $subscribedUsersCount;
}

// ******* post_comments.php *****************

// delete comments
function deleteComment($commentId){
    global $connection;

    $query = "DELETE FROM comments WHERE comment_id={$commentId}";
    $deleteComment = mysqli_query($connection, $query);

    confirmQuery($deleteComment);
}

// undo approve comment
function undoApproveComment($commentId){

    global $connection;

    $query = "UPDATE comments SET comment_status='unapproved' WHERE comment_id={$commentId}";
    $undoApproveComment = mysqli_query($connection, $query);

    confirmQuery($undoApproveComment);
}

// approve comment
function approveComment($commentId){

    global $connection;

    $query = "UPDATE comments SET comment_status='approved' WHERE comment_id={$commentId}";
    $approveComment = mysqli_query($connection, $query);

    confirmQuery($approveComment);
}

//select all comments
function selectAllComments(){
    global $connection;

    $query = "SELECT * FROM comments ORDER BY comment_id DESC ";
    $selectAllComments = mysqli_query($connection, $query);

    confirmQuery($selectAllComments);
    return $selectAllComments;
}

// select posts by comment post id
function selectPostByCommentPostId($commentPostId){

    global $connection;

    $query = "SELECT * FROM posts WHERE post_id = {$commentPostId}";
    $selectCommentPost = mysqli_query($connection, $query);

    confirmQuery($selectCommentPost);
    return $selectCommentPost;
}

//


