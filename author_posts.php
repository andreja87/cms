<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'admin/functions.php'; ?>

    <!-- Navigation -->
<?php include 'includes/nav.php'; ?>

    <!-- Page Content -->
    <div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php

            $author = $_GET['author'];
            $query = "SELECT * FROM posts WHERE post_author='{$author}'";
            $authorPosts = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($authorPosts)) {

                // we need to do it through loop:
                $postId = $row['post_id'];
                $title = $row['post_title'];
                $content = substr($row['post_content'], 0, 500);
                $image = $row['post_image'];
                $date = $row['post_date'];
                $author = $row['post_author'];
                $postStatus = $row['post_status'];

                if ($postStatus == 'active') {


                    ?>
                    <h1 class="page-header">
                        <?php
                        echo $author;
                        ?>                <small>All Posts</small>
                    </h1>

                    <!-- FFirst Blog Post -->
                    <h2>
                        <!--                    id of the post for get method  -->
                        <a href="post.php?pId=<?php echo $postId; ?>"><?php echo $title; ?></a>
                    </h2>

                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date; ?></p>
                    <hr>
                    <a href="post.php?pId=<?php echo $postId; ?>">
                        <img class="img-responsive" src="images/<?php echo $image; ?>" alt="">
                    </a>
                    <hr>
                    <p><?php echo $content; ?></p>
                    <a class="btn btn-primary" href="post.php?pId=<?php echo $postId; ?>">Read More <span
                                class="glyphicon glyphicon-chevron-right"></span></a>


                    <hr>
                    <?php

                }
            } //while loop this closed here in order to list all posts dynamically
            ?>



        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include 'includes/sidebar.php'; ?>

    </div>
    <!-- /.row -->

    <hr>

<?php include 'includes/footer.php'; ?>