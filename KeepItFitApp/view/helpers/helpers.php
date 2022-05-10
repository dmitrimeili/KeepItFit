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
