<?php
ob_start();
if (isset($_GET['pId'])){

    $postId = mysqli_real_escape_string($connection, $_GET['pId']);

    $findPost = findPostById($postId);

    while ($row = mysqli_fetch_assoc($findPost)){

        $postTitle = $row['post_title'];
    }

}

?>

    <h4>All Comments For Post:
        <a href="../post.php?pId=<?php echo $postId ?>"> <?php echo $postTitle; ?></a>
    </h4>
<table class="table table-bordered table-hover">
    <thead>
    <tr></tr>
    <th>Id</th>
    <th>Author</th>
    <th>Email</th>
    <th>Comment</th>
    <th>Status</th>
    <th>Date</th>
    <th>Approve</th>
    <th>Undo Approval</th>
    <th>Delete</th>
    </thead>
    <tbody>

    <?php

//    $query = "SELECT * FROM comments WHERE comment_post_id={$postId}";
//    $selectAllPostComments = mysqli_query($connection, $query);
//    confirmQuery($selectAllPostComments);

    $selectAllPostComments = selectCommentsByPost($postId);

    while($row = mysqli_fetch_assoc($selectAllPostComments)){
        $commentId = $row['comment_id'];
        $commentPostId = $row['comment_post_id'];
        $commentAuthor = $row['comment_author'];
        $commentAuthorEmail = $row['comment_author_email'];
        $commentContent = $row['comment_content'];
        $commentStatus = $row['comment_status'];
        $commentDate = $row['comment_date'];


        echo "<tr>";
        echo "<td>{$commentId}</td>";
        echo "<td>{$commentAuthor}</td>";
        echo "<td>{$commentAuthorEmail}</td>";
        echo "<td>{$commentContent}</td>";
        echo "<td>{$commentStatus}</td>";
        echo "<td>{$commentDate}</td>";
        echo "<td><a href='comments.php?approve={$commentId}'>Approve</a></td>";
        echo "<td><a href='comments.php?undo_approve={$commentId}'>Undo Approval</a></td>";
        echo "<td><a href='comments.php?delete={$commentId}'>Delete</a></td>";

        echo "</tr>";
    } // .while
    ?>

    </tbody>
</table>

<?php
// approve
if (isset($_GET['approve'])){

    $approveCommentId = $_GET['approve'];

    approveComment($approveCommentId);

    header("Location: posts.php");
}


//undo approve
if (isset($_GET['undo_approve'])){

    $undoApprovalId = $_GET['undo_approve'];

    undoApproveComment($undoApprovalId);

    header("Location: posts.php");
}



// delete comments
if (isset($_GET['delete'])){

    $deleteCommentId = $_GET['delete'];

    deleteComment($deleteCommentId);

    header("Location: posts.php");
}
