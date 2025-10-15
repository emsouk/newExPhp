<?php
// Import du fichier user_request.php
include 'users_request.php';
include 'tools.php';

// Tester si le formulaire est soumis
if (isset($_POST["submit"])) {
    // Traitement du formulaire
    $result = add_user();
    // Redirection (attente 2s avant de recharger la page)
    header("Refresh:2; url=add_user.php");
}

/**
 * Méthode pour gérer l'ajout d'un utilisateur (formulaire)
 * @return string message de sortie
 */
function add_user(): string
{
    // Test si les champs sont vides
    if (empty($_POST["firstname"]) || empty($_POST["lastname"]) || empty($_POST["email"]) || empty($_POST["password"])) {
        return "Veuillez remplir les 4 champs";
    }

    // Test si les 2 mots de passe correspondent
    if ($_POST["password"] != $_POST["verif_password"]) {
        return "Les 2 mots de passe ne correspondent pas";
    }

    // Nettoyer les entrées
    foreach ($_POST as $key => $value) {
        $_POST[$key] = sanitize($value);
    }

    // Vérification du mot de passe (au moins 12 caractères, maj, min, chiffre)
    if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{12,}$/', $_POST["password"])) {
        return "Le mot de passe doit contenir des majuscules, minuscules, chiffres et au moins 12 caractères";
    }

    // Vérifier si l'email est invalide
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        return "L'email n'est pas valide";
    }

    // Test si le compte existe déjà
    if (is_user_exists($_POST["email"])) {
        return "Cet email n'est pas utilisable";
    }

    // Hash du mot de passe
    $_POST["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Ajout du compte en BDD
    try {
        // Import de l'image
        $file_name = import_file();

        // Si aucun fichier importé, on met une image par défaut
        $_POST["img"] = $file_name ? $file_name : "profil.png";

        // Ajout en BDD
        save_user($_POST);
        return "Le compte " . $_POST["email"] . " a été ajouté avec succès";

    } catch (Exception $e) {
        return $e->getMessage();
    }
}

/**
 * Fonction pour gérer l'import d'une image
 */
function import_file(): bool|string {
    // Test si le fichier image existe
    if (isset($_FILES["img"])) {
        if (isset($_FILES["img"]["name"]) && !empty($_FILES["img"]["name"])) {
            // Ancien nom
            $old_name = $_FILES["img"]["name"];
            // Extension
            $ext = strtolower(getFileExtension($old_name));

            // Vérifier la taille (max 100 Mo)
            if ($_FILES["img"]["size"] > (100 * 1024 * 1024)) {
                echo "Le fichier est trop grand";
                return false;
            }

            // Vérifier le format
            if ($ext != "png" && $ext != "jpg" && $ext != "jpeg") {
                echo "Le format n'est pas valide";
                return false;
            }

            // Nouveau nom unique
            $new_name = uniqid("img", true) . "." . $ext;

            // Déplacer le fichier
            move_uploaded_file($_FILES["img"]["tmp_name"], "public/asset/" . $new_name);
            return $new_name;
        }
        return false;
    }
    return false;
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

            <form action="" method="post" enctype="multipart/form-data" novalidate>
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
                    <label for="verif_password" class="form-label">Confirmation du mot de passe</label>
                    <input type="password" class="form-control" id="verif_password" name="verif_password" placeholder="Confirmer le mot de passe"
                        pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{12,}$" required>
                </div>

                <div class="mb-4">
                    <label for="img" class="form-label">Ajouter une image</label>
                    <input type="file" class="form-control" name="img" id="img" accept=".png, .jpg, .jpeg">
                </div>

                <button type="submit" class="btn btn-primary w-100" name="submit">Ajouter</button>
            </form>

            <p class="mt-3 text-center text-danger fw-semibold"><?= $result ?? "" ?></p>
        </div>
    </div>


    <footer>
        <?php include 'footer.php'; ?>
    </footer>
        

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
