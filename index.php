<?php require 'vendor/autoload.php'; ?>
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
    <p class="lead text-secondary mb-5">Composants 100% PHP natif, sans Twig 😎</p>
  </main>

  <?php include 'footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
