<?php

// Point d'entrée simple pour les exercices Symfony
// En production, utilisez le système de routing Symfony complet

$request_uri = $_SERVER['REQUEST_URI'];
$path = parse_url($request_uri, PHP_URL_PATH);

// Routes de base pour les exercices
switch (true) {
    case $path === '/':
    case $path === '/authors':
        // Redirection vers la liste des auteurs
        header('Content-Type: text/html; charset=utf-8');
        echo '<!DOCTYPE html>
        <html>
        <head>
            <title>Exercices Symfony - Auteurs</title>
            <style>
                body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
                .container { text-align: center; background: #f8f9fa; padding: 40px; border-radius: 10px; }
                h1 { color: #333; }
                .links { margin-top: 30px; }
                .link { display: inline-block; margin: 10px; padding: 15px 25px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; }
                .link:hover { background: #0056b3; }
                .info { background: #e9ecef; padding: 20px; border-radius: 5px; margin: 20px 0; }
            </style>
        </head>
        <body>
            <div class="container">
                <h1>Exercices Symfony - Gestion des Auteurs</h1>
                <div class="info">
                    <p><strong>Note :</strong> Ce projet contient les exercices Symfony avec les contrôleurs et vues Twig créés.</p>
                    <p>Pour utiliser pleinement Symfony, installez le framework complet avec Composer.</p>
                </div>
                <div class="links">
                    <a href="/example-author" class="link">Exercice 1 - Affichage Variable</a>
                    <a href="/static-list" class="link">Exercice 2 - Liste des Auteurs</a>
                </div>
                <div class="info">
                    <h3>Fichiers créés :</h3>
                    <ul style="text-align: left;">
                        <li>src/Controller/AuthorController.php</li>
                        <li>templates/show.html.twig</li>
                        <li>templates/list.html.twig</li>
                        <li>templates/showAuthor.html.twig</li>
                    </ul>
                </div>
            </div>
        </body>
        </html>';
        break;

    case preg_match('/^\/author\/(.+)$/', $path, $matches):
        $name = $matches[1];
        // Simulation du rendu Twig pour l'exercice 1
        include 'demo_show.php';
        break;

    case $path === '/example-author':
        $name = 'Victor Hugo';
        include 'demo_show.php';
        break;

    case $path === '/static-list':
        include 'demo_list.php';
        break;

    default:
        http_response_code(404);
        echo '<h1>Page non trouvée</h1><p><a href="/">Retour à l\'accueil</a></p>';
        break;
}