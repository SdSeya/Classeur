<?php
/**
 * flash.php
 * Page séquentielle pour afficher la série The Flash
 */
?><!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="Détails de la série The Flash : descriptions et navigation séquentielle entre cartes." />
  <title>Classeur - Série: The Flash</title>

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
          <small class="site-sub">The Flash</small>
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
        <h1 id="hero-title">Rapport sur la série The Flash</h1>
        <p class="lead">Découvre les aventures de Barry Allen. Clique sur "Continuer" pour afficher la première carte, puis navigue séquentiellement.</p>

        <p class="cta">
          <button class="btn primary" id="startBtn" aria-controls="cardsContainer" aria-expanded="false">Continuer</button>
        </p>
      </div>

      <div class="hero-illustration" aria-hidden="false">
        <picture>
          <source srcset="flash.jpg" type="image/jpeg">
          <img class="hero-img" src="flash.jpg" alt="Logo The Flash" />
        </picture>
      </div>
    </section>

    <section class="grid progressive-cards" aria-label="Saisons The Flash" id="cardsContainer" data-persist-key="flash-sequence">
      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

      <!-- Saison 1 -->
      <article class="card hidden" data-index="0" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 1 (2014)</h3>
          <p>Barry Allen devient The Flash après un accident et affronte Reverse-Flash.</p>
          <img src="flashs1.jpg" alt="The Flash Saison 1" />
        </div>
      </article>

      <!-- Saison 2 -->
      <article class="card hidden" data-index="1" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 2 (2015)</h3>
          <p>Barry affronte Zoom et découvre l’existence du multivers.</p>
          <img src="flashs2.jpg" alt="The Flash Saison 2" />
        </div>
      </article>

      <!-- Saison 3 -->
      <article class="card hidden" data-index="2" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 3 (2016)</h3>
          <p>Barry fait face aux conséquences de Flashpoint et affronte Savitar.</p>
          <img src="flashs3.jpg" alt="The Flash Saison 3" />
        </div>
      </article>

      <!-- Saison 4 -->
      <article class="card hidden" data-index="3" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 4 (2017)</h3>
          <p>Barry affronte DeVoe, le Penseur, un ennemi redoutable.</p>
          <img src="flashs4.jpg" alt="The Flash Saison 4" />
        </div>
      </article>

      <!-- Saison 5 -->
      <article class="card hidden" data-index="4" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 5 (2018)</h3>
          <p>Barry rencontre sa fille Nora venue du futur et affronte Cicada.</p>
          <img src="flashs5.jpg" alt="The Flash Saison 5" />
        </div>
      </article>

      <!-- Saison 6 -->
      <article class="card hidden" data-index="5" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 6 (2019)</h3>
          <p>Barry affronte Bloodwork et se prépare à Crisis on Infinite Earths.</p>
          <img src="flashs6.jpg" alt="The Flash Saison 6" />
        </div>
      </article>

      <!-- Saison 7 -->
      <article class="card hidden" data-index="6" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 7 (2021)</h3>
          <p>Barry combat les Forces et affronte Godspeed.</p>
          <img src="flashs7.jpg" alt="The Flash Saison 7" />
        </div>
      </article>

      <!-- Saison 8 -->
      <article class="card hidden" data-index="7" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 8 (2022)</h3>
          <p>Barry affronte Armageddon et continue de protéger Central City.</p>
          <img src="flashs8.jpg" alt="The Flash Saison 8" />
        </div>
      </article>

      <!-- Saison 9 -->
      <article class="card hidden" data-index="8" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Saison 9 (2023)</h3>
          <p>Dernière saison où Barry affronte ses ultimes ennemis et conclut son histoire.</p>
          <img src="flashs9.jpg" alt="The Flash Saison 9" />
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
      <div>© <span id="year"></span> Ton site — The Flash Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
