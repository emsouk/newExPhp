<?php 
include 'database.php';

dump(connectBDD());

function add_user($user){
    // requete sql 
        $sql = "INSERT INTO users(firstname, lastname, email, 'password' VALUE(?,?,?,?)";
    try{
    // preparation de la requete sql
        $bdd = connectBDD()->prepare($sql);
    // assigner les paramètres 
        $bdd->bindParam(1, $user["firstname"], PDO::PARAM_STR);
        $bdd->bindParam(2, $user["lastname"], PDO::PARAM_STR);
        $bdd->bindParam(3, $user["email"], PDO::PARAM_STR);
        $bdd->bindParam(4, $user["password"], PDO::PARAM_STR);
    //execution
        $bdd->execute();
    } catch (Exception $e){
        echo $e->getMessage();
    }

    
    
}