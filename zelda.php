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

<!-- The Legend of Zelda (1986) -->
<article class="card hidden" data-index="5">
  <div class="card-content">
    <h3 class="card-title">The Legend of Zelda (1986)</h3>
    <p class="card-body">Link doit sauver Zelda et réunir la Triforce.</p>
    <img class="hero-img" src="zelda_1986.jpg" alt="The Legend of Zelda" />
  </div>
</article>

<!-- Zelda II: The Adventure of Link (1987) -->
<article class="card hidden" data-index="6">
  <div class="card-content">
    <h3 class="card-title">Zelda II: The Adventure of Link (1987)</h3>
    <p class="card-body">Un gameplay orienté action-RPG, Link doit réveiller Zelda.</p>
    <img class="hero-img" src="zelda_2.jpg" alt="Zelda II Adventure of Link" />
  </div>
</article>

<!-- A Link to the Past (1991) -->
<article class="card hidden" data-index="7">
  <div class="card-content">
    <h3 class="card-title">A Link to the Past (1991)</h3>
    <p class="card-body">Link voyage entre monde de la lumière et des ténèbres.</p>
    <img class="hero-img" src="zelda_alttp.jpg" alt="Zelda A Link to the Past" />
  </div>
</article>

<!-- Link's Awakening (1993) -->
<article class="card hidden" data-index="8">
  <div class="card-content">
    <h3 class="card-title">Link's Awakening (1993)</h3>
    <p class="card-body">Coincé sur l’île de Cocolint, Link doit réveiller le Poisson-Rêve.</p>
    <img class="hero-img" src="zelda_la.jpg" alt="Zelda Link's Awakening" />
  </div>
</article>

<!-- Ocarina of Time (1998) -->
<article class="card hidden" data-index="9">
  <div class="card-content">
    <h3 class="card-title">Ocarina of Time (1998)</h3>
    <p class="card-body">Link voyage dans le temps pour sauver Hyrule du maléfique Ganondorf.</p>
    <img class="hero-img" src="zelda_oot.jpg" alt="Zelda Ocarina of Time" />
  </div>
</article>

<!-- Majora's Mask (2000) -->
<article class="card hidden" data-index="10">
  <div class="card-content">
    <h3 class="card-title">Majora's Mask (2000)</h3>
    <p class="card-body">Link doit sauver Termina en trois jours grâce au pouvoir des masques.</p>
    <img class="hero-img" src="zelda_mm.jpg" alt="Zelda Majora's Mask" />
  </div>
</article>

<!-- Oracle of Ages (2001) -->
<article class="card hidden" data-index="11">
  <div class="card-content">
    <h3 class="card-title">Oracle of Ages (2001)</h3>
    <p class="card-body">Link voyage dans le temps pour sauver Nayru.</p>
    <img class="hero-img" src="zelda_ages.jpg" alt="Zelda Oracle of Ages" />
  </div>
</article>

<!-- Oracle of Seasons (2001) -->
<article class="card hidden" data-index="12">
  <div class="card-content">
    <h3 class="card-title">Oracle of Seasons (2001)</h3>
    <p class="card-body">Link manipule les saisons pour sauver Din.</p>
    <img class="hero-img" src="zelda_seasons.jpg" alt="Zelda Oracle of Seasons" />
  </div>
</article>

<!-- The Wind Waker (2002) -->
<article class="card hidden" data-index="13">
  <div class="card-content">
    <h3 class="card-title">The Wind Waker (2002)</h3>
    <p class="card-body">Link explore un vaste océan à la recherche de sa sœur.</p>
    <img class="hero-img" src="zelda_ww.jpg" alt="Zelda The Wind Waker" />
  </div>
</article>

<!-- Four Swords Adventures (2004) -->
<article class="card hidden" data-index="14">
  <div class="card-content">
    <h3 class="card-title">Four Swords Adventures (2004)</h3>
    <p class="card-body">Link se divise en quatre pour vaincre Vaati.</p>
    <img class="hero-img" src="zelda_fsa.jpg" alt="Zelda Four Swords Adventures" />
  </div>
</article>

