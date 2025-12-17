<?php
/**
 * league_series.php
 * Page séquentielle pour afficher les jeux League of Legends et spin-offs
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
  <meta name="description" content="Détails des jeux League of Legends et spin-offs." />
  <title>Classeur - Série : League of Legends</title>
  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">🌀</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de jeu</strong>
          <small class="site-sub">League of Legends</small>
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
        <h1 id="hero-title">Saga League of Legends</h1>
        <p class="lead">
          Tous les jeux et spin-offs de l’univers League of Legends, du MOBA principal aux jeux dérivés.
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
        <img class="hero-img" src="league.jpg" alt="Illustration League of Legends" />
      </div>
    </section>

    <section class="grid progressive-cards"
             aria-label="Jeux League of Legends"
             id="cardsContainer"
             data-persist-key="league-sequence">

      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

<!-- League of Legends -->
<article class="card hidden" data-index="1">
  <div class="card-content">
    <h3 class="card-title">League of Legends (2009)</h3>
    <p class="card-body">
      MOBA sur PC qui a lancé l’univers Runeterra, avec champions, skins et compétition e-sport.
    </p>
    <img class="hero-img" src="lol_2009.jpg" alt="League of Legends 2009" />
  </div>
</article>

<!-- Teamfight Tactics -->
<article class="card hidden" data-index="2">
  <div class="card-content">
    <h3 class="card-title">Teamfight Tactics (2019)</h3>
    <p class="card-body">
      Auto-battler dans l’univers LoL, disponible sur PC et mobile.
    </p>
    <img class="hero-img" src="tft.jpg" alt="Teamfight Tactics" />
  </div>
</article>

<!-- Legends of Runeterra -->
<article class="card hidden" data-index="3">
  <div class="card-content">
    <h3 class="card-title">Legends of Runeterra (2020)</h3>
    <p class="card-body">
      Jeu de cartes stratégique basé sur les champions de Runeterra.
    </p>
    <img class="hero-img" src="lor.jpg" alt="Legends of Runeterra" />
  </div>
</article>

<!-- League of Legends: Wild Rift -->
<article class="card hidden" data-index="4">
  <div class="card-content">
    <h3 class="card-title">League of Legends: Wild Rift (2020)</h3>
    <p class="card-body">
      Version mobile/console du MOBA, optimisée pour des parties rapides.
    </p>
    <img class="hero-img" src="wild_rift.jpg" alt="League of Legends Wild Rift" />
  </div>
</article>

<!-- Ruined King -->
<article class="card hidden" data-index="5">
  <div class="card-content">
    <h3 class="card-title">Ruined King: A League of Legends Story (2021)</h3>
    <p class="card-body">
      RPG solo narratif centré sur les personnages de Bilgewater.
    </p>
    <img class="hero-img" src="ruined_king.jpg" alt="Ruined King" />
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
      <div>© <span id="year"></span> Ton site — League of Legends Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
