<?php
session_start();
require "controler/controler.php";

$page = $_GET['action'];
switch ($page){
    default;
    MainPage();
    break;
}