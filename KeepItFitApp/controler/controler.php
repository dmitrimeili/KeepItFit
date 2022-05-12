<?php
require_once 'model/model.php';

function MainPage()
{
    require_once "view/home.php";
}

function Login()
{
    require_once "view/login.php";
}

function SignUp()
{
    require_once "view/signup.php";
}

function CreateAccount($info)
{
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
        tryLogin($info);
    }
}

function tryLogin($info)
{

    $users = getUsers();//Puts the values of the data sheet users in a table

    foreach ($users as $user) {
        //If the username and the password are true the user connects to the session
        if ($user["email"] == $info['email'] && password_verify($info['password'], $user["password"])) {

            $_SESSION["firstname"] = $user["firstname"];
            $_SESSION["lastname"] = $user["lastname"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["role_id"] = $user["role_id"];
            $_SESSION['height'] = $user['height'];
            $_SESSION['weight'] = $user['weight'];
            $_SESSION['birthday'] = $user['birthday'];
            $_SESSION["id"] = $user["id"];


            MainPage(); //Return to home page
            $_SESSION['flashmessage'] = "Connected";
        }
    }



    //If the form is false the page show error
    if (!isset($_SESSION["firstname"])) {
        $_SESSION["flashmessage"] = "L'email ou le mot de passe est incorrecte";
        Login();
    }
}

function Logout()
{
    session_unset();
    session_destroy();
    $_SESSION["flashmessage"] = "Vous êtes déconnecté";
    MainPage();

}