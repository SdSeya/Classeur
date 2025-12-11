<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="Détails des films Spider-Man : descriptions et navigation séquentielle entre cartes." />
  <title>Classeur - Film: Spider-Man</title>

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
          <small class="site-sub">Spider-Man</small>
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
        <h1 id="hero-title">Rapport sur les films Spider-Man</h1>
        <p class="lead">Découvre les aventures de Peter Parker alias Spider-Man. Clique sur "Continuer" pour afficher la première carte, puis navigue séquentiellement.</p>

        <p class="cta">
          <button type="button" class="btn primary" id="startBtn" aria-controls="cardsContainer" aria-expanded="false">Continuer</button>
        </p>
      </div>

      <div class="hero-illustration" aria-hidden="false">
        <picture>
          <source srcset="sm.jpg" type="image/jpeg">
          <img class="hero-img" src="sm.jpg" alt="Spider-Man en action" />
        </picture>
      </div>
    </section>

    <!-- CARTES PROGRESSIVES -->
    <section class="grid progressive-cards" aria-label="Films Spider-Man" id="cardsContainer" data-persist-key="spiderman-sequence">
      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

      <!-- Spider-Man (2002) -->
      <article class="card hidden" data-index="0" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Spider-Man (2002)</h3>
          <p class="card-body">Peter Parker devient Spider-Man après la morsure d’une araignée radioactive et affronte le Bouffon Vert.</p>
          <source srcset="sm1.jpg" type="image/jpeg">
          <img class="hero-img" src="sm1.jpg" alt="Écran affichant du code coloré" />
        </div>
      </article>

      <!-- Spider-Man 2 (2004) -->
      <article class="card hidden" data-index="1" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Spider-Man 2 (2004)</h3>
          <p class="card-body">Peter Parker lutte pour concilier sa vie personnelle et son rôle de super-héros, tout en affrontant le Docteur Octopus.</p>
          <source srcset="sm2.jpg" type="image/jpeg">
          <img class="hero-img" src="sm2.jpg" alt="Écran affichant du code coloré" />
        </div>
      </article>

      <!-- Spider-Man 3 (2007) -->
      <article class="card hidden" data-index="2" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Spider-Man 3 (2007)</h3>
          <p class="card-body">Peter affronte Venom et l’Homme-Sable, tout en luttant contre l’influence du symbiote.</p>
          <source srcset="sm3.jpg" type="image/jpeg">
          <img class="hero-img" src="sm3.jpg" alt="Écran affichant du code coloré" />
        </div>
      </article>

      <!-- The Amazing Spider-Man (2012) -->
      <article class="card hidden" data-index="3" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">The Amazing Spider-Man (2012)</h3>
          <p class="card-body">Nouvelle version où Peter Parker découvre des secrets sur ses parents et affronte le Lézard.</p>
          <source srcset="asm1.jpg" type="image/jpeg">
          <img class="hero-img" src="asm1.jpg" alt="Écran affichant du code coloré" />
        </div>
      </article>

      <!-- The Amazing Spider-Man 2 (2014) -->
<article class="card hidden" data-index="4" tabindex="0" role="button" aria-expanded="false">
  <div class="card-content">
    <h3 class="card-title">The Amazing Spider-Man 2 (2014)</h3>
    <p class="card-body">
      Peter Parker continue de jongler entre sa vie personnelle et son rôle de super-héros. 
      Il affronte Electro, le Bouffon Vert et fait face à des pertes tragiques qui marquent son destin.
    </p>
    <source srcset="asm2.jpg" type="image/jpeg">
          <img class="hero-img" src="asm2.jpg" alt="Écran affichant du code coloré" />
  </div>
</article>


      <!-- Spider-Man: Homecoming (2017) -->
      <article class="card hidden" data-index="4" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Spider-Man: Homecoming (2017)</h3>
          <p class="card-body">Sous la tutelle de Tony Stark, Peter Parker tente de prouver sa valeur en affrontant le Vautour.</p>
          <source srcset="smh.jpg" type="image/jpeg">
          <img class="hero-img" src="smh.jpg" alt="Écran affichant du code coloré" />
        </div>
      </article>

      <!-- Spider-Man: Far From Home (2019) -->
<article class="card hidden" data-index="5" tabindex="0" role="button" aria-expanded="false">
  <div class="card-content">
    <h3 class="card-title">Spider-Man: Far From Home (2019)</h3>
    <p class="card-body">Après les événements d’Avengers: Endgame, Peter Parker part en voyage scolaire en Europe et affronte Mysterio, tout en essayant de gérer l’héritage de Tony Stark.</p>
    <source srcset="smf.jpg" type="image/jpeg">
          <img class="hero-img" src="smf.jpg" alt="Écran affichant du code coloré" />
  </div>
</article>

<!-- Spider-Man: No Way Home (2021) -->
<article class="card hidden" data-index="6" tabindex="0" role="button" aria-expanded="false">
  <div class="card-content">
    <h3 class="card-title">Spider-Man: No Way Home (2021)</h3>
    <p class="card-body">Peter Parker demande l’aide de Doctor Strange pour effacer la révélation de son identité. Mais le sort attire des ennemis d’autres univers, menant à une bataille épique multivers.</p>
    <source srcset="smn.jpg" type="image/jpeg">
          <img class="hero-img" src="smn.jpg" alt="Écran affichant du code coloré" />
  </div>
</article>

<!-- Spider-Man: Brand New Day (à venir) -->
<article class="card hidden" data-index="7" tabindex="0" role="button" aria-expanded="false">
  <div class="card-content">
    <h3 class="card-title">Spider-Man: Brand New Day (à venir)</h3>
    <p class="card-body">Prochain film annoncé — peu d’informations officielles pour le moment, mais il promet de nouvelles aventures pour Peter Parker.</p>
    <source srcset="smb.jpg" type="image/jpeg">
          <img class="hero-img" src="smb.jpg" alt="Écran affichant du code coloré" />
  </div>
</article>

    </section>

    <div class="controls" style="margin-top:0.8rem">
      <button type="button" id="resetCards" class="btn ghost">Réinitialiser</button>
      <button type="button" id="revealAll" class="btn">Afficher tout</button>
    </div>
  </main>

  <footer class="site-footer" role="contentinfo">
    <div class="container footer-inner">
      <div>© <span id="year"></span> Ton site — Spider-Man Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
