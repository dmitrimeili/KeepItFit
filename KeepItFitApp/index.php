<?php
session_start();
require "controler/controler.php";

$page = $_GET["action"];
switch ($page) {
    case "Login";
        Login();
        break;
    case "tryLogin";
        trylogin($_POST);
        break;
    case "Signup";
        SignUp();
        break;
    case "CreateAccount";
        CreateAccount($_POST);
        break;
    case "Logout";
        Logout();
        break;
    case "PersonalPage";
        PersonalPage();
        break;
    case "addPlace";
        addPlace($_POST);
        break;
    case "addTargetedArea";
        addTargetedArea($_POST);
        break;
    case "addProgram";
        addProgram($_POST);
        break;
    default:
        MainPage();
        break;
}