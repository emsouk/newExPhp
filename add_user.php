<?php
//import du fichier user_request.php
include 'users_request.php';
include 'tools.php';

//tester si le formulaire est soumis
if (isset($_POST["submit"])) {
    //traitement du formulaire
    $result = add_user();
    //redirection
    header("Refresh:2; url=add_user.php");
}

/**
 * Méthode pour gérer l'ajout d'un utilisateur (formulaire)
 * @return string message de sortie
 */
function add_user(): string {
    // Test si les champs sont vides
    if (empty($_POST["firstname"]) || empty($_POST["lastname"]) || empty($_POST["email"]) || empty($_POST["password"])) {
        return "Veuillez remplir les 4 champs.";
    }

    // Vérification de la correspondance des mots de passe
    if ($_POST["password"] !== $_POST["password2"]) {
        return "Les mots de passe ne sont pas identiques.";
    }

    // Nettoyage des entrées
    foreach ($_POST as $key => $value) {
        $_POST[$key] = sanitize($value);
    }

    // Vérifier si l'email est valide
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        return "L'email n'est pas valide.";
    }

    // Vérifier si le compte existe déjà
    if (is_user_exists($_POST["email"])) {
        return "Cet email est déjà utilisé.";
    }

    // Vérification de la complexité du mot de passe
    $regexPassword = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{12,}$/";
    if (!preg_match($regexPassword, $_POST["password"])) {
        return "Le mot de passe doit contenir au moins 12 caractères, une majuscule, une minuscule et un chiffre.";
    }

    // Hash du mot de passe
    $_POST["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Ajout du compte en base de données
    try {
        save_user($_POST);
        return "Le compte " . htmlspecialchars($_POST["email"]) . " a été ajouté avec succès.";
    } catch (Exception $e) {
        return "Erreur : " . $e->getMessage();
    }
}
?>


   
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un utilisateur</title>
    <!-- Lien Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <header>
    <?php include 'navbar.php'; ?>
    </header>
    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <div class="card shadow-lg p-4" style="max-width: 450px; width: 100%; border-radius: 1rem;">
            <h2 class="text-center mb-4 text-primary">Ajouter un utilisateur</h2>

            <form action="" method="post" novalidate>
                <div class="mb-3">
                    <label for="firstname" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Saisir votre prénom" required>
                </div>

                <div class="mb-3">
                    <label for="lastname" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Saisir votre nom" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Saisir votre email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Saisir un mot de passe" required>
                    <div class="form-text">12 caractères minimum, avec majuscule, minuscule et chiffre.</div>
                </div>

                <div class="mb-4">
                    <label for="password2" class="form-label">Confirmation du mot de passe</label>
                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirmer le mot de passe" 
                        pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{12,}$" required>
                </div>

                <button type="submit" class="btn btn-primary w-100" name="submit">Ajouter</button>
            </form>

            <p class="mt-3 text-center text-danger fw-semibold"><?= $result ?? "" ?></p>
        </div>
    </div>

     <?php include 'footer.php'; ?>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
