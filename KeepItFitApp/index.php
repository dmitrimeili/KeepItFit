<?php
session_start();
require "controler/controler.php";

$page = $_GET["action"];
switch ($page){
    case "Login";
        Login();
    break;
    case "tryLogin";
    trylogin($_POST);
    case "Signup";
    SignUp();
    break;
    case "CreateAccount";
    CreateAccount($_POST);
    break;
    default:
    MainPage();
    break;
}