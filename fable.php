<?php
/**
 * fable_series.php
 * Page séquentielle pour afficher la saga Fable
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
  <meta name="description" content="Détails des jeux de la saga Fable." />
  <title>Classeur - Série : Fable</title>

  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">🗡️</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de jeu</strong>
          <small class="site-sub">Fable</small>
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
        <h1 id="hero-title">Rapport sur la saga Fable</h1>
        <p class="lead">
          Fable est une saga de RPG où les choix moraux du joueur influencent
          le monde, l’histoire et l’apparence du héros.
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
        <img class="hero-img" src="fable.jpg" alt="Illustration Fable" />
      </div>
    </section>

    <section class="grid progressive-cards"
             aria-label="Jeux Fable"
             id="cardsContainer"
             data-persist-key="fable-sequence">

      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

<!-- Fable (2004) -->
<article class="card hidden" data-index="1">
  <div class="card-content">
    <h3 class="card-title">Fable (2004)</h3>
    <p class="card-body">
      Le joueur incarne un jeune héros dont les choix façonnent Albion.
    </p>
    <img class="hero-img" src="fable_2004.jpg" alt="Fable 2004" />
  </div>
</article>

<!-- Fable: The Lost Chapters (2005) -->
<article class="card hidden" data-index="2">
  <div class="card-content">
    <h3 class="card-title">Fable: The Lost Chapters (2005)</h3>
    <p class="card-body">
      Version enrichie avec une nouvelle fin et des zones inédites.
    </p>
    <img class="hero-img" src="fable_tlc.jpg" alt="Fable The Lost Chapters" />
  </div>
</article>

<!-- Fable II (2008) -->
<article class="card hidden" data-index="3">
  <div class="card-content">
    <h3 class="card-title">Fable II (2008)</h3>
    <p class="card-body">
      Albion évolue technologiquement et les décisions du héros
      ont encore plus d’impact.
    </p>
    <img class="hero-img" src="fable_2.jpg" alt="Fable II" />
  </div>
</article>

<!-- Fable III (2010) -->
<article class="card hidden" data-index="4">
  <div class="card-content">
    <h3 class="card-title">Fable III (2010)</h3>
    <p class="card-body">
      Le héros devient roi et doit faire des choix politiques cruciaux
      pour sauver le royaume.
    </p>
    <img class="hero-img" src="fable_3.jpg" alt="Fable III" />
  </div>
</article>

<!-- Fable Anniversary (2014) -->
<article class="card hidden" data-index="5">
  <div class="card-content">
    <h3 class="card-title">Fable Anniversary (2014)</h3>
    <p class="card-body">
      Remake HD du premier Fable avec graphismes améliorés.
    </p>
    <img class="hero-img" src="fable_anniversary.jpg" alt="Fable Anniversary" />
  </div>
</article>

<!-- Fable (Reboot à venir) -->
<article class="card hidden" data-index="6">
  <div class="card-content">
    <h3 class="card-title">Fable (Reboot)</h3>
    <p class="card-body">
      Reboot de la saga développé par Playground Games,
      revisitant l’univers d’Albion.
    </p>
    <img class="hero-img" src="fable_reboot.jpg" alt="Fable Reboot" />
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
      <div>© <span id="year"></span> Ton site — Fable Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
