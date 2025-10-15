<?php

include 'database.php';


//Méthode ajouter un utilisateur
function save_user(array $user) {
    //Requête SQL
    $sql = "INSERT INTO users(firstname, lastname, email, `password`, img) VALUE(?,?,?,?,?)";

        //Préparation de la requête SQL
        $bdd = connectBDD()->prepare($sql);
        //Assigner les paramètres
        $bdd->bindParam(1, $user["firstname"], PDO::PARAM_STR);
        $bdd->bindParam(2, $user["lastname"], PDO::PARAM_STR);
        $bdd->bindParam(3, $user["email"], PDO::PARAM_STR);
        $bdd->bindParam(4, $user["password"], PDO::PARAM_STR);
        $bdd->bindParam(5, $user["img"], PDO::PARAM_STR);
        //Exécution
        $bdd->execute();

}


//Méthode de consultation pour vérifier si le compte existe 
function is_user_exists(string $email): bool{
    // Requete SQL
    $sql = "SELECT u.id FROM users AS u WHERE u.email = ?";
    // Prépaation de la requete SQL
    $bdd = connectBDD()->prepare($sql);
    //Assigner le param email
    $bdd->bindParam(1, $email, PDO::PARAM_STR);
    // Executer la requete SQL
    $bdd->execute();

    // Test si le tableau est vide 
    if (empty($bdd->fetch(PDO::FETCH_ASSOC))){
        return true;
    }
    return false;
    
}
