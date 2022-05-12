<?php

//Set a  flash message
function flashMessage()
{
    $res = "";
    if(isset($_SESSION["flashmessage"])){
        $res = "<div id='flashmessage' class='alert alert-danger'>" . $_SESSION["flashmessage"] . "</div>";
    }
    unset($_SESSION["flashmessage"]);
    return $res;
}

function login_bt()// fonction pour modifiert les boutons de connexion quand on se login logout
{
    $coma = "'";
    if(isset($_SESSION["firstname"])){
        return'<li><a href="index.php?action=PersonalPage"> Bonjour ' . $_SESSION["firstname"] . '</a></li>
               <li><a href="index.php?action=Logout"> Se déconnecter</a></li>';
    }else{
        return '<li><a href="index.php?action=Login">Se connecter</a></li>
				<li><a href="index.php?action=Signup">S'. $coma . 'enregistrer</a></li>';
    }
}