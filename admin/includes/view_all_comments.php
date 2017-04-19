<?php
// bulk options
commBulkOption();
?>
<!--  Page Header  -->
<?php
if (isset($_GET['source'])){
    $source = $_GET['source'];
    pageHeader($source);
}else{
    $source = "";
}

?>
    <form action="" method="post">
    <div class="row">
    <table class="table table-bordered table-hover">
    <thead>
    <tr></tr>
    <th><input type="checkbox" class="checkbox" id="selectAllBoxes" ></th>
    <th>Author</th>
    <th>Email</th>
    <th>Comment</th>
    <th>Status</th>
    <th>For Post</th>
    <th>Date</th>
    <th>Approve</th>
    <th>Undo Approval</th>
    <th>Delete</th>
    </thead>
    <tbody>

    <?php

    //find all comments
    $allComments = selectAllComments();

    while($row = mysqli_fetch_assoc($allComments)){
        $commentId = $row['comment_id'];
        $commentPostId = $row['comment_post_id'];
        $commentAuthor = $row['comment_author'];
        $commentAuthorEmail = $row['comment_author_email'];
        $commentContent = $row['comment_content'];
        $commentStatus = $row['comment_status'];
        $commentDate = $row['comment_date'];


        echo "<tr>";
        echo "<td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' id='select' value='{$commentId}'></td>";
        echo "<td>{$commentAuthor}</td>";
        echo "<td>{$commentAuthorEmail}</td>";
        echo "<td>{$commentContent}</td>";
        echo "<td>{$commentStatus}</td>";


        $selectCommentPost = selectPostByCommentPostId($commentPostId);

        while ($row = mysqli_fetch_assoc($selectCommentPost)){

            $commentPostId = $row['post_id'];
            $commentPostTitle = $row['post_title'];

            echo "<td><a href='../post.php?pId={$commentPostId}'>{$commentPostTitle}</a></td>";
            //we going out of the admin folder and we put parameter id for specific post

        }
        echo "<td>{$commentDate}</td>";
        echo "<td><a href='comments.php?approve={$commentId}'>Approve</a></td>";
        echo "<td><a href='comments.php?undo_approve={$commentId}'>Undo Approval</a></td>";
        echo "<td><a href='comments.php?delete={$commentId}'>Delete</a></td>";

        echo "</tr>";
    }
    ?>

    </tbody>
</table>
    </div> <!-- row -->
    <div class="row">
        <div id="bulkOptionsContainer" class="col-xs-4">
            <select class="form-control" name="bulk_options" id="bulk_options">
                <option value="">Select Options</option>
                <option value="approve">Approve</option>
                <option value="undo_approve">Undo Approval</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" value="Apply" class="btn btn-success">
        </div>
    </div>
</form>
<?php
// approve
if (isset($_GET['approve'])){

    $approvalId = $_GET['approve'];
    approveComment($approvalId);

    header("Location: comments.php");
}


//undo approve
if (isset($_GET['undo_approve'])){

    $undoApprovalId = $_GET['undo_approve'];
    undoApproveComment($undoApprovalId);

    header("Location: comments.php");
}


// delete comments
if (isset($_GET['delete'])){

    $deleteCommentId = $_GET['delete'];
    deleteComment($deleteCommentId);
    header("Location: comments.php");
}
