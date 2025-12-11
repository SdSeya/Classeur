<?php
// accueil.php
// Page d’accueil avec recherche et navigation

// Tableau de correspondance titres -> pages
$films = [
    // Films
    "avengers" => "index.php",
    "iron man" => "ironman.php",
    "spider-man" => "spiderman.php",
    "batman" => "batman.php",
    "superman" => "superman.php",
    "star wars" => "starwars.php",
    "star trek" => "startrek.php",
    "le seigneur des anneaux" => "lordoftherings.php",
    "harry potter" => "harrypotter.php",
    "fast & furious" => "fastandfurious.php",
    // Séries
    "the flash" => "flash.php",
    "arrow" => "arrow.php",
    "supergirl" => "supergirl.php",
    "legends of tomorrow" => "legendsoftomorrow.php",
    "black lightning" => "blacklightning.php",
    "batwoman" => "batwoman.php",
    "superman & lois" => "supermanandlois.php",
    "gotham" => "gotham.php",
    "smallville" => "smallville.php",
    "constantine" => "constantine.php",
    "stargirl" => "stargirl.php",
    "titans" => "titans.php",
    // Pages complètes
    "films" => "movies_list.php",
    "séries" => "serie.php"
];

$messageErreur = "";

// Vérifie si une recherche est soumise
if (isset($_GET['film'])) {
    $recherche = strtolower(trim($_GET['film']));
    if (array_key_exists($recherche, $films)) {
        header("Location: " . $films[$recherche]);
        exit;
    } else {
        $messageErreur = "❌ Désolé, le titre « " . htmlspecialchars($_GET['film']) . " » n’a pas été trouvé.";
    }
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>🗄️ Classeur - Accueil</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #004080, #001933);
      margin:0; padding:0; color:#fff;
    }
    header {
      background: linear-gradient(90deg, #007BFF, #0056b3);
      padding:25px; text-align:center;
      box-shadow:0 2px 8px rgba(0,0,0,0.2);
    }
    nav a { margin:0 15px; text-decoration:none; color:#fff; font-weight:bold; }
    nav a:hover { color:#ffd700; }
    main { margin:40px auto; max-width:600px; text-align:center; }
    input[type="text"] {
      padding:12px; width:80%; border-radius:8px; border:none;
      font-size:16px; margin-top:20px;
    }
    button {
      margin-top:15px; padding:10px 20px;
      background:linear-gradient(90deg, #007BFF, #0056b3);
      color:#fff; border:none; border-radius:30px;
      font-size:16px; font-weight:bold; cursor:pointer;
    }
    button:hover { background:linear-gradient(90deg, #0056b3, #004080); }
    .error {
      margin-top:20px; padding:15px;
      background:#ffdddd; color:#900;
      border:1px solid #900; border-radius:8px;
      font-weight:bold;
    }
    footer {
      margin-top:60px; padding:20px; background:#f1f1f1;
      text-align:center; color:#333;
    }
  </style>
</head>
<body>
  <header>
    <h1>Recherche</h1>
    <nav>
      <a href="movies_list.php">Films</a>
      <a href="serie.php">Séries</a>
      <a href="presentation.php">Accueil Pincipal</a>
    </nav>
  </header>

  <main>
    <h2>🔎 Recherche</h2>
    <form method="get" action="">
      <input type="text" name="film" list="filmsList" placeholder="Tapez un titre de film ou série...">
      <datalist id="filmsList">
        <!-- Films -->
        <option value="Avengers">
        <option value="Iron Man">
        <option value="Spider-Man">
        <option value="Batman">
        <option value="Superman">
        <option value="Star Wars">
        <option value="Star Trek">
        <option value="Le Seigneur des Anneaux">
        <option value="Harry Potter">
        <option value="Fast & Furious">
        <!-- Séries -->
        <option value="The Flash">
        <option value="Arrow">
        <option value="Supergirl">
        <option value="Legends of Tomorrow">
        <option value="Black Lightning">
        <option value="Batwoman">
        <option value="Superman & Lois">
        <option value="Gotham">
        <option value="Smallville">
        <option value="Constantine">
        <option value="Stargirl">
        <option value="Titans">
        <!-- Pages complètes -->
        <option value="Films">
        <option value="Séries">
      </datalist>
      <button type="submit">Rechercher</button>
    </form>

    <?php if ($messageErreur): ?>
      <div class="error"><?php echo $messageErreur; ?></div>
    <?php endif; ?>
  </main>

  <footer>
    <p>© <?php echo date('Y'); ?> Mon site</p>
  </footer>
</body>
</html>
