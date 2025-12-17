<?php
/**
 * sea_of_thieves_series.php
 * Page séquentielle pour afficher Sea of Thieves
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
    echo 'Missing config.php or db_config.php.';
    exit;
}

// Connexion PDO
$dsn = sprintf(
    'mysql:host=%s;dbname=%s;charset=utf8mb4',
    $config['db_host'],
    $config['db_name']
);

try {
    $pdo = new PDO(
        $dsn,
        $config['db_user'],
        $config['db_pass'],
        $config['pdo_options']
    );
} catch (PDOException $e) {
    http_response_code(500);
    echo 'Erreur DB : ' . htmlspecialchars($e->getMessage(), ENT_QUOTES);
    exit;
}

function h($s) {
    return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="Détails du jeu Sea of Thieves et de ses grandes mises à jour." />
  <title>Classeur - Série : Sea of Thieves</title>

  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">🏴‍☠️</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de jeu</strong>
          <small class="site-sub">Sea of Thieves</small>
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
        <h1 id="hero-title">Rapport sur Sea of Thieves</h1>
        <p class="lead">
          Une aventure multijoueur en monde ouvert où les joueurs incarnent
          des pirates, explorent les mers, cherchent des trésors et vivent
          leurs propres légendes.
        </p>

        <p class="cta">
          <button class="btn primary" id="startBtn"
                  aria-controls="cardsContainer"
                  aria-expanded="false">
            Continuer
          </button>
          <a href="#" class="btn ghost" id="learnBtn">En savoir plus</a>
        </p>
      </div>

      <div class="hero-illustration">
        <img class="hero-img" src="sea_of_thieves.jpg" alt="Illustration Sea of Thieves" />
      </div>
    </section>

    <section class="grid progressive-cards"
             aria-label="Sea of Thieves"
             id="cardsContainer"
             data-persist-key="sea-of-thieves-sequence">

      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

<!-- Sea of Thieves (2018) -->
<article class="card hidden" data-index="1">
  <div class="card-content">
    <h3 class="card-title">Sea of Thieves (2018)</h3>
    <p class="card-body">
      Lancement du jeu avec exploration libre, coopération entre pirates
      et batailles navales dynamiques.
    </p>
    <img class="hero-img" src="sot_2018.jpg" alt="Sea of Thieves 2018" />
  </div>
</article>

<!-- The Hungering Deep -->
<article class="card hidden" data-index="2">
  <div class="card-content">
    <h3 class="card-title">The Hungering Deep</h3>
    <p class="card-body">
      Première grande mise à jour introduisant un mégalodon
      et des événements mondiaux coopératifs.
    </p>
    <img class="hero-img" src="sot_hungering_deep.jpg" alt="The Hungering Deep Sea of Thieves" />
  </div>
</article>

<!-- Cursed Sails -->
<article class="card hidden" data-index="3">
  <div class="card-content">
    <h3 class="card-title">Cursed Sails</h3>
    <p class="card-body">
      Ajout de navires squelettes hostiles et d’un scénario évolutif.
    </p>
    <img class="hero-img" src="sot_cursed_sails.jpg" alt="Cursed Sails Sea of Thieves" />
  </div>
</article>

<!-- Forsaken Shores -->
<article class="card hidden" data-index="4">
  <div class="card-content">
    <h3 class="card-title">Forsaken Shores</h3>
    <p class="card-body">
      Introduction du Devil’s Roar, une zone volcanique dangereuse.
    </p>
    <img class="hero-img" src="sot_forsaken_shores.jpg" alt="Forsaken Shores Sea of Thieves" />
  </div>
</article>

<!-- Tall Tales -->
<article class="card hidden" data-index="5">
  <div class="card-content">
    <h3 class="card-title">Tall Tales</h3>
    <p class="card-body">
      Quêtes scénarisées apportant une forte dimension narrative.
    </p>
    <img class="hero-img" src="sot_tall_tales.jpg" alt="Tall Tales Sea of Thieves" />
  </div>
</article>

<!-- A Pirate's Life -->
<article class="card hidden" data-index="6">
  <div class="card-content">
    <h3 class="card-title">A Pirate’s Life</h3>
    <p class="card-body">
      Crossover avec Pirates des Caraïbes,
      introduisant Jack Sparrow et de nouvelles aventures.
    </p>
    <img class="hero-img" src="sot_pirates_life.jpg" alt="A Pirate's Life Sea of Thieves" />
  </div>
</article>

<!-- Seasons -->
<article class="card hidden" data-index="7">
  <div class="card-content">
    <h3 class="card-title">Saisons</h3>
    <p class="card-body">
      Système de saisons apportant progression, récompenses
      et défis réguliers.
    </p>
    <img class="hero-img" src="sot_seasons.jpg" alt="Sea of Thieves Seasons" />
  </div>
</article>

    </section>

    <div class="controls" style="margin-top:0.8rem">
      <button id="resetCards" class="btn ghost">Réinitialiser</button>
      <button id="revealAll" class="btn">Afficher tout</button>
    </div>
  </main>

  <footer class="site-footer" role="contentinfo">
    <div class="container footer-inner">
      <div>© <span id="year"></span> Ton site — Sea of Thieves Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
