<?php 
require 'vendor/autoload.php'; 
include 'database.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Components</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: linear-gradient(135deg, #f8f9fa, #e8f0ff); min-height: 100vh; display: flex; flex-direction: column;">

  <header>
    <?php include 'navbar.php'; ?>
  </header>

  <main class="container text-center py-5 flex-grow-1">
    <h1 class="mb-4 text-primary fw-bold">PHP Components 🤙🌶️</h1>
   <p class="lead text-center mt-4" style="max-width: 800px; margin: auto;">
    Bienvenue dans mon espace d’exercices PHP 🧩 !  
    Ici, je mets en pratique les notions que j’apprends au fil de ma formation : conditions, boucles, formulaires, calculs, manipulation du DOM et plus encore.  
    Chaque exercice est une étape de mon apprentissage en développement web, avec une pointe de fun et de logique 🤙.
  </p>


  </main>

  <?php include 'footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">co</script>


</body>
</html>
