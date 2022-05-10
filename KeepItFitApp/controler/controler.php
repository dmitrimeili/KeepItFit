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
