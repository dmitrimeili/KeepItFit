<?php


function getAllItems($table)
{
    try {
        $dbh = callPDO();
        $query = "SELECT * FROM $table";
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
    $users = getAllItems("users");
    return $users;
}

function getPlaces()
{
    $places = getAllItems("places");
    return $places;
}

function getTargetedAreas()
{
    $areas = getAllItems("targetedareas");
    return $areas;
}

function getPrograms()
{
    $programs = getAllItems("programs");
    return $programs;
}

function getMaterials()
{
    $materials = getAllItems("materials");
    return $materials;
}

function getExercises()
{
    $exercises = getAllItems("exercises");
    return $exercises;
}

function getExSequencies()
{
    $exsequencies = getAllItems("sequencies
                    inner join exercises on exercise_id = exercises.id
                    inner join programs on program_id = programs.id");
    return $exsequencies;
}

function getExPlaces()
{
    $explaces = getAllItems("exercises_practice_places
                inner join exercises on exercise_id = exercises.id
                inner join places on place_id = places.id");
    return $explaces;
}

function getExAreas()
{
    $exareas = getAllItems("exercises_use_targetedareas
                inner join exercises on exercise_id = exercises.id
                inner join targetedareas on targetedarea_id = targetedareas.id");
    return $exareas;
}

function getAnItem($table) // get un item
{
    try {
        $dbh = callPDO();
        $query = "SELECT * FROM $table";
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

function getAnExercise($name)
{
    $exercise = getAnItem("exercises where exercise = '$name'");
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

function callPDO()
{
    require ".const.php";
    $dbh = new PDO('mysql:host=' . $dbhost . ';dbname=' . $dbname, $user, $pass);
    return $dbh;

}
/*
 * select * from sequencies
inner join exercises on exercise_id = exercises.id
inner join programs on program_id = programs.id
*/