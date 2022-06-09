<?php


function getAllItems($table)// function to get al items
{
    try {
        $dbh = callPDO();
        $query = "SELECT $table";
        $statement = $dbh->prepare($query);//prepare query
        $statement->execute();//execute query
        $queryResult = $statement->fetchAll(PDO::FETCH_ASSOC);//prepare result for client
        $dbh = null;
        return $queryResult;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }
}

function getUsers()
{
    $users = getAllItems(" * FROM users");
    return $users;
}

function getPlaces()
{
    $places = getAllItems(" * FROM places");
    return $places;
}

function getTargetedAreas()
{
    $areas = getAllItems(" * FROM targetedareas");
    return $areas;
}

function getPrograms()
{
    $programs = getAllItems(" * FROM programs");
    return $programs;
}

function getMaterials()
{
    $materials = getAllItems(" * FROM materials");
    return $materials;
}

function getExercises()
{
    $exercises = getAllItems(" * FROM exercises");
    return $exercises;
}

function getUserSequencies($userId) // get all users sequencies
{
    $userseq = getAllItems("* FROM sequencies_has_users
                inner join sequencies on sequencie_id = sequencies.id
                inner join programs on program_id = programs.id
                where user_id = $userId");
    return $userseq;
}

function getUserPrograms($userId)// get one of users sequencies
{
    $userprogram = getAllItems("distinct program_id, name FROM sequencies_has_users
                inner join sequencies on sequencie_id = sequencies.id
                inner join programs on program_id = programs.id
                where user_id = $userId");
    return $userprogram;
}

function getExUserPrograms($userId,$programId)// get all exercises with same user and program input
{
    $ex = getAllItems("* FROM sequencies_has_users
                inner join sequencies on sequencie_id = sequencies.id
                inner join programs on program_id = programs.id
                inner join exercises on exercise_id = exercises.id
                where user_id = $userId and
                program_id = $programId");
    return $ex;
}

function getExByAreaPlace($placeid,$programid)// get all exercises with same place and program input
{
    $ex = getAllItems("exercises.id exId, exercises.exercise, targetedareas.id areaId, targetedareas.name areaName, places.id placeId, places.place, programs.id programId, programs.name progName, sequencies.id sequencieId, sequencies.exercise_id, sequencies.program_id from exercises_practice_places epp
inner join exercises on epp.exercise_id = exercises.id
inner join places on place_id = places.id
inner join sequencies on sequencies.exercise_id = exercises.id
inner join programs on programs.id = sequencies.program_id
inner join  exercises_use_targetedareas eut on eut.exercise_id = exercises.id
inner join targetedareas on targetedareas.id = eut.targetedarea_id
where places.id = $placeid
AND programs.id = $programid
");
    return $ex;
}

function getAnItem($table) // get un item
{
    try {
        $dbh = callPDO();
        $query = "SELECT $table";
        $statment = $dbh->prepare($query);
        $statment->execute();
        $queryResults = $statment->fetch(PDO::FETCH_ASSOC);
        return $queryResults;
        $dbh = null;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }
}

function getMaxIdEx()
{
    $maxId = getAnItem("max(id) from exercises");
    return $maxId;
}

function getMinIdEx()
{
   $minId = getAnItem("min(id) from exercises");
    return $minId;
}

function getAnExercise($name)
{
    $exercise = getAnItem("exercise, image, description, repetition, time, difficulty, materials.name material, targetedareas.name area, programs.name program  FROM exercises_use_targetedareas
                inner join targetedareas on targetedarea_id = targetedareas.id
                inner join exercises on exercise_id = exercises.id
                inner join materials on materials_id = materials.id
                inner join sequencies on exercises.id = sequencies.exercise_id
                inner join programs on program_id = programs.id
                where exercise = '$name'");
    return $exercise;

}
function getAnEx($name)
{
    $exercise = getAnItem("* From exercises where exercise = '$name'");
    return $exercise;

}

function addAnItem($table)
{
    try {
        $dbh = callPDO();
        $query = "INSERT INTO $table";
        $statement = $dbh->prepare($query);//prepare query
        $statement->execute();//execute query
        $id = $dbh->lastInsertId();
        $dbh = null;
        return $id;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }

}

function addUser($user)
{
    addAnItem("users (email,firstname,lastname,weight,height,password,birthday,role_id)
    Values ('{$user["email"]}', '{$user["firstname"]}', '{$user["lastname"]}','{$user["weight"]}','{$user["height"]}','{$user["password"]}','{$user["birthday"]}','{$user["role_id"]}')");
}

function addAPlace($place)
{

    addAnItem("places (place) Values ('$place')");
}

function addATargetedArea($area)
{
    addAnItem("targetedareas (name) Values ('$area')");
}

function addAProgram($program)
{
    addAnItem("programs (name) Values ('$program')");
}

function addAMaterial($material)
{
    addAnItem("materials (name) Values ('$material')");
}

function addAnEx($name, $image, $description, $reps, $time, $diff, $material)
{

    addAnItem("exercises (exercise,image,description,repetition,time,difficulty,materials_id)
    Values ('$name','$image','$description',$reps,$time,$diff,$material)");
}

function addAnExPlace($exerciseId, $placeId)
{
    addAnItem("exercises_practice_places (exercise_id,place_id) Values ($exerciseId,$placeId)");
}

function addAnExArea($exerciseId, $areaId)
{
    addAnItem("exercises_use_targetedareas (exercise_id,targetedarea_id) Values ($exerciseId,$areaId)");
}

function addSequencie($exerciseId, $programId)
{
    addAnItem("sequencies (exercise_id,program_id) Values($exerciseId,$programId)");
}

function addUserProgram($sequencieId,$userId)
{
    addAnItem("sequencies_has_users (sequencie_id,user_id) Values($sequencieId,$userId)");
}

function deleteItem($table)// mettre à jour un item dans la bdd
{
    try {
        $dbh = callPDO();
        $query = "DELETE FROM $table";
        $statement = $dbh->prepare($query);
        $statement->execute();
        $queryResult = $statement->fetch();
        $dbh = null;
        return $queryResult;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }
}

function delAPlace($place)
{

    deleteItem("places where place = '$place'");
}

function delAnArea($area)
{
    deleteItem("targetedareas where name = '$area'");
}

function delAProgram($program)
{
    deleteItem("programs where name = '$program'");
}

function delAMaterial($material)
{
    deleteItem("materials where name = '$material'");
}

function delUserProgram($seqId)
{
    deleteItem("sequencies_has_users where sequencie_id = $seqId");
}

function callPDO()
{
    require ".const.php";
    $dbh = new PDO('mysql:host=' . $dbhost . ';dbname=' . $dbname, $user, $pass);
    return $dbh;

}
