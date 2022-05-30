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
    $users = getUsers();//get all users in db
    //check if all required inputs are filled
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
            $newUser = [// store user info
                "firstname" => $info['firstname'],
                "lastname" => $info['lastname'],
                "email" => $info['email'],
                "weight" => $info['weight'],
                "height" => $info['height'],
                "password" => $password,
                "birthday" => $info['birthday'],
                "role_id" => 1
            ];
            SendMail($info['email'], $info['firstname']);// send email to confirm register
            addUser($newUser); //Add user in datasheet
            tryLogin($info);
        }
    }
}

function SendMail($email, $firstname)
{

    // the message
    $msg = "Bonjour $firstname,\n\nNous confirmons votre inscription sur KeepItFit !";
// use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg, 70);
    $headers = "From:keepitfit.support@outlook.com" . "\r\n";

// send email
    mail($email, "Inscription KeepItFit", $msg, $headers);

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
    if ($_SESSION['role_id'] == 1) {// if user is normal user

        $places = getPlaces();
        $programs = getPrograms();
        $persoprogs = getUserPrograms($_SESSION['id']);
        require_once "view/personal.php";

    } else {// if user is admin
        $places = getPlaces();
        $programs = getPrograms();
        $areas = getTargetedAreas();
        $materials = getMaterials();
        require_once "view/admin.php";
    }
}

function addPlace($place)
{
    $getPlaces = getPlaces();// get all places
    $exist = "";

    foreach ($getPlaces as $getPlace) {// check if the place already exists in db
        if ($place['place'] == $getPlace['place']) {

            $exist = true;
        }
    }
    if ($exist == true) {// show error if place already exists
        $_SESSION['flashmessage'] = "Lieu déjà existant";

    } elseif ($place['place'] == "") {// show error if requiered input is empty
        $_SESSION['flashmessage'] = "Champ vide";
    } else {// add place to db
        addAPlace($place['place']);
    }
    PersonalPage();

}

function addTargetedArea($area)
{
    $getAreas = getTargetedAreas();// get all targeted areas
    $exist = "";
    foreach ($getAreas as $getArea) {// check if the targeted area already exists in db

        if ($area['trargetedArea'] == $getArea['name']) {

            $exist = true;
        }
    }
    if ($exist == true) {// show error if targeted area already exists
        $_SESSION['flashmessage'] = "Zone ciblée déjà existante";
    } elseif ($area['trargetedArea'] == "") {// show error if requiered input is empty
        $_SESSION['flashmessage'] = "Champ vide";
    } else {// add targeted area to db
        addATargetedArea($area["trargetedArea"]);
    }

    PersonalPage();
}

function addProgram($program)
{
    $getPrograms = getPrograms();// get all programs
    $exist = "";
    foreach ($getPrograms as $getProgram) {// check if the program already exists in db
        if ($getProgram['name'] == $program['program']) {
            $exist = true;
        }
    }
    if ($exist == true) {// show error if program already exists
        $_SESSION['flashmessage'] = "Programme déjà existant";
    } elseif ($program['program'] == "") {// show error if requiered input is empty
        $_SESSION['flashmessage'] = "Champ vide";
    } else {// add program to db
        addAProgram($program["program"]);
    }


    PersonalPage();
}

