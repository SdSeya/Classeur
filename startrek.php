<?php
/**
 * startrek.php
 * Page séquentielle pour afficher les films Star Trek
 */
?><!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="Détails des films Star Trek : descriptions et navigation séquentielle entre cartes." />
  <title>Classeur - Film: Star Trek</title>

  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">🖖</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de film</strong>
          <small class="site-sub">Star Trek</small>
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
        <h1 id="hero-title">Rapport sur les films Star Trek</h1>
        <p class="lead">Revivez les voyages de l’Enterprise. Clique sur "Continuer" pour afficher la première carte, puis navigue séquentiellement.</p>

        <p class="cta">
          <button class="btn primary" id="startBtn" aria-controls="cardsContainer" aria-expanded="false">Continuer</button>
        </p>
      </div>

      <div class="hero-illustration" aria-hidden="false">
        <picture>
          <source srcset="startrek.jpg" type="image/jpeg">
          <img class="hero-img" src="startrek.jpg" alt="Logo Star Trek" />
        </picture>
      </div>
    </section>

    <section class="grid progressive-cards" aria-label="Films Star Trek" id="cardsContainer" data-persist-key="startrek-sequence">
      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

      <!-- Star Trek: The Motion Picture (1979) -->
      <article class="card hidden" data-index="0" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Star Trek: The Motion Picture (1979)</h3>
          <p>L’équipage de l’Enterprise affronte une mystérieuse entité spatiale.</p>
          <source srcset="st79.jpg" type="image/jpeg">
          <img class="hero-img" src="st79.jpg" alt="Logo Star Trek" />
        </div>
      </article>

      <!-- Star Trek II: The Wrath of Khan (1982) -->
      <article class="card hidden" data-index="1" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Star Trek II: The Wrath of Khan (1982)</h3>
          <p>Khan revient pour se venger de Kirk dans l’un des films les plus célèbres de la saga.</p>
          <source srcset="st82.jpg" type="image/jpeg">
          <img class="hero-img" src="st82.jpg" alt="Logo Star Trek" />
        </div>
      </article>

      <!-- Star Trek IV: The Voyage Home (1986) -->
      <article class="card hidden" data-index="2" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Star Trek IV: The Voyage Home (1986)</h3>
          <p>L’équipage voyage dans le temps pour sauver des baleines et la Terre.</p>
          <source srcset="st86.jpg" type="image/jpeg">
          <img class="hero-img" src="st86.jpg" alt="Logo Star Trek" />
        </div>
      </article>

      <!-- Star Trek: Generations (1994) -->
      <article class="card hidden" data-index="3" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Star Trek: Generations (1994)</h3>
          <p>Les équipages de Kirk et Picard se rencontrent pour affronter une menace cosmique.</p>
          <source srcset="st94.jpg" type="image/jpeg">
          <img class="hero-img" src="st94.jpg" alt="Logo Star Trek" />
        </div>
      </article>

      <!-- Star Trek: First Contact (1996) -->
      <article class="card hidden" data-index="4" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Star Trek: First Contact (1996)</h3>
          <p>Picard et son équipage affrontent les Borgs et voyagent dans le passé.</p>
          <source srcset="st96.jpg" type="image/jpeg">
          <img class="hero-img" src="st96.jpg" alt="Logo Star Trek" />
        </div>
      </article>

      <!-- Star Trek (2009) -->
      <article class="card hidden" data-index="5" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Star Trek (2009)</h3>
          <p>Reboot de la saga où Kirk et Spock doivent sauver la Fédération contre Nero.</p>
          <source srcset="st09.jpg" type="image/jpeg">
          <img class="hero-img" src="st09.jpg" alt="Logo Star Trek" />
        </div>
      </article>

      <!-- Star Trek Into Darkness (2013) -->
      <article class="card hidden" data-index="6" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Star Trek Into Darkness (2013)</h3>
          <p>L’Enterprise affronte une menace interne menée par Khan.</p>
          <source srcset="st13.jpg" type="image/jpeg">
          <img class="hero-img" src="st13.jpg" alt="Logo Star Trek" />
        </div>
      </article>

      <!-- Star Trek Beyond (2016) -->
      <article class="card hidden" data-index="7" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3>Star Trek Beyond (2016)</h3>
          <p>L’équipage explore de nouvelles frontières et affronte Krall.</p>
          <source srcset="st16.jpg" type="image/jpeg">
          <img class="hero-img" src="st16.jpg" alt="Logo Star Trek" />
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
      <div>© <span id="year"></span> Ton site — Star Trek Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
