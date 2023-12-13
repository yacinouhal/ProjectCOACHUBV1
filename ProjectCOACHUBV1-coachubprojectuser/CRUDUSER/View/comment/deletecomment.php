<?php
include '../../Controller/forumcont.php'; 
$forumController = new ForumController();

// Check if the comment ID is provided
if (isset($_GET['id']) && isset($_GET['postId'])) {
    $commentId = $_GET['id'];
    $postId = $_GET['postId'];
    
    // Call the deleteComment method
    $forumController->deleteComment($commentId);
    
    // Redirect back to the referring page or a default page
    $referrer = $_SERVER['HTTP_REFERER'];
    header("Location: $referrer");
    exit();
} else {
    // If the comment ID is not provided, handle the error
    echo "Comment ID not provided.";
}

if (isset($_POST["submitDeleteComment"])) {
    $deleteCommentId = $_POST["deleteCommentId"];
    $forumController->deleteComment($deleteCommentId);
    
    // Redirect back to the referring page or a default page
    $referrer = $_SERVER['HTTP_REFERER'];
    header("Location: $referrer");
    exit();
}
?>
