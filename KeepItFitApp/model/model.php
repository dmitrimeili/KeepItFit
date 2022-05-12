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

function callPDO()
{
    require ".const.php";
    $dbh = new PDO('mysql:host=' . $dbhost . ';dbname=' . $dbname, $user, $pass);
    return $dbh;
}
