<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/cms">CMS Front</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"> </i>
                        <span>Categories</span><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php

                        $selectAllCategories = findAllCategories();

                        while($row = mysqli_fetch_assoc($selectAllCategories)){

                            $catTitle = $row['cat_title'];
                            $catId = $row['cat_id'];

                            $catClass = "";
                            $registrationClass = "";
                            // every time when we make the static link we need to create variable there

                            $pageName = basename($_SERVER['PHP_SELF']);
                            $registration = 'registration.php';

                            if (isset($_GET['category']) && $_GET['category'] == $catId){

                                $catClass = 'active';
                            }elseif($pageName == $registration){
                                $registrationClass = 'active';
                            }
                            echo "<li class='{$catClass}'><a href='/cms/category/{$catId}'>{$catTitle}</a> </li>";// use double quotes that you can use the {}

                        }
                        ?>

                        <li>
                    </ul>
                </li>
                <li class="<?php echo $registrationClass; ?>"><a href="/cms/registration">Registration</a></li>

<!--                if user is logged in show the user buttons             -->

                <li class="dropdown -align-right">
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
                        <li>
                            <?php
                            if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
                                echo "<a href='/cms/admin?source=dashboard'>Admin</a>";
                            }
                            ?>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
