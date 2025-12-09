<?php
/**
 * lordoftherings.php
 * Page séquentielle pour afficher les films Le Seigneur des Anneaux et Le Hobbit
 */
?><!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="Détails des films Le Seigneur des Anneaux et Le Hobbit : descriptions et navigation séquentielle entre cartes." />
  <title>Classeur - Film: Le Seigneur des Anneaux</title>

  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">💍</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de film</strong>
          <small class="site-sub">Le Seigneur des Anneaux</small>
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
        <h1 id="hero-title">Rapport sur les films Le Seigneur des Anneaux</h1>
        <p class="lead">Revivez l’épopée de la Terre du Milieu. Clique sur "Continuer" pour afficher la première carte, puis navigue séquentiellement.</p>

        <p class="cta">
          <button class="btn primary" id="startBtn" aria-controls="cardsContainer" aria-expanded="false">Continuer</button>
        </p>
      </div>

      <div class="hero-illustration" aria-hidden="false">
        <picture>
          <source srcset="lotr.jpg" type="image/jpeg">
          <img class="hero-img" src="lotr.jpg" alt="Logo Seigneur des Anneaux" />
        </picture>
      </div>
    </section>

    <section class="grid progressive-cards" aria-label="Films Seigneur des Anneaux" id="cardsContainer" data-persist-key="lotr-sequence">
      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

      <!-- La Communauté de l’Anneau (2001) -->
      <article class="card hidden" data-index="0" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>La Communauté de l’Anneau (2001)</h3>
          <p>Frodon reçoit l’Anneau Unique et part en quête pour le détruire.</p>
          <source srcset="lotr1.jpg" type="image/jpeg">
          <img class="hero-img" src="lotr1.jpg" alt="Logo Seigneur des Anneaux" />
        </div>
      </article>

      <!-- Les Deux Tours (2002) -->
      <article class="card hidden" data-index="1" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Les Deux Tours (2002)</h3>
          <p>La Communauté est séparée, Aragorn mène la bataille du Gouffre de Helm.</p>
          <source srcset="lotr2.jpg" type="image/jpeg">
          <img class="hero-img" src="lotr2.jpg" alt="Logo Seigneur des Anneaux" />
        </div>
      </article>

      <!-- Le Retour du Roi (2003) -->
      <article class="card hidden" data-index="2" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Le Retour du Roi (2003)</h3>
          <p>La bataille finale pour la Terre du Milieu et la destruction de l’Anneau.</p>
          <source srcset="lotr3.jpg" type="image/jpeg">
          <img class="hero-img" src="lotr3.jpg" alt="Logo Seigneur des Anneaux" />
        </div>
      </article>

      <!-- Le Hobbit : Un voyage inattendu (2012) -->
      <article class="card hidden" data-index="3" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Le Hobbit : Un voyage inattendu (2012)</h3>
          <p>Bilbo Baggins rejoint les nains pour reprendre Erebor au dragon Smaug.</p>
          <source srcset="ho1.jpg" type="image/jpeg">
          <img class="hero-img" src="ho1.jpg" alt="Logo Seigneur des Anneaux" />
        </div>
      </article>

      <!-- Le Hobbit : La Désolation de Smaug (2013) -->
      <article class="card hidden" data-index="4" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Le Hobbit : La Désolation de Smaug (2013)</h3>
          <p>Bilbo affronte Smaug dans la montagne solitaire.</p>
          <source srcset="ho2.jpg" type="image/jpeg">
          <img class="hero-img" src="ho2.jpg" alt="Logo Seigneur des Anneaux" />
        </div>
      </article>

      <!-- Le Hobbit : La Bataille des Cinq Armées (2014) -->
      <article class="card hidden" data-index="5" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Le Hobbit : La Bataille des Cinq Armées (2014)</h3>
          <p>Les peuples de la Terre du Milieu s’affrontent pour le contrôle d’Erebor.</p>
          <source srcset="ho3.jpg" type="image/jpeg">
          <img class="hero-img" src="ho3.jpg" alt="Logo Seigneur des Anneaux" />
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
      <div>© <span id="year"></span> Ton site — Seigneur des Anneaux Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
