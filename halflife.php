<?php
/**
 * half_life_series.php
 * Page séquentielle pour afficher la saga Half-Life
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
  <meta name="description" content="Détails des jeux Half-Life." />
  <title>Classeur - Série : Half-Life</title>
  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">🔬</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de jeu</strong>
          <small class="site-sub">Half-Life</small>
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
        <h1 id="hero-title">Saga Half-Life</h1>
        <p class="lead">
          Tous les jeux et extensions de la saga Half-Life, du premier opus à Half-Life: Alyx.
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
        <img class="hero-img" src="halflife.jpg" alt="Illustration Half-Life" />
      </div>
    </section>

    <section class="grid progressive-cards"
             aria-label="Jeux Half-Life"
             id="cardsContainer"
             data-persist-key="halflife-sequence">

      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

<!-- Half-Life (1998) -->
<article class="card hidden" data-index="1">
  <div class="card-content">
    <h3 class="card-title">Half-Life (1998)</h3>
    <p class="card-body">
      FPS révolutionnaire suivant Gordon Freeman dans le complexe de Black Mesa.
    </p>
    <img class="hero-img" src="hl_1998.jpg" alt="Half-Life 1998" />
  </div>
</article>

<!-- Opposing Force (1999) -->
<article class="card hidden" data-index="2">
  <div class="card-content">
    <h3 class="card-title">Half-Life: Opposing Force (1999)</h3>
    <p class="card-body">
      Extension où l’on incarne le soldat Adrian Shephard dans Black Mesa.
    </p>
    <img class="hero-img" src="hl_of.jpg" alt="Half-Life Opposing Force" />
  </div>
</article>

<!-- Blue Shift (2001) -->
<article class="card hidden" data-index="3">
  <div class="card-content">
    <h3 class="card-title">Half-Life: Blue Shift (2001)</h3>
    <p class="card-body">
      Extension centrée sur Barney Calhoun et la fuite de Black Mesa.
    </p>
    <img class="hero-img" src="hl_bs.jpg" alt="Half-Life Blue Shift" />
  </div>
</article>

<!-- Decay (2001) -->
<article class="card hidden" data-index="4">
  <div class="card-content">
    <h3 class="card-title">Half-Life: Decay (2001)</h3>
    <p class="card-body">
      Extension coop pour PS2, jouable à deux, centrée sur Black Mesa.
    </p>
    <img class="hero-img" src="hl_decay.jpg" alt="Half-Life Decay" />
  </div>
</article>

<!-- Half-Life 2 (2004) -->
<article class="card hidden" data-index="5">
  <div class="card-content">
    <h3 class="card-title">Half-Life 2 (2004)</h3>
    <p class="card-body">
      Suite acclamée, introduisant le moteur Source et la lutte contre le Cartel.
    </p>
    <img class="hero-img" src="hl2.jpg" alt="Half-Life 2" />
  </div>
</article>

<!-- Episode One (2006) -->
<article class="card hidden" data-index="6">
  <div class="card-content">
    <h3 class="card-title">Half-Life 2: Episode One (2006)</h3>
    <p class="card-body">
      Premier épisode de la trilogie annoncée après Half-Life 2.
    </p>
    <img class="hero-img" src="hl2_ep1.jpg" alt="Half-Life 2 Episode One" />
  </div>
</article>

<!-- Episode Two (2007) -->
<article class="card hidden" data-index="7">
  <div class="card-content">
    <h3 class="card-title">Half-Life 2: Episode Two (2007)</h3>
    <p class="card-body">
      Deuxième épisode, poursuivant l’histoire de Gordon Freeman.
    </p>
    <img class="hero-img" src="hl2_ep2.jpg" alt="Half-Life 2 Episode Two" />
  </div>
</article>

<!-- Half-Life: Alyx (2020) -->
<article class="card hidden" data-index="8">
  <div class="card-content">
    <h3 class="card-title">Half-Life: Alyx (2020)</h3>
    <p class="card-body">
      Préquelle de Half-Life 2 en réalité virtuelle, centrée sur Alyx Vance.
    </p>
    <img class="hero-img" src="hl_alyx.jpg" alt="Half-Life Alyx" />
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
      <div>© <span id="year"></span> Ton site — Half-Life Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
