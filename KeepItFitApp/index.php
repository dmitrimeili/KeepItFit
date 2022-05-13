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
    case "delPlace";
        delPlace($_POST);
        break;
    case "delArea";
        delArea($_POST);
        break;
    case "delProgram";
        delProgram($_POST);
        break;
        case "CreateExPage";
        CreateExPage();
        break;
    default:
        MainPage();
        break;
}