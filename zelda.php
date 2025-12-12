<?php
/**
 * zelda_series.php
 * Page séquentielle pour afficher les jeux de la saga The Legend of Zelda
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
  <meta name="description" content="Détails des jeux The Legend of Zelda : descriptions et navigation séquentielle entre cartes." />
  <title>Classeur - Série: The Legend of Zelda</title>

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
          <small class="site-sub">The Legend of Zelda</small>
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
        <h1 id="hero-title">Rapport sur la saga The Legend of Zelda</h1>
        <p class="lead">Ici se trouvent quelques détails sur les jeux principaux de la saga Zelda. Appuie sur "Continuer" pour afficher la première carte, puis clique sur une carte visible (ou appuie Entrée / Espace) pour afficher la suivante.</p>

        <p class="cta">
          <button class="btn primary" id="startBtn" aria-controls="cardsContainer" aria-expanded="false">Continuer</button>
          <a href="#" class="btn ghost" id="learnBtn">En savoir plus</a>
        </p>
      </div>

      <div class="hero-illustration" aria-hidden="false">
        <picture>
          <source srcset="zelda.jpg" type="image/jpeg">
          <img class="hero-img" src="zelda.jpg" alt="Illustration Zelda" />
        </picture>
      </div>
    </section>

    <section class="grid progressive-cards" aria-label="Jeux Zelda" id="cardsContainer" data-persist-key="zelda-sequence">
      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

      <!-- Ocarina of Time (1998) -->
      <article class="card hidden" data-index="0" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Ocarina of Time (1998)</h3>
          <p class="card-body">Link voyage dans le temps pour sauver Hyrule du maléfique Ganondorf.</p>
          <img class="hero-img" src="zelda_oot.jpg" alt="Zelda Ocarina of Time" />
        </div>
      </article>

      <!-- Majora's Mask (2000) -->
      <article class="card hidden" data-index="1" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Majora's Mask (2000)</h3>
          <p class="card-body">Link doit sauver Termina en trois jours grâce au pouvoir des masques.</p>
          <img class="hero-img" src="zelda_mm.jpg" alt="Zelda Majora's Mask" />
        </div>
      </article>

      <!-- Twilight Princess (2006) -->
      <article class="card hidden" data-index="2" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Twilight Princess (2006)</h3>
          <p class="card-body">Link explore un monde envahi par les ténèbres et se transforme en loup.</p>
          <img class="hero-img" src="zelda_tp.jpg" alt="Zelda Twilight Princess" />
        </div>
      </article>

      <!-- Breath of the Wild (2017) -->
      <article class="card hidden" data-index="3" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Breath of the Wild (2017)</h3>
          <p class="card-body">Un monde ouvert immense où Link peut grimper, cuisiner et découvrir des secrets.</p>
          <img class="hero-img" src="zelda_botw.jpg" alt="Zelda Breath of the Wild" />
        </div>
      </article>

      <!-- Tears of the Kingdom (2023) -->
      <article class="card hidden" data-index="4" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Tears of the Kingdom (2023)</h3>
          <p class="card-body">Suite directe de BOTW, Link explore les cieux et les profondeurs d’Hyrule.</p>
          <img class="hero-img" src="zelda_totk.jpg" alt="Zelda Tears of the Kingdom" />
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
      <div>© <span id="year"></span> Ton site — Zelda Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
