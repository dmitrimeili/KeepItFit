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

    if (($info['firstname'] == "") || ($info['lastname'] == "") || ($info['email'] == "") || ($info['weight'] == "") || ($info['height'] == "") || ($info['password'] == "") || ($info['birthday'] == "") ) {
        $_SESSION["flashmessage"] = "Veuillez remplir tout les champs";
        SignUp();
    } else {
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
}

function tryLogin($info)
{

    $users = getUsers();//Puts the values of the data sheet users in a table
    if (($info['email'] == null) || ($info['password'] == null)) {
        $_SESSION['flashmessage'] = "Veuilliez remplir tout les champs";
        Login();
    } else {
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

                $_SESSION['flashmessage'] = "Connecté";
                MainPage(); //Return to home page

            }
        }
        //If the form is false the page show error
        if (!isset($_SESSION["firstname"])) {
            $_SESSION["flashmessage"] = "L'email ou le mot de passe est incorrecte";
            Login();
        }
    }


}

function Logout()
{
    session_unset();
    session_destroy();
    $_SESSION["flashmessage"] = "Vous êtes déconnecté";
    MainPage();

}

function PersonalPage()
{
    if ($_SESSION['role_id'] == 1) {
        require_once "view/personal.php";
    } else {
        $places = getPlaces();
        $programs = getPrograms();
        $areas = getTargetedAreas();
        $materials = getMaterials();
        require_once "view/admin.php";
    }
}

function addPlace($place)
{
    $getPlaces = getPlaces();

    foreach ($getPlaces as $getPlace) {
        if ($place['place'] == $getPlace['place']) {

            $exist = true;
        }
    }
    if ($exist == true) {
        $_SESSION['flashmessage'] = "Lieu déjà existant";

    } elseif ($place['place'] == "") {
        $_SESSION['flashmessage'] = "Champ vide";
    } else {
        addAPlace($place['place']);
    }
    PersonalPage();

}

function addTargetedArea($area)
{
    $getAreas = getTargetedAreas();
    foreach ($getAreas as $getArea) {

        if ($area['trargetedArea'] == $getArea['name']) {

            $exist = true;
        }
    }
    if ($exist == true) {
        $_SESSION['flashmessage'] = "Zone ciblée déjà existante";
    } elseif ($area['trargetedArea'] == "") {
        $_SESSION['flashmessage'] = "Champ vide";
    } else {
        addATargetedArea($area["trargetedArea"]);
    }

    PersonalPage();
}

function addProgram($program)
{
    $getPrograms = getPrograms();
    foreach ($getPrograms as $getProgram) {
        if ($getProgram['name'] == $program['program']) {
            $exist = true;
        }
    }
    if ($exist == true) {
        $_SESSION['flashmessage'] = "Programme déjà existant";
    } elseif ($program['program'] == "") {
        $_SESSION['flashmessage'] = "Champ vide";
    } else {
        addAProgram($program["program"]);
    }


    PersonalPage();
}

function addMaterial($material)
{

    $getMaterials = getMaterials();

    foreach ($getMaterials as $getMaterial) {
        if ($getMaterial['name'] == $material['material']) {
            $exist = true;
        }
    }
    if ($exist == true) {
        $_SESSION['flashmessage'] = "Matériel déjà existant";
    } elseif ($material['material'] == "") {
        $_SESSION['flashmessage'] = "Champ vide";
    } else {
        addAMaterial($material["material"]);
    }


    PersonalPage();
}


function delPlace($place)
{

    delAplace($place['delplace']);
    PersonalPage();
}

function delArea($area)
{
    delAnArea($area['delarea']);
    PersonalPage();
}

function delProgram($program)
{
    delAProgram($program['delprogram']);
    PersonalPage();
}

function delMaterial($material)
{

    delAMaterial($material['delmaterial']);
    PersonalPage();
}

function createExPage()
{
    $places = getPlaces();
    $programs = getPrograms();
    $areas = getTargetedAreas();
    $materials = getMaterials();
    require_once "view/createEx.php";

}