<!-- The Minish Cap (2004) -->
<article class="card hidden" data-index="15">
  <div class="card-content">
    <h3 class="card-title">The Minish Cap (2004)</h3>
    <p class="card-body">Link découvre le peuple Minish et affronte Vaati.</p>
    <img class="hero-img" src="zelda_minish.jpg" alt="Zelda The Minish Cap" />
  </div>
</article>

<!-- Twilight Princess (2006) -->
<article class="card hidden" data-index="16">
  <div class="card-content">
    <h3 class="card-title">Twilight Princess (2006)</h3>
    <p class="card-body">Link explore un monde envahi par les ténèbres et se transforme en loup.</p>
    <img class="hero-img" src="zelda_tp.jpg" alt="Zelda Twilight Princess" />
  </div>
</article>

<!-- Phantom Hourglass (2007) -->
<article class="card hidden" data-index="17">
  <div class="card-content">
    <h3 class="card-title">Phantom Hourglass (2007)</h3>
    <p class="card-body">Suite de Wind Waker, Link explore les mers avec la carte magique.</p>
    <img class="hero-img" src="zelda_ph.jpg" alt="Zelda Phantom Hourglass" />
  </div>
</article>

<!-- Spirit Tracks (2009) -->
<article class="card hidden" data-index="18">
  <div class="card-content">
    <h3 class="card-title">Spirit Tracks (2009)</h3>
    <p class="card-body">Link voyage en train pour sauver Zelda et Hyrule.</p>
    <img class="hero-img" src="zelda_st.jpg" alt="Zelda Spirit Tracks" />
  </div>
</article>

<!-- Skyward Sword (2011) -->
<article class="card hidden" data-index="19">
  <div class="card-content">
    <h3 class="card-title">Skyward Sword (2011)</h3>
    <p class="card-body">Link explore les cieux et forge la Master Sword.</p>
    <img class="hero-img" src="zelda_ss.jpg" alt="Zelda Skyward Sword" />
  </div>
</article>

<!-- A Link Between Worlds (2013) -->
<article class="card hidden" data-index="20">
  <div class="card-content">
    <h3 class="card-title">A Link Between Worlds (2013)</h3>
    <p class="card-body">Link peut se transformer en peinture pour voyager sur les murs.</p>
    <img class="hero-img" src="zelda_albw.jpg" alt="Zelda A Link Between Worlds" />
  </div>
</article>

<!-- Tri Force Heroes (2015) -->
<article class="card hidden" data-index="21">
  <div class="card-content">
    <h3 class="card-title">Tri Force Heroes (2015)</h3>
    <p class="card-body">Trois Links coopèrent pour résoudre des énigmes et vaincre des ennemis.</p>
    <img class="hero-img" src="zelda_tf.jpg" alt="Zelda Tri Force Heroes" />
  </div>
</article>

<!-- Breath of the Wild (2017) -->
<article class="card hidden" data-index="22">
  <div class="card-content">
    <h3 class="card-title">Breath of the Wild (2017)</h3>
    <p class="card-body">Un monde ouvert immense où Link peut grimper, cuisiner et découvrir des secrets.</p>
    <img class="hero-img" src="zelda_botw.jpg" alt="Zelda Breath of the Wild" />
  </div>
</article>

<!-- Tears of the Kingdom (2023) -->
<article class="card hidden" data-index="23">
  <div class="card-content">
    <h3 class="card-title">Tears of the Kingdom (2023)</h3>
    <p class="card-body">Suite directe de BOTW, Link explore les cieux et les profondeurs d’Hyrule.</p>
    <img class="hero-img" src="zelda_totk.jpg" alt="Zelda Tears of the Kingdom" />
  </div>
</article>

<!-- Echoes of Wisdom (2024) -->
<article class="card hidden" data-index="24">
  <div class="card-content">
    <h3 class="card-title">Echoes of Wisdom (2024)</h3>
    <p class="card-body">Pour la première fois, Zelda est jouable et utilise la magie pour sauver Hyrule.</p>
    <img class="hero-img" src="zelda_eow.jpg" alt="Zelda Echoes of Wisdom" />
  </div>
</article>

<!-- Link's Awakening DX (1998, remake) -->
<article class="card hidden" data-index="25">
  <div class="card-content">
    <h3 class="card-title">Link's Awakening DX (1998)</h3>
    <p class="card-body">Version colorisée et enrichie de Link’s Awakening sur Game Boy Color.</p>
    <img class="hero-img" src="zelda_ladx.jpg" alt="Zelda Link's Awakening DX" />
  </div>
