<?php
session_start();
require "controler/controler.php";
if (!isset($_GET['action'])) {
    $_GET['action'] = null;
} else {
    $page = $_GET["action"];
}

switch ($page) {
    case "Login";
        login();
        break;
    case "tryLogin";
        trylogin($_POST);
        break;
    case "Signup";
        SignUp();
        break;
    case "CreateAccount";
        createAccount($_POST);
        break;
    case "Logout";
        logout();
        break;
    case "PersonalPage";
        personalPage();
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
    case "addMaterial";
        addMaterial($_POST);
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
    case "delMaterial";
        delMaterial($_POST);
        break;
    case "CreateExPage";
        createExPage();
        break;
    case "createEx";
        createEx($_POST, $_FILES);
        break;
    case "allExPage";
        allExPage();
        break;
    case "exDetails";
        exDetails($_GET);
        break;
    case "CreateProgram";
        createProgram($_POST);
        break;
        case "PersonalProgramPage";
        personalProgramPage($_GET);
        break;
    default:
        MainPage();
        break;
}