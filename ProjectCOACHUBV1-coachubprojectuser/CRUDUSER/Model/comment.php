
<?php
class Comment
{
    private $id;
    private $author;
    private $content;
    private $post_id;

    public function __construct($id, $author, $content, $post_id)
    {
        $this->id = $id;
        $this->author = $author;
        $this->content = $content;
        $this->post_id = $post_id;
    }
    public function getAuthor()
    {
        return $this->author;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function getPostId()
    {
        return $this->post_id;
    }
    public function getId()
    {
        return $this->id;
    }
}
?>