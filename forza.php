<?php
/**
 * forza_horizon_series.php
 * Page séquentielle pour afficher les jeux de la saga Forza Horizon
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
$dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8mb4', $config['db_host'], $config['db_name']);
try {
    $pdo = new PDO($dsn, $config['db_user'], $config['db_pass'], $config['pdo_options']);
} catch (PDOException $e) {
    http_response_code(500);
    echo 'Erreur DB : ' . htmlspecialchars($e->getMessage(), ENT_QUOTES);
    exit;
}

function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="Détails des jeux de la saga Forza Horizon." />
  <title>Classeur - Série : Forza Horizon</title>

  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">🏎️</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de jeu</strong>
          <small class="site-sub">Forza Horizon</small>
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
        <h1 id="hero-title">Rapport sur la saga Forza Horizon</h1>
        <p class="lead">Explorez le monde ouvert automobile de Forza Horizon, entre festivals, liberté de conduite et voitures de rêve. Cliquez sur « Continuer » pour afficher les jeux un par un.</p>

        <p class="cta">
          <button class="btn primary" id="startBtn" aria-controls="cardsContainer" aria-expanded="false">Continuer</button>
          <a href="#" class="btn ghost" id="learnBtn">En savoir plus</a>
        </p>
      </div>

      <div class="hero-illustration">
        <img class="hero-img" src="forza.jpg" alt="Illustration Forza Horizon" />
      </div>
    </section>

    <section class="grid progressive-cards" aria-label="Jeux Forza Horizon" id="cardsContainer" data-persist-key="forza-horizon-sequence">
      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

<!-- Forza Horizon (2012) -->
<article class="card hidden" data-index="1">
  <div class="card-content">
    <h3 class="card-title">Forza Horizon (2012)</h3>
    <p class="card-body">Premier opus de la série, situé dans le Colorado, mêlant courses et festival automobile.</p>
    <img class="hero-img" src="fh1.jpg" alt="Forza Horizon 1" />
  </div>
</article>

<!-- Forza Horizon 2 (2014) -->
<article class="card hidden" data-index="2">
  <div class="card-content">
    <h3 class="card-title">Forza Horizon 2 (2014)</h3>
    <p class="card-body">Exploration du sud de l'Europe avec un monde ouvert plus vaste et dynamique.</p>
    <img class="hero-img" src="fh2.jpg" alt="Forza Horizon 2" />
  </div>
</article>

<!-- Forza Horizon 3 (2016) -->
<article class="card hidden" data-index="3">
  <div class="card-content">
    <h3 class="card-title">Forza Horizon 3 (2016)</h3>
    <p class="card-body">Direction l'Australie, avec une liberté totale et la possibilité d'organiser le festival.</p>
    <img class="hero-img" src="fh3.jpg" alt="Forza Horizon 3" />
  </div>
</article>

<!-- Forza Horizon 4 (2018) -->
<article class="card hidden" data-index="4">
  <div class="card-content">
    <h3 class="card-title">Forza Horizon 4 (2018)</h3>
    <p class="card-body">Situé au Royaume-Uni, introduit des saisons dynamiques affectant le gameplay.</p>
    <img class="hero-img" src="fh4.jpg" alt="Forza Horizon 4" />
  </div>
</article>

<!-- Forza Horizon 5 (2021) -->
<article class="card hidden" data-index="5">
  <div class="card-content">
    <h3 class="card-title">Forza Horizon 5 (2021)</h3>
    <p class="card-body">Le plus vaste opus, se déroulant au Mexique avec des environnements variés.</p>
    <img class="hero-img" src="fh5.jpg" alt="Forza Horizon 5" />
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
      <div>© <span id="year"></span> Ton site — Forza Horizon Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
```
