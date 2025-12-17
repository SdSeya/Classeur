<?php
/**
 * spiderman_series.php
 * Page séquentielle pour afficher tous les jeux Spider-Man
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
  <meta name="description" content="Détails de tous les jeux Spider-Man." />
  <title>Classeur - Série : Spider-Man</title>
  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">🕷️</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de jeu</strong>
          <small class="site-sub">Spider-Man</small>
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
        <h1 id="hero-title">Rapport complet sur la saga Spider-Man</h1>
        <p class="lead">
          Tous les jeux vidéo Spider-Man depuis les années 80 jusqu’aux titres récents Insomniac Games.
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
        <img class="hero-img" src="spiderman.jpg" alt="Illustration Spider-Man" />
      </div>
    </section>

    <section class="grid progressive-cards"
             aria-label="Jeux Spider-Man"
             id="cardsContainer"
             data-persist-key="spiderman-sequence">

      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

<!-- Jeux classiques et rétro -->
<article class="card hidden" data-index="1">
  <div class="card-content">
    <h3 class="card-title">Spider-Man (1982)</h3>
    <p class="card-body">Premier jeu Spider-Man sur Atari 2600.</p>
    <img class="hero-img" src="spiderman_1982.jpg" alt="Spider-Man 1982" />
  </div>
</article>

<article class="card hidden" data-index="2">
  <div class="card-content">
    <h3 class="card-title">Spider-Man (1984)</h3>
    <p class="card-body">Jeu 8-bit classique sur ordinateurs.</p>
    <img class="hero-img" src="spiderman_1984.jpg" alt="Spider-Man 1984" />
  </div>
</article>

<article class="card hidden" data-index="3">
  <div class="card-content">
    <h3 class="card-title">The Amazing Spider-Man and Captain America in Dr. Doom’s Revenge! (1989)</h3>
    <p class="card-body">Aventure avec Spider-Man et Captain America.</p>
    <img class="hero-img" src="spiderman_doom1989.jpg" alt="Spider-Man Dr Doom 1989" />
  </div>
</article>

<article class="card hidden" data-index="4">
  <div class="card-content">
    <h3 class="card-title">The Amazing Spider-Man (1990)</h3>
    <p class="card-body">Jeu sur Amiga et Game Boy.</p>
    <img class="hero-img" src="spiderman_1990.jpg" alt="Spider-Man 1990" />
  </div>
</article>

<article class="card hidden" data-index="5">
  <div class="card-content">
    <h3 class="card-title">The Amazing Spider-Man vs. The Kingpin (1991)</h3>
    <p class="card-body">Combattez Kingpin à travers plusieurs niveaux.</p>
    <img class="hero-img" src="spiderman_kingpin1991.jpg" alt="Spider-Man Kingpin 1991" />
  </div>
</article>

<!-- Jeux 3D et modernes -->
<article class="card hidden" data-index="6">
  <div class="card-content">
    <h3 class="card-title">Spider-Man (2000)</h3>
    <p class="card-body">Jeu PS1 / N64 / Dreamcast avec missions et combats.</p>
    <img class="hero-img" src="spiderman_2000.jpg" alt="Spider-Man 2000" />
  </div>
</article>

<article class="card hidden" data-index="7">
  <div class="card-content">
    <h3 class="card-title">Spider-Man 2 (2004)</h3>
    <p class="card-body">Première vraie ville ouverte pour se balancer.</p>
    <img class="hero-img" src="spiderman_2_2004.jpg" alt="Spider-Man 2 2004" />
  </div>
</article>

<article class="card hidden" data-index="8">
  <div class="card-content">
    <h3 class="card-title">Spider-Man 3 (2007)</h3>
    <p class="card-body">Adaptation du film avec combats et exploration.</p>
    <img class="hero-img" src="spiderman_3_2007.jpg" alt="Spider-Man 3 2007" />
  </div>
</article>

<article class="card hidden" data-index="9">
  <div class="card-content">
    <h3 class="card-title">Spider-Man: Web of Shadows (2008)</h3>
    <p class="card-body">Action-RPG avec choix et fins multiples.</p>
    <img class="hero-img" src="spiderman_wos.jpg" alt="Spider-Man Web of Shadows" />
  </div>
</article>

<article class="card hidden" data-index="10">
  <div class="card-content">
    <h3 class="card-title">Spider-Man: Shattered Dimensions (2010)</h3>
    <p class="card-body">Explorez plusieurs univers et versions de Spider-Man.</p>
    <img class="hero-img" src="spiderman_sd.jpg" alt="Spider-Man Shattered Dimensions" />
  </div>
</article>

<article class="card hidden" data-index="11">
  <div class="card-content">
    <h3 class="card-title">Spider-Man: Edge of Time (2011)</h3>
    <p class="card-body">Aventure temporelle entre deux versions de Peter Parker.</p>
    <img class="hero-img" src="spiderman_eot.jpg" alt="Spider-Man Edge of Time" />
  </div>
</article>

<article class="card hidden" data-index="12">
  <div class="card-content">
    <h3 class="card-title">The Amazing Spider-Man (2012)</h3>
    <p class="card-body">Jeu basé sur le film de 2012.</p>
    <img class="hero-img" src="spiderman_2012.jpg" alt="The Amazing Spider-Man 2012" />
  </div>
</article>

<article class="card hidden" data-index="13">
  <div class="card-content">
    <h3 class="card-title">The Amazing Spider-Man 2 (2014)</h3>
    <p class="card-body">Suite sur consoles et PC avec nouveau scénario.</p>
    <img class="hero-img" src="spiderman_asm2.jpg" alt="The Amazing Spider-Man 2" />
  </div>
</article>

<!-- Insomniac Games -->
<article class="card hidden" data-index="14">
  <div class="card-content">
    <h3 class="card-title">Marvel’s Spider-Man (2018)</h3>
    <p class="card-body">Open-world PS4 / PS5 / PC avec histoire originale.</p>
    <img class="hero-img" src="spiderman_ps4.jpg" alt="Marvel's Spider-Man 2018" />
  </div>
</article>

<article class="card hidden" data-index="15">
  <div class="card-content">
    <h3 class="card-title">Marvel’s Spider-Man: Miles Morales (2020)</h3>
    <p class="card-body">Spin-off centré sur Miles Morales avec nouvelles missions.</p>
    <img class="hero-img" src="spiderman_mm.jpg" alt="Spider-Man Miles Morales" />
  </div>
</article>

<article class="card hidden" data-index="16">
  <div class="card-content">
    <h3 class="card-title">Marvel’s Spider-Man 2 (2023)</h3>
    <p class="card-body">Suite massive sur PS5 avec Peter Parker et Miles Morales.</p>
    <img class="hero-img" src="spiderman_2_2023.jpg" alt="Marvel's Spider-Man 2" />
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
      <div>© <span id="year"></span> Ton site — Spider-Man Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
