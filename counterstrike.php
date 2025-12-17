<?php
/**
 * counterstrike_series.php
 * Page séquentielle pour afficher la saga Counter-Strike
 */

declare(strict_types=1);

// Charger la configuration
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
  <meta name="description" content="Détails des jeux Counter-Strike." />
  <title>Classeur - Série : Counter-Strike</title>
  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">🎯</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de jeu</strong>
          <small class="site-sub">Counter-Strike</small>
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
        <h1 id="hero-title">Saga Counter-Strike</h1>
        <p class="lead">
          Tous les jeux et versions majeures de Counter-Strike, du mod original aux versions modernes.
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
        <img class="hero-img" src="counterstrike.jpg" alt="Illustration Counter-Strike" />
      </div>
    </section>

    <section class="grid progressive-cards"
             aria-label="Jeux Counter-Strike"
             id="cardsContainer"
             data-persist-key="counterstrike-sequence">

      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

<!-- Counter-Strike (1999) -->
<article class="card hidden" data-index="1">
  <div class="card-content">
    <h3 class="card-title">Counter-Strike (1999)</h3>
    <p class="card-body">
      Mod Half-Life original qui a lancé la saga Counter-Strike.
    </p>
    <img class="hero-img" src="cs_1999.jpg" alt="Counter-Strike 1999" />
  </div>
</article>

<!-- CS 1.6 -->
<article class="card hidden" data-index="2">
  <div class="card-content">
    <h3 class="card-title">Counter-Strike 1.6 (2003)</h3>
    <p class="card-body">
      Version officielle très populaire sur PC, compétitive et e-sportive.
    </p>
    <img class="hero-img" src="cs16.jpg" alt="Counter-Strike 1.6" />
  </div>
</article>

<!-- CS: Condition Zero -->
<article class="card hidden" data-index="3">
  <div class="card-content">
    <h3 class="card-title">Counter-Strike: Condition Zero (2004)</h3>
    <p class="card-body">
      Campagne solo et missions supplémentaires, sur le moteur Half-Life.
    </p>
    <img class="hero-img" src="cs_cz.jpg" alt="Counter-Strike Condition Zero" />
  </div>
</article>

<!-- CS: Source -->
<article class="card hidden" data-index="4">
  <div class="card-content">
    <h3 class="card-title">Counter-Strike: Source (2004)</h3>
    <p class="card-body">
      Version remastérisée sur le moteur Source, graphiques améliorés.
    </p>
    <img class="hero-img" src="cs_source.jpg" alt="Counter-Strike Source" />
  </div>
</article>

<!-- CS: Global Offensive -->
<article class="card hidden" data-index="5">
  <div class="card-content">
    <h3 class="card-title">Counter-Strike: Global Offensive (2012)</h3>
    <p class="card-body">
      MOBA FPS moderne, compétitif avec mises à jour régulières et skins.
    </p>
    <img class="hero-img" src="cs_go.jpg" alt="CS:GO" />
  </div>
</article>

<!-- Counter-Strike 2 -->
<article class="card hidden" data-index="6">
  <div class="card-content">
    <h3 class="card-title">Counter-Strike 2 (2023)</h3>
    <p class="card-body">
      Remake / mise à jour de CS:GO avec moteur Source 2 et graphismes améliorés.
    </p>
    <img class="hero-img" src="cs2.jpg" alt="Counter-Strike 2" />
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
      <div>© <span id="year"></span> Ton site — Counter-Strike Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
