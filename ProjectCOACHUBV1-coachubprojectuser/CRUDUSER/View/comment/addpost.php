<?php
include '../../Controller/forumcont.php';

$forumController = new ForumController();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and add post
    if (
        isset($_POST["postTitle"]) &&
        isset($_POST["postAuthor"]) &&
        isset($_POST["postContent"])
    ) {
        $postTitle = $_POST["postTitle"];
        $postAuthor = $_POST["postAuthor"];
        $postContent = $_POST["postContent"];

        if (!empty($postTitle) && !empty($postAuthor) && !empty($postContent)) {
            $post = new Post(null, $postTitle, $postAuthor, $postContent);
            $forumController->addPost($post);
        }
    }

    // Validate and add comment
    if (
        isset($_POST["commentAuthor"]) &&
        isset($_POST["commentContent"]) &&
        isset($_POST["postId"])
    ) {
        $commentAuthor = $_POST["commentAuthor"];
        $commentContent = $_POST["commentContent"];
        $postId = $_POST["postId"];

        if (!empty($commentAuthor) && !empty($commentContent) && !empty($postId)) {
            $comment = new Comment(null, $commentAuthor, $commentContent, $postId);
            $forumController->addComment($comment);
        }
    }
    
}

// Pagination settings
$postsPerPage = 5; // Number of posts per page
$totalPosts = count($forumController->getPosts());
$totalPages = ceil($totalPosts / $postsPerPage);

// Get current page
$currentPage = isset($_GET['page']) ? max(1, min($totalPages, $_GET['page'])) : 1;
$offset = ($currentPage - 1) * $postsPerPage;

// Retrieve posts for the current page
$posts = $forumController->getPostsPaginated($offset, $postsPerPage);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discussion Forum</title>
    <link rel="stylesheet" href="styles.css">
    <script>
       function validatePostForm() {
    var postTitle = document.getElementById("postTitle").value;
    var postAuthor = document.getElementById("postAuthor").value;
    var postContent = document.getElementById("postContent").value;

    // Check if any field is empty or if username is less than 3 characters
    if (postTitle.trim() === "" || postAuthor.trim() === "" || postAuthor.trim().length < 3 || postContent.trim() === "") {
        alert("All fields are required for the post, and the username must be at least 3 characters.");
        return false;
    }
      // Check if the username contains any numbers
      if (/\d/.test(postAuthor)) {
        alert("Username cannot contain numbers.");
        return false;
    }

    // Check if the title starts with an uppercase letter
    if (!/^[A-Z]/.test(postTitle)) {
        alert("Post title must start with an uppercase letter.");
        return false;
    }

    return true;
}

    function validateCommentForm(postId) {
        var commentAuthor = document.getElementById("commentAuthor" + postId).value;
        var commentContent = document.getElementById("commentContent" + postId).value;

        // Check if any field is empty or if username is less than 3 characters
        if (commentAuthor.trim() === "" || commentAuthor.trim().length < 3 || commentContent.trim() === "") {
            alert("All fields are required for the comment, and the username must be at least 3 characters.");
            return false;
        }
        return true;
    }
        

        function searchPosts() {
            console.log("Search button clicked");
        // Get the input value from the search bar
        var searchInput = document.getElementById("searchInput").value.toLowerCase();

        // Get all post containers
        var postContainers = document.getElementsByClassName("post-container");

        // Iterate through each post container
        for (var i = 0; i < postContainers.length; i++) {
            // Get the post title from the current post container
            var postTitle = postContainers[i].getElementsByClassName("post-content")[0].getElementsByTagName("h3")[0].innerText.toLowerCase();

            // Show or hide the post container based on the search input
            if (postTitle.includes(searchInput)) {
                postContainers[i].style.display = "block"; // Show the post container
            } else {
                postContainers[i].style.display = "none"; // Hide the post container
            }
        }
    }
    </script>
    <style>
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            padding: 8px 16px;
            text-decoration: none;
            color: #ffffff;
            background-color: #007bff;
            border-radius: 5px;
            margin: 0 5px;
            cursor: pointer;
        }

        .pagination a.active {
            background-color: #004080;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 style="text-align:center; color: #ff00b3;">The healthy forum</h1>
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search by title">
            <button class="button" onclick="searchPosts()">Search</button>
        </div>

        <div class="post-content">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" onsubmit="return validatePostForm();">
                <input type="text" id="postTitle" name="postTitle" placeholder="Post Title">
                <input type="text" id="postAuthor" name="postAuthor" placeholder="Your username">
                <textarea id="postContent" name="postContent" placeholder="Write your post here"></textarea>
                <button class="button" type="submit" value="Submit Post">Submit Post</button>
            </form>
        </div>

        <!-- Display posts -->
        <div>
            <?php
            if (!empty($posts)) {
                foreach ($posts as $post) {
                    echo "<div class='post-container'>";
                    echo "<div class='post-content'>";
                    echo "<h3>{$post->getTitle()}</h3>";
                    echo "<p>Post by {$post->getAuthor()}</p>";
                    echo "<p>{$post->getContent()}</p>";

                    // Comment form with unique id attributes
                    echo "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='POST' onsubmit='return validateCommentForm({$post->getId()});'>";
                    echo "<input type='hidden' name='postId' value='{$post->getId()}'>";
                    echo "<input type='text' id='commentAuthor{$post->getId()}' name='commentAuthor' placeholder='Your username'>";
                    echo "<textarea id='commentContent{$post->getId()}' name='commentContent' placeholder='Write your comment'></textarea>";
                    echo "<button class='button' type='submit' value='Submit Comment'>Submit Comment</button>";
                    echo "</form>";

                    // Display comments
                     // Display comments with delete button
                     $comments = $forumController->getCommentsByPost($post->getId());
                     if (!empty($comments)) {
                         echo "<div class='comments'>";
                         echo "<h4>Comments:</h4>";
                         foreach ($comments as $comment) {
                             echo "<div class='comment'>";
                             echo "<p>{$comment->getContent()} says: {$comment->getPostId()}</p>";
                             echo "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='POST'>";
                             echo "<input type='hidden' name='deleteCommentId' value='{$comment->getId()}'>";
                             echo "<a href='deletecomment.php?id={$comment->getId()}&postId={$post->getId()}'>Delete Comment</a>";

                             echo "</form>";
                             echo "</div>";
                         }
                       
                        echo "</div>";
                    }

                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No posts found.</p>";
            }
            ?>

            <!-- Pagination links -->
            <div class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <a href="?page=<?php echo $i; ?>" <?php if ($i == $currentPage) echo 'class="active"'; ?>><?php echo $i; ?></a>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</body>

</html>

