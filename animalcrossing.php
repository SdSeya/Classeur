<?php
/**
 * animal_crossing_series.php
 * Page séquentielle pour afficher les jeux de la saga Animal Crossing
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
  <meta name="description" content="Détails des jeux de la saga Animal Crossing." />
  <title>Classeur - Série : Animal Crossing</title>

  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">🐾</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de jeu</strong>
          <small class="site-sub">Animal Crossing</small>
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
        <h1 id="hero-title">Rapport sur la saga Animal Crossing</h1>
        <p class="lead">
          Une série de simulation de vie paisible où tu aménages ton village
          (ou ton île), interagis avec des habitants animaux et vis au rythme
          des saisons.
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
        <img class="hero-img" src="animal_crossing.jpg" alt="Illustration Animal Crossing" />
      </div>
    </section>

    <section class="grid progressive-cards"
             aria-label="Jeux Animal Crossing"
             id="cardsContainer"
             data-persist-key="animal-crossing-sequence">

      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

<!-- Animal Crossing (2001) -->
<article class="card hidden" data-index="1">
  <div class="card-content">
    <h3 class="card-title">Animal Crossing (2001)</h3>
    <p class="card-body">
      Le joueur emménage dans un village peuplé d’animaux anthropomorphes
      et vit une vie paisible au fil des saisons.
    </p>
    <img class="hero-img" src="ac1.jpg" alt="Animal Crossing 2001" />
  </div>
</article>

<!-- Wild World (2005) -->
<article class="card hidden" data-index="2">
  <div class="card-content">
    <h3 class="card-title">Animal Crossing: Wild World (2005)</h3>
    <p class="card-body">
      Version portable introduisant le multijoueur en ligne
      et de nouvelles interactions sociales.
    </p>
    <img class="hero-img" src="acww.jpg" alt="Animal Crossing Wild World" />
  </div>
</article>

<!-- City Folk (2008) -->
<article class="card hidden" data-index="3">
  <div class="card-content">
    <h3 class="card-title">Animal Crossing: City Folk (2008)</h3>
    <p class="card-body">
      Ajout de la ville, proposant des boutiques et activités inédites
      en complément du village.
    </p>
    <img class="hero-img" src="accf.jpg" alt="Animal Crossing City Folk" />
  </div>
</article>

<!-- New Leaf (2012) -->
<article class="card hidden" data-index="4">
  <div class="card-content">
    <h3 class="card-title">Animal Crossing: New Leaf (2012)</h3>
    <p class="card-body">
      Le joueur devient maire et peut façonner son village
      grâce à des projets publics.
    </p>
    <img class="hero-img" src="acnl.jpg" alt="Animal Crossing New Leaf" />
  </div>
</article>

<!-- New Horizons (2020) -->
<article class="card hidden" data-index="5">
  <div class="card-content">
    <h3 class="card-title">Animal Crossing: New Horizons (2020)</h3>
    <p class="card-body">
      Sur une île déserte, le joueur crée un paradis personnalisé
      avec une liberté totale d’aménagement.
    </p>
    <img class="hero-img" src="acnh.jpg" alt="Animal Crossing New Horizons" />
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
      <div>© <span id="year"></span> Ton site — Animal Crossing Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
