<?php
/**
 * metroid_series.php
 * Page séquentielle pour afficher les jeux de la saga Metroid
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
  <meta name="description" content="Détails des jeux de la saga Metroid." />
  <title>Classeur - Série : Metroid</title>

  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">🚀</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de jeu</strong>
          <small class="site-sub">Metroid</small>
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
        <h1 id="hero-title">Rapport sur la saga Metroid</h1>
        <p class="lead">
          Suivez les missions de Samus Aran, chasseuse de primes,
          à travers une saga mêlant exploration, solitude et science-fiction.
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
        <img class="hero-img" src="metroid.jpg" alt="Illustration Metroid" />
      </div>
    </section>

    <section class="grid progressive-cards"
             aria-label="Jeux Metroid"
             id="cardsContainer"
             data-persist-key="metroid-sequence">

      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

<!-- Metroid (1986) -->
<article class="card hidden" data-index="1">
  <div class="card-content">
    <h3 class="card-title">Metroid (1986)</h3>
    <p class="card-body">
      Samus Aran infiltre la planète Zebes pour éliminer les pirates de l’espace.
    </p>
    <img class="hero-img" src="metroid_1986.jpg" alt="Metroid 1986" />
  </div>
</article>

<!-- Metroid II (1991) -->
<article class="card hidden" data-index="2">
  <div class="card-content">
    <h3 class="card-title">Metroid II: Return of Samus (1991)</h3>
    <p class="card-body">
      Mission d’éradication des Metroids sur la planète SR388.
    </p>
    <img class="hero-img" src="metroid2.jpg" alt="Metroid II Return of Samus" />
  </div>
</article>

<!-- Super Metroid (1994) -->
<article class="card hidden" data-index="3">
  <div class="card-content">
    <h3 class="card-title">Super Metroid (1994)</h3>
    <p class="card-body">
      Considéré comme un pilier du genre Metroidvania,
      avec une exploration libre et immersive.
    </p>
    <img class="hero-img" src="super_metroid.jpg" alt="Super Metroid" />
  </div>
</article>

<!-- Metroid Fusion (2002) -->
<article class="card hidden" data-index="4">
  <div class="card-content">
    <h3 class="card-title">Metroid Fusion (2002)</h3>
    <p class="card-body">
      Samus affronte le parasite X et une version sombre d’elle-même.
    </p>
    <img class="hero-img" src="metroid_fusion.jpg" alt="Metroid Fusion" />
  </div>
</article>

<!-- Metroid Zero Mission (2004) -->
<article class="card hidden" data-index="5">
  <div class="card-content">
    <h3 class="card-title">Metroid Zero Mission (2004)</h3>
    <p class="card-body">
      Remake du premier Metroid avec un gameplay modernisé.
    </p>
    <img class="hero-img" src="metroid_zero_mission.jpg" alt="Metroid Zero Mission" />
  </div>
</article>

<!-- Metroid Prime (2002) -->
<article class="card hidden" data-index="6">
  <div class="card-content">
    <h3 class="card-title">Metroid Prime (2002)</h3>
    <p class="card-body">
      Passage réussi à la vue à la première personne,
      mêlant action et exploration.
    </p>
    <img class="hero-img" src="metroid_prime.jpg" alt="Metroid Prime" />
  </div>
</article>

<!-- Metroid Prime 2 (2004) -->
<article class="card hidden" data-index="7">
  <div class="card-content">
    <h3 class="card-title">Metroid Prime 2: Echoes (2004)</h3>
    <p class="card-body">
      Samus explore une planète divisée entre lumière et ténèbres.
    </p>
    <img class="hero-img" src="metroid_prime2.jpg" alt="Metroid Prime 2 Echoes" />
  </div>
</article>

<!-- Metroid Prime 3 (2007) -->
<article class="card hidden" data-index="8">
  <div class="card-content">
    <h3 class="card-title">Metroid Prime 3: Corruption (2007)</h3>
    <p class="card-body">
      Conclusion épique de la trilogie Prime sur Wii.
    </p>
    <img class="hero-img" src="metroid_prime3.jpg" alt="Metroid Prime 3 Corruption" />
  </div>
</article>

<!-- Metroid Dread (2021) -->
<article class="card hidden" data-index="9">
  <div class="card-content">
    <h3 class="card-title">Metroid Dread (2021)</h3>
    <p class="card-body">
      Retour à la 2D avec une ambiance oppressante
      et les redoutables robots E.M.M.I.
    </p>
    <img class="hero-img" src="metroid_dread.jpg" alt="Metroid Dread" />
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
      <div>© <span id="year"></span> Ton site — Metroid Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
