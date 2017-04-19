<?php include 'includes/db.php'; ?>
<?php include 'admin/functions.php'; ?>
<?php include 'includes/header.php'; ?>

    <!-- Navigation -->
<?php include 'includes/nav.php'; ?>

    <!-- Page Content -->
    <div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php

//            if the specific post title is clicked:
            if (isset($_GET['pId'])) {

                $postId = $_GET['pId'];

                //post view count: reference
//                $query = "UPDATE posts SET post_view_count=post_view_count +1 WHERE post_id={$postId}";
//                $updateCountView = mysqli_query($connection, $query);
//                confirmQuery($updateCountView);

                $query = "SELECT * FROM posts WHERE post_id = {$postId}";
                $getAllPost = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($getAllPost)) {

                    // we need to do it through loop:
                    $title = $row['post_title'];
                    $content = $row['post_content'];
                    $image = $row['post_image'];
                    $date = $row['post_date'];
                    $author = $row['post_author'];

                    ?>

                    <!-- First Blog Post -->
                    <h2>
                        <a href="#"><?php echo $title; ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $author; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date; ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $image; ?>" alt="">
                    <hr>
                    <p><?php echo $content; ?></p>

                    <?php
                    if (isset($_SESSION['user_role'])){
                        if (isset($_GET['pId'])){
                            $postId = $_GET['pId'];
                            echo "<a href='admin/posts.php?source=edit_post&pId={$postId}'>Edit Post</a>";
                        }
                    }
                    ?>
                    <hr>


                <?php } //while
                    }else{

                header("Location: index.php");
            }
            // this closed here in order to list all posts dynamically ?>


            <!-- Blog Comments -->

            <?php
            // catching comment data

            if (isset($_POST['submit'])){

                $commentPostId = $_GET['pId'];

                $commentAuthor = $_POST['comment_author'];
                $authorEmail = $_POST['author_email'];
                $commentContent = $_POST['comment_content'];

                if (!empty($commentAuthor) && !empty($authorEmail) && !empty($commentContent)){

                    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_author_email, comment_content,comment_date) ";
                    $query .= "VALUES ($commentPostId, '{$commentAuthor}', '{$authorEmail}', '{$commentContent}', now())";

                    $insertComment = mysqli_query($connection, $query);

                    confirmQuery($insertComment);

                    header("Location: post.php?pId={$commentPostId}");

                }else {

                    echo "<script>alert('Please Fill All Comments Fields')</script>";

                }
            }


            ?>

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form" method="post" action="">
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" class="form-control" name="comment_author" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="author_email" required>
                    </div>
                    <div class="form-group">
                        <label for="comment">Your Comment</label>
                        <textarea class="form-control" rows="3" name="comment_content" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Add Comment</button>
                </form>
            </div>



            <hr>

            <!-- Posted Comments -->

            <?php
            // show all approved comments for specific post:

            if(isset($_GET['pId'])){

                $commentPostId = $_GET['pId'];

                $query = "SELECT * FROM comments WHERE ";
                $query .= "comment_post_id={$commentPostId} ";
                $query .= "AND comment_status='approved' ";
                $query .= "ORDER BY comment_id DESC";
                $selectComments = mysqli_query($connection, $query);

                confirmQuery($selectComments);

                while($row = mysqli_fetch_assoc($selectComments)) {

                    $commentDate = date('F j, Y, g:i a', strtotime($row['comment_date']));
                    $commentContent = $row['comment_content'];
                    $commentAuthor = $row['comment_author'];

            ?>


            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $commentAuthor; ?>
                        <small><?php echo $commentDate; ?></small>
                    </h4>
                    <?php echo $commentContent; ?>
                </div>
            </div>


            <?php } }?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include 'includes/sidebar.php'; ?>

    </div>
    <!-- /.row -->

    <hr>

<?php include 'includes/footer.php'; ?>