</article>

<!-- Ocarina of Time 3D (2011, remake) -->
<article class="card hidden" data-index="26">
  <div class="card-content">
    <h3 class="card-title">Ocarina of Time 3D (2011)</h3>
    <p class="card-body">Remake sur 3DS avec graphismes améliorés et interface modernisée.</p>
    <img class="hero-img" src="zelda_oot3d.jpg" alt="Zelda Ocarina of Time 3D" />
  </div>
</article>

<!-- Majora's Mask 3D (2015, remake) -->
<article class="card hidden" data-index="27">
  <div class="card-content">
    <h3 class="card-title">Majora's Mask 3D (2015)</h3>
    <p class="card-body">Remake sur 3DS avec ajustements de gameplay et graphismes retravaillés.</p>
    <img class="hero-img" src="zelda_mm3d.jpg" alt="Zelda Majora's Mask 3D" />
  </div>
</article>

<!-- The Wind Waker HD (2013, remake) -->
<article class="card hidden" data-index="28">
  <div class="card-content">
    <h3 class="card-title">The Wind Waker HD (2013)</h3>
    <p class="card-body">Version HD sur Wii U avec graphismes lissés et gameplay amélioré.</p>
    <img class="hero-img" src="zelda_wwhd.jpg" alt="Zelda The Wind Waker HD" />
  </div>
</article>

<!-- Twilight Princess HD (2016, remake) -->
<article class="card hidden" data-index="29">
  <div class="card-content">
    <h3 class="card-title">Twilight Princess HD (2016)</h3>
    <p class="card-body">Remaster HD sur Wii U avec textures améliorées et interface revue.</p>
    <img class="hero-img" src="zelda_tphd.jpg" alt="Zelda Twilight Princess HD" />
  </div>
</article>

<!-- Skyward Sword HD (2021, remake) -->
<article class="card hidden" data-index="30">
  <div class="card-content">
    <h3 class="card-title">Skyward Sword HD (2021)</h3>
    <p class="card-body">Remaster sur Switch avec commandes modernisées et graphismes affinés.</p>
    <img class="hero-img" src="zelda_sshd.jpg" alt="Zelda Skyward Sword HD" />
  </div>
</article>

<!-- Link's Awakening (2019, remake complet) -->
<article class="card hidden" data-index="31">
  <div class="card-content">
    <h3 class="card-title">Link's Awakening (2019)</h3>
    <p class="card-body">Remake complet sur Switch avec style graphique unique et musiques réorchestrées.</p>
    <img class="hero-img" src="zelda_la2019.jpg" alt="Zelda Link's Awakening Remake" />
  </div>
</article>

<!-- Hyrule Warriors (2014, spin-off) -->
<article class="card hidden" data-index="32">
  <div class="card-content">
    <h3 class="card-title">Hyrule Warriors (2014)</h3>
    <p class="card-body">Spin-off orienté action, Link et ses alliés affrontent des hordes d’ennemis.</p>
    <img class="hero-img" src="zelda_hw.jpg" alt="Zelda Hyrule Warriors" />
  </div>
</article>

<!-- Hyrule Warriors: Age of Calamity (2020, spin-off) -->
<article class="card hidden" data-index="33">
  <div class="card-content">
    <h3 class="card-title">Hyrule Warriors: Age of Calamity (2020)</h3>
    <p class="card-body">Préquelle de BOTW, raconte la guerre contre Ganon 100 ans avant.</p>
    <img class="hero-img" src="zelda_hwac.jpg" alt="Zelda Hyrule Warriors Age of Calamity" />
  </div>
</article>

<!-- Cadence of Hyrule (2019, spin-off) -->
<article class="card hidden" data-index="34">
  <div class="card-content">
    <h3 class="card-title">Cadence of Hyrule (2019)</h3>
    <p class="card-body">Jeu musical et d’action basé sur Crypt of the NecroDancer avec Zelda et Link.</p>
    <img class="hero-img" src="zelda_coh.jpg" alt="Zelda Cadence of Hyrule" />
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
