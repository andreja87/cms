<?php
$pId = getPostId();

$selectPostById = selectPostsById(); // consult which function is better
while($row = mysqli_fetch_assoc($selectPostById)) {
    $postId = $row['post_id'];
    $postAuthor = $row['post_author'];
    $postTitle = $row['post_title'];
    $postContent = $row['post_content'];
    $postCatId = $row['post_category_id'];
    $postStatus = $row['post_status'];
    $postImage = $row['post_image'];
    $postTags = $row['post_tags'];
    $postDate = $row['post_date'];
}

if (isset($_POST['submit'])) {

    $postId = getPostId();

    $postAuthor = escapeString($_POST['author']);
    $postTitle = $_POST['title'];
    $postContent = escapeString($_POST['content']);
    $postCatId = $_POST['post_category'];
    $postStatus = $_POST['status'];
    $postImage = $_FILES['image']['name'];
    $postImgTemp = $_FILES['image']['tmp_name'];
    $postTags = $_POST['tags'];
    $postDate = date('d-m-y');

    move_uploaded_file($postImgTemp, "../images/$postImage");

//    if we didn't change the image to show old one we have function for that:
    if (empty($postImage)){

        $selectImage = findPostById($postId);

        while ($row = mysqli_fetch_assoc($selectImage)){
            $postImage = $row['post_image'];
        }
    }
//    $postImage = emptyImage($postImage);

    $query = "UPDATE posts SET ";
    $query .= "post_category_id = {$postCatId}, ";
    $query .= "post_title = '{$postTitle}', ";
    $query .= "post_author = '{$postAuthor}', ";
    $query .= "post_date = now(), ";
    $query .= "post_image = '{$postImage}', ";
    $query .= "post_content = '{$postContent}', ";
    $query .= "post_tags = '{$postTags}', ";
    $query .= "post_status = '{$postStatus}' ";
    $query .= "WHERE post_id = {$postId}";

    $updatePost = mysqli_query($connection, $query);

    confirmQuery($updatePost);
    // show message if post was successfully updated:
    echo "<p class='bg-success'>Post was successfully updated. <a href='../post.php?pId={$pId}'>View Post</a> or <a href='posts.php'>Edit More Posts</a></p>";

}


?>
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $postTitle; ?>" type="text" class="form-control" id="title" name="title">
    </div>

    <div class="form-group">
        <label for="post_category">Category</label><br>
        <select name="post_category" id="post_category">
<!--            attribute name is very important because this is that value which will be submitted every time when we select on of options-->

            <?php

            //display all categories and select from it:
            $selectCategories = findAllCategories();

            while ($row = mysqli_fetch_assoc($selectCategories)){

                $catId = $row['cat_id'];
                $catTitle = $row['cat_title'];

                echo "<option value='{$catId}'>{$catTitle}</option>";
//              we are displaing the name but we are carrying the category id
            }

            ?>
        </select>
    </div>

        <label for="status">Post status</label><br>
        <select name="status" id="status">
            <option value="<?php echo $postStatus; ?>"><?php echo $postStatus; ?></option>

            <?php
            if ($postStatus == 'active'){
                echo "<option value='draft'>Draft</option>";
            }else {
                echo "<option value='active'>Active</option>";
            }
            ?>
        </select>

    <div class="form-group">
        <label for="image">Current Image</label><br>
        <img width="100" src="../images/<?php echo  $postImage; ?>" alt="">
        <input type="file" name="image" class="form-control" id="image" value="Add New Image">
    </div>

    <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control" name="content" id="content" rows="10" cols="30"><?php echo str_replace('\r\n','<br>',$postContent); ?></textarea>
    </div>

    <div class="form-group">
        <label for="tags">Tags</label>
        <input value="<?php echo $postTags; ?>"type="text" class="form-control" id="tags" name="tags">
    </div>

    <div class="form-group">
        <label for="author">Author</label>
        <input type="text" class="form-control" id="author" name="author" value="<?php echo $postAuthor; ?>" >
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="submit" value="Update Post">
    </div>
</form>