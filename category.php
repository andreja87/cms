<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'admin/functions.php';?>
    <!-- Navigation -->
<?php include 'includes/nav.php'; ?>

    <!-- Page Content -->
    <div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php

            if (isset($_GET['category'])) {

                $catId = $_GET['category'];

                $perPage = 5; //posts per page

                if (isset($_GET['page'])){ //pagination
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


                if (isAdmin()){

                    // prepared statement with the placeholder ? :
                    $query1 = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_image, post_content, post_date FROM posts WHERE post_category_id=?");

                    //mysqli_prepare
                }else{

                    $query2 = mysqli_prepare($connection,"SELECT post_id, post_title, post_author, post_image, post_content, post_date FROM posts WHERE post_category_id=? AND post_status = ?");
                    $status = 'active';

                    // this is useful for security purposes
                }

                // this is executed through two different protocols and because of that
                // it is more secure for data base.
                if (isset($query1)){

                    mysqli_stmt_bind_param($query1, "i", $postCategoryId);
                    mysqli_stmt_execute($query1);
                    mysqli_stmt_bind_result($query1, $postId, $title, $author, $image, $content, $date);
                    $stmt = $query1;
                }else{

                    mysqli_stmt_bind_param($query2, "is", $postCategoryId, $status);
                    mysqli_stmt_execute($query2);
                    mysqli_stmt_bind_result($query2, $postId, $title, $author, $image, $content, $date);
                    $stmt = $query2;
                }

                if (mysqli_stmt_num_rows($stmt) === 1){
                    echo "<h1 class='text-center'>There isn't posts in this category</h1>";
                }

                    while (mysqli_stmt_fetch($stmt)):

                        ?>

                        <!-- First Blog Post -->
                        <h2>
                            <!--                    id of the post for get method  -->
                            <a href="post.php?pId=<?php echo $postId; ?>"><?php echo $title; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $author; ?></a>
                        </p>
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
            endwhile; mysqli_stmt_close($stmt); // you can do that for all functionality, we will make the application a little faster
            // it is ok to close db connection but in case that we do not close it the php will close connection alone
            }else{
                header("Location: index.php");
                }
             ?>





        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include 'includes/sidebar.php'; ?>

    </div>
    <!-- /.row -->

    <hr>

    <ul class="pager">
        <!--        pager bootstrap class         for pagination        -->

<!--        --><?php
//        for ($i = 1; $i <= $numberOfPosts; $i++){
//
//            if ($i == $page){
//                echo "<li><a class='active-link' href='index.php?page={$i}'>{$i}</a></li>";
//
//            }else{
//                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
//            }
//        }
//        ?>
    </ul>

<?php include 'includes/footer.php'; ?>