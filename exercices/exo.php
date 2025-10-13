<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Exercice Tableaux PHP</title>

  <!-- ✅ Lien Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- ✅ Navbar -->
    <?php include 'navbar.php'; ?>

  <!-- ✅ Contenu principal -->
  <main class="container my-5">
    <div class="card shadow-sm border-0">
      <div class="card-body">
        <h1 class="card-title text-primary mb-4 text-center">Itération sur les Tableaux</h1>
        <p class="text-secondary text-center">Affichage des données avec différentes boucles PHP</p>
        <hr>

        <div class="row">
          <div class="col-md-6">
            <h5 class="text-success">Tableau associatif :</h5>
            <div class="bg-light p-3 border rounded">
              <?php
              //Création d'un tableau vide
              $tab = [];
              //ajout de colonnes (tableau associatif)
              $tab["prenom"] = "Mathieu";
              $tab["nom"] = "Adrar";
              $tab["email"] = "mathieu@test.com";

              //Itération tableau associatif
              foreach ($tab as $key => $value) {
                  echo "<div><strong>$key</strong> : $value</div>";
              }
              ?>
            </div>
          </div>

          <div class="col-md-6">
            <h5 class="text-success">Tableau indexé :</h5>
            <div class="bg-light p-3 border rounded">
              <?php
              //Tableau indexé (avec des valeurs)
              $tab_indexe = [0,15,22,33,47];
              //Ajout d'une colonne tableau indexé
              $tab_indexe[] = 20;

              //Itération tableau indexé
              foreach ($tab_indexe as $key => $value) {
                  echo "<div><strong>Index $key</strong> : $value</div>";
              }

              //Iteration tableau indexé avec la boucle for
              echo "<hr><h6>Boucle for :</h6>";
              for ($i=0; $i < count($tab_indexe); $i++) { 
                  echo $tab_indexe[$i] . " ";
              }

              //compteur (index)
              echo "<hr><h6>Boucle while :</h6>";
              $cpt = 0;
              while ($cpt < count($tab_indexe)) {
                  echo $tab_indexe[$cpt] . " ";
                  $cpt++;
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- ✅ Footer -->
    <?php include 'footer.php'; ?>

  <!-- ✅ Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
