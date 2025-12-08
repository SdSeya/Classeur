<?php
/**
 * fastandfurious.php
 * Page séquentielle pour afficher les films Fast & Furious
 */
?><!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="Détails des films Fast & Furious : descriptions et navigation séquentielle entre cartes." />
  <title>Classeur - Film: Fast & Furious</title>

  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">F</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de film</strong>
          <small class="site-sub">Fast & Furious</small>
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
        <h1 id="hero-title">Rapport sur les films Fast & Furious</h1>
        <p class="lead">Découvre la saga explosive Fast & Furious. Clique sur "Continuer" pour afficher la première carte, puis navigue séquentiellement.</p>

        <p class="cta">
          <button class="btn primary" id="startBtn" aria-controls="cardsContainer" aria-expanded="false">Continuer</button>
        </p>
      </div>

      <div class="hero-illustration" aria-hidden="false">
        <picture>
          <source srcset="fastfurious.jpg" type="image/jpeg">
          <img class="hero-img" src="fastfurious.jpg" alt="Voitures de Fast & Furious" />
        </picture>
      </div>
    </section>

    <section class="grid progressive-cards" aria-label="Films Fast & Furious" id="cardsContainer" data-persist-key="fastfurious-sequence">
      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

      <!-- Fast & Furious (2001) -->
      <article class="card hidden" data-index="0" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">The Fast and the Furious (2001)</h3>
          <p class="card-body">Brian O’Conner infiltre le milieu des courses de rue et rencontre Dominic Toretto.</p>
          <img src="ff2001.jpg" alt="Fast and Furious 2001" />
        </div>
      </article>

      <!-- 2 Fast 2 Furious (2003) -->
      <article class="card hidden" data-index="1" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>2 Fast 2 Furious (2003)</h3>
          <p>Brian s’associe à Roman Pearce pour démanteler un cartel à Miami.</p>
          <img src="ff2003.jpg" alt="2 Fast 2 Furious" />
        </div>
      </article>

      <!-- Tokyo Drift (2006) -->
      <article class="card hidden" data-index="2" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>The Fast and the Furious: Tokyo Drift (2006)</h3>
          <p>Sean Boswell découvre l’univers du drift au Japon.</p>
          <img src="ff2006.jpg" alt="Tokyo Drift" />
        </div>
      </article>

      <!-- Fast & Furious (2009) -->
      <article class="card hidden" data-index="3" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Fast & Furious (2009)</h3>
          <p>Dom et Brian se retrouvent pour affronter un trafiquant de drogue.</p>
          <img src="ff2009.jpg" alt="Fast & Furious 2009" />
        </div>
      </article>

      <!-- Fast Five (2011) -->
      <article class="card hidden" data-index="4" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Fast Five (2011)</h3>
          <p>Dom et son équipe affrontent l’agent Hobbs à Rio de Janeiro.</p>
          <img src="ff2011.jpg" alt="Fast Five" />
        </div>
      </article>

      <!-- Fast & Furious 6 (2013) -->
      <article class="card hidden" data-index="5" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Fast & Furious 6 (2013)</h3>
          <p>L’équipe affronte Owen Shaw et découvre que Letty est en vie.</p>
          <img src="ff2013.jpg" alt="Fast & Furious 6" />
        </div>
      </article>

      <!-- Furious 7 (2015) -->
      <article class="card hidden" data-index="6" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Furious 7 (2015)</h3>
          <p>Deckard Shaw cherche à se venger, l’équipe doit l’arrêter.</p>
          <img src="ff2015.jpg" alt="Furious 7" />
        </div>
      </article>

      <!-- The Fate of the Furious (2017) -->
      <article class="card hidden" data-index="7" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>The Fate of the Furious (2017)</h3>
          <p>Dom trahit son équipe sous l’influence de Cipher.</p>
          <img src="ff2017.jpg" alt="The Fate of the Furious" />
        </div>
      </article>

      <!-- F9 (2021) -->
      <article class="card hidden" data-index="8" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>F9 (2021)</h3>
          <p>Dom affronte son frère Jakob et une nouvelle menace mondiale.</p>
          <img src="ff2021.jpg" alt="F9" />
        </div>
      </article>

      <!-- Fast X (2023) -->
      <article class="card hidden" data-index="9" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Fast X (2023)</h3>
          <p>Dom et sa famille affrontent Dante Reyes, fils d’un ancien ennemi.</p>
          <img src="ff2023.jpg" alt="Fast X" />
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
      <div>© <span id="year"></span> Ton site — Fast & Furious Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
