<?php include '../navbar.php'; ?>

<?php
if (isset($_POST['submit'])) {
    if (($_POST['nbr1'] != "" || $_POST['nbr2'] != "" || $_POST['operateur'] != "")) {
        $nbr1 = $_POST['nbr1'];
        $nbr2 = $_POST['nbr2'];
        $operateur = $_POST['operateur'];

        switch ($_POST['operateur']) {
            case 'add':
                $result = $nbr1 + $nbr2;
                break;
            case 'sous':
                $result = $nbr1 - $nbr2;
                break;
            case 'multi':
                $result = $nbr1 * $nbr2;
                break;
            case 'div':
                if ($_POST['nbr2'] != 0) {
                    $result = $nbr1 / $nbr2;
                } else {
                    $result = "❌ On ne peut pas diviser par zéro Jacky !";
                }
                break;
            default:
                $result = "Opérateur inconnu 🧐";
                break;
        }
    } else {
        $result = "⚠️ Les champs sont vides !";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calculatrice PHP 🤙</title>

  <!-- ✅ Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

  <main class="container my-5 flex-grow-1">
    <div class="card shadow-sm border-0 mx-auto" style="max-width: 700px;">
      <div class="card-body text-center">
        <h1 class="text-primary fw-bold mb-4">🧮 Ma Calculatrice PHP 🤙</h1>
        <p class="text-secondary mb-4">Entre deux nombres et choisis un opérateur pour voir le résultat !</p>

        <!-- ✅ Formulaire -->
        <form action="" method="post" class="text-start">
          <div class="mb-3">
            <label class="form-label fw-semibold">Premier nombre</label>
            <input type="text" name="nbr1" class="form-control" placeholder="Ex : 12" value="<?= $nbr1 ?? '' ?>">
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Deuxième nombre</label>
            <input type="text" name="nbr2" class="form-control" placeholder="Ex : 5" value="<?= $nbr2 ?? '' ?>">
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Opérateur</label>
            <input type="text" name="operateur" class="form-control" placeholder="add, sous, multi, div" value="<?= $operateur ?? '' ?>">
          </div>

          <div class="d-grid">
            <input type="submit" name="submit" value="Calculer" class="btn btn-primary rounded-pill">
          </div>
        </form>

        <!-- ✅ Résultat -->
        <?php if (isset($result)) : ?>
          <div class="alert alert-light mt-4 shadow-sm">
            <h5 class="fw-bold">Résultat :</h5>
            <p class="mb-0">
              🌶️ <?= $nbr1 ?? '' ?> <?= $operateur ?? '' ?> <?= $nbr2 ?? '' ?> = 
              <strong><?= $result ?? '' ?></strong> 🤙
            </p>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </main>

  <!-- ✅ Footer -->
  <?php include '../footer.php'; ?>

  <!-- ✅ Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
