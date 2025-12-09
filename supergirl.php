<?php
/**
 * supergirl.php
 * Page séquentielle pour afficher la série Supergirl
 */
?><!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="Détails de la série Supergirl : descriptions et navigation séquentielle entre cartes." />
  <title>Classeur - Série: Supergirl</title>

  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">🦸‍♀️</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de série</strong>
          <small class="site-sub">Supergirl</small>
        </div>
      </div>

      <nav class="main-nav" role="navigation" aria-label="Navigation principale">
        <a href="accueil.php" class="nav-link">Accueil</a>
        <a href="movies_list.php" class="nav-link">Films</a>
        <a href="contact.php" class="nav-link">Contact</a>
      </nav>
    </div>
  </header>

  <main class="container" id="main" role="main">
    <section class="hero" aria-labelledby="hero-title">
      <div class="hero-content">
        <h1 id="hero-title">Rapport sur la série Supergirl</h1>
        <p class="lead">Découvre les aventures de Kara Zor-El. Clique sur "Continuer" pour afficher la première carte, puis navigue séquentiellement.</p>

        <p class="cta">
          <button class="btn primary" id="startBtn" aria-controls="cardsContainer" aria-expanded="false">Continuer</button>
        </p>
      </div>

      <div class="hero-illustration" aria-hidden="false">
        <picture>
          <source srcset="supergirl.jpg" type="image/jpeg">
          <img class="hero-img" src="supergirl.jpg" alt="Logo Supergirl" />
        </picture>
      </div>
    </section>

    <section class="grid progressive-cards" aria-label="Saisons Supergirl" id="cardsContainer" data-persist-key="supergirl-sequence">
      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

      <!-- Saison 1 -->
      <article class="card hidden" data-index="0" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 1 (2015)</h3>
          <p>Kara Zor-El, cousine de Superman, révèle ses pouvoirs et devient Supergirl.</p>
          <img src="supergirl1.jpg" alt="Supergirl Saison 1" />
        </div>
      </article>

      <!-- Saison 2 -->
      <article class="card hidden" data-index="1" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 2 (2016)</h3>
          <p>Kara rencontre Superman et affronte Cadmus et Mon-El.</p>
          <img src="supergirl2.jpg" alt="Supergirl Saison 2" />
        </div>
      </article>

      <!-- Saison 3 -->
      <article class="card hidden" data-index="2" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 3 (2017)</h3>
          <p>Supergirl affronte Reign, une Worldkiller redoutable.</p>
          <img src="supergirl3.jpg" alt="Supergirl Saison 3" />
        </div>
      </article>

      <!-- Saison 4 -->
      <article class="card hidden" data-index="3" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 4 (2018)</h3>
          <p>Kara lutte contre l’Agent Liberty et les tensions anti‑aliens.</p>
          <img src="supergirl4.jpg" alt="Supergirl Saison 4" />
        </div>
      </article>

      <!-- Saison 5 -->
      <article class="card hidden" data-index="4" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 5 (2019)</h3>
          <p>Supergirl affronte Leviathan et participe à Crisis on Infinite Earths.</p>
          <img src="supergirl5.jpg" alt="Supergirl Saison 5" />
        </div>
      </article>

      <!-- Saison 6 -->
      <article class="card hidden" data-index="5" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 6 (2021)</h3>
          <p>Dernière saison où Kara affronte Nyxly et conclut son histoire.</p>
          <img src="supergirl6.jpg" alt="Supergirl Saison 6" />
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
      <div>© <span id="year"></span> Ton site — Supergirl Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
