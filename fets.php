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
      box-shadow:0 2px 8px rgba(0, 0, 0, 0.2);
    }
    nav a { margin:0 15px; text-decoration:none; color:#fff; font-weight:bold; }
    nav a:hover { color:#ffd700; }
    main { margin:40px; }
    section {
      margin-bottom:60px;
      padding:20px;
      background:#f9f9f9;
      border-radius:12px;
      box-shadow:0 2px 8px rgba(0,0,0,0.1);
    }
    section h2 {
      margin-top:0;
      color:#0056b3;
      border-bottom:2px solid #007BFF;
      padding-bottom:10px;
    }
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
    <h1>🎬 Classeur - Liste des films et des Séries 📺</h1>
    <nav>
      <a href="accueil.php">🔍 Recherche</a>
    </nav>
  </header>

  <main>
    <!-- Section Films -->
    <section>
      <h2>Films</h2>
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
    </section>

    <!-- Section Séries -->
    <section>
      <h2>Séries</h2>
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
</section>

            <!-- Section Jeux Vidéo -->
    <section>
      <h2>Jeux Vidéo</h2>
      <div class="cards-grid">
        <div class="card">
          <h3>The Legend of Zelda</h3>
          <p>Revivez les aventures de Link à travers Hyrule.</p>
          <a href="zelda_series.php">➡ Voir la saga Zelda</a>
        </div>
        <div class="card">
          <h3>Super Mario</h3>
          <p>Les aventures de Mario, Luigi et leurs amis dans des mondes variés.</p>
          <a href="mario_series.php">➡ Voir la saga Mario</a>
        </div>
        <div class="card">
          <h3>Pokémon</h3>
          <p>Attrapez-les tous à travers les différentes générations.</p>
          <a href="pokemon_series.php">➡ Voir la saga Pokémon</a>
        </div>
        <div class="card">
          <h3>Halo</h3>
          <p>Le Major et Cortana affrontent le Covenant et les Flood.</p>
          <a href="halo_series.php">➡ Voir la saga Halo</a>
        </div>
        <div class="card">
          <h3>League of Legends</h3>
          <p>Le MOBA culte avec ses champions et ses stratégies.</p>
          <a href="lol.php">➡ Voir la page LoL</a>
        </div>
        <div class="card">
          <h3>Diablo</h3>
          <p>La série d’action-RPG de Blizzard où l’on affronte les forces démoniaques.</p>
          <a href="diablo_series.php">➡ Voir la saga Diablo</a>
        </div>
        <div class="card">
          <h3>Half-Life</h3>
          <p>La série culte de Valve avec Gordon Freeman, pionnière du FPS narratif.</p>
          <a href="halflife_series.php">➡ Voir la saga Half-Life</a>
        </div>
        <div class="card">
          <h3>StarCraft</h3>
          <p>La série de stratégie en temps réel opposant Terrans, Protoss et Zergs.</p>
          <a href="starcraft_series.php">➡ Voir la saga StarCraft</a>
        </div>
        <div class="card">
          <h3>Counter-Strike</h3>
          <p>La série culte de FPS compétitifs, de CS 1.6 à CS:GO et CS2.</p>
          <a href="counterstrike_series.php">➡ Voir la saga Counter-Strike</a>
        </div>
        <div class="card">
          <h3>World of Warcraft</h3>
          <p>MMORPG culte dans l’univers d’Azeroth, avec raids et quêtes épiques.</p>
          <a href="wow.php">➡ Voir la page WoW</a>
        </div>
        <div class="card">
          <h3>The Witcher</h3>
          <p>Action-RPG où Geralt de Riv part à la recherche de Ciri dans un monde ouvert.</p>
          <a href="witcher_series.php">➡ Voir la saga The Witcher</a>
        </div>
        <div class="card">
          <h3>Minecraft</h3>
          <p>Construisez, explorez et survivez dans un monde cubique infini.</p>
          <a href="minecraft.php">➡ Voir la page Minecraft</a>
        </div>
        <div class="card">
          <h3>Fortnite</h3>
          <p>Battle Royale mondialement connu avec construction et affrontements.</p>
          <a href="fortnite.php">➡ Voir la page Fortnite</a>
        </div>
        <div class="card">
          <h3>Call of Duty</h3>
          <p>La série de FPS militaire emblématique.</p>
          <a href="callofduty_series.php">➡ Voir la saga Call of Duty</a>
        </div>
        <div class="card">
          <h3>Assassin’s Creed</h3>
          <p>Explorez l’histoire à travers les yeux des Assassins.</p>
          <a href="assassinscreed_series.php">➡ Voir la saga Assassin’s Creed</a>
        </div>
        <div class="card">
          <h3>Final Fantasy</h3>
          <p>La saga culte de RPG japonais avec des mondes et histoires variés.</p>
          <a href="finalfantasy_series.php">➡ Voir la saga Final Fantasy</a>
        </div>
      </div>
    </section>
