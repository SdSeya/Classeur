<?php
/**
 * smallville.php
 * Page séquentielle pour afficher la série Smallville
 */
?><!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="Détails de la série Smallville : descriptions et navigation séquentielle entre cartes." />
  <title>Classeur - Série: Smallville</title>
  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>
  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">🌾</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de série</strong>
          <small class="site-sub">Smallville</small>
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
        <h1 id="hero-title">Rapport sur la série Smallville</h1>
        <p class="lead">L’ascension de Clark Kent avant Superman. Clique sur "Continuer" pour afficher la première carte, puis navigue séquentiellement.</p>
        <p class="cta">
          <button class="btn primary" id="startBtn" aria-controls="cardsContainer" aria-expanded="false">Continuer</button>
        </p>
      </div>
      <div class="hero-illustration" aria-hidden="false">
        <picture>
          <source srcset="smallville.jpg" type="image/jpeg">
          <img class="hero-img" src="smallville.jpg" alt="Logo Smallville" />
        </picture>
      </div>
    </section>

    <section class="grid progressive-cards" aria-label="Saisons Smallville" id="cardsContainer" data-persist-key="smallville-sequence">
      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

      <?php
      $saisons = [];
      for ($n = 1; $n <= 10; $n++) {
        $annee = 2000 + $n;
        $desc = [
          1 => "Clark découvre ses pouvoirs et affronte la pluie de météorites.",
          2 => "Arrivée de Red Kryptonite, tensions avec Lex Luthor.",
          3 => "Clark assume ses responsabilités et renforce ses liens.",
          4 => "Recherche des Pierres de Savoir kryptoniennes.",
          5 => "La Forteresse se révèle, Brainiac arrive.",
          6 => "Zod menace Metropolis, Justice commence à se former.",
          7 => "Kara (Supergirl) apparaît, secrets de Krypton.",
          8 => "Naissance du Blur, Lois et Clark se rapprochent.",
          9 => "Society et Salvation, le Blur devient un symbole.",
          10 => "Clark devient finalement Superman.",
        ][$n];
        $saisons[] = ["Saison $n ($annee)", $desc, "smallville$n.jpg"];
      }
      foreach ($saisons as $i => $s) {
        echo '<article class="card hidden" data-index="'.$i.'" tabindex="0" role="button" aria-expanded="false">
                <div class="card-content">
                  <h3>'.$s[0].'</h3>
                  <p>'.$s[1].'</p>
                  <img src="'.$s[2].'" alt="Smallville '.$s[0].'" />
                </div>
              </article>';
      }
      ?>
    </section>

    <div class="controls" style="margin-top:0.8rem">
      <button id="resetCards" class="btn ghost">Réinitialiser</button>
      <button id="revealAll" class="btn">Afficher tout</button>
    </div>
  </main>

  <footer class="site-footer" role="contentinfo">
    <div class="container footer-inner">
      <div>© <span id="year"></span> Ton site — Smallville Edition.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>
