<?php
// Simulation du rendu de showAuthor.html.twig
$authors = array(
    1 => array('id' => 1, 'picture' => '/images/Victor-Hugo.webp','username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com ', 'nb_books' => 100),
    2 => array('id' => 2, 'picture' => '/images/william-shakespeare.webp','username' => ' William Shakespeare', 'email' => ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
    3 => array('id' => 3, 'picture' => '/images/Taha_Hussein.jpeg','username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300),
);

if (!isset($authors[$authorId])) {
    http_response_code(404);
    echo '<h1>Auteur non trouvé</h1><p><a href="/static-list">Retour à la liste</a></p>';
    exit;
}

$author = $authors[$authorId];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'Auteur - <?php echo htmlspecialchars($author['username']); ?></title>
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
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 15px;
        }
        .author-details {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .author-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            border: 4px solid #3498db;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .author-info {
            width: 100%;
            max-width: 400px;
        }
        .info-item {
            background-color: #ecf0f1;
            margin: 10px 0;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #3498db;
        }
        .info-label {
            font-weight: bold;
            color: #2c3e50;
            display: block;
            margin-bottom: 5px;
        }
        .info-value {
            color: #34495e;
            font-size: 16px;
        }
        .author-name {
            font-size: 24px;
            color: #2c3e50;
            font-weight: bold;
        }
        .books-count {
            color: #e74c3c;
            font-weight: bold;
            font-size: 18px;
        }
        .back-link {
            margin-top: 30px;
            display: inline-block;
            padding: 12px 24px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .back-link:hover {
            background-color: #2980b9;
        }
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }
            .author-image {
                width: 120px;
                height: 120px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Détails de l'Auteur</h1>
        
        <div class="author-details">
            <img src="<?php echo htmlspecialchars($author['picture']); ?>" alt="<?php echo htmlspecialchars($author['username']); ?>" class="author-image" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTUwIiBoZWlnaHQ9IjE1MCIgdmlld0JveD0iMCAwIDE1MCAxNTAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxNTAiIGhlaWdodD0iMTUwIiBmaWxsPSIjZGRkIi8+Cjx0ZXh0IHg9Ijc1IiB5PSI4MCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE2IiBmaWxsPSIjNjY2IiB0ZXh0LWFuY2hvcj0ibWlkZGxlIj5JbWFnZTwvdGV4dD4KPC9zdmc+'">
            
            <div class="author-info">
                <div class="info-item">
                    <span class="info-label">Nom :</span>
                    <span class="info-value author-name"><?php echo htmlspecialchars(trim($author['username'])); ?></span>
                </div>
                
                <div class="info-item">
                    <span class="info-label">Email :</span>
                    <span class="info-value"><?php echo htmlspecialchars(trim($author['email'])); ?></span>
                </div>
                
                <div class="info-item">
                    <span class="info-label">Nombre de livres :</span>
                    <span class="info-value books-count"><?php echo $author['nb_books']; ?></span>
                </div>
                
                <div class="info-item">
                    <span class="info-label">ID :</span>
                    <span class="info-value">#<?php echo $author['id']; ?></span>
                </div>
            </div>
            
            <a href="/static-list" class="back-link">← Retour à la liste des auteurs</a>
        </div>
    </div>
</body>
</html>