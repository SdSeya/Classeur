<?php
// accueil.php

$films = [
    "avengers" => [
        "titre" => "Classeur - Film: Avengers",
        "lien"  => "index.php"
    ],
    "batman" => [
        "titre" => "Classeur - Film: Batman",
        "lien"  => "batman.php"
    ],
    "iron man" => [
        "titre" => "Classeur - Film: Iron Man",
        "lien"  => "ironman.php"
    ],
    "spiderman" => [
        "titre" => "Classeur - Film: Spider-Man",
        "lien"  => "spiderman.php"
    ],
    "superman" => [
        "titre" => "Classeur - Film: Superman",
        "lien"  => "superman.php"
    ],
    "star wars" => [
        "titre" => "Classeur - Film: Star Wars",
        "lien"  => "starwars.php"
    ],
    "star trek" => [
        "titre" => "Classeur - Film: Star Trek",
        "lien"  => "startrek.php"
    ],
    "seigneur des anneaux" => [
        "titre" => "Classeur - Film: Le Seigneur des Anneaux",
        "lien"  => "lordoftherings.php"
    ],
    "harry potter" => [
        "titre" => "Classeur - Film: Harry Potter",
        "lien"  => "harrypotter.php"
    ],
    "fast and furious" => [
        "titre" => "Classeur - Film: Fast & Furious",
        "lien"  => "fastandfurious.php"
    ]
];


$searchQuery = "";
$result = null;
if (isset($_GET['query'])) {
    $searchQuery = strtolower(trim($_GET['query']));
    foreach ($films as $key => $film) {
        if ($searchQuery === strtolower($key)) {
            $result = $film;
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Classeur - Accueil</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #00003dff, #00196dff);
      margin:0;
      padding:0;
      text-align:center;
      color:#333;
    }
    header {
      background: linear-gradient(90deg, #007BFF, #0056b3);
      color:#fff;
      padding:25px;
      box-shadow:0 2px 8px rgba(0,0,0,0.2);
    }
    nav a {
      margin:0 15px;
      text-decoration:none;
      color:#fff;
      font-weight:bold;
      transition:color 0.3s;
    }
    nav a:hover {
      color:#ffd700;
    }
    main {
      margin-top:50px;
    }
    .search-container {
      margin-top:30px;
      display:flex;
      justify-content:center;
    }
    .search-bar {
      width:350px;
      padding:12px;
      border:1px solid #ccc;
      border-radius:25px;
      font-size:16px;
      outline:none;
      transition:border 0.3s;
    }
    .search-bar:focus {
      border-color:#007BFF;
    }
    .search-button {
      padding:12px 20px;
      margin-left:10px;
      background:linear-gradient(90deg, #28a745, #218838);
      color:white;
      border:none;
      border-radius:25px;
      cursor:pointer;
      font-size:16px;
      font-weight:bold;
      transition:transform 0.2s, background 0.3s;
    }
    .search-button:hover {
      background:linear-gradient(90deg, #218838, #1e7e34);
      transform:scale(1.05);
    }
    .result {
      margin-top:40px;
      font-size:18px;
    }
    .card {
      background:#fff;
      border-radius:12px;
      margin:20px auto;
      padding:25px;
      max-width:500px;
      box-shadow:0 4px 12px rgba(0,0,0,0.15);
      transition:transform 0.3s;
    }
    .card:hover {
      transform:translateY(-5px);
    }
    .card h3 {
      margin-top:0;
      color:#007BFF;
    }
    .card a {
      display:inline-block;
      margin-top:15px;
      padding:15px 25px;
      background:linear-gradient(90deg, #007BFF, #0056b3);
      color:#fff;
      border-radius:30px;
      text-decoration:none;
      font-size:18px;
      font-weight:bold;
      transition:background 0.3s, transform 0.2s;
    }
    .card a:hover {
      background:linear-gradient(90deg, #0056b3, #004080);
      transform:scale(1.05);
    }
    footer {
      margin-top:60px;
      padding:20px;
      background:#f1f1f1;
      color:#555;
      font-size:14px;
    }
  </style>
</head>
<body>
  <header>
    <h1>🎬 Bienvenue sur la page d'accueil</h1>
    <nav>
      <a href="accueil.php">Accueil</a>
      <a href="movies_list.php">Films</a>
    </nav>
  </header>
<main>
    <!-- Barre de recherche -->
    <div class="search-container">
      <form action="accueil.php" method="GET">
        <input type="text" name="query" placeholder="Rechercher un film..." class="search-bar" />
        <button type="submit" class="search-button">🔍 Rechercher</button>
      </form>
    </div>

    <!-- Résultat de recherche -->
    <?php if (!empty($searchQuery)): ?>
      <div class="result">
        <?php if ($result): ?>
          <div class="card">
            <h3><?php echo htmlspecialchars($result['titre']); ?></h3>
            <a href="<?php echo htmlspecialchars($result['lien']); ?>">➡ Voir les détails</a>
          </div>
        <?php else: ?>
          <p>Aucun résultat trouvé pour : <strong><?php echo htmlspecialchars($searchQuery); ?></strong></p>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </main>

  <footer>
    <p>© <?php echo date('Y'); ?> Mon site de films</p>
  </footer>
</body>
</html>
