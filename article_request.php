<?php
//import de la BDD
include 'database.php';


function test() {
    $bdd = new PDO('mysql:host=localhost;dbname=app', 'root', '');
    $id = $bdd->lastInsertId();
    dd($id);
}
/**
 * Méthode qui ajoute un article + associe ces catégories en BDD
 * @param array $article super globale $_POST avec les données du formulaire
 * @return void 
 */
function add_article(array $article) {
    
    //1 Requête pour ajouter l'article
    //Requête SQL
    $sql = "INSERT INTO article(title, content) VALUE(?,?)";
    $pdo = connectBDD();

    //Préparer la requête
    $bdd = $pdo->prepare($sql);
    //Assigner les paramètres
    $bdd->bindParam(1, $article["title"], PDO::PARAM_STR);
    $bdd->bindParam(2, $article["content"], PDO::PARAM_STR);
    //Exécuter la requête
    $bdd->execute();
    //Récupérer l'id de l'article ajouté
    
    $id_article = (int) $pdo->lastInsertId();
    //2 Requêtes pour associer les catégories à l'article
    //Boucle pour associer les catégories à l'article
    foreach($article["categories"] as $category) {
        //id_category
        $category = (int) $category;
        //Requête pour la table association
        $sql_article_category = "INSERT INTO article_category(id_article, id_category)
        VALUE(?,?)";

        //Préparer la requête
        $bdd_article_category = connectBDD()->prepare($sql_article_category);
        //Assigner les paramètres
        $bdd_article_category->bindParam(1,$id_article, PDO::PARAM_INT);
        $bdd_article_category->bindParam(2,$category, PDO::PARAM_INT);
        //Exécuter la requête
        $bdd_article_category->execute();

    }
}

/**
 * Méthode qui retourne la liste des catégories
 * @return array tableau des enregistrements de catégories
 */
function get_all_categories() {
    //Requête SQL
    $sql = "SELECT c.id, c.name_category AS `name` FROM category AS c ORDER BY `name` ASC";
    //Préparer la requête
    $bdd = connectBDD()->prepare($sql);
    //Exécuter la requête
    $bdd->execute();
    //Récupérer la liste des catégories
    $categories = $bdd->fetchAll(PDO::FETCH_ASSOC);
    //Retourner la liste des catégories (tableau associatif)
    return $categories;
}