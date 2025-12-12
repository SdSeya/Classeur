<?php
// movies_list.php

// Page centrale pour accéder aux différentes pages de films
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>🎬 Classeur - Liste des films</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #00003dff, #00196dff);
      margin:0; padding:0; color:#333;
    }
    header {
      background: linear-gradient(90deg, #007BFF, #0056b3);
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
    .card h3 { color:#007BFF; margin-top:0; }
    .card a {
      display:inline-block; margin-top:15px; padding:10px 18px;
      background:linear-gradient(90deg, #007BFF, #0056b3);
      color:#fff; border-radius:30px; text-decoration:none; font-weight:bold;
    }
    .card a:hover { background:linear-gradient(90deg, #0056b3, #004080); }
    footer { margin-top:60px; padding:20px; background:#f1f1f1; text-align:center; color:#555; }
  </style>
</head>
<body>
  <header>
    <h1>🎬 Classeur - Liste des films 🎬</h1>
    <nav>
      <a href="accueil.php">🔍 Recherche</a>
      <a href="serie.php">📺 Séries</a>
    </nav>
  </header>

  <main>
    <div class="cards-grid">
      <div class="card"><h3>Avengers</h3><p>Découvre les aventures des plus grands héros réunis.</p><a href="index.php">➡ Voir la page Avengers</a></div>
      <div class="card"><h3>Iron Man</h3><p>Explore l’histoire de Tony Stark et son armure high-tech.</p><a href="ironman.php">➡ Voir la page Iron Man</a></div>
      <div class="card"><h3>Spider-Man</h3><p>Plonge dans les aventures de Peter Parker alias Spider-Man.</p><a href="spiderman.php">➡ Voir la page Spider-Man</a></div>
      <div class="card"><h3>Batman</h3><p>Découvre le protecteur de Gotham City.</p><a href="batman.php">➡ Voir la page Batman</a></div>
      <div class="card"><h3>Superman</h3><p>Revivez les aventures de l’Homme d’Acier.</p><a href="superman.php">➡ Voir la page Superman</a></div>
      <div class="card"><h3>Star Wars</h3><p>Revivez la saga intergalactique.</p><a href="starwars.php">➡ Voir la page Star Wars</a></div>
      <div class="card"><h3>Star Trek</h3><p>Voyagez avec l’Enterprise dans l’espace.</p><a href="startrek.php">➡ Voir la page Star Trek</a></div>
      <div class="card"><h3>Le Seigneur des Anneaux</h3><p>Revivez l’épopée de la Terre du Milieu.</p><a href="lordoftherings.php">➡ Voir la page Seigneur des Anneaux</a></div>
      <div class="card"><h3>Harry Potter</h3><p>Plongez dans la magie de Poudlard.</p><a href="harrypotter.php">➡ Voir la page Harry Potter</a></div>
      <div class="card"><h3>Fast & Furious</h3><p>Vivez l’action et les courses effrénées.</p><a href="fastandfurious.php">➡ Voir la page Fast & Furious</a></div>
    </div>
  </main>

  <footer>
    <p>© <?php echo date('Y'); ?> Mon site de films</p>
  </footer>
</body>
</html>
