<?php
// Simulation du rendu de list.html.twig
$authors = array(
    array('id' => 1, 'picture' => '/images/Victor-Hugo.webp','username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com ', 'nb_books' => 100),
    array('id' => 2, 'picture' => '/images/william-shakespeare.webp','username' => ' William Shakespeare', 'email' => ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
    array('id' => 3, 'picture' => '/images/Taha_Hussein.jpeg','username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300),
);

$totalBooks = 0;
foreach ($authors as $author) {
    $totalBooks += $author['nb_books'];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Auteurs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        .stats {
            background-color: #ecf0f1;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 30px;
            text-align: center;
        }
        .stats p {
            margin: 5px 0;
            font-weight: bold;
            color: #2c3e50;
        }
        .authors-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        .author-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            background-color: #fafafa;
            transition: transform 0.3s ease;
        }
        .author-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .author-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 3px solid #3498db;
        }
        .author-name {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .author-email {
            color: #666;
            margin-bottom: 10px;
        }
        .author-books {
            color: #e74c3c;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .details-link {
            display: inline-block;
            padding: 8px 16px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .details-link:hover {
            background-color: #2980b9;
        }
        .back-link {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 20px;
            background-color: #27ae60;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Liste des Auteurs</h1>
        
        <?php if (!empty($authors)): ?>
            <div class="stats">
                <p>Nombre d'auteurs : <?php echo count($authors); ?></p>
                <p>Nombre total de livres : <?php echo $totalBooks; ?></p>
            </div>
            
            <div class="authors-grid">
                <?php foreach ($authors as $author): ?>
                    <div class="author-card">
                        <img src="<?php echo htmlspecialchars($author['picture']); ?>" alt="<?php echo htmlspecialchars($author['username']); ?>" class="author-image" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIiBmaWxsPSIjZGRkIi8+Cjx0ZXh0IHg9IjUwIiB5PSI1NSIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmaWxsPSIjNjY2IiB0ZXh0LWFuY2hvcj0ibWlkZGxlIj5JbWFnZTwvdGV4dD4KPC9zdmc+'">
                        <div class="author-name"><?php echo strtoupper(htmlspecialchars($author['username'])); ?></div>
                        <div class="author-email"><?php echo htmlspecialchars(trim($author['email'])); ?></div>
                        <div class="author-books">Nombre de livres : <?php echo $author['nb_books']; ?></div>
                        <a href="/author-details/<?php echo $author['id']; ?>" class="details-link">Détails</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div style="text-align: center; color: #666; font-style: italic; padding: 40px;">
                <p>Aucun auteur n'est défini ou la liste est vide.</p>
            </div>
        <?php endif; ?>
        
        <div style="text-align: center;">
            <a href="/" class="back-link">Retour à l'accueil</a>
        </div>
    </div>
</body>
</html>