<?php
/**
 * mario_series.php
 * Page séquentielle pour afficher les jeux de la saga Super Mario
 */
declare(strict_types=1);

// Charger la configuration : prefer config.php, fallback to db_config.php
$configPathPrimary = __DIR__ . '/config.php';
$configPathFallback = __DIR__ . '/db_config.php';
if (file_exists($configPathPrimary)) {
    $config = require $configPathPrimary;
} elseif (file_exists($configPathFallback)) {
    $config = require $configPathFallback;
} else {
    http_response_code(500);
    echo 'Missing config.php or db_config.php - crée le fichier config.php (voir exemple).';
    exit;
}

// Connexion PDO en utilisant la config
$dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8mb4', $config['db_host'], $config['db_name']);
try {
    $pdo = new PDO($dsn, $config['db_user'], $config['db_pass'], $config['pdo_options']);
} catch (PDOException $e) {
    http_response_code(500);
    echo 'Erreur de connexion à la base de données : ' . htmlspecialchars($e->getMessage(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    exit;
}

function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="Détails des jeux Super Mario : descriptions et navigation séquentielle entre cartes." />
  <title>Classeur - Série: Super Mario</title>
  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">🍄</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de jeu</strong>
          <small class="site-sub">Super Mario</small>
        </div>
      </div>

      <nav class="main-nav" role="navigation" aria-label="Navigation principale">
        <a href="accueil.php" class="nav-link">Accueil</a>
        <a href="jeux.php" class="nav-link">Jeux Vidéo</a>
        <a href="movies_list.php" class="nav-link">Films</a>
        <a href="serie.php" class="nav-link">Séries</a>
      </nav>
    </div>
  </header>

  <main class="container" id="main" role="main">
    <section class="hero" aria-labelledby="hero-title">
      <div class="hero-content">
        <h1 id="hero-title">Rapport sur la saga Super Mario</h1>
        <p class="lead">Ici se trouvent les détails sur les jeux principaux de la saga Mario. Clique sur "Continuer" pour afficher la première carte, puis navigue séquentiellement.</p>

        <p class="cta">
          <button class="btn primary" id="startBtn" aria-controls="cardsContainer" aria-expanded="false">Continuer</button>
          <a href="#" class="btn ghost" id="learnBtn">En savoir plus</a>
        </p>
      </div>

      <div class="hero-illustration" aria-hidden="false">
        <picture>
          <source srcset="mario.jpg" type="image/jpeg">
          <img class="hero-img" src="mario.jpg" alt="Illustration Mario" />
        </picture>
      </div>
    </section>

    <section class="grid progressive-cards" aria-label="Jeux Mario" id="cardsContainer" data-persist-key="mario-sequence">
      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

      <!-- Super Mario Bros (1985) -->
      <article class="card hidden" data-index="0"><div class="card-content"><h3>Super Mario Bros (1985)</h3><p>Le jeu culte qui a lancé la saga sur NES.</p><img class="hero-img" src="mario_bros.jpg" alt="Super Mario Bros" /></div></article>

      <!-- Super Mario Bros 2 (1988) -->
      <article class="card hidden" data-index="1"><div class="card-content"><h3>Super Mario Bros 2 (1988)</h3><p>Un épisode atypique avec des mécaniques différentes.</p><img class="hero-img" src="mario2.jpg" alt="Super Mario Bros 2" /></div></article>

      <!-- Super Mario Bros 3 (1988) -->
      <article class="card hidden" data-index="2"><div class="card-content"><h3>Super Mario Bros 3 (1988)</h3><p>Un des épisodes les plus célèbres avec la feuille de Tanooki.</p><img class="hero-img" src="mario3.jpg" alt="Super Mario Bros 3" /></div></article>

      <!-- Super Mario World (1990) -->
      <article class="card hidden" data-index="3"><div class="card-content"><h3>Super Mario World (1990)</h3><p>Introduction de Yoshi et exploration du monde de Dinosaur Land.</p><img class="hero-img" src="mario_world.jpg" alt="Super Mario World" /></div></article>

      <!-- Super Mario 64 (1996) -->
      <article class="card hidden" data-index="4"><div class="card-content"><h3>Super Mario 64 (1996)</h3><p>Premier Mario en 3D, révolution du genre.</p><img class="hero-img" src="mario64.jpg" alt="Super Mario 64" /></div></article>

      <!-- Super Mario Sunshine (2002) -->
      <article class="card hidden" data-index="5"><div class="card-content"><h3>Super Mario Sunshine (2002)</h3><p>Mario nettoie l’île Delfino avec son jet FLUDD.</p><img class="hero-img" src="mario_sunshine.jpg" alt="Super Mario Sunshine" /></div></article>

      <!-- Super Mario Galaxy (2007) -->
      <article class="card hidden" data-index="6"><div class="card-content"><h3>Super Mario Galaxy (2007)</h3><p>Mario explore l’espace avec une gravité innovante.</p><img class="hero-img" src="mario_galaxy.jpg" alt="Super Mario Galaxy" /></div></article>

      <!-- Super Mario Galaxy 2 (2010) -->
      <article class="card hidden" data-index="7"><div class="card-content"><h3>Super Mario Galaxy 2 (2010)</h3><p>Suite directe avec encore plus de planètes et Yoshi jouable.</p><img class="hero-img" src="mario_galaxy2.jpg" alt="Super Mario Galaxy 2" /></div></article>

      <!-- Super Mario 3D Land (2011) -->
      <article class="card hidden" data-index="8"><div class="card-content"><h3>Super Mario 3D Land (2011)</h3><p>Un Mario portable en 3D sur Nintendo 3DS.</p><img class="hero-img" src="mario_3dland.jpg" alt="Super Mario 3D Land" /></div></article>

      <!-- Super Mario 3D World (2013) -->
      <article class="card hidden" data-index="9"><div class="card-content"><h3>Super Mario 3D World (2013)</h3><p>Mario et ses amis explorent des niveaux en 3D coopératifs.</p><img class="hero-img" src="mario_3dworld.jpg" alt="Super Mario 3D World" /></div></article>

      <!-- Super Mario Odyssey (2017) -->
      <article class="card hidden" data-index="10"><div class="card-content"><h3>Super Mario Odyssey (2017)</h3><p>Mario voyage à travers des royaumes variés avec Cappy.</p><img class="hero-img" src="mario_odyssey.jpg" alt="Super Mario Odyssey" /></div></article>

      <!-- Super Mario Bros Wonder (2023) -->
      <article class="card hidden" data-index="11"><div class="card-content"><h3 class="card-title">Super Mario Bros Wonder (2023)</h3><p>Dernier épisode 2D avec les fleurs prodiges qui transforment les niveaux.</p><img class="hero-img" src="mario_wonder.jpg" alt="Super Mario Bros Wonder" /></div></article>
    </section>

    <div class="controls" style="margin-top:0.8rem">
      <button id="resetCards" class="btn ghost" title="Réinitialiser l'affichage des cartes">Réinitialiser</button>
      <button id="revealAll" class="btn" title="Afficher toutes les cartes">Afficher tout</button>
    </div>
  </main>

  <footer class="site-footer" role="contentinfo">
    <div class="container footer-inner">
      <div>© <span id="year"></span> Ton site — Mario Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
