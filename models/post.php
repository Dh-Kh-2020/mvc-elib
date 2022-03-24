<?php
require_once('config/DBConn.php');
class Post extends DB{

    private $title;
    private $sub_title;
    private $img;
    private $body;
    private $user_name;
    // private $created_at;

    public function __construct(){
        parent::__construct();
    }

    public function createPost($post, $img, $date){
        $this->user_name = $_POST['user_name'];
        $this->title = $_POST['blog_ttl'];
        $this->sub_title = $_POST['blog_subttl'];
        $this->img = $img;
        $this->body = $_POST['blog_body'];

        $this->created_at = $date;
        
        $uQuery = "SELECT user_id FROM users WHERE username = '".$this->user_name."'";
        $stmt = $this->conn->prepare($uQuery);
        $stmt->execute();        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $user_id = $row['user_id'];
        
        $query = "INSERT INTO posts VALUES (null, '".$user_id."', '".$this->title."', '".$this->sub_title."', '".$this->img."', '".$this->body."', '".$this->created_at."')";
        $stmt = $this->conn->prepare($query);

        if (!$stmt->execute()) {
            echo "Error: " . $stmt . "<br>" . print_r($this->conn->errorInfo());;
        }
    }

    public function selectAllPosts(){
        $query = "SELECT posts.post_id, posts.user_id, posts.title, posts.sub_title, posts.post_img, posts.body, posts.created_at, users.username
                    FROM posts
                    INNER JOIN users 
                    ON posts.user_id = users.user_id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!$stmt->execute()) {
            return "Error: " . $stmt . "<br>" . $this->conn->errorInfo();
        }

        return $rows;
    }

    public function selectOnePost($get){
        $post_id = $_GET['post_id'];

        $query = "SELECT posts.post_id, posts.user_id, posts.title, posts.sub_title, posts.post_img, posts.body, posts.created_at, users.username
                    FROM posts
                    INNER JOIN users 
                    ON posts.user_id = users.user_id
                    WHERE posts.post_id ='". $post_id."'";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$stmt->execute()) {
            return "Error: " . $stmt . "<br>" . $this->conn->errorInfo();
        }

        return $row;
    }
}