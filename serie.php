<?php
// serie.php

// Page centrale pour accéder aux différentes pages de séries
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>📺 Classeur - Liste des séries</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #3d0000ff, #6d0019ff);
      margin:0; padding:0; color:#333;
    }
    header {
      background: linear-gradient(90deg, #FF4500, #b30000);
      color:#fff; padding:25px; text-align:center;
      box-shadow:0 2px 8px rgba(0,0,0,0.2);
    }
    nav a { margin:0 15px; text-decoration:none; color:#fff; font-weight:bold; }
    nav a:hover { color:#ffd700; }
    main { margin:40px; }
    .cards-grid {
      display:grid;
      grid-template-columns:repeat(auto-fit, minmax(250px, 1fr));
      gap:20px;
    }
    .card {
      background:#fff; border-radius:12px; padding:25px;
      box-shadow:0 4px 12px rgba(0,0,0,0.15);
      transition:transform 0.3s; text-align:center;
    }
    .card:hover { transform:translateY(-5px); }
    .card h3 { color:#FF4500; margin-top:0; }
    .card a {
      display:inline-block; margin-top:15px; padding:10px 18px;
      background:linear-gradient(90deg, #FF4500, #b30000);
      color:#fff; border-radius:30px; text-decoration:none; font-weight:bold;
    }
    .card a:hover { background:linear-gradient(90deg, #b30000, #800000); }
    footer { margin-top:60px; padding:20px; background:#f1f1f1; text-align:center; color:#555; }
  </style>
</head>
<body>
  <header>
    <h1>📺 Classeur - Liste des séries</h1>
    <nav>
      <a href="accueil.php">Accueil</a>
      <a href="movies_list.php">Films</a>
    </nav>
  </header>

  <main>
    <p>Sélectionne une série pour accéder à sa page dédiée :</p>
    <div class="cards-grid">
      <div class="card"><h3>The Flash</h3><p>Les aventures de Barry Allen alias The Flash.</p><a href="flash.php">➡ Voir la page Flash</a></div>
      <div class="card"><h3>Arrow</h3><p>L’histoire d’Oliver Queen devenu le justicier Arrow.</p><a href="arrow.php">➡ Voir la page Arrow</a></div>
      <div class="card"><h3>Supergirl</h3><p>Les aventures de Kara Zor‑El alias Supergirl.</p><a href="supergirl.php">➡ Voir la page Supergirl</a></div>
      <div class="card"><h3>Legends of Tomorrow</h3><p>Les Légendes voyagent à travers le temps et l’espace.</p><a href="legendsoftomorrow.php">➡ Voir la page Legends of Tomorrow</a></div>
      <div class="card"><h3>Black Lightning</h3><p>Jefferson Pierce alias Black Lightning protège sa ville.</p><a href="blacklightning.php">➡ Voir la page Black Lightning</a></div>
      <div class="card"><h3>Batwoman</h3><p>Kate Kane puis Ryan Wilder protègent Gotham sous le masque de Batwoman.</p><a href="batwoman.php">➡ Voir la page Batwoman</a></div>
      <div class="card"><h3>Superman & Lois</h3><p>Clark Kent et Lois Lane élèvent leurs enfants à Smallville.</p><a href="supermanandlois.php">➡ Voir la page Superman & Lois</a></div>
      <div class="card"><h3>Gotham</h3><p>Les origines de Batman et de ses ennemis à travers James Gordon.</p><a href="gotham.php">➡ Voir la page Gotham</a></div>
      <div class="card"><h3>Smallville</h3><p>La jeunesse de Clark Kent avant de devenir Superman.</p><a href="smallville.php">➡ Voir la page Smallville</a></div>
      <div class="card"><h3>Constantine</h3><p>John Constantine combat les forces occultes et les démons.</p><a href="constantine.php">➡ Voir la page Constantine</a></div>
      <div class="card"><h3>Stargirl</h3><p>Courtney Whitmore reprend l’héritage de la JSA.</p><a href="stargirl.php">➡ Voir la page Stargirl</a></div>
      <div class="card"><h3>Titans</h3><p>Dick Grayson forme une équipe de jeunes héros.</p><a href="titans.php">➡ Voir la page Titans</a></div>
    </div>
  </main>

  <footer>
    <p>© <?php echo date('Y'); ?> Mon site de séries</p>
  </footer>
</body>
</html>
