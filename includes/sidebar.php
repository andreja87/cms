<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
        <div class="input-group">
            <input name="search" type="text" class="form-control">
            <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" name="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
        </div>

<!--            --><?php
//            if (isset($_SESSION['username']) && isset($_SESSION['user_role']) ){
//                echo $_SESSION['username'];    // check this
//            }
//            ?>
        </form> <!-- search form -->
        <!-- /.input-group -->
    </div>

    <!-- Login User Form -->
    <div class="well">
    <?php if (isset($_SESSION['user_role'])): ?>
        <h4>Logged as <?php echo $_SESSION['username']; ?></h4>
        <a href="includes/logout.php" class="btn btn-primary">Logout</a>

    <?php else: ?>
        <h4>Login</h4>
        <form action="includes/login.php" method="post">

            <div class="form-group">
                <input name="username" type="text" class="form-control" placeholder="enter username">
            </div>

            <div class="input-group"> <!-- the password and button will be in the same line -->
                <input name="password" type="password" class="form-control" placeholder="enter password">
                <span class="input-group-btn">

                    <button class="btn btn-primary" type="submit" name="submit">Login</button>

                </span>
            </div>

        </form> <!-- search form -->
        <!-- /.input-group -->

    <?php endif; ?>



    </div>


    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <?php

                    $query = "SELECT * FROM categories";
                    $selectAllCategories = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($selectAllCategories)){

                        $catId = $row['cat_id'];
                        $catTitle = $row['cat_title'];

                        echo "<li><a href='/cms/category/{$catId}'>{$catTitle}</a></li>";// use double quotes that you can use the {}

                    }

                    ?>
                </ul>
            </div>

            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include 'widget.php'; ?>

</div>

