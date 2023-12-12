<?php
include '../../Controller/forumcont.php';
$forumController = new ForumController();
$posts = $forumController->getPosts(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Posts</title>
    <link rel="stylesheet" type="text/css" href="back.css">

</head>

<body>
    <center>
        <h1>Welcome Admin</h1>
        <h2>
            <a href="addpost.php">Add Post</a>
        </h2>
    </center>
    <table>
        <tr>
            <th>Post ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Content</th>
            <th>Update</th>
            <th>Delete</th>
            <th>Comments</th>
        </tr>

        <?php foreach ($posts as $post): ?>
            <tr>
                <td><?= $post->getId(); ?></td>
                <td><?= $post->getTitle(); ?></td>
                <td><?= $post->getAuthor(); ?></td>
                <td><?= $post->getContent(); ?></td>
                <td>
                    <a href="updatepost.php?id=<?= $post->getId(); ?>">Update</a>
                </td>
                <td>
                    <a href="deletepost.php?id=<?= $post->getId(); ?>">Delete Post</a>
                </td>
                <td>
                    <?php
                    // Assuming you have a method to retrieve comments for a post
                    $comments = $forumController->getCommentsByPost($post->getId());
                    foreach ($comments as $comment) {
                        echo '<strong>' . $comment->getContent() . ':</strong> ' . $comment->getPostId();
                        echo ' <a href="deletecomment.php?id=' . $comment->getId() . '&postId=' . $post->getId() . '">Delete Comment</a><br>';
                        echo ' <a href="updatecomment.php?id=' . $comment->getId() . '&postId=' . $post->getId() . '">Update Comment</a><br>';

                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>
