<?php
/**
 * blacklightning.php
 * Page séquentielle pour afficher la série Black Lightning
 */
?><!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="Détails de la série Black Lightning : descriptions et navigation séquentielle entre cartes." />
  <title>Classeur - Série: Black Lightning</title>

  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">⚡</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de série</strong>
          <small class="site-sub">Black Lightning</small>
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
        <h1 id="hero-title">Rapport sur la série Black Lightning</h1>
        <p class="lead">Découvre les aventures de Jefferson Pierce alias Black Lightning. Clique sur "Continuer" pour afficher la première carte, puis navigue séquentiellement.</p>

        <p class="cta">
          <button class="btn primary" id="startBtn" aria-controls="cardsContainer" aria-expanded="false">Continuer</button>
        </p>
      </div>

      <div class="hero-illustration" aria-hidden="false">
        <picture>
          <source srcset="blacklightning.jpg" type="image/jpeg">
          <img class="hero-img" src="blacklightning.jpg" alt="Logo Black Lightning" />
        </picture>
      </div>
    </section>

    <section class="grid progressive-cards" aria-label="Saisons Black Lightning" id="cardsContainer" data-persist-key="blacklightning-sequence">
      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

      <!-- Saison 1 -->
      <article class="card hidden" data-index="0" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 1 (2018)</h3>
          <p>Jefferson Pierce reprend son identité de Black Lightning pour protéger sa famille et sa ville.</p>
          <img src="bl1.jpg" alt="Black Lightning Saison 1" />
        </div>
      </article>

      <!-- Saison 2 -->
      <article class="card hidden" data-index="1" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 2 (2018‑2019)</h3>
          <p>Jefferson affronte de nouvelles menaces et ses filles découvrent leurs pouvoirs.</p>
          <img src="bl2.jpg" alt="Black Lightning Saison 2" />
        </div>
      </article>

      <!-- Saison 3 -->
      <article class="card hidden" data-index="2" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 3 (2019‑2020)</h3>
          <p>Black Lightning combat Markovia et participe à Crisis on Infinite Earths.</p>
          <img src="bl3.jpg" alt="Black Lightning Saison 3" />
        </div>
      </article>

      <!-- Saison 4 -->
      <article class="card hidden" data-index="3" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 4 (2021)</h3>
          <p>Dernière saison où Jefferson affronte Tobias Whale et conclut son histoire.</p>
          <img src="bl4.jpg" alt="Black Lightning Saison 4" />
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
      <div>© <span id="year"></span> Ton site — Black Lightning Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
