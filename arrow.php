<?php
/**
 * arrow.php
 * Page séquentielle pour afficher la série Arrow
 */
?><!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="Détails de la série Arrow : descriptions et navigation séquentielle entre cartes." />
  <title>Classeur - Série: Arrow</title>

  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">🏹</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de série</strong>
          <small class="site-sub">Arrow</small>
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
        <h1 id="hero-title">Rapport sur la série Arrow</h1>
        <p class="lead">Découvre les aventures d’Oliver Queen. Clique sur "Continuer" pour afficher la première carte, puis navigue séquentiellement.</p>

        <p class="cta">
          <button class="btn primary" id="startBtn" aria-controls="cardsContainer" aria-expanded="false">Continuer</button>
        </p>
      </div>

      <div class="hero-illustration" aria-hidden="false">
        <picture>
          <source srcset="arrow.jpg" type="image/jpeg">
          <img class="hero-img" src="arrow.jpg" alt="Logo Arrow" />
        </picture>
      </div>
    </section>

    <section class="grid progressive-cards" aria-label="Saisons Arrow" id="cardsContainer" data-persist-key="arrow-sequence">
      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

      <!-- Saison 1 -->
      <article class="card hidden" data-index="0" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 1 (2012)</h3>
          <p>Oliver Queen revient à Starling City après 5 ans sur une île et devient Arrow.</p>
          <img src="arrow1.jpg" alt="Arrow Saison 1" />
        </div>
      </article>

      <!-- Saison 2 -->
      <article class="card hidden" data-index="1" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 2 (2013)</h3>
          <p>Oliver affronte Deathstroke et doit protéger sa famille et sa ville.</p>
          <img src="arrow2.jpg" alt="Arrow Saison 2" />
        </div>
      </article>

      <!-- Saison 3 -->
      <article class="card hidden" data-index="2" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 3 (2014)</h3>
          <p>Ra’s al Ghul défie Oliver et menace Starling City.</p>
          <img src="arrow3.jpg" alt="Arrow Saison 3" />
        </div>
      </article>

      <!-- Saison 4 -->
      <article class="card hidden" data-index="3" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 4 (2015)</h3>
          <p>Oliver affronte Damien Darhk et son organisation H.I.V.E.</p>
          <img src="arrow4.jpg" alt="Arrow Saison 4" />
        </div>
      </article>

      <!-- Saison 5 -->
      <article class="card hidden" data-index="4" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 5 (2016)</h3>
          <p>Prometheus devient l’ennemi juré d’Oliver et révèle ses secrets.</p>
          <img src="arrow5.jpg" alt="Arrow Saison 5" />
        </div>
      </article>

      <!-- Saison 6 -->
      <article class="card hidden" data-index="5" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 6 (2017)</h3>
          <p>Oliver affronte Ricardo Diaz et lutte pour protéger son équipe.</p>
          <img src="arrow6.jpg" alt="Arrow Saison 6" />
        </div>
      </article>

      <!-- Saison 7 -->
      <article class="card hidden" data-index="6" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 7 (2018)</h3>
          <p>Oliver est emprisonné et doit affronter ses ennemis derrière les barreaux.</p>
          <img src="arrow7.jpg" alt="Arrow Saison 7" />
        </div>
      </article>

      <!-- Saison 8 -->
      <article class="card hidden" data-index="7" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 8 (2019)</h3>
          <p>Dernière saison où Oliver se sacrifie lors de Crisis on Infinite Earths.</p>
          <img src="arrow8.jpg" alt="Arrow Saison 8" />
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
      <div>© <span id="year"></span> Ton site — Arrow Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
