<?php
/**
 * diablo_series.php
 * Page séquentielle pour afficher la saga Diablo
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
  <meta name="description" content="Détails des jeux Diablo." />
  <title>Classeur - Série : Diablo</title>
  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">🔥</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de jeu</strong>
          <small class="site-sub">Diablo</small>
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
        <h1 id="hero-title">Saga Diablo</h1>
        <p class="lead">
          Tous les jeux et extensions de la célèbre saga d’action-RPG de Blizzard.
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
        <img class="hero-img" src="diablo.jpg" alt="Illustration Diablo" />
      </div>
    </section>

    <section class="grid progressive-cards"
             aria-label="Jeux Diablo"
             id="cardsContainer"
             data-persist-key="diablo-sequence">

      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

<!-- Diablo (1996) -->
<article class="card hidden" data-index="1">
  <div class="card-content">
    <h3 class="card-title">Diablo (1996)</h3>
    <p class="card-body">
      Action-RPG original où le joueur combat les forces démoniaques de Tristram.
    </p>
    <img class="hero-img" src="diablo_1996.jpg" alt="Diablo 1996" />
  </div>
</article>

<!-- Diablo II (2000) -->
<article class="card hidden" data-index="2">
  <div class="card-content">
    <h3 class="card-title">Diablo II (2000)</h3>
    <p class="card-body">
      Suite culte avec classes variées, combats et exploration dans Sanctuaire.
    </p>
    <img class="hero-img" src="diablo2.jpg" alt="Diablo II" />
  </div>
</article>

<!-- Diablo II: Lord of Destruction (2001, DLC) -->
<article class="card hidden" data-index="3">
  <div class="card-content">
    <h3 class="card-title">Diablo II: Lord of Destruction (2001)</h3>
    <p class="card-body">
      Extension ajoutant les classes assassin et druide et de nouvelles zones.
    </p>
    <img class="hero-img" src="diablo2_lod.jpg" alt="Diablo II Lord of Destruction" />
  </div>
</article>

<!-- Diablo III (2012) -->
<article class="card hidden" data-index="4">
  <div class="card-content">
    <h3 class="card-title">Diablo III (2012)</h3>
    <p class="card-body">
      Action-RPG moderne avec classes et aventures dans Santuaire.
    </p>
    <img class="hero-img" src="diablo3.jpg" alt="Diablo III" />
  </div>
</article>

<!-- Diablo III: Reaper of Souls (2014, expansion) -->
<article class="card hidden" data-index="5">
  <div class="card-content">
    <h3 class="card-title">Diablo III: Reaper of Souls (2014)</h3>
    <p class="card-body">
      Extension ajoutant l’Acte V et la classe Crusader.
    </p>
    <img class="hero-img" src="diablo3_ros.jpg" alt="Diablo III Reaper of Souls" />
  </div>
</article>

<!-- Diablo IV (2023) -->
<article class="card hidden" data-index="6">
  <div class="card-content">
    <h3 class="card-title">Diablo IV (2023)</h3>
    <p class="card-body">
      Retour aux racines sombres, monde ouvert et classes classiques avec multijoueur.
    </p>
    <img class="hero-img" src="diablo4.jpg" alt="Diablo IV" />
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
      <div>© <span id="year"></span> Ton site — Diablo Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
