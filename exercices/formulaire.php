  <!-- ✅ Navbar -->
  <?php include '../navbar.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calcul TVA - PHP</title>

  <!-- ✅ Lien Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">


  <main class="container my-5">
    <div class="card shadow-sm border-0 mx-auto" style="max-width: 700px;">
      <div class="card-body">
        <h1 class="text-center text-primary fw-bold mb-4">💶 Calcul du prix TTC</h1>

        <?php
          if (isset($_POST['submit'])) {
              if (!empty($_POST['montant'] || $_POST['nombre'] || $_POST['tva'])) {
                  $montantHT = $_POST['montant'];
                  $nombreArticles = $_POST['nombre'];
                  $tauxTVA = $_POST['tva'];
              }
          }

          if (isset($_POST['submit'])) {
              if (!empty($_POST['montant']) && !empty($_POST['nombre']) && !empty($_POST['tva'])) {
                  $montantHT = $_POST['montant'];
                  $nombreArticles = $_POST['nombre'];
                  $tauxTVA = $_POST['tva'];
                  $resultat = $montantHT * $tauxTVA * $nombreArticles;
                  // var_dump($resultat);
              } elseif (empty($_POST['montant']) || empty($_POST['nombre']) || empty($_POST['tva'])) {
                  echo "<div class='alert alert-warning text-center'>⚠️ Veuillez remplir tous les champs correctement !</div>";
              } elseif (!is_numeric($_POST['montant']) || !is_numeric($_POST['nombre']) || !is_numeric($_POST['tva'])) {
                  echo "<div class='alert alert-danger text-center'>❌ Veuillez remplir tous les champs avec des nombres valides ! 🐽</div>";
              }
          }
        ?>

        <!-- ✅ Formulaire -->
        <form action="" method="post" class="mt-4">
          <div class="mb-3">
            <label class="form-label fw-semibold">Montant HT</label>
            <input type="number" name="montant" class="form-control" placeholder="Saisir le montant HT">
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Nombre d’articles</label>
            <input type="number" name="nombre" class="form-control" placeholder="Saisir le nombre d'articles">
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Taux de TVA</label>
            <input type="number" name="tva" class="form-control" step="0.01" placeholder="Saisir le taux de TVA (ex: 0.2)">
          </div>

          <div class="d-grid">
            <input type="submit" name="submit" value="Calculer" class="btn btn-primary rounded-pill">
          </div>
        </form>

        <!-- ✅ Résultats -->
        <?php if (isset($resultat)) : ?>
          <div class="alert alert-success mt-4 text-center">
            <h4>Résultat :</h4>
            <p class="mb-1">Le prix TTC pour cet article est de <strong><?= $resultat ?? "" ?> €</strong></p>
          </div>

          <div class="bg-light border rounded p-3 mt-3">
            <p><strong>Montant HT :</strong> <?= $montantHT ?? "" ?></p>
            <p><strong>Nombre d’articles :</strong> <?= $nombreArticles ?? "" ?></p>
            <p><strong>Taux de TVA :</strong> <?= $tauxTVA ?? "" ?></p>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </main>

  <!-- ✅ Footer -->
  <?php include '../footer.php'; ?>

  <!-- ✅ JS Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
