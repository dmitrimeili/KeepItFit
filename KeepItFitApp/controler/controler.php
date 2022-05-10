<?php
require_once 'model/model.php';

function MainPage()
{
    $users = getUsers();
    require_once "view/home.php";
}
function Login(){
    require_once "view/login.php";
}
function SignUp(){
    require_once "view/signup.php";
}
function CreateAccount($info){
    $users = getUsers();

    foreach ($users as $user) {
        //Check if email already exist in db
        if ($user["email"] == $info['email']) {
            $_SESSION["flashmessage"] = "l'email est déja utilisé";
            $login = false;
            Signup();
        }
    }
    if (!isset($login)) {
        $password = $info['password'];
        $password = password_hash($password, PASSWORD_DEFAULT);//Hashing password
        $newUser = [
            "firstname" => $info['firstname'],
            "lastname" => $info['lastname'],
            "email" => $info['email'],
            "weight" => $info['weight'],
            "height" => $info['height'],
            "password" => $password,
            "birthday" => $info['birthday'],
            "role_id" => 1
        ];

        addUser($newUser); //Add user in datasheet
       
        tryLogin($newemail, $truePassword);
    }
}
