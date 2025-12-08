<?php
/**
 * harrypotter.php
 * Page séquentielle pour afficher les films Harry Potter
 */
?><!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="Détails des films Harry Potter : descriptions et navigation séquentielle entre cartes." />
  <title>Classeur - Film: Harry Potter</title>

  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">⚡</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de film</strong>
          <small class="site-sub">Harry Potter</small>
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
        <h1 id="hero-title">Rapport sur les films Harry Potter</h1>
        <p class="lead">Revivez la magie de Poudlard. Clique sur "Continuer" pour afficher la première carte, puis navigue séquentiellement.</p>

        <p class="cta">
          <button class="btn primary" id="startBtn" aria-controls="cardsContainer" aria-expanded="false">Continuer</button>
        </p>
      </div>

      <div class="hero-illustration" aria-hidden="false">
        <picture>
          <source srcset="harrypotter.jpg" type="image/jpeg">
          <img class="hero-img" src="harrypotter.jpg" alt="Logo Harry Potter" />
        </picture>
      </div>
    </section>

    <section class="grid progressive-cards" aria-label="Films Harry Potter" id="cardsContainer" data-persist-key="harrypotter-sequence">
      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

      <!-- Harry Potter à l'école des sorciers (2001) -->
      <article class="card hidden" data-index="0" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Harry Potter à l'école des sorciers (2001)</h3>
          <p>Harry découvre qu’il est un sorcier et entre à Poudlard.</p>
          <img src="hp2001.jpg" alt="Harry Potter 2001" />
        </div>
      </article>

      <!-- Harry Potter et la Chambre des secrets (2002) -->
      <article class="card hidden" data-index="1" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Harry Potter et la Chambre des secrets (2002)</h3>
          <p>Harry affronte le Basilic et découvre le journal de Jedusor.</p>
          <img src="hp2002.jpg" alt="Harry Potter 2002" />
        </div>
      </article>

      <!-- Harry Potter et le Prisonnier d’Azkaban (2004) -->
      <article class="card hidden" data-index="2" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Harry Potter et le Prisonnier d’Azkaban (2004)</h3>
          <p>Harry rencontre Sirius Black et découvre la vérité sur son passé.</p>
          <img src="hp2004.jpg" alt="Harry Potter 2004" />
        </div>
      </article>

      <!-- Harry Potter et la Coupe de feu (2005) -->
      <article class="card hidden" data-index="3" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Harry Potter et la Coupe de feu (2005)</h3>
          <p>Harry participe au Tournoi des Trois Sorciers et affronte Voldemort.</p>
          <img src="hp2005.jpg" alt="Harry Potter 2005" />
        </div>
      </article>

      <!-- Harry Potter et l’Ordre du Phénix (2007) -->
      <article class="card hidden" data-index="4" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Harry Potter et l’Ordre du Phénix (2007)</h3>
          <p>Harry fonde l’Armée de Dumbledore et affronte Dolores Ombrage.</p>
          <img src="hp2007.jpg" alt="Harry Potter 2007" />
        </div>
      </article>

      <!-- Harry Potter et le Prince de sang-mêlé (2009) -->
      <article class="card hidden" data-index="5" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Harry Potter et le Prince de sang-mêlé (2009)</h3>
          <p>Harry découvre les Horcruxes et la vérité sur Voldemort.</p>
          <img src="hp2009.jpg" alt="Harry Potter 2009" />
        </div>
      </article>

      <!-- Harry Potter et les Reliques de la Mort – Partie 1 (2010) -->
      <article class="card hidden" data-index="6" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Harry Potter et les Reliques de la Mort – Partie 1 (2010)</h3>
          <p>Harry, Ron et Hermione partent à la recherche des Horcruxes.</p>
          <img src="hp2010.jpg" alt="Harry Potter 2010" />
        </div>
      </article>

      <!-- Harry Potter et les Reliques de la Mort – Partie 2 (2011) -->
      <article class="card hidden" data-index="7" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Harry Potter et les Reliques de la Mort – Partie 2 (2011)</h3>
          <p>La bataille finale à Poudlard oppose Harry à Voldemort.</p>
          <img src="hp2011.jpg" alt="Harry Potter 2011" />
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
      <div>© <span id="year"></span> Ton site — Harry Potter Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
