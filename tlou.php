<?php
/**
 * the_last_of_us_series.php
 * Page séquentielle pour afficher la saga The Last of Us
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
  <meta name="description" content="Détails des jeux de la saga The Last of Us." />
  <title>Classeur - Série : The Last of Us</title>

  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">🧟</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de jeu</strong>
          <small class="site-sub">The Last of Us</small>
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
        <h1 id="hero-title">Rapport sur la saga The Last of Us</h1>
        <p class="lead">
          The Last of Us est une saga narrative post-apocalyptique
          centrée sur la survie, les relations humaines
          et les choix moraux.
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
        <img class="hero-img" src="the_last_of_us.jpg" alt="Illustration The Last of Us" />
      </div>
    </section>

    <section class="grid progressive-cards"
             aria-label="Jeux The Last of Us"
             id="cardsContainer"
             data-persist-key="the-last-of-us-sequence">

      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

<!-- The Last of Us (2013) -->
<article class="card hidden" data-index="1">
  <div class="card-content">
    <h3 class="card-title">The Last of Us (2013)</h3>
    <p class="card-body">
      Joel escorte Ellie à travers les États-Unis ravagés
      par une pandémie fongique.
    </p>
    <img class="hero-img" src="tlou_2013.jpg" alt="The Last of Us 2013" />
  </div>
</article>

<!-- The Last of Us Remastered (2014) -->
<article class="card hidden" data-index="2">
  <div class="card-content">
    <h3 class="card-title">The Last of Us Remastered (2014)</h3>
    <p class="card-body">
      Version améliorée sur PS4 avec graphismes affinés
      et performances optimisées.
    </p>
    <img class="hero-img" src="tlou_remastered.jpg" alt="The Last of Us Remastered" />
  </div>
</article>

<!-- Left Behind -->
<article class="card hidden" data-index="3">
  <div class="card-content">
    <h3 class="card-title">Left Behind</h3>
    <p class="card-body">
      DLC narratif centré sur Ellie et les événements
      précédant le jeu principal.
    </p>
    <img class="hero-img" src="tlou_left_behind.jpg" alt="The Last of Us Left Behind" />
  </div>
</article>

<!-- The Last of Us Part II (2020) -->
<article class="card hidden" data-index="4">
  <div class="card-content">
    <h3 class="card-title">The Last of Us Part II (2020)</h3>
    <p class="card-body">
      Ellie affronte les conséquences de la vengeance
      dans un monde encore plus brutal.
    </p>
    <img class="hero-img" src="tlou_part2.jpg" alt="The Last of Us Part II" />
  </div>
</article>

<!-- The Last of Us Part I (2022) -->
<article class="card hidden" data-index="5">
  <div class="card-content">
    <h3 class="card-title">The Last of Us Part I (2022)</h3>
    <p class="card-body">
      Remake complet sur PS5 avec graphismes modernes
      et IA améliorée.
    </p>
    <img class="hero-img" src="tlou_part1.jpg" alt="The Last of Us Part I" />
  </div>
</article>

<!-- The Last of Us Part II Remastered (2024) -->
<article class="card hidden" data-index="6">
  <div class="card-content">
    <h3 class="card-title">The Last of Us Part II Remastered (2024)</h3>
    <p class="card-body">
      Version remasterisée sur PS5 avec nouveaux modes
      et améliorations techniques.
    </p>
    <img class="hero-img" src="tlou_part2_remastered.jpg" alt="The Last of Us Part II Remastered" />
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
      <div>© <span id="year"></span> Ton site — The Last of Us Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
