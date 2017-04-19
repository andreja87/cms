<?php include 'includes/admin_header.php'; ?>
<?php
if (!isAdmin($_SESSION['username'])){
    header("Location: ../index.php");
}
?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include 'includes/admin_nav.php'; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <?php

//                    page header
                    $source = $_GET['source'];
                    issetGetSource($source);

                        //                    Users Including
                        switch ($source) {
                            case'add_user':
                                include 'includes/add_user.php';
                                break;
                            case'edit_user':
                                include 'includes/edit_user.php';
                                break;
                            default:
                                include "includes/view_all_users.php";
                                break;

                        }


                    ?>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include 'includes/admin_footer.php'; ?>
