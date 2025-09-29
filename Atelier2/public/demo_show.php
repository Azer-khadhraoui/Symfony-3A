<?php
// Simulation du rendu de show.html.twig
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affichage Auteur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        .author-name {
            font-size: 24px;
            color: #2c3e50;
            font-weight: bold;
        }
        .back-link {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-link:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Informations sur l'auteur</h1>
        <p class="author-name">Nom de l'auteur : <?php echo htmlspecialchars($name); ?></p>
        
        <a href="/" class="back-link">Retour à l'accueil</a>
        <a href="/static-list" class="back-link">Liste des auteurs</a>
    </div>
</body>
</html>