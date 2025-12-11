<?php
/**
 * superman.php
 * Page séquentielle pour afficher les films Superman
 */
?><!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="Détails des films Superman : descriptions et navigation séquentielle entre cartes." />
  <title>Classeur - Film: Superman</title>

  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">S</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de film</strong>
          <small class="site-sub">Superman</small>
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
        <h1 id="hero-title">Rapport sur les films Superman</h1>
        <p class="lead">Découvre les aventures de l’Homme d’Acier. Clique sur "Continuer" pour afficher la première carte, puis navigue séquentiellement.</p>

        <p class="cta">
          <button class="btn primary" id="startBtn" aria-controls="cardsContainer" aria-expanded="false">Continuer</button>
        </p>
      </div>

      <div class="hero-illustration" aria-hidden="false">
        <picture>
          <source srcset="superman.jpg" type="image/jpeg">
          <img class="hero-img" src="superman.jpg" alt="Superman en vol" />
        </picture>
      </div>
    </section>

    <section class="grid progressive-cards" aria-label="Films Superman" id="cardsContainer" data-persist-key="superman-sequence">
      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

      <!-- Superman (1978) -->
      <article class="card hidden" data-index="0" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Superman (1978)</h3>
          <p class="card-body">Clark Kent découvre ses pouvoirs et devient Superman pour protéger Metropolis contre Lex Luthor.</p>
          <source srcset="s1.jpg" type="image/jpeg">
          <img class="hero-img" src="s1.jpg" alt="Attaque des clones" />
        </div>
      </article>

      <!-- Superman II (1980) -->
      <article class="card hidden" data-index="1" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Superman II (1980)</h3>
          <p class="card-body">Superman affronte les criminels kryptoniens menés par le Général Zod.</p>
          <source srcset="s2.jpg" type="image/jpeg">
          <img class="hero-img" src="s2.jpg" alt="Attaque des clones" />
        </div>
      </article>

      <!-- Superman III (1983) -->
      <article class="card hidden" data-index="2" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Superman III (1983)</h3>
          <p class="card-body">Superman doit faire face à un nouvel ennemi et à ses propres faiblesses.</p>
          <source srcset="s3.jpg" type="image/jpeg">
          <img class="hero-img" src="s3.jpg" alt="Attaque des clones" />
        </div>
      </article>

      <!-- Superman IV (1987) -->
      <article class="card hidden" data-index="3" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Superman IV: The Quest for Peace (1987)</h3>
          <p class="card-body">Superman tente d’éliminer toutes les armes nucléaires de la Terre.</p>
          <source srcset="s4.jpg" type="image/jpeg">
          <img class="hero-img" src="s4.jpg" alt="Attaque des clones" />
        </div>
      </article>

      <!-- Superman Returns (2006) -->
      <article class="card hidden" data-index="4" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Superman Returns (2006)</h3>
          <p class="card-body">Après une longue absence, Superman revient sur Terre pour sauver l’humanité et retrouver Lois Lane.</p>
          <source srcset="sr.jpg" type="image/jpeg">
          <img class="hero-img" src="sr.jpg" alt="Attaque des clones" />
        </div>
      </article>

      <!-- Man of Steel (2013) -->
      <article class="card hidden" data-index="5" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Man of Steel (2013)</h3>
          <p class="card-body">Nouvelle version où Superman affronte le Général Zod et accepte son rôle de protecteur.</p>
          <source srcset="mos.jpg" type="image/jpeg">
          <img class="hero-img" src="mos.jpg" alt="Attaque des clones" />
        </div>
      </article>

      <!-- Batman v Superman (2016) -->
      <article class="card hidden" data-index="6" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Batman v Superman: Dawn of Justice (2016)</h3>
          <source srcset="batmanvss.jpg" type="image/jpeg">
          <img class="hero-img" src="batmanvss.jpg" alt="Attaque des clones" />
        </div>
      </article>


      <!-- Superman: Legacy (2025) -->
      <article class="card hidden" data-index="9" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Superman: Legacy (2025)</h3>
          <p class="card-body">Prochain film réalisé par James Gunn, une nouvelle interprétation de l’Homme d’Acier.</p>
          <source srcset="sl25.jpg" type="image/jpeg">
          <img class="hero-img" src="sl25.jpg" alt="Attaque des clones" />
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
      <div>© <span id="year"></span> Ton site — Superman Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
