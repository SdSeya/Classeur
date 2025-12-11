<?php
/**
 * starwars.php
 * Page séquentielle pour afficher les films Star Wars
 */
?><!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="Détails des films Star Wars : descriptions et navigation séquentielle entre cartes." />
  <title>Classeur - Film: Star Wars</title>

  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">★</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de film</strong>
          <small class="site-sub">Star Wars</small>
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
        <h1 id="hero-title">Rapport sur les films Star Wars</h1>
        <p class="lead">Revivez la saga intergalactique. Clique sur "Continuer" pour afficher la première carte, puis navigue séquentiellement.</p>

        <p class="cta">
          <button class="btn primary" id="startBtn" aria-controls="cardsContainer" aria-expanded="false">Continuer</button>
        </p>
      </div>

      <div class="hero-illustration" aria-hidden="false">
        <picture>
          <source srcset="sw.jpg" type="image/jpeg">
          <img class="hero-img" src="sw.jpg" alt="Logo Star Wars" />
        </picture>
      </div>
    </section>

    <section class="grid progressive-cards" aria-label="Films Star Wars" id="cardsContainer" data-persist-key="starwars-sequence">
      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

      <!-- Épisode IV -->
      <article class="card hidden" data-index="0" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Un nouvel espoir (1977)</h3>
          <p>Luke Skywalker rejoint la Rébellion pour détruire l’Étoile de la Mort.</p>
          <source srcset="sw1977.jpg" type="image/jpeg">
          <img class="hero-img" src="sw1977.jpg" alt="Star Wars 1977" />
        </div>
      </article>

      <!-- Épisode V -->
      <article class="card hidden" data-index="1" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>L’Empire contre-attaque (1980)</h3>
          <p>Les rebelles affrontent l’Empire, Luke découvre la vérité sur Dark Vador.</p>
          <source srcset="sw1980.jpg" type="image/jpeg">
          <img class="hero-img" src="sw1980.jpg" alt="Empire contre-attaque" />
        </div>
      </article>

      <!-- Épisode VI -->
      <article class="card hidden" data-index="2" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Le Retour du Jedi (1983)</h3>
          <p>Luke affronte Vador et l’Empereur, l’Alliance détruit la seconde Étoile de la Mort.</p>
          <source srcset="sw1983.jpg" type="image/jpeg">
          <img class="hero-img" src="sw1983.jpg" alt="Retour du Jedi" />
        </div>
      </article>

      <!-- Épisode I -->
      <article class="card hidden" data-index="3" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>La Menace fantôme (1999)</h3>
          <p>Les Jedi découvrent Anakin Skywalker et affrontent Dark Maul.</p>
          <source srcset="sw1999.jpg" type="image/jpeg">
          <img class="hero-img" src="sw1999.jpg" alt="Menace fantôme" />
        </div>
      </article>

      <!-- Épisode II -->
      <article class="card hidden" data-index="4" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>L’Attaque des clones (2002)</h3>
          <p>Anakin et Padmé se rapprochent, la guerre des clones commence.</p>
          <source srcset="sw2002.jpg" type="image/jpeg">
          <img class="hero-img" src="sw2002.jpg" alt="Attaque des clones" />
        </div>
      </article>

      <!-- Épisode III -->
      <article class="card hidden" data-index="5" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>La Revanche des Sith (2005)</h3>
          <p>Anakin bascule du côté obscur et devient Dark Vador.</p>
          <source srcset="sw2005.jpg" type="image/jpeg">
          <img class="hero-img" src="sw2005.jpg" alt="Revanche des Sith" />
        </div>
      </article>

      <!-- Épisode VII -->
      <article class="card hidden" data-index="6" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Le Réveil de la Force (2015)</h3>
          <p>Rey découvre ses pouvoirs, Kylo Ren menace la galaxie.</p>
          <source srcset="sw2015.jpg" type="image/jpeg">
          <img class="hero-img" src="sw2015.jpg" alt="Réveil de la Force" />
        </div>
      </article>

      <!-- Épisode VIII -->
      <article class="card hidden" data-index="7" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Les Derniers Jedi (2017)</h3>
          <p>Rey s’entraîne avec Luke, la Résistance lutte contre le Premier Ordre.</p>
          <source srcset="sw2017.jpg" type="image/jpeg">
          <img class="hero-img" src="sw2017.jpg" alt="Derniers Jedi" />
        </div>
      </article>

      <!-- Épisode IX -->
      <article class="card hidden" data-index="8" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>L’Ascension de Skywalker (2019)</h3>
          <p>Rey affronte Palpatine, la saga Skywalker se conclut.</p>
          <source srcset="sw2019.jpg" type="image/jpeg">
          <img class="hero-img" src="sw2019.jpg" alt="Ascension de Skywalker" />
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
      <div>© <span id="year"></span> Ton site — Star Wars Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
