<?php
/**
 * legendsoftomorrow.php
 * Page séquentielle pour afficher la série DC's Legends of Tomorrow
 */
?><!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="Détails de la série DC's Legends of Tomorrow : descriptions et navigation séquentielle entre cartes." />
  <title>Classeur - Série: Legends of Tomorrow</title>

  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">⏳</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de série</strong>
          <small class="site-sub">Legends of Tomorrow</small>
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
        <h1 id="hero-title">Rapport sur la série Legends of Tomorrow</h1>
        <p class="lead">Découvre les aventures des Légendes à travers le temps. Clique sur "Continuer" pour afficher la première carte, puis navigue séquentiellement.</p>

        <p class="cta">
          <button class="btn primary" id="startBtn" aria-controls="cardsContainer" aria-expanded="false">Continuer</button>
        </p>
      </div>

      <div class="hero-illustration" aria-hidden="false">
        <picture>
          <source srcset="legends.jpg" type="image/jpeg">
          <img class="hero-img" src="legends.jpg" alt="Logo Legends of Tomorrow" />
        </picture>
      </div>
    </section>

    <section class="grid progressive-cards" aria-label="Saisons Legends of Tomorrow" id="cardsContainer" data-persist-key="legends-sequence">
      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

      <!-- Saison 1 -->
      <article class="card hidden" data-index="0" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 1 (2016)</h3>
          <p>Rip Hunter recrute des héros et des anti‑héros pour affronter Vandal Savage.</p>
          <img src="legends1.jpg" alt="Legends Saison 1" />
        </div>
      </article>

      <!-- Saison 2 -->
      <article class="card hidden" data-index="1" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 2 (2016‑2017)</h3>
          <p>Les Légendes affrontent la Legion of Doom et voyagent dans le temps.</p>
          <img src="legends2.jpg" alt="Legends Saison 2" />
        </div>
      </article>

      <!-- Saison 3 -->
      <article class="card hidden" data-index="2" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 3 (2017‑2018)</h3>
          <p>Les Légendes réparent les anomalies temporelles et affrontent Mallus.</p>
          <img src="legends3.jpg" alt="Legends Saison 3" />
        </div>
      </article>

      <!-- Saison 4 -->
      <article class="card hidden" data-index="3" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 4 (2018‑2019)</h3>
          <p>Les Légendes affrontent des créatures magiques libérées dans le temps.</p>
          <img src="legends4.jpg" alt="Legends Saison 4" />
        </div>
      </article>

      <!-- Saison 5 -->
      <article class="card hidden" data-index="4" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 5 (2020)</h3>
          <p>Les Légendes affrontent les Encores, des âmes criminelles revenues du passé.</p>
          <img src="legends5.jpg" alt="Legends Saison 5" />
        </div>
      </article>

      <!-- Saison 6 -->
      <article class="card hidden" data-index="5" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 6 (2021)</h3>
          <p>Les Légendes affrontent une invasion extraterrestre.</p>
          <img src="legends6.jpg" alt="Legends Saison 6" />
        </div>
      </article>

      <!-- Saison 7 -->
      <article class="card hidden" data-index="6" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 7 (2021‑2022)</h3>
          <p>Dernière saison où les Légendes sont piégées dans le passé sans leur vaisseau temporel.</p>
          <img src="legends7.jpg" alt="Legends Saison 7" />
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
      <div>© <span id="year"></span> Ton site — Legends of Tomorrow Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
