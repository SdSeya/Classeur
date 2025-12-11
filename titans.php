<?php
/**
 * titans.php
 * Page séquentielle pour afficher la série Titans
 */
?><!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="Détails de la série Titans : descriptions et navigation séquentielle entre cartes." />
  <title>Classeur - Série: Titans</title>
  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>
  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">🦅</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de série</strong>
          <small class="site-sub">Titans</small>
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
        <h1 id="hero-title">Rapport sur la série Titans</h1>
        <p class="lead">Dick Grayson mène une équipe de jeunes héros. Clique sur "Continuer" pour afficher la première carte, puis navigue séquentiellement.</p>
        <p class="cta">
          <button class="btn primary" id="startBtn" aria-controls="cardsContainer" aria-expanded="false">Continuer</button>
        </p>
      </div>
      <div class="hero-illustration" aria-hidden="false">
        <picture>
          <source srcset="titans.jpg" type="image/jpeg">
          <img class="hero-img" src="titans.jpg" alt="Logo Titans" />
        </picture>
      </div>
    </section>

    <section class="grid progressive-cards" aria-label="Saisons Titans" id="cardsContainer" data-persist-key="titans-sequence">
      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

      <?php
      $saisons = [
        ["Saison 1 (2018)", "Dick rencontre Rachel, Kory et Gar; naissance des Titans.", "titans1.jpg"],
        ["Saison 2 (2019)", "La team affronte Deathstroke et les fantômes du passé.", "titans2.jpg"],
        ["Saison 3 (2021)", "Les Titans vont à Gotham; Red Hood et Scarecrow menacent la ville.", "titans3.jpg"],
        ["Saison 4 (2022–2023)", "Brother Blood et Mother Mayhem défient les Titans.", "titans4.jpg"],
      ];
      foreach ($saisons as $i => $s) {
        echo '<article class="card hidden" data-index="'.$i.'" tabindex="0" role="button" aria-expanded="false">
                <div class="card-content">
                  <h3>'.$s[0].'</h3>
                  <p>'.$s[1].'</p>
                  <img src="'.$s[2].'" alt="Titans '.$s[0].'" />
                </div>
              </article>';
      }
      ?>
    </section>

    <div class="controls" style="margin-top:0.8rem">
      <button id="resetCards" class="btn ghost">Réinitialiser</button>
      <button id="revealAll" class="btn">Afficher tout</button>
    </div>
  </main>

  <footer class="site-footer" role="contentinfo">
    <div class="container footer-inner">
      <div>© <span id="year"></span> Ton site — Titans Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
