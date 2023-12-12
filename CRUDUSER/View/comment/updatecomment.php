<?php
include '../../Controller/forumcont.php'; // Adjust the path as needed
$forumController = new ForumController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["commentContent"]) && isset($_POST["commentId"])) {
        if (!empty($_POST["commentContent"]) && !empty($_POST["commentId"])) {
            // Create a Comment object
            $comment = new Comment(
                $_POST["commentId"],
                null,
                $_POST["commentContent"],
                null
            );

            $success = $forumController->updateComment($comment);

            if ($success) {
                header("Location: listpost.php?id=" . $_POST["postId"]);
                exit();
            } 
        } else {
            echo "Comment content is required.";
        }
    }
}

// Retrieve the comment to be updated
if (isset($_GET['id']) && isset($_GET['postId'])) {
    $comment = $forumController->getCommentById($_GET['id']);

    if ($comment) {
        $postId = $_GET['postId'];
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update Comment</title>
        </head>

        <body>
            <button><a href="listpost.php?id=<?= $postId; ?>">Back to list</a></button>
            <hr>

            <form action="" method="POST">
                <input type="hidden" name="commentId" value="<?= $comment->getId(); ?>">
                <input type="hidden" name="postId" value="<?= $postId; ?>">
                <label for="commentContent">Comment:</label>
                <textarea id="commentContent" name="commentContent"><?= htmlspecialchars($comment->getPostId()); ?></textarea><br>
                <input type="submit" value="Update Comment">
                <input type="reset" value="Reset">
            </form>

        </body>

        </html>
    <?php
    } else {
        echo "Comment not found.";
    }
} else {
    echo "Comment ID or Post ID not provided.";
}
?>