function addMaterial($material)
{
    $exist = "";
    $getMaterials = getMaterials();// get all materials

    foreach ($getMaterials as $getMaterial) {// check if the material already exists in db
        if ($getMaterial['name'] == $material['material']) {
            $exist = true;
        }
    }
    if ($exist == true) {// show error if material already exists
        $_SESSION['flashmessage'] = "Matériel déjà existant";
    } elseif ($material['material'] == "") {// show error if requiered input is empty
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
    $exist = "";
    $getExercises = getExercises();// get all materials
    foreach ($getExercises as $getExercise) {// check if the exercise already exists in db
        if ($getExercise['exercise'] == $info['name']) {
            $exist = true;
        }
    }
    if ($exist == true) {// show error if exercise already exists
        $_SESSION["flashmessage"] = "le nom de l'exercice existe déja.";
        createExPage();
    } // show error if requiered inputs are empty
    elseif (($info['name'] == "") || ($info['description'] == "") || ($info['difficulty'] == "") || ($info['material'] == "") || ($info['place'] == "") || ($file['fileToUpload']['name'] == "")) {
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


                $uploadOk = 1;
            } else {

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

            $notimage = "seulment les fichiers JPG, JPEG, PNG & GIF sont autorisé";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $_SESSION['flashmessage'] = "Désolé " . $fileexist . $filelarge . $notimage;
            createExPage();

            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($file["fileToUpload"]["tmp_name"], $target_file)) {
                $description = htmlspecialchars($info["description"]);//utilise la fonction htmlspecialchars pour omettre les ' quand on execute l'sql

                if ($info['reps'] == "") {// if repetition is null value = 0
                    $info['reps'] = 0;
                }
                if ($info['time'] == "") {// if time is null value = 0
                    $info['time'] = 0;
                }
                // add exercise to database and to all concerned intermediate tables
                addAnEx($info['name'], $file["fileToUpload"]["name"], $description, $info['reps'], $info['time'], $info['difficulty'], $info['material']);
                $exercise = getAnExercise($info['name']);
                addAnExPlace($exercise['id'], $info['place']);
                addAnExArea($exercise['id'], $info['area']);
                addSequencie($exercise['id'], $info['program']);
                $_SESSION['flashmessage'] = "exercice créer";
                allExPage();
            } else {// if problem with image upload
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

    $maxId = getMaxIdEx();// get exercises max id
    $minId = getMinIdEx();// get exercises min id
    // convert to int
    $maxId = (int)$maxId["max(id)"];
    $minId = (int)$minId['min(id)'];
    // get user sequencies
    $userseqs = getUserSequencies($_SESSION['id']);
    // get exercises by area and place
    $exercises = getExByAreaPlace($info['place'], $info['program']);
    $chosen = [];
    $area = [];
    foreach ($userseqs as $userseq) {// delete all exercise in relation with the chosen program
        if ($userseq['program_id'] == $info['program']) {
            delUserProgram($userseq['sequencie_id']);

        }
    }
    // create program with 6 different exercises
    while (count($chosen) < 6) {
        // get a random id from specific exercises
        $rand = rand($minId, $maxId);
        foreach ($exercises as $exercise) {
            //check if the id exists in the chosen exercises
            if ($exercise['exId'] == $rand) {
                // check if the random number has already been chosen
                if (in_array($rand, $chosen) != true) {
                    // check if the targeted area from the chosen exercise has already been selected
                    if (in_array($exercise['areaId'], $area) != true) {
                        $chosen[] = $rand;
                        $area[] = $exercise['areaId'];
                        // create personal program
                        addUserProgram($exercise['sequencieId'], $_SESSION['id']);
                        PersonalPage();


                    }

                }
                break;
            }
        }
    }


}

function PersonalProgramPage($info)
{

    $exercises = getExUserPrograms($_SESSION['id'], $info['progId']);
    require_once "view/personalprogram.php";
}

function createPDF($info)
{
    $exercises = getExUserPrograms($_SESSION['id'], $info['program_id']);
    $exname = "";
    $exdesc = "";
    $eximg = "";
    $exreps = "";
    $extime = "";
    $extot = "";
    $test = "";

    //get info from each exercise to add to pdf
    foreach ($exercises as $exercise) {
        $exname = "<h1>" . $exercise['exercise'] . "</h1> <br>";
        $exdesc = $exercise['description'] . "<br>";
        $eximg = "<img src='images/" . $exercise['image'] . "' width='150px' height='150px'> <br>";
        if ($exercise['time'] != 0) {
            $extime = "Temps : " . $exercise['time'] . " s";
        }
        if ($exercise['repetition'] != 0) {
            $extime = "Répetition : " . $exercise['repetition'];
        }
        // add all exercises
        $extot = $extot . $exname . $eximg . $extime . "  " . $exreps . "<br>";



    }

    require_once __DIR__ . '/../vendor/autoload.php';
    $mpdf = new \Mpdf\Mpdf();
    $data = $extot;
    $mpdf->WriteHTML($data);
    $mpdf->Output('Programme_' . $exercise['name'] . ".pdf", "D");


}