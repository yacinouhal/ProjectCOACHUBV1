<?php
include '../../Controller/forumcont.php';
$forumController = new ForumController();

// Check if the post ID is provided
if (isset($_GET['id'])) {
    $postId = $_GET['id'];
    
    // Call the deletePost method
    $forumController->deletePost($postId);
    
    // Redirect back to the list of posts
    header('Location: listpost.php');
    exit();
} else {
    // If the post ID is not provided, handle the error
    echo "Post ID not provided.";
}
?>
