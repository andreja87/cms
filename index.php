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

                $perPage = 5;

                if (isset($_GET['page'])){

                    $page = $_GET['page'];
                }else {
                    $page = "";
                }

                if ($page == "" || $page == 1){
                    $page1 = 0;
                }else{
                    $page1 = ($page * $perPage) - $perPage;
                    // revise this lesson
                }

                $query = "SELECT * FROM posts WHERE post_status = 'active'";
                $postsCount = mysqli_query($connection, $query);
                confirmQuery($postsCount);
                $numPosts = mysqli_num_rows($postsCount);

                // if we do not have published posts
                if ($numPosts < 1){
                    echo "<h1 class='text-center'>No Posts Currently</h1>";
                }
                $numPosts = ceil($numPosts / $perPage); // ceil function round float in integer value

                //                $query = "SELECT * FROM posts LIMIT 3"; This will show us 3 posts on the page
//                $query = "SELECT * FROM posts LIMIT 0,10"; This will show us 0 to 10 posts on the page
                $query = "SELECT * FROM posts WHERE post_status='active' LIMIT $page1,5";
                $posts = mysqli_query($connection, $query);
                confirmQuery($posts);

                while($row = mysqli_fetch_assoc($posts)) {

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

                        <!-- FFirst Blog Post -->
<!--                        <h1>--><?php //echo  $numPosts; ?><!--</h1>-->
                        <h2>
                            <!--                    id of the post for get method  -->
                            <a href="post/<?php echo $postId; ?>"><?php echo $title; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="author_posts.php?author=<?php echo $author;?>"><?php echo $author; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date; ?></p>
                        <hr>
                        <a href="post/<?php echo $postId; ?>">
                            <img class="img-responsive" src="images/<?php echo $image; ?>" alt="">
                        </a>
                        <hr>
                        <p><?php echo $content; ?></p>
                        <a class="btn btn-primary" href="post/<?php echo $postId; ?>">Read More <span
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

    <ul class="pager">
<!--        pager bootstrap class         for pagination        -->

        <?php
        for ($i = 1; $i <= $numPosts; $i++){

            if ($i == $page){
                echo "<li><a class='active-link' href='index.php?page={$i}'>{$i}</a></li>";

            }else{
                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
            }
        }
        ?>
    </ul>

<?php include 'includes/footer.php'; ?>