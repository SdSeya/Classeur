<?php
/**
 * movies_list.php
 * Version : corrections pour s'assurer que les boutons fonctionnent (type="button" + IDs stables)
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

$tokenFilter = isset($_GET['token']) ? trim($_GET['token']) : '';

try {
    // Liste des films
    $stmt = $pdo->query("
        SELECT m.id, m.slug, m.title, m.description
        FROM movies m
        ORDER BY m.id
    ");
    $movies = $stmt->fetchAll();

    // Charge tous les reveals (on les exposera côté client groupés par movie_id)
    if ($tokenFilter !== '') {
        $stmt = $pdo->prepare("
            SELECT r.id, r.session_token, r.movie_id, r.comment, r.revealed_at
            FROM movie_reveals r
            WHERE r.session_token = :token
            ORDER BY r.revealed_at ASC
        ");
        $stmt->execute([':token' => $tokenFilter]);
        $reveals = $stmt->fetchAll();
    } else {
        $stmt = $pdo->query("
            SELECT r.id, r.session_token, r.movie_id, r.comment, r.revealed_at
            FROM movie_reveals r
            ORDER BY r.movie_id, r.revealed_at ASC
        ");
        $reveals = $stmt->fetchAll();
    }
} catch (Exception $e) {
    http_response_code(500);
    echo "Erreur DB : " . h($e->getMessage());
    exit;
}

// Grouper les reveals par movie_id pour usage côté client
$revealsByMovie = [];
foreach ($reveals as $r) {
    $mid = (string)($r['movie_id'] ?? '');
    if ($mid === '') continue;
    if (!isset($revealsByMovie[$mid])) $revealsByMovie[$mid] = [];
    $revealsByMovie[$mid][] = $r;
}

// JSON safe pour injection côté client
$revealsJson = json_encode($revealsByMovie, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);


?><!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="Détails des films ironman : descriptions et navigation séquentielle entre cartes." />
  <title>Classeur - Film: Ironman</title>

  <!-- Feuille de style séquentielle -->
  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <!-- Skip link pour l'accessibilité -->
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">A</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de film</strong>
          <small class="site-sub">ironman</small>
        </div>
      </div>

      <nav class="main-nav" role="navigation" aria-label="Navigation principale">
        <nav class="main-nav" role="navigation" aria-label="Navigation principale">
  <a href="accueil.php" class="nav-link">Accueil</a>
  <a href="movies_list.php" class="nav-link">Films</a>
  <a href="serie.php" class="nav-link">Series</a>
      </nav>
    </div>
  </header>

  <main class="container" id="main" role="main">
    <section class="hero" aria-labelledby="hero-title">
      <div class="hero-content">
        <h1 id="hero-title">Rapport sur les films Iron man</h1>
        <p class="lead">Ici se trouvent quelques détails sur les films Iron man. Appuie sur "Continuer" pour afficher la première carte, puis clique sur une carte visible (ou appuie Entrée / Espace) pour afficher la suivante.</p>

        <p class="cta">
          <button class="btn primary" id="startBtn" aria-controls="cardsContainer" aria-expanded="false">Continuer</button>
          <a href="#" class="btn ghost" id="learnBtn">En savoir plus</a>
        </p>
      </div>

      <div class="hero-illustration" aria-hidden="false">
        <picture>
          <source srcset="im.jpg" type="image/jpeg">
          <img class="hero-img" src="im.jpg" alt="Écran affichant du code coloré" />
        </picture>
      </div>
    </section>

    <!-- CARDS : chaque .card contient .card-content (utile pour l'animation) -->
    <section class="grid progressive-cards" aria-label="Fonctionnalités séquentielles" id="cardsContainer" data-persist-key="avengers-sequence">
      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

     <!-- Iron Man (2008) -->
<article class="card hidden" data-index="0" tabindex="0" role="button" aria-expanded="false">
  <div class="card-content">
    <h3 class="card-title">Iron Man</h3>
    <p class="card-body">Premier film Iron Man (2008) où Tony Stark, génie milliardaire, crée son armure et devient un super-héros.</p>
    <picture>
      <source srcset="im1.jpg" type="image/jpeg">
      <img class="hero-img" src="im1.jpg" alt="Tony Stark en armure Iron Man" />
    </picture>
  </div>
</article>

<!-- Iron Man 2 (2010) -->
<article class="card hidden" data-index="1" tabindex="0" role="button" aria-expanded="false">
  <div class="card-content">
    <h3 class="card-title">Iron Man 2</h3>
    <p class="card-body">Tony Stark fait face aux conséquences de son identité publique et affronte de nouveaux ennemis comme Whiplash.</p>
    <picture>
      <source srcset="im2.jpg" type="image/jpeg">
      <img class="hero-img" src="im2.jpg" alt="Iron Man affrontant Whiplash" />
    </picture>
  </div>
</article>

<!-- Iron Man 3 (2013) -->
<article class="card hidden" data-index="2" tabindex="0" role="button" aria-expanded="false">
  <div class="card-content">
    <h3 class="card-title">Iron Man 3</h3>
    <p class="card-body">Tony Stark affronte le Mandarin et doit surmonter ses propres faiblesses après les événements d’Avengers.</p>
    <picture>
      <source srcset="im3.jpg" type="image/jpeg">
      <img class="hero-img" src="im3.jpg" alt="Iron Man en combat contre le Mandarin" />
    </picture>
  </div>
</article>
    </section>

    <div class="controls" style="margin-top:0.8rem">
      <button id="resetCards" class="btn ghost" title="Réinitialiser l'affichage des cartes">Réinitialiser</button>
      <button id="revealAll" class="btn" title="Afficher toutes les cartes">Afficher tout</button>
    </div>
  </main>

  <footer class="site-footer" role="contentinfo">
    <div class="container footer-inner">
      <div>© <span id="year"></span> Ton site — construit pour être édité.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <!-- Panneau de réglages léger -->
  <aside class="settings" id="settings" aria-hidden="true">
    <h4>Personnaliser</h4>

    <label class="setting-row">
      <span>Couleur principale</span>
      <input id="primaryColor" type="color" value="#1d4ed8" />
    </label>

    <label class="setting-row">
      <span>Couleur fond</span>
      <input id="bgColor" type="color" value="#f8fafc" />
    </label>

    <label class="setting-row">
      <input id="darkMode" type="checkbox" />
      <span>Mode sombre</span>
    </label>

    <div class="settings-actions">
      <button id="resetBtn" class="btn ghost">Réinitialiser</button>
      <button id="toggleSettings" class="btn" aria-expanded="false">Paramètres</button>
    </div>
  </aside>

  <!-- Script principal -->
  <script src="script.js" defer></script>
</body>
</html>
