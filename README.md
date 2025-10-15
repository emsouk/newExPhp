Projet PHP – Gestion d’utilisateurs et d’articles
💡 Présentation

Ce projet a été réalisé dans le cadre de ma formation Développeuse Web à l’ADRAR.
Il regroupe plusieurs fonctionnalités écrites en PHP natif, destinées à apprendre la logique du langage côté serveur, la manipulation de formulaires, la gestion de fichiers, et l’interaction avec une base de données MySQL.

⚙️ Fonctionnalités principales
👤 Gestion des utilisateurs

Ajout d’un utilisateur via un formulaire sécurisé

Vérification et nettoyage des entrées (sanitize(), filter_var(), regex)

Vérification des mots de passe (longueur, majuscules, minuscules, chiffres)

Hash du mot de passe avec password_hash()

Vérification de l’unicité de l’email en base

Upload d’une image de profil avec contrôle du format et de la taille

Attribution d’une image par défaut si aucun fichier n’est importé

📝 Gestion des articles

Ajout d’un article avec un titre, un contenu et des catégories associées

Insertion en base via PDO et requêtes préparées

Liaison article ↔ catégories via une table pivot article_category

Formulaire dynamique : les catégories sont chargées depuis la base de données

🧰 Technologies utilisées

PHP 8+

MySQL

PDO (connexion sécurisée, requêtes préparées)

HTML5 / Bootstrap 5

XAMPP (environnement local)

🔐 Sécurité & bonnes pratiques

Utilisation de requêtes préparées (prepare(), bindValue()) pour éviter les injections SQL

Vérification des fichiers uploadés (extension, taille, nom unique)

Nettoyage des entrées utilisateurs

Hash sécurisé des mots de passe

🧩 Architecture simplifiée

📁 phpexo/
│
├── add_user.php              → Formulaire d’ajout utilisateur
├── add_article.php           → Formulaire d’ajout d’article
├── user_request.php          → Fonctions liées aux utilisateurs
├── article_request.php       → Fonctions liées aux articles
├── tools.php                 → Fonctions utilitaires (sanitize, etc.)
├── database.php              → Connexion PDO
├── public/
│   └── asset/                → Images importées
├── vendor/                   → Autoload (Composer)
├── navbar.php / footer.php   → Templates de mise en page
└── README.md
🚀 Objectifs pédagogiques

Manipuler la superglobale $_POST et la superglobale $_FILES

Utiliser des requêtes SQL préparées avec PDO

Gérer la validation et la sécurité des formulaires

Comprendre la structure MVC simplifiée

Apprendre à déboguer les erreurs PHP (parenthèses, accolades, typage, etc.)

🧑‍💻 Auteur

👋 Émilie Derian
Développeuse web en reconversion – passionnée par la création d’interfaces simples, accessibles et efficaces.
Projet réalisé dans le cadre de ma formation à l’ADRAR.
