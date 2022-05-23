<?php
require_once 'model/model.php';

function MainPage()
{
    require_once "view/home.php";
}

function login()
{
    require_once "view/login.php";
}

function SignUp()
{
    require_once "view/signup.php";
}

function createAccount($info)
{
    $users = getUsers();

    if (($info['firstname'] == "") || ($info['lastname'] == "") || ($info['email'] == "") || ($info['weight'] == "") || ($info['height'] == "") || ($info['password'] == "") || ($info['birthday'] == "")) {
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
        login();
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
            login();
        }
    }


}

function logout()
{
    session_unset();
    session_destroy();
    $_SESSION["flashmessage"] = "Vous êtes déconnecté";
    MainPage();

}

function PersonalPage()
{
    if ($_SESSION['role_id'] == 1) {

        $places = getPlaces();
        $programs = getPrograms();
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

function createEx($info, $file)
{
    $getExercises = getExercises();
    foreach ($getExercises as $getExercise) {
        if ($getExercise['exercise'] == $info['name']) {
            $exist = true;
        }
    }
    if ($exist == true) {
        $_SESSION["flashmessage"] = "le nom de l'exercice existe déja.";
        createExPage();
    } elseif (($info['name'] == "") || ($info['description'] == "") || ($info['difficulty'] == "") || ($info['material'] == "") || ($info['place'] == "") || ($file['fileToUpload']['name'] == "")) {
        $_SESSION["flashmessage"] = "Veuillez remplir tout les champs";
        createExPage();

    } else {
        $target_dir = "images/";
        $target_file = $target_dir . basename($file["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if (isset($info["submit"])) {
            $check = getimagesize($file["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";

                $uploadOk = 1;
            } else {
                //echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            //echo "Sorry, file already exists.";
            $fileexist = "le fichier existe déja";
            $uploadOk = 0;
        }
        // Check file size
        if ($file["fileToUpload"]["size"] > 500000) {
            //echo "Sorry, your file is too large.";
            $filelarge = "le fichier est trop large";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $notimage = "seulment les fichiers JPG, JPEG, PNG & GIF sont autorisé";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $_SESSION['flashmessage'] = "Désolé " . $fileexist . $filelarge . $notimage;
            createExPage();
            //echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($file["fileToUpload"]["tmp_name"], $target_file)) {
                $description = htmlspecialchars($info["description"]);//utilise la fonction htmlspecialchars pour omettre les ' quand on execute l'sql

                if ($info['reps'] == "") {
                    $info['reps'] = 0;
                }
                if ($info['time'] == "") {
                    $info['time'] = 0;
                }
                addAnEx($info['name'], $file["fileToUpload"]["name"], $description, $info['reps'], $info['time'], $info['difficulty'], $info['material']);
                $exercise = getAnExercise($info['name']);
                addAnExPlace($exercise['id'], $info['place']);
                addAnExArea($exercise['id'], $info['area']);
                addSequencie($exercise['id'], $info['program']);
                $_SESSION['flashmessage'] = "exercice créer";
                allExPage();
            } else {
                $_SESSION['flashmessage'] = "Désolé il y a eu une erreur au moment de l'upload de l'image veuilliez réessayer.";
                CreateExPage();
            }
        }

    }


}

function allExPage()
{
    $exercises = getExercises();
    require_once "view/allEx.php";
}

function exDetails($name)
{
    $exercise = getAnExercise($name['name']);
    require_once "view/exDetails.php";
}

function createProgram($info)
{

    $exercises = getExByAreaPlace($info['place'],$info['program']);
    var_dump($exercises);
    /*$explaces = getExPlaces();
    $exsequencies = getExSequencies();

    foreach ($explaces as $explace) {
        if ($info['place'] == $explace['place_id'])
        {
            $id = $explace['exercise_id'];
            foreach ($exsequencies as $exsequency)
            {
                if(($info['program'] == $exsequency['program_id']) && ($id == $exsequency['exercise_id']))
                {
                    var_dump($id,$exsequency['exercise_id']);
                }
            }
        }
    }

    foreach ($exercises as $exercise) {

    }*/

}