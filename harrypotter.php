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


?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="Détails des films Harry Potter : descriptions et navigation séquentielle entre cartes." />
  <title>Classeur - Film: Harry Potter</title>

  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">⚡</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de film</strong>
          <small class="site-sub">Harry Potter</small>
        </div>
      </div>

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
        <h1 id="hero-title">Rapport sur les films Harry Potter</h1>
        <p class="lead">Revivez la magie de Poudlard. Clique sur "Continuer" pour afficher la première carte, puis navigue séquentiellement.</p>

        <p class="cta">
          <button class="btn primary" id="startBtn" aria-controls="cardsContainer" aria-expanded="false">Continuer</button>
        </p>
      </div>

      <div class="hero-illustration" aria-hidden="false">
        <picture>
          <source srcset="hp.jpg" type="image/jpeg">
          <img class="hero-img" src="hp.jpg" alt="Logo Harry Potter" />
        </picture>
      </div>
    </section>

    <section class="grid progressive-cards" aria-label="Films Harry Potter" id="cardsContainer" data-persist-key="harrypotter-sequence">
      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

      <!-- Harry Potter à l'école des sorciers (2001) -->
      <article class="card hidden" data-index="0" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Harry Potter à l'école des sorciers (2001)</h3>
          <p>Harry découvre qu’il est un sorcier et entre à Poudlard.</p>
          <source srcset="hp1.jpg" type="image/jpeg">
          <img class="hero-img" src="hp1.jpg" alt="Logo Harry Potter" />
        </div>
      </article>

      <!-- Harry Potter et la Chambre des secrets (2002) -->
      <article class="card hidden" data-index="1" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Harry Potter et la Chambre des secrets (2002)</h3>
          <p>Harry affronte le Basilic et découvre le journal de Jedusor.</p>
          <source srcset="hp2.jpg" type="image/jpeg">
          <img class="hero-img" src="hp2.jpg" alt="Logo Harry Potter" />
        </div>
      </article>

      <!-- Harry Potter et le Prisonnier d’Azkaban (2004) -->
      <article class="card hidden" data-index="2" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Harry Potter et le Prisonnier d’Azkaban (2004)</h3>
          <p>Harry rencontre Sirius Black et découvre la vérité sur son passé.</p>
          <source srcset="hp3.jpg" type="image/jpeg">
          <img class="hero-img" src="hp3.jpg" alt="Logo Harry Potter" />
        </div>
      </article>

      <!-- Harry Potter et la Coupe de feu (2005) -->
      <article class="card hidden" data-index="3" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Harry Potter et la Coupe de feu (2005)</h3>
          <p>Harry participe au Tournoi des Trois Sorciers et affronte Voldemort.</p>
          <source srcset="hp4.jpg" type="image/jpeg">
          <img class="hero-img" src="hp4.jpg" alt="Logo Harry Potter" />
        </div>
      </article>

      <!-- Harry Potter et l’Ordre du Phénix (2007) -->
      <article class="card hidden" data-index="4" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Harry Potter et l’Ordre du Phénix (2007)</h3>
          <p>Harry fonde l’Armée de Dumbledore et affronte Dolores Ombrage.</p>
          <source srcset="hp5.jpg" type="image/jpeg">
          <img class="hero-img" src="hp5.jpg" alt="Logo Harry Potter" />
        </div>
      </article>

      <!-- Harry Potter et le Prince de sang-mêlé (2009) -->
      <article class="card hidden" data-index="5" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Harry Potter et le Prince de sang-mêlé (2009)</h3>
          <p>Harry découvre les Horcruxes et la vérité sur Voldemort.</p>
          <source srcset="hp6.jpg" type="image/jpeg">
          <img class="hero-img" src="hp6.jpg" alt="Logo Harry Potter" />
        </div>
      </article>

      <!-- Harry Potter et les Reliques de la Mort – Partie 1 (2010) -->
      <article class="card hidden" data-index="6" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Harry Potter et les Reliques de la Mort – Partie 1 (2010)</h3>
          <p>Harry, Ron et Hermione partent à la recherche des Horcruxes.</p>
          <source srcset="hp7.1.jpg" type="image/jpeg">
          <img class="hero-img" src="hp7.1.jpg" alt="Logo Harry Potter" />
        </div>
      </article>

      <!-- Harry Potter et les Reliques de la Mort – Partie 2 (2011) -->
      <article class="card hidden" data-index="7" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Harry Potter et les Reliques de la Mort – Partie 2 (2011)</h3>
          <p>La bataille finale à Poudlard oppose Harry à Voldemort.</p>
          <source srcset="hp7.2.jpg" type="image/jpeg">
          <img class="hero-img" src="hp7.2.jpg" alt="Logo Harry Potter" />
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
      <div>© <span id="year"></span> Ton site — Harry Potter Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
