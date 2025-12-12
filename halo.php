<?php
/**
 * halo_series.php
 * Page séquentielle pour afficher les jeux de la saga Halo
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
    echo 'Missing config.php or db_config.php - crée le fichier config.php (voir exemple).';
    exit;
}

// Connexion PDO en utilisant la config
$dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8mb4', $config['db_host'], $config['db_name']);
try {
    $pdo = new PDO($dsn, $config['db_user'], $config['db_pass'], $config['pdo_options']);
} catch (PDOException $e) {
    http_response_code(500);
    echo 'Erreur de connexion à la base de données : ' . htmlspecialchars($e->getMessage(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    exit;
}

function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }

?><!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="Détails des jeux Halo : descriptions et navigation séquentielle entre cartes." />
  <title>Classeur - Série: Halo</title>
  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">🛡️</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de jeu</strong>
          <small class="site-sub">Halo</small>
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
        <h1 id="hero-title">Rapport sur la saga Halo</h1>
        <p class="lead">Ici se trouvent les détails sur tous les jeux principaux de la saga Halo. Clique sur "Continuer" pour afficher la première carte, puis navigue séquentiellement.</p>

        <p class="cta">
          <button class="btn primary" id="startBtn" aria-controls="cardsContainer" aria-expanded="false">Continuer</button>
          <a href="#" class="btn ghost" id="learnBtn">En savoir plus</a>
        </p>
      </div>

      <div class="hero-illustration" aria-hidden="false">
        <picture>
          <source srcset="halo.jpg" type="image/jpeg">
          <img class="hero-img" src="halo.jpg" alt="Illustration Halo" />
        </picture>
      </div>
    </section>

    <section class="grid progressive-cards" aria-label="Jeux Halo" id="cardsContainer" data-persist-key="halo-sequence">
      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

      <!-- Halo: Combat Evolved -->
      <article class="card hidden" data-index="0"><div class="card-content"><h3>Halo: Combat Evolved (2001)</h3><p>Le Major découvre l’anneau Halo et affronte le Covenant.</p><img class="hero-img" src="halo_ce.jpg" alt="Halo Combat Evolved" /></div></article>

      <!-- Halo 2 -->
      <article class="card hidden" data-index="1"><div class="card-content"><h3>Halo 2 (2004)</h3><p>Suite directe avec le combat contre le Covenant et l’Arbiter.</p><img class="hero-img" src="halo2.jpg" alt="Halo 2" /></div></article>

      <!-- Halo 3 -->
      <article class="card hidden" data-index="2"><div class="card-content"><h3>Halo 3 (2007)</h3><p>Conclusion de la trilogie originale, le Major affronte les Flood.</p><img class="hero-img" src="halo3.jpg" alt="Halo 3" /></div></article>

      <!-- Halo 3: ODST -->
      <article class="card hidden" data-index="3"><div class="card-content"><h3>Halo 3: ODST (2009)</h3><p>Une escouade ODST explore New Mombasa après l’invasion Covenant.</p><img class="hero-img" src="halo_odst.jpg" alt="Halo 3 ODST" /></div></article>

      <!-- Halo Wars -->
      <article class="card hidden" data-index="4"><div class="card-content"><h3>Halo Wars (2009)</h3><p>Jeu de stratégie en temps réel racontant la guerre contre le Covenant.</p><img class="hero-img" src="halo_wars.jpg" alt="Halo Wars" /></div></article>

      <!-- Halo Reach -->
      <article class="card hidden" data-index="5"><div class="card-content"><h3>Halo Reach (2010)</h3><p>Préquelle racontant la chute de la planète Reach et le sacrifice de la Noble Team.</p><img class="hero-img" src="halo_reach.jpg" alt="Halo Reach" /></div></article>

      <!-- Halo 4 -->
      <article class="card hidden" data-index="6"><div class="card-content"><h3>Halo 4 (2012)</h3><p>Le Major affronte les Prométhéens et découvre le Didacte.</p><img class="hero-img" src="halo4.jpg" alt="Halo 4" /></div></article>

      <!-- Halo 5: Guardians -->
      <article class="card hidden" data-index="7"><div class="card-content"><h3>Halo 5: Guardians (2015)</h3><p>Le Major est traqué par l’escouade Osiris, tandis que Cortana prend une nouvelle direction.</p><img class="hero-img" src="halo5.jpg" alt="Halo 5 Guardians" /></div></article>

      <!-- Halo Wars 2 -->
      <article class="card hidden" data-index="8"><div class="card-content"><h3>Halo Wars 2 (2017)</h3><p>Suite RTS où l’équipage du Spirit of Fire affronte les Parias.</p><img class="hero-img" src="halo_wars2.jpg" alt="Halo Wars 2" /></div></article>

      <!-- Halo Infinite -->
      <article class="card hidden" data-index="9"><div class="card-content"><h3>Halo Infinite (2021)</h3><p>Retour du Major dans un monde ouvert, affrontant les Parias sur Zeta Halo.</p><img class="hero-img" src="halo_infinite.jpg" alt="Halo Infinite" /></div></article>
    </section>

    <div class="controls" style="margin-top:0.8rem">
      <button id="resetCards" class="btn ghost">Réinitialiser</button>
      <button id="revealAll" class="btn">Afficher tout</button>
    </div>
  </main>

  <footer class="site-footer" role="contentinfo">
    <div class="container footer-inner">
      <div>© <span id="year"></span> Ton site — Halo Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
