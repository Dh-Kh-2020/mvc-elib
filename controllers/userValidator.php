<?php
class UserValidator {

    private $data;
    private $errors = [];

    function __construct($post_data) {
        $this->data = $post_data;
    }

    function __destruct() {}

    function validation() {
        $this->validateName();
        $this->validateEmail();
        $this->validatePassword();

        return $this->errors;
    }
    
    private function validateName() {
        
        $us = trim($this->data['username']);

        if (empty($us)) {
            $this->handleError('name', 'Name cannot be empty ! <br />');
        } elseif ( !preg_match('/^[a-zA-Z ]{7,}$/', $us) ){
            $this->handleError('name', 'Invalid format! Name must be at least 7 alphabetic characters <br />');
        }

    }

    private function validateEmail(){

        $em = trim($this->data['email']);

        if (empty($em)){
            $this->handleError('email', 'E-mail cannot be empty! <br />');
        } elseif ( !filter_var($em, FILTER_VALIDATE_EMAIL) ){
            $this->handleError('email', 'Invalid E-mail! It should be similar to example@gmail.com <br />');
        }
    }

    private function validatePassword(){

        $psw = trim($this->data['password']);
        $uppercase = preg_match('@[A-Z]@', $psw);
        $lowercase = preg_match('@[a-z]@', $psw);
        $number    = preg_match('@[0-9]@', $psw);

        if (empty($psw)){
            $this->handleError('password', 'Password cannot be empty! <br />');
        } elseif ( !$uppercase || !$lowercase || !$number || strlen($psw) < 7) {
            $this->handleError('password', 'Invalid Password ! must be at least 7 characters containing Must contain at least 1 number, one uppercase and one lowercase character <br />');
            // $this->handleError('password', 'Invalid Password ! must be at least 7 symbolic alphanumeric characters<br />');
        } 
    }

    private function handleError($key, $value){
        $this->errors[$key] = $value;
    }
}