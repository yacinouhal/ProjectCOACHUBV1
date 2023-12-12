<?php
include '../../Controller/forumcont.php';
$forumController = new ForumController(); 

$post = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        isset($_POST["title"]) &&
        isset($_POST["content"]) &&
        isset($_POST["author"])
        // Add more fields as needed
    ) {
        if (
            !empty($_POST['title']) &&
            !empty($_POST["content"]) &&
            !empty($_POST["author"])
            // Add more conditions as needed
        ) {
            $post = new Post(
                $_POST['id'],
                $_POST['title'],
                $_POST['author'],
                $_POST['content']
                // Add more fields as needed
            );

            $success = $forumController->updatePost($post);

            if ($success) {
                header('Location: listpost.php');
                exit();
            } else {
                echo "Failed to update post. Please try again.";
            }
        } else {
            echo "All fields are required.";
        }
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Post</title>
</head>

<body>
    <button><a href="listpost.php">Back to list</a></button>
    <hr>

    <?php
    if (isset($_GET['id'])) {
        $oldPost = $forumController->getPost($_GET['id']);

        if ($oldPost) {
    ?>

            <form action="" method="POST">
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                <!-- Add hidden fields for other necessary data -->

                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($oldPost['title']); ?>"><br>

                <label for="content">Content:</label>
                <textarea id="content" name="content"><?php echo htmlspecialchars($oldPost['content']); ?></textarea><br>

                <!-- Add field for the author -->
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($oldPost['author']); ?>"><br>

                <!-- Add fields for other data -->

                <input type="submit" value="Save">
                <input type="reset" value="Reset">
            </form>

    <?php
        } else {
            echo "Post not found.";
        }
    } else {
        echo "Post ID not provided.";
    }
    ?>

</body>

</html>
