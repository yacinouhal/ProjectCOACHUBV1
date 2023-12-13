<?php
include '../../Model/config.php'; 
include '../../Model/Post.php';
include '../../Model/comment.php';

class forumController
{

    public function getPosts()
    {
        $sql = "SELECT * FROM posts";
        $db = getConnexion();
        try {
            $result = $db->query($sql);
            $posts = [];

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $post = new Post(
                    $row['id'],
                    $row['title'],
                    $row['author'],
                    $row['content']
                );

                $posts[] = $post;
            }

            return $posts;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function addPost(Post $post)
    {
        $sql = "INSERT INTO posts (title, author, content) VALUES (:title, :author, :content)";
        $db = getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'title' => $post->getTitle(),
                'author' => $post->getAuthor(),
                'content' => $post->getContent(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function deletePost($postId)
    {
        $sql = "DELETE FROM posts WHERE id = :id";
        $db = getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $postId);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function updatePost(Post $post)
    {
        $sql = "UPDATE posts SET title = :title, author = :author, content = :content WHERE id = :id";
        $db = getConnexion();
        $query = $db->prepare($sql);

        try {
            $query->execute([
                'id' => $post->getId(),
                'title' => $post->getTitle(),
                'author' => $post->getAuthor(),
                'content' => $post->getContent(),
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function getPost($postId)
    {
        $sql = "SELECT * FROM posts WHERE id = :id";
        $db = getConnexion();
        $query = $db->prepare($sql);

        try {
            $query->bindValue(':id', $postId);
            $query->execute();
            $post = $query->fetch(PDO::FETCH_ASSOC);

            return $post;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function getCommentsByPost($postId)
    {
        $sql = "SELECT * FROM comments WHERE post_id = :post_id";
        $db = getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute(['post_id' => $postId]);

            $comments = [];

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $comment = new Comment(
                    $row['id'],
                    $row['post_id'],
                    $row['author'],
                    $row['content']
                );

                $comments[] = $comment;
            }

            return $comments;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

public function addComment(Comment $comment)
{
    $sql = "INSERT INTO comments (author, content, post_id) VALUES (:author, :content, :post_id)";
    $db = getConnexion();

    try {
        $query = $db->prepare($sql);
        $query->execute([
            'author' => $comment->getAuthor(),
            'content' => $comment->getContent(),
            'post_id' => $comment->getPostId(),
        ]);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
public function deleteComment($commentId)
{
    $sql = "DELETE FROM comments WHERE id = :id";
    $db = getConnexion();

    try {
        $query = $db->prepare($sql);
        $query->execute(['id' => $commentId]);
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
}

public function updateComment(Comment $comment)
{
    $sql = "UPDATE comments SET content = :content WHERE id = :id";
    $db = getConnexion();
    $query = $db->prepare($sql);

    try {
        $query->execute([
            'id' => $comment->getId(),
            'content' => $comment->getContent(),
        ]);

        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

public function getCommentById($commentId)
{
    $sql = "SELECT * FROM comments WHERE id = :id";
    $db = getConnexion();

    try {
        $query = $db->prepare($sql);
        $query->bindValue(':id', $commentId);
        $query->execute();

        $commentData = $query->fetch(PDO::FETCH_ASSOC);

        if (!$commentData) {
            return null; // Comment not found
        }

        $comment = new Comment(
            $commentData['id'],
            $commentData['post_id'],
            $commentData['author'],
            $commentData['content']
        );

        return $comment;
    } catch (PDOException $e) {
        throw new Exception('Failed to get comment by ID: ' . $e->getMessage());
    }
}


public function getPostsPaginated($offset, $limit)
{
    $sql = "SELECT * FROM posts LIMIT :offset, :limit";
    $db = getConnexion();
    
    try {
        $query = $db->prepare($sql);
        $query->bindParam(':offset', $offset, PDO::PARAM_INT);
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
        $query->execute();

        $posts = [];

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $post = new Post(
                $row['id'],
                $row['title'],
                $row['author'],
                $row['content']
            );

            $posts[] = $post;
        }

        return $posts;
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
}


}
    

