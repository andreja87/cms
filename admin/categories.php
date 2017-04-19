<?php include 'includes/admin_header.php'; ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include 'includes/admin_nav.php'; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <?php

//                     $source = issetGetSource($source);

                    if(isset($_GET['source'])){
                        $source = $_GET['source'];
                    }else{
                        $source = "";
                    }

                    ?>

                    <div class="col-xs-6">

                        <?php newCategory(); ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add New Category</label>
                                <input class="form-control" type="text" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>

<!--                        update category include                             -->
                        <?php
                        if (isset($_GET['update'])){

                            $catId = $_GET['update'];

                            include 'includes/update_categories.php';
                        }
                        ?>
                    </div>




                    <div class="col-xs-6">

                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category Title</th>
                                <th>Delete</th>
                                <th>Update</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php listCategories(); ?>
                            <?php $deleteCat = deleteCategory();
                            if ($deleteCat){
                                header("Location: categories.php");
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include 'includes/admin_footer.php'; ?>

