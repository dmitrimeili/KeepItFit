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
    default:
    MainPage();
    break;
}