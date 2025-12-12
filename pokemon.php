<?php
/**
 * pokemon_series.php
 * Page séquentielle pour afficher les jeux de la saga Pokémon
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
  <meta name="description" content="Détails des jeux Pokémon : descriptions et navigation séquentielle entre cartes." />
  <title>Classeur - Série: Pokémon</title>
  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">⚡</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de jeu</strong>
          <small class="site-sub">Pokémon</small>
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
        <h1 id="hero-title">Rapport sur la saga Pokémon</h1>
        <p class="lead">Ici se trouvent quelques détails sur les jeux principaux de la saga Pokémon. Appuie sur "Continuer" pour afficher la première carte, puis clique sur une carte visible (ou appuie Entrée / Espace) pour afficher la suivante.</p>

        <p class="cta">
          <button class="btn primary" id="startBtn" aria-controls="cardsContainer" aria-expanded="false">Continuer</button>
          <a href="#" class="btn ghost" id="learnBtn">En savoir plus</a>
        </p>
      </div>

      <div class="hero-illustration" aria-hidden="false">
        <picture>
          <source srcset="pokemon.jpg" type="image/jpeg">
          <img class="hero-img" src="pokemon.jpg" alt="Illustration Pokémon" />
        </picture>
      </div>
    </section>

    <section class="grid progressive-cards" aria-label="Jeux Pokémon" id="cardsContainer" data-persist-key="pokemon-sequence">
      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

      <!-- Pokémon Rouge/Bleu (1996) -->
      <article class="card hidden" data-index="0" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Pokémon Rouge/Bleu (1996)</h3>
          <p class="card-body">Les débuts de la saga à Kanto avec Pikachu et les 151 premiers Pokémon.</p>
          <img class="hero-img" src="pokemon_rb.jpg" alt="Pokémon Rouge/Bleu" />
        </div>
      </article>

      <!-- Pokémon Or/Argent (1999) -->
      <article class="card hidden" data-index="1" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Pokémon Or/Argent (1999)</h3>
          <p class="card-body">Nouvelle région Johto et introduction des Pokémon légendaires Lugia et Ho-Oh.</p>
          <img class="hero-img" src="pokemon_gs.jpg" alt="Pokémon Or/Argent" />
        </div>
      </article>

      <!-- Pokémon Rubis/Saphir (2002) -->
      <article class="card hidden" data-index="2" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Pokémon Rubis/Saphir (2002)</h3>
          <p class="card-body">Découverte de la région Hoenn et des Pokémon légendaires Groudon et Kyogre.</p>
          <img class="hero-img" src="pokemon_rs.jpg" alt="Pokémon Rubis/Saphir" />
        </div>
      </article>

      <!-- Pokémon Diamant/Perle (2006) -->
      <article class="card hidden" data-index="3" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Pokémon Diamant/Perle (2006)</h3>
          <p class="card-body">Arrivée de la région Sinnoh et des Pokémon légendaires Dialga et Palkia.</p>
          <img class="hero-img" src="pokemon_dp.jpg" alt="Pokémon Diamant/Perle" />
        </div>
      </article>

      <!-- Pokémon Noir/Blanc (2010) -->
      <article class="card hidden" data-index="4" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Pokémon Noir/Blanc (2010)</h3>
          <p class="card-body">Introduction de la région Unys et des Pokémon légendaires Reshiram et Zekrom.</p>
          <img class="hero-img" src="pokemon_bw.jpg" alt="Pokémon Noir/Blanc" />
        </div>
      </article>

      <!-- Pokémon X/Y (2013) -->
      <article class="card hidden" data-index="5" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Pokémon X/Y (2013)</h3>
          <p class="card-body">Premiers jeux en 3D complète, introduction des Méga-évolutions.</p>
          <img class="hero-img" src="pokemon_xy.jpg" alt="Pokémon X/Y" />
        </div>
      </article>

      <!-- Pokémon Soleil/Lune (2016) -->
      <article class="card hidden" data-index="6" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Pokémon Soleil/Lune (2016)</h3>
          <p class="card-body">Découverte de la région Alola et des formes régionales.</p>
          <img class="hero-img" src="pokemon_sm.jpg" alt="Pokémon Soleil/Lune" />
        </div>
      </article>

      <!-- Pokémon Épée/Bouclier (2019) -->
      <article class="card hidden" data-index="7" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Pokémon Épée/Bouclier (2019)</h3>
          <p class="card-body">Exploration de la région Galar avec les Pokémon Dynamax et Gigamax.</p>
          <img class="hero-img" src="pokemon_swsh.jpg" alt="Pokémon Épée/Bouclier" />
        </div>
      </article>

      <!-- Pokémon Écarlate/Violet (2022) -->
      <article class="card hidden" data-index="8" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Pokémon Écarlate/Violet (2022)</h3>
          <p class="card-body">Premiers jeux en monde ouvert de la saga, situés dans la région de Paldea.</p>
          <img class="hero-img" src="pokemon_sv.jpg" alt="Pokémon Écarlate/Violet" />
        </div>
      </article>

            <!-- Pokémon Z-A (2025) -->
      <article class="card hidden" data-index="9" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Pokémon Z-A (2025)</h3>
          <p class="card-body">Un nouvel épisode annoncé, situé dans la région de Lumiose City, avec des mécaniques inédites.</p>
          <img class="hero-img" src="pokemon_za.jpg" alt="Pokémon Z-A" />
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
      <div>© <span id="year"></span> Ton site — Pokémon Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
