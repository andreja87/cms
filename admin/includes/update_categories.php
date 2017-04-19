<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Update Category</label>
            <?php
            if (isset($_GET['update'])){

                $listAllCategories = selectCategoryById();

                    while($row = mysqli_fetch_assoc($listAllCategories)) {

                        $catId = $row['cat_id'];
                        $catTitle = $row['cat_title'];
            ?>

        <input value="<?php if (isset($catId)){echo $catTitle;}?>" class="form-control" type="text" name="cat_title">


            <?php } }

            //update query:
            $updateCategoryTitle = updateCategory();

            if ($updateCategoryTitle) {

                header("Location: categories.php");
            }

            ?>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update" value="Update Category">
    </div>

</form>
