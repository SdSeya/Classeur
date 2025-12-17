<?php
/**
 * bloodborne_series.php
 * Page séquentielle pour afficher la saga Bloodborne
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
  <meta name="description" content="Détails de la saga Bloodborne." />
  <title>Classeur - Série : Bloodborne</title>
  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">🩸</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de jeu</strong>
          <small class="site-sub">Bloodborne</small>
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
        <h1 id="hero-title">Rapport sur la saga Bloodborne</h1>
        <p class="lead">
          La saga Bloodborne, jeux d’action-RPG sombres et exigeants, développés par FromSoftware.
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
        <img class="hero-img" src="bloodborne.jpg" alt="Illustration Bloodborne" />
      </div>
    </section>

    <section class="grid progressive-cards"
             aria-label="Jeux Bloodborne"
             id="cardsContainer"
             data-persist-key="bloodborne-sequence">

      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

<!-- Bloodborne (2015) -->
<article class="card hidden" data-index="1">
  <div class="card-content">
    <h3 class="card-title">Bloodborne (2015)</h3>
    <p class="card-body">
      Action-RPG sur PS4, explorant Yharnam et ses créatures terrifiantes.
    </p>
    <img class="hero-img" src="bloodborne_2015.jpg" alt="Bloodborne 2015" />
  </div>
</article>

<!-- Bloodborne: The Old Hunters (2015, DLC) -->
<article class="card hidden" data-index="2">
  <div class="card-content">
    <h3 class="card-title">Bloodborne: The Old Hunters (DLC 2015)</h3>
    <p class="card-body">
      Extension ajoutant de nouvelles zones, boss et armes à l’univers de Bloodborne.
    </p>
    <img class="hero-img" src="bloodborne_oldhunters.jpg" alt="Bloodborne The Old Hunters" />
  </div>
</article>

<!-- Bloodborne Remastered / Collection -->
<article class="card hidden" data-index="3">
  <div class="card-content">
    <h3 class="card-title">Bloodborne: Complete Edition (Remaster, hypothétique)</h3>
    <p class="card-body">
      Collection regroupant le jeu et le DLC The Old Hunters avec graphismes améliorés.
    </p>
    <img class="hero-img" src="bloodborne_complete.jpg" alt="Bloodborne Complete Edition" />
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
      <div>© <span id="year"></span> Ton site — Bloodborne Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
