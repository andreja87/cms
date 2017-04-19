<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../index.php">Admin Panel</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">

<!--        <li><a href="">Users Online --><?php //echo usersOnline(); ?><!--</a></li>-->

        <li><a href="">Users Online <span class="users-online"></span></a></li>

        <li><a href="../index.php">Home</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"> </i>
                <span>

                    <?php
                    if (isset($_SESSION['first_name']) && isset($_SESSION['last_name'])) {

                        echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
                    }
                    ?>
                </span><b class="caret"></b></a>



            <ul class="dropdown-menu">
                <li>
                    <a href=""><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>


    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="index.php?source=dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#posts"><i class="fa fa-fw fa-clipboard"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="posts" class="collapse">
                    <li>
                        <a href="posts.php?source=view_all_posts">View All Posts</a>
                    </li>
                    <li>
                        <a href="posts.php?source=add_post">Add Post</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="categories.php?source=view_all_categories"><i class="fa fa-fw fa-bars"></i> Categories</a>
            </li><li>
                <a href="comments.php?source=view_all_comments"><i class="fa fa-fw fa-comments"></i> Comments</a>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#users"><i class="fa fa-fw fa-users"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="users" class="collapse">
                    <li>
                        <a href="users.php?source=view_all_users">View All Users</a>
                    </li>
                    <li>
                        <a href="users.php?source=add_user">Add User</a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="profile.php?source=profile"><i class="fa fa-fw fa-user"></i> Profile</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>
