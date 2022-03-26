<?php
require_once('config/DBConn.php');
class User extends DB {

    public function __construct(){
        parent::__construct();
    }

    function insert($post){
        $username   = $_POST['username'];
        $email      = $_POST['email'];
        $password   = $_POST['password'];

        $eQuery = "SELECT email FROM users WHERE email = '".$email."'";
        $stmt = $this->conn->prepare($eQuery);
        $stmt->execute();        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            echo "email is already exists";
        } else {
            $query = "INSERT INTO users VALUES (null, '".$username."', '".$email."', '".md5($password)."')";
            $stmt = $this->conn->prepare($query);
            if (!$stmt->execute()) {
                echo "Error: " . $stmt . "<br>" . print_r($this->conn->errorInfo());;
            } 
        }
    }

    function select($post){
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        $query  = "SELECT * FROM users WHERE username = '".$username."' AND password = '".md5($password)."'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        // $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $number_of_rows = $stmt->fetchColumn(); 

        return $number_of_rows;
    }
}