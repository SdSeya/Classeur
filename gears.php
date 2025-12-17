<?php
/**
 * gears_of_war_series.php
 * Page séquentielle pour afficher les jeux de la saga Gears of War
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
  <meta name="description" content="Détails des jeux de la saga Gears of War." />
  <title>Classeur - Série : Gears of War</title>

  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">🔫</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de jeu</strong>
          <small class="site-sub">Gears of War</small>
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
        <h1 id="hero-title">Rapport sur la saga Gears of War</h1>
        <p class="lead">
          Plonge dans une saga de tir à la troisième personne brutale et intense,
          suivant Marcus Fenix et l’escouade Delta face à la menace des Locustes.
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
        <img class="hero-img" src="gears.jpg" alt="Illustration Gears of War" />
      </div>
    </section>

    <section class="grid progressive-cards"
             aria-label="Jeux Gears of War"
             id="cardsContainer"
             data-persist-key="gears-of-war-sequence">

      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

<!-- Gears of War (2006) -->
<article class="card hidden" data-index="1">
  <div class="card-content">
    <h3 class="card-title">Gears of War (2006)</h3>
    <p class="card-body">
      Premier affrontement contre les Locustes sur la planète Sera.
    </p>
    <img class="hero-img" src="gow1.jpg" alt="Gears of War 2006" />
  </div>
</article>

<!-- Gears of War 2 (2008) -->
<article class="card hidden" data-index="2">
  <div class="card-content">
    <h3 class="card-title">Gears of War 2 (2008)</h3>
    <p class="card-body">
      L’escouade Delta plonge au cœur du territoire ennemi pour sauver l’humanité.
    </p>
    <img class="hero-img" src="gow2.jpg" alt="Gears of War 2" />
  </div>
</article>

<!-- Gears of War 3 (2011) -->
<article class="card hidden" data-index="3">
  <div class="card-content">
    <h3 class="card-title">Gears of War 3 (2011)</h3>
    <p class="card-body">
      Conclusion de la trilogie originale face à une nouvelle menace.
    </p>
    <img class="hero-img" src="gow3.jpg" alt="Gears of War 3" />
  </div>
</article>

<!-- Gears of War: Judgment (2013) -->
<article class="card hidden" data-index="4">
  <div class="card-content">
    <h3 class="card-title">Gears of War: Judgment (2013)</h3>
    <p class="card-body">
      Spin-off centré sur le passé de Baird, avant les événements du premier jeu.
    </p>
    <img class="hero-img" src="gow_judgment.jpg" alt="Gears of War Judgment" />
  </div>
</article>

<!-- Gears of War 4 (2016) -->
<article class="card hidden" data-index="5">
  <div class="card-content">
    <h3 class="card-title">Gears of War 4 (2016)</h3>
    <p class="card-body">
      Nouvelle génération avec JD Fenix, fils de Marcus.
    </p>
    <img class="hero-img" src="gow4.jpg" alt="Gears of War 4" />
  </div>
</article>

<!-- Gears 5 (2019) -->
<article class="card hidden" data-index="6">
  <div class="card-content">
    <h3 class="card-title">Gears 5 (2019)</h3>
    <p class="card-body">
      Kait Diaz devient le personnage central dans une aventure plus ouverte.
    </p>
    <img class="hero-img" src="gears5.jpg" alt="Gears 5" />
  </div>
</article>

<!-- Gears Tactics (2020) -->
<article class="card hidden" data-index="7">
  <div class="card-content">
    <h3 class="card-title">Gears Tactics (2020)</h3>
    <p class="card-body">
      Spin-off tactique au tour par tour, se déroulant avant la saga principale.
    </p>
    <img class="hero-img" src="gears_tactics.jpg" alt="Gears Tactics" />
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
      <div>© <span id="year"></span> Ton site — Gears of War Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
