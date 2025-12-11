<?php
/**
 * supermanandlois.php
 * Page séquentielle pour afficher la série Superman & Lois
 */
?><!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="Détails de la série Superman & Lois : descriptions et navigation séquentielle entre cartes." />
  <title>Classeur - Série: Superman & Lois</title>
  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>
  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">🦸‍♂️</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de série</strong>
          <small class="site-sub">Superman & Lois</small>
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
        <h1 id="hero-title">Rapport sur la série Superman & Lois</h1>
        <p class="lead">Le quotidien de Clark et Lois à Smallville. Clique sur "Continuer" pour afficher la première carte, puis navigue séquentiellement.</p>
        <p class="cta">
          <button class="btn primary" id="startBtn" aria-controls="cardsContainer" aria-expanded="false">Continuer</button>
        </p>
      </div>
      <div class="hero-illustration" aria-hidden="false">
        <picture>
          <source srcset="supermanlois.jpg" type="image/jpeg">
          <img class="hero-img" src="supermanlois.jpg" alt="Logo Superman & Lois" />
        </picture>
      </div>
    </section>

    <section class="grid progressive-cards" aria-label="Saisons Superman & Lois" id="cardsContainer" data-persist-key="supermanlois-sequence">
      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

      <article class="card hidden" data-index="0">
        <div class="card-content">
          <h3>Saison 1 (2021)</h3>
          <p>La famille Kent s’installe à Smallville et affronte Captain Luthor / Steel.</p>
          <img src="supermanlois1.jpg" alt="Superman & Lois Saison 1" />
        </div>
      </article>

      <article class="card hidden" data-index="1">
        <div class="card-content">
          <h3>Saison 2 (2022)</h3>
          <p>Des événements surnaturels autour de la mine réveillent une menace kryptonienne.</p>
          <img src="supermanlois2.jpg" alt="Superman & Lois Saison 2" />
        </div>
      </article>

      <article class="card hidden" data-index="2">
        <div class="card-content">
          <h3>Saison 3 (2023)</h3>
          <p>La famille fait face à une épreuve majeure tandis que Bruno Mannheim sévit à Metropolis.</p>
          <img src="supermanlois3.jpg" alt="Superman & Lois Saison 3" />
        </div>
      </article>

      <article class="card hidden" data-index="3">
        <div class="card-content">
          <h3>Saison 4 (2024)</h3>
          <p>Conclusion des arcs, Superman affronte Lex Luthor et de nouvelles menaces.</p>
          <img src="supermanlois4.jpg" alt="Superman & Lois Saison 4" />
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
      <div>© <span id="year"></span> Ton site — Superman & Lois Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
