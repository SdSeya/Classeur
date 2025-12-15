<?php
/**
 * god_of_war_series.php
 * Page séquentielle pour afficher les jeux de la saga God of War
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
  <meta name="description" content="Détails des jeux de la saga God of War." />
  <title>Classeur - Série : God of War</title>

  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">⚔️</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de jeu</strong>
          <small class="site-sub">God of War</small>
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
        <h1 id="hero-title">Rapport sur la saga God of War</h1>
        <p class="lead">Découvrez l'histoire de Kratos à travers les différents jeux de la saga. Cliquez sur « Continuer » pour afficher les cartes une par une.</p>

        <p class="cta">
          <button class="btn primary" id="startBtn" aria-controls="cardsContainer" aria-expanded="false">Continuer</button>
          <a href="#" class="btn ghost" id="learnBtn">En savoir plus</a>
        </p>
      </div>

      <div class="hero-illustration">
        <img class="hero-img" src="gow.jpg" alt="Illustration God of War" />
      </div>
    </section>

    <section class="grid progressive-cards" aria-label="Jeux God of War" id="cardsContainer" data-persist-key="gow-sequence">
      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

<!-- God of War (2005) -->
<article class="card hidden" data-index="1">
  <div class="card-content">
    <h3 class="card-title">God of War (2005)</h3>
    <p class="card-body">Kratos, guerrier spartiate, jure vengeance aux dieux de l'Olympe.</p>
    <img class="hero-img" src="gow_2005.jpg" alt="God of War 2005" />
  </div>
</article>

<!-- God of War II (2007) -->
<article class="card hidden" data-index="2">
  <div class="card-content">
    <h3 class="card-title">God of War II (2007)</h3>
    <p class="card-body">Kratos affronte Zeus et tente de changer son destin.</p>
    <img class="hero-img" src="gow_2.jpg" alt="God of War II" />
  </div>
</article>

<!-- God of War III (2010) -->
<article class="card hidden" data-index="3">
  <div class="card-content">
    <h3 class="card-title">God of War III (2010)</h3>
    <p class="card-body">L'affrontement final de Kratos contre les dieux de l'Olympe.</p>
    <img class="hero-img" src="gow_3.jpg" alt="God of War III" />
  </div>
</article>

<!-- God of War: Chains of Olympus (2008) -->
<article class="card hidden" data-index="4">
  <div class="card-content">
    <h3 class="card-title">Chains of Olympus (2008)</h3>
    <p class="card-body">Préquelle racontant une mission de Kratos au service des dieux.</p>
    <img class="hero-img" src="gow_coo.jpg" alt="Chains of Olympus" />
  </div>
</article>

<!-- God of War: Ghost of Sparta (2010) -->
<article class="card hidden" data-index="5">
  <div class="card-content">
    <h3 class="card-title">Ghost of Sparta (2010)</h3>
    <p class="card-body">Kratos affronte son passé et découvre la vérité sur son frère.</p>
    <img class="hero-img" src="gow_gos.jpg" alt="Ghost of Sparta" />
  </div>
</article>

<!-- God of War (2018) -->
<article class="card hidden" data-index="6">
  <div class="card-content">
    <h3 class="card-title">God of War (2018)</h3>
    <p class="card-body">Kratos vit désormais dans la mythologie nordique avec son fils Atreus.</p>
    <img class="hero-img" src="gow_2018.jpg" alt="God of War 2018" />
  </div>
</article>

<!-- God of War Ragnarök (2022) -->
<article class="card hidden" data-index="7">
  <div class="card-content">
    <h3 class="card-title">God of War Ragnarök (2022)</h3>
    <p class="card-body">Kratos et Atreus affrontent les dieux nordiques lors du Ragnarök.</p>
    <img class="hero-img" src="gow_ragnarok.jpg" alt="God of War Ragnarok" />
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
      <div>© <span id="year"></span> Ton site — God of War Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
```
