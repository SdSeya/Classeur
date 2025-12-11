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
  <meta name="description" content="Détails des films Avengers : descriptions et navigation séquentielle entre cartes." />
  <title>Classeur - Film: Avengers</title>

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
          <small class="site-sub">Avengers</small>
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
        <h1 id="hero-title">Rapport sur les films Avengers</h1>
        <p class="lead">Ici se trouvent quelques détails sur les films Avengers. Appuie sur "Continuer" pour afficher la première carte, puis clique sur une carte visible (ou appuie Entrée / Espace) pour afficher la suivante.</p>

        <p class="cta">
          <button class="btn primary" id="startBtn" aria-controls="cardsContainer" aria-expanded="false">Continuer</button>
          <a href="#" class="btn ghost" id="learnBtn">En savoir plus</a>
        </p>
      </div>

      <div class="hero-illustration" aria-hidden="false">
        <picture>
          <source srcset="avengers.jpg" type="image/jpeg">
          <img class="hero-img" src="avengers.jpg" alt="Écran affichant du code coloré" />
        </picture>
      </div>
    </section>

    <!-- CARDS : chaque .card contient .card-content (utile pour l'animation) -->
    <section class="grid progressive-cards" aria-label="Fonctionnalités séquentielles" id="cardsContainer" data-persist-key="avengers-sequence">
      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

      <!-- Par défaut toutes les cartes sont cachées : la première s'affichera seulement après 'Continuer' -->
      <article class="card hidden" data-index="0" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Avengers</h3>
          <p class="card-body">Premier film Avengers où les plus grands héros de la Terre s'unissent pour vaincre Loki et son armée de Chitauri.</p>
        <picture>
          <source srcset="avengers1.jpg" type="image/jpeg">
          <img class="hero-img" src="avengers1.jpg" alt="Écran affichant du code coloré" />
        </picture>
        </div>
      </article>

      <article class="card hidden" data-index="1" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Avengers: Age of Ultron</h3>
          <p class="card-body">Deuxième film où les Avengers affrontent Ultron, une IA dangereuse, et font face aux conséquences de leurs actions.</p>
        <picture>
          <source srcset="avengersaou.jpg" type="image/jpeg">
          <img class="hero-img" src="avengersaou.jpg" alt="Écran affichant du code coloré" />
        </picture>
        </div>
      </article>

      <article class="card hidden" data-index="2" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Avengers: Infinity War</h3>
          <p class="card-body">Les Avengers s'allient à de nombreux héros pour combattre Thanos, qui cherche à réunir les Pierres d'Infinité.</p>
        <picture>
          <source srcset="avengersiw.jpg" type="image/jpeg">
          <img class="hero-img" src="avengersiw.jpg" alt="Écran affichant du code coloré" />
        </picture>
        </div>
      </article>

      <article class="card hidden" data-index="3" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Avengers: Endgame</h3>
          <p class="card-body">Les héros voyagent dans le temps et s'unissent pour réparer les événements causés par Thanos et reprendre ce qui leur a été pris.</p>
        <picture>
          <source srcset="avengerseg.jpg" type="image/jpeg">
          <img class="hero-img" src="avengerseg.jpg" alt="Écran affichant du code coloré" />
        </picture>
        </div>
      </article>

      <article class="card hidden" data-index="4" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Avengers: Doomsday (à venir)</h3>
          <p class="card-body">Prochain film annoncé pour décembre 2026 — peu d'informations officielles pour le moment.</p>
        <picture>
          <source srcset="avengersdd.jpg" type="image/jpeg">
          <img class="hero-img" src="avengersdd.jpg" alt="Écran affichant du code coloré" />
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
