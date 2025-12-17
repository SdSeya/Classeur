<?php
/**
 * horizon_series.php
 * Page séquentielle pour afficher la saga Horizon
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
  <meta name="description" content="Détails des jeux de la saga Horizon." />
  <title>Classeur - Série : Horizon</title>

  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">🏹</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de jeu</strong>
          <small class="site-sub">Horizon</small>
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
        <h1 id="hero-title">Rapport sur la saga Horizon</h1>
        <p class="lead">
          Horizon est une saga d’action-RPG en monde ouvert
          mêlant technologie avancée et monde post-apocalyptique,
          où l’humanité cohabite avec des machines.
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
        <img class="hero-img" src="horizon.jpg" alt="Illustration Horizon" />
      </div>
    </section>

    <section class="grid progressive-cards"
             aria-label="Jeux Horizon"
             id="cardsContainer"
             data-persist-key="horizon-sequence">

      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

<!-- Horizon Zero Dawn (2017) -->
<article class="card hidden" data-index="1">
  <div class="card-content">
    <h3 class="card-title">Horizon Zero Dawn (2017)</h3>
    <p class="card-body">
      Aloy explore un monde dominé par des machines
      pour découvrir ses origines et sauver l’humanité.
    </p>
    <img class="hero-img" src="hzd_2017.jpg" alt="Horizon Zero Dawn" />
  </div>
</article>

<!-- The Frozen Wilds -->
<article class="card hidden" data-index="2">
  <div class="card-content">
    <h3 class="card-title">The Frozen Wilds</h3>
    <p class="card-body">
      Extension ajoutant une nouvelle région glacée,
      de nouvelles machines et un scénario inédit.
    </p>
    <img class="hero-img" src="hzd_frozen_wilds.jpg" alt="Horizon The Frozen Wilds" />
  </div>
</article>

<!-- Horizon Zero Dawn Complete Edition -->
<article class="card hidden" data-index="3">
  <div class="card-content">
    <h3 class="card-title">Horizon Zero Dawn – Complete Edition</h3>
    <p class="card-body">
      Version complète incluant le jeu de base
      et l’extension The Frozen Wilds.
    </p>
    <img class="hero-img" src="hzd_complete.jpg" alt="Horizon Zero Dawn Complete Edition" />
  </div>
</article>

<!-- Horizon Forbidden West (2022) -->
<article class="card hidden" data-index="4">
  <div class="card-content">
    <h3 class="card-title">Horizon Forbidden West (2022)</h3>
    <p class="card-body">
      Aloy part à l’ouest pour affronter de nouvelles menaces
      et explorer des terres inconnues.
    </p>
    <img class="hero-img" src="hfw_2022.jpg" alt="Horizon Forbidden West" />
  </div>
</article>

<!-- Burning Shores -->
<article class="card hidden" data-index="5">
  <div class="card-content">
    <h3 class="card-title">Burning Shores</h3>
    <p class="card-body">
      Extension narrative exclusive PS5,
      poursuivant l’histoire de Forbidden West.
    </p>
    <img class="hero-img" src="hfw_burning_shores.jpg" alt="Horizon Burning Shores" />
  </div>
</article>

<!-- Horizon Call of the Mountain -->
<article class="card hidden" data-index="6">
  <div class="card-content">
    <h3 class="card-title">Horizon Call of the Mountain</h3>
    <p class="card-body">
      Spin-off en réalité virtuelle se déroulant
      dans l’univers d’Horizon.
    </p>
    <img class="hero-img" src="horizon_vr.jpg" alt="Horizon Call of the Mountain" />
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
      <div>© <span id="year"></span> Ton site — Horizon Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
