<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>

    <!-- Navigation -->
<?php include 'includes/nav.php'; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php

                    //we are catch the data to post
                    if(isset($_POST['submit'])){
                        $search = $_POST['search'];

                            //search posts
                        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
                        $searchQuery = mysqli_query($connection, $query);

                        if (!$searchQuery){

                             die("Query failed: " . mysqli_error($connection));

                        }
                        $count = mysqli_num_rows($searchQuery);

                        if($count == 0){

                            echo "<h2>No Result</h2>";

                        }else{
                            // if search word exist in some post:

                            while($row = mysqli_fetch_assoc($searchQuery)){

                                // we need to do it through loop:
                                $title = $row['post_title'];
                                $content = $row['post_content'];
                                $image = $row['post_image'];
                                $date = $row['post_date'];
                                $author = $row['post_author'];

                        }
                        ?>

                            <h1 class="page-header">
                                Page Heading
                                <small>Secondary Text</small>
                            </h1>

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
                            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                            <?php


                    }



                ?>




                    <hr>
<?php } // this closed here in order to list all posts dynamically ?>



            </div>

            <!-- Blog Sidebar Widgets Column -->
<?php include 'includes/sidebar.php'; ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include 'includes/footer.php'; ?>