<?php
/**
 * batwoman.php
 * Page séquentielle pour afficher la série Batwoman
 */
?><!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="Détails de la série Batwoman : descriptions et navigation séquentielle entre cartes." />
  <title>Classeur - Série: Batwoman</title>
  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>
  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">🦇</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de série</strong>
          <small class="site-sub">Batwoman</small>
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
        <h1 id="hero-title">Rapport sur la série Batwoman</h1>
        <p class="lead">Gotham a besoin d’une nouvelle chevalière. Clique sur "Continuer" pour afficher la première carte, puis navigue séquentiellement.</p>
        <p class="cta">
          <button class="btn primary" id="startBtn" aria-controls="cardsContainer" aria-expanded="false">Continuer</button>
        </p>
      </div>
      <div class="hero-illustration" aria-hidden="false">
        <picture>
          <source srcset="batwoman.jpg" type="image/jpeg">
          <img class="hero-img" src="batwoman.jpg" alt="Logo Batwoman" />
        </picture>
      </div>
    </section>

    <section class="grid progressive-cards" aria-label="Saisons Batwoman" id="cardsContainer" data-persist-key="batwoman-sequence">
      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

      <article class="card hidden" data-index="0" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 1 (2019)</h3>
          <p>Kate Kane endosse le costume de Batwoman pour défendre Gotham contre Alice.</p>
          <img src="batwoman1.jpg" alt="Batwoman Saison 1" />
        </div>
      </article>

      <article class="card hidden" data-index="1" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 2 (2021)</h3>
          <p>Ryan Wilder devient la nouvelle Batwoman et affronte Safiyah et Black Mask.</p>
          <img src="batwoman2.jpg" alt="Batwoman Saison 2" />
        </div>
      </article>

      <article class="card hidden" data-index="2" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 3 (2021–2022)</h3>
          <p>La Bat-Team traque des artefacts criminels issus de la galerie de Batman.</p>
          <img src="batwoman3.jpg" alt="Batwoman Saison 3" />
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
      <div>© <span id="year"></span> Ton site — Batwoman Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
