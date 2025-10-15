<?php

include 'article_request.php';
include 'tools.php';

$categories = get_all_categories();

// Tester si le formulaire est soumis
if (isset($_POST["submit"])) {
    // Traitement du formulaire
    $result = addArticle();
    // Redirection (attente 2s avant de recharger la page)
    // header("Refresh:2; url=add_user.php");
}

function addArticle(){

    if(!isset($_POST["title"]) && !isset($_POST["content"])){
        return   "Veuillez remplir correctement les champs !";
    } else if (strlen($_POST["title"]) < 2 ){
        return "Ecris plus ma belle !";
    } 

    // Nettoyer les entrées 
    foreach ($_POST as $key => $value) {
        if(gettype($value) != "array"){
            $_POST[$key] = sanitize($value);
        }  
    }

    try {
        // Ajout en BDD
        add_article($_POST);
       return  "L'article " . $_POST["title"] . " à bien été ajouté a la base de données";

    } catch (Exception $e) {
        return $e->getMessage();
    } }



?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un article</title>
    <!-- Lien Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <main class="container py-5">
        <div class="card shadow-lg p-4 mx-auto" style="max-width: 700px; border-radius: 1rem;">
            <h2 class="text-center mb-4 text-primary">Ajouter un article</h2>

            <form action="" method="post" enctype="multipart/form-data" novalidate>
                <div class="mb-3">
                    <label for="title" class="form-label">Titre de l'article</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Saisir le titre de l'article" required>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Contenu de l'article</label>
                    <textarea class="form-control" name="content" id="content" rows="6" placeholder="Saisir le contenu de l'article" required></textarea>
                </div>

                <div class="mb-4">
                    <label for="categories" class="form-label">Catégories</label>
                    <select name="categories[]" id="categories" class="form-select" multiple required>
                        <?php foreach ($categories as $key => $value) : ?>
                            <option value="<?= $value["id"] ?>"><?= htmlspecialchars($value["name"]) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="form-text">Maintenez CTRL (ou CMD sur Mac) pour sélectionner plusieurs catégories.</div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-4" name="submit">Ajouter l'article</button>
                </div>
            </form>
            <p class="mt-3 text-center text-danger fw-semibold"><?= $result ?? "" ?></p>
        </div>
    </main>

    <footer class="mt-5">
        <?php include 'footer.php'; ?>
    </footer>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
