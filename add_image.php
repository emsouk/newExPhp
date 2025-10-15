<?php
    include 'vendor/autoload.php';
    include 'tools.php';
    if (isset($_POST["submit"])) {
        //ancien nom du fichier
        dd($_FILES["image"]);
        $old_name = $_FILES["image"]["name"];
        //extension 
        $ext = getFileExtension($old_name);
        $new_name = uniqid("img", true) . "." . $ext;
        //dd($old_name, $ext, $new_name);
        if ($_FILES["image"]["size"] > (100 * 1024 * 1024)) {
            echo "le fichier est trop grand";
        } else if 
            ($ext != "png" || $ext != "PNG" || $ext != "jpg" || $ext != "jpeg" || $ext != "JPEG" || $ext != "JPG") {
                echo " le format n'est pas valide"; 
            }
        }
        move_uploaded_file($_FILES["image"]["tmp_name"], "public/asset/" . $_FILES["image"]["name"]);
       /*  dd($_FILES); */

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importer des fichiers</title>
    <!-- Lien Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <main class="flex-fill d-flex justify-content-center align-items-center py-5">
        <div class="card shadow-lg p-5" style="max-width: 450px; width: 100%; border-radius: 1rem;">
            <h2 class="text-center text-primary mb-4">Importer un fichier</h2>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="image" class="form-label">Choisir une image :</label>
                    <input type="file" class="form-control" id="image" name="image" required>
                </div>

                <div class="d-grid">
                    <input type="submit" class="btn btn-primary" value="Importer" name="submit">
                </div>
            </form>
        </div>
    </main>

    <footer class="mt-auto">
        <?php include 'footer.php'; ?>
    </footer>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
