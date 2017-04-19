<?php
include "delete_modal.php";

// posts bulk options

if (isset($_POST['checkBoxArray'])){
    //we check for checkBoxArray

    //looping around to the end of the array:
    foreach ($_POST['checkBoxArray'] as $checkBoxValue){

        $bulkOptions = $_POST['bulk_options']; // from select tag
        // it's change every time when we select option

        //switch statement - different states according to one condition
        switch ($bulkOptions){

            // we want to update posts according to option selection:
            case 'active':
                $query = "UPDATE posts SET post_status='{$bulkOptions}' WHERE post_id={$checkBoxValue}";
                $publishPost = mysqli_query($connection, $query);
                confirmQuery($publishPost);
                break;
            case 'draft':
                $query = "UPDATE posts SET post_status='{$bulkOptions}' WHERE post_id={$checkBoxValue}";
                $draftPost = mysqli_query($connection, $query);
                confirmQuery($draftPost);
                break;
            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id={$checkBoxValue}";
                $selectPosts = mysqli_query($connection, $query);

                confirmQuery($selectPosts);
                while ($row = mysqli_fetch_assoc($selectPosts)) {
                    $postAuthor = $row['post_author'];
                    $postTitle = $row['post_title'];
                    $postCatId = $row['post_category_id'];
                    $postImage = $row['post_image'];
                    $postContent = $row['post_content'];
                    $postTags = $row['post_tags'];


                    $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags) ";
                    $query .= "VALUES({$postCatId},'{$postTitle}','{$postAuthor}',now(),'{$postImage}','{$postContent}','{$postTags}')";

                    $clonePost = mysqli_query($connection, $query);
                    confirmQuery($clonePost);
                    header("Location: posts.php?source=view_all_posts");
                }
                break;
            case 'delete':
                $query = "DELETE FROM posts WHERE post_id={$checkBoxValue}";
                $deletePost = mysqli_query($connection, $query);
                confirmQuery($deletePost);
                break;
        }

    }
}
?>
<div class="container-fluid">
    <form action="" method="post">

    <div class="row">
    <div id="bulkOptionsContainer" class="col-xs-4">
        <select class="form-control" name="bulk_options" id="bulk_options">
            <option value="">Select Options</option>
            <option value="active">Publish</option>
            <option value="draft">Draft</option>
            <option value="clone">Clone</option>
            <option value="delete">Delete</option>
        </select>
    </div>
    <div class="col-xs-4">
        <input type="submit" name="submit" value="Apply" class="btn btn-success">
        <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
    </div>
    </div>
<!--    div row above is putted because of styling the #bulkOptionsContainer id-->
        <div class="row">
        <table class="table table-bordered table-hover" id="view-all-posts">
    <thead>
    <tr>
    <th><input type="checkbox" class="checkbox" id="selectAllBoxes" ></th>
    <th>Author</th>
    <th>Title</th>
    <th>Category</th>
    <th>Status</th>
    <th>Image</th>
<!--    <th>Tags</th>-->
<!--    <th>Date</th>-->
    <th>Comm</th>
    <th>Views</th>
    <th>View</th>
    <th>Edit</th>
    <th>Delete</th>
    </tr>
    </thead>
    <tbody>

    <?php

//    $query = "SELECT * FROM posts ORDER BY post_id DESC";
    // joining tables together:
    // name of the table.column name,... FROM table LEFT JOIN table ON table.the same field=table.the same field
// we making the lass queries the application is faster and cleaner

    $query = "SELECT posts.post_id, posts.post_author, posts.post_title, posts.post_category_id, posts.post_status,posts.post_image, ";
    $query .= "posts.post_content, posts.post_tags, post_view_count, categories.cat_id, categories.cat_title FROM posts ";
    $query .= "LEFT JOIN categories ON posts.post_category_id=categories.cat_id ORDER BY posts.post_id DESC";

    $selectPosts = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($selectPosts)){
        $postId = $row['post_id'];
        $postAuthor = $row['post_author'];
        $postTitle = $row['post_title'];
        $postCatId = $row['post_category_id'];
        $postStatus = $row['post_status'];
        $postImage = $row['post_image'];
        $postTags = $row['post_tags'];
//        $postDate = $row['post_date'];
        $postViews = $row['post_view_count'];
        $catTitle = $row['cat_title'];
        $catId = $row['cat_id'];
        echo "<tr>";
        echo "<td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' id='select' value='{$postId}'></td>";
        // we fill array with ids of the posts that we want to apply changes
        echo "<td>{$postAuthor}</td>";
        echo "<td>{$postTitle}</td>";

//        $query = "SELECT * FROM categories WHERE cat_id = {$postCatId}";
//
//        $selectCategories = mysqli_query($connection, $query);
//
//        while ($row = mysqli_fetch_assoc($selectCategories)){
//
//            $catId = $row['cat_id'];
//            $catTitle = $row['cat_title'];

        echo "<td>{$catTitle}</td>";
        echo "<td>{$postStatus}</td>";
        echo "<td><img width='100' height='50' src='../images/$postImage'></td>";
//        echo "<td>{$postTags}</td>";
        echo "<td><a href='posts.php?source=post_comments&pId=$postId'>" . commentCount($postId) . "</a></td>";
        echo "<td><a href='posts.php?reset={$postId}'>{$postViews}</a></td>";
        echo "<td><a class='btn btn-primary' href='../post.php?pId={$postId}'>View</a></td>";
        echo "<td><a class='btn btn-success' href='posts.php?source=edit_post&pId={$postId}'>Edit</a></td>";

        ?>
        <form method="post">
            <input type="hidden" name="post_id" value="<?php echo $postId; ?>">


            <?php
            echo '<td><input class="btn btn-danger" type="submit" name="delete" value="Delete"></td>';
            ?>
        </form>
        <?php


//        echo "<td><a rel='{$postId}' class='delete_link' href='javascript:void(0)'>Delete</a></td>";
//        echo "<td><a onclick=\"javascript: return confirm('Are you sure you want to delete this post?'); \" href='posts.php?delete={$postId}'>Delete</a></td>";

        echo "</tr>";
    }
    ?>

    </tbody>
</table>
        </div>
</form>
</div>

<?php
// deleting via post method
if (isset($_POST['delete'])){

    $postId = $_POST['post_id'];
    $query = "DELETE FROM posts WHERE post_id={$postId}";
    $result = mysqli_query($connection, $query);

    confirmQuery($result);
    header("Location: posts.php");
}

//reset views
if (isset($_GET['reset'])){

    $resetViewsId = mysqli_real_escape_string($connection, $_GET['reset']);

    $query = "UPDATE posts SET post_view_count = 0 WHERE post_id={$resetViewsId}";
    $resetViewsQuery = mysqli_query($connection, $query);
// you should always escape values that you put in the db
    confirmQuery($resetViewsQuery);
    header("Location: posts.php");
}

?>

<script>
<!--    for make that delete modal work we have to write js code direct on the page because of dynamic content-->
    
    $(document).ready(function () {

//        function is targeting this specific class
        $(".delete_link").on('click', function () {

//            (this) means that specific item
            var id = $(this).attr("rel");
//            we need to send a get request
            var deleteUrl = "posts.php?delete="+ id +""; //delete link


            $(".modal_delete_link").attr("href", deleteUrl);

            $("#myModal").modal('show');

        });
        
    });
</script>