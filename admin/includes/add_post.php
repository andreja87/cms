<?php
$username = sessionUsername();
$InsertedPostId = insertNewPost();

    echo "<p class='bg-success'>Post was successfully created. <a href='../post.php?pId={$InsertedPostId}'>View Post</a> or <a href='posts.php'>View All Posts</a></p>";




?>
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" id="title" name="title">
    </div>

    <div class="form-group">
        <label for="post_category">Category</label>
        <br>
        <select name="post_category" id="post_category">
            <!--            attribute name is very important because this is that value which will be submitted every time when we select on of options-->

            <?php

            //display all categories and select from it:
            $selectCategories = findAllCategories();

            while ($row = mysqli_fetch_assoc($selectCategories)){

                $catId = $row['cat_id'];
                $catTitle = $row['cat_title'];

                echo "<option value='{$catId}'>{$catTitle}</option>";
//              we are displaying the name but we are carrying the category id
            }

            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="image">Image</label>
    <input type="file" name="image" id="image">
    </div>

    <div class="form-group">
        <label for="content">Content</label>
            <textarea class="form-control" name="content" id="content" rows="10" cols="30"></textarea>
    </div>

    <div class="form-group">
        <label for="tags">Tags</label>
        <input type="text" class="form-control" id="tags" name="tags">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <br>
        <select name="post_status" id="post_status">
            <option value="draft" selected>Draft</option>
            <option value="active">Publish</option>
        </select>
    </div>

    <div class="form-group">
        <label for="author">Author</label>
        <br>
        <select name="author" id="post_status">
            <option value="<?php echo $username; ?>" selected><?php echo $username; ?></option>
        </select>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="submit" value="Publish Post">
    </div>
</form>