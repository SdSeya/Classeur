<?php
// jeuxvideo.php
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>🎮 Classeur - Séries de jeux vidéo</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #001933, #004080);
      margin:0; padding:0; color:#333;
    }
    header {
      background: linear-gradient(90deg, #00bfff, #0056b3);
      color:#fff; padding:25px; text-align:center;
      box-shadow:0 2px 8px rgba(0,0,0,0.2);
    }
    nav a { margin:0 15px; text-decoration:none; color:#fff; font-weight:bold; }
    nav a:hover { color:#ffd700; }
    main { margin:40px; }
    section {
      margin-bottom:50px;
      padding:20px;
      border-radius:12px;
      box-shadow:0 2px 8px rgba(0,0,0,0.1);
    }
    h2 {
      display:flex; align-items:center; gap:10px;
      margin-top:0;
    }
    h2 img { width:40px; height:auto; }
    .cards-grid {
      display:grid;
      grid-template-columns:repeat(auto-fit, minmax(250px, 1fr));
      gap:20px;
      margin-top:20px;
    }
    .card {
      background:#fff; border-radius:12px; padding:25px;
      box-shadow:0 4px 12px rgba(0,0,0,0.15);
      transition:transform 0.3s; text-align:center;
    }
    .card:hover { transform:translateY(-5px); }
    .card h3 { margin-top:0; }
    .card a {
      display:inline-block; margin-top:15px; padding:10px 18px;
      color:#fff; border-radius:30px; text-decoration:none; font-weight:bold;
    }
    /* Couleurs par console */
    .nintendo { background:#ffecec; }
    .nintendo h2, .nintendo .card h3 { color:#e60012; }
    .nintendo .card a { background:linear-gradient(90deg, #e60012, #b3000d); }

    .playstation { background:#e6ecff; }
    .playstation h2, .playstation .card h3 { color:#003791; }
    .playstation .card a { background:linear-gradient(90deg, #003791, #001f4d); }

    .xbox { background:#e6ffe6; }
    .xbox h2, .xbox .card h3 { color:#107c10; }
    .xbox .card a { background:linear-gradient(90deg, #107c10, #0a4d0a); }

    .pc { background:#f2f2f2; }
    .pc h2, .pc .card h3 { color:#444; }
    .pc .card a { background:linear-gradient(90deg, #444, #222); }

    footer { margin-top:60px; padding:20px; background:#f1f1f1; text-align:center; color:#555; }
  </style>
</head>
<body>
  <header>
    <h1>🎮 Classeur - Séries de jeux vidéo 🎮</h1>
    <nav>
      <a href="accueil.php">🔍 Recherche</a>
      <a href="movies_list.php">🎬 Films</a>
      <a href="serie.php">📺 Séries TV</a>
    </nav>
  </header>

  <main>
    <!-- Nintendo -->
    <section class="nintendo">
      <h2><img src="nlogo.png" alt="nlogo"> Séries Nintendo</h2>
      <div class="cards-grid">
        <div class="card"><h3>The Legend of Zelda</h3><p>La saga culte d’aventure où Link protège Hyrule à travers des dizaines d’épisodes.</p><a href="zelda.php">➡ Voir la saga Zelda</a></div>
        <div class="card"><h3>Super Mario</h3><p>La série emblématique de plateforme avec Mario, Luigi et leurs amis.</p><a href="mario.php">➡ Voir la saga Mario</a></div>
        <div class="card"><h3>Pokémon</h3><p>La série RPG où l’on capture et entraîne des créatures à travers plusieurs générations.</p><a href="pokemon.php">➡ Voir la saga Pokémon</a></div>
        <div class="card"><h3>Animal Crossing</h3><p>Une série de simulation de vie où l’on développe son village ou son île.</p><a href="animalcrossing.php">➡ Voir la saga Animal Crossing</a></div>
        <div class="card"><h3>Metroid</h3><p>La saga de science-fiction où Samus Aran combat les pirates de l’espace et les Métroïdes.</p><a href="metroid.php">➡ Voir la saga Metroid</a></div>
      </div>
    </section>

    <!-- PlayStation -->
    <section class="playstation">
      <h2><img src="plogo.png" alt="plogo"> Séries PlayStation</h2>
      <div class="cards-grid">
        <div class="card"><h3>God of War</h3><p>La saga d’action où Kratos affronte les dieux grecs puis nordiques.</p><a href="gow.php">➡ Voir la saga God of War</a></div>
        <div class="card"><h3>The Last of Us</h3><p>Une série dramatique post-apocalyptique centrée sur Joel et Ellie.</p><a href="tlou.php">➡ Voir la saga TLOU</a></div>
        <div class="card"><h3>Horizon</h3><p>La série futuriste où Aloy explore un monde peuplé de machines.</p><a href="horizon.php">➡ Voir la saga Horizon</a></div>
        <div class="card"><h3>Spider-Man</h3><p>Les aventures de Peter Parker adaptées en jeux vidéo modernes.</p><a href="smg.php">➡ Voir la saga Spider-Man</a></div>
        <div class="card"><h3>Bloodborne</h3><p>Un action-RPG sombre, héritier spirituel de la série Souls.</p><a href="bloodborne.php">➡ Voir la saga Bloodborne</a></div>
      </div>
    </section>

    <!-- Xbox -->
    <section class="xbox">
      <h2><img src="xlogo.png" alt="xlogo"> Séries Xbox</h2>
      <div class="cards-grid">
        <div class="card"><h3>Halo</h3><p>La saga culte de science-fiction où le Major et Cortana affrontent le Covenant et les Flood.</p><a href="halo.php">➡ Voir la saga Halo</a></div>
        <div class="card"><h3>Gears of War</h3><p>La série de tir à la troisième personne avec Marcus Fenix et Kait Diaz.</p><a href="gears.php">➡ Voir la saga Gears</a></div>
        <div class="card"><h3>Forza Horizon</h3><p>La série de jeux de course en monde ouvert.</p><a href="forza.php">➡ Voir la saga Forza</a></div>
        <div class="card"><h3>Sea of Thieves</h3><p>Une série multijoueur où l’on incarne des pirates.</p><a href="seaofthieves.php">➡ Voir la saga Sea of Thieves</a></div>
        <div class="card"><h3>Fable</h3><p>La série RPG où les choix du joueur influencent son destin.</p><a href="fable.php">➡ Voir la saga Fable</a></div>
      </div>
    </section>

    <!-- PC -->
    <section class="pc">
      <h2><img src="pclogo.png" alt="pclogo"> Séries PC</h2>
      <div class="cards-grid">
        <div class="card"><h3>League of Legends</h3><p>Le MOBA compétitif mondialement connu.</p><a href="lol.php">➡ Voir la saga LoL</a></div>
        <div class="card"><h3>Counter-Strike</h3><p>La série culte de FPS compétitifs</p><a href="counterstrike.php">➡ Voir la saga Counter-Strike</a></div>
        <div class="card"><h3>Diablo</h3><p>La série d’action-RPG de Blizzard où l’on affronte les forces démoniaques.</p><a href="diablo.php">➡ Voir la saga Diablo</a></div>
        <div class="card"><h3>Half-Life</h3><p>La série culte de Valve avec Gordon Freeman, pionnière du FPS narratif.</p><a href="halflife.php">➡ Voir la saga Half-Life</a></div>
      </div>
    </section>