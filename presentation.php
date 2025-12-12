<?php
// accueil.php
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>🗄️ Classeur - Accueil</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #004080, #001933);
      margin:0; padding:0; color:#fff;
    }
    header {
      background: linear-gradient(90deg, #007BFF, #0056b3);
      padding:25px; text-align:center;
      box-shadow:0 2px 8px rgba(0,0,0,0.2);
    }
    nav a {
      margin:0 15px; text-decoration:none; color:#fff; font-weight:bold;
      transition: color 0.3s ease;
    }
    nav a:hover { color:#ffd700; }
    main {
      margin:60px auto; max-width:700px; text-align:center;
    }
    h2 {
      font-size:2em; margin-bottom:20px; color:#ffd700;
    }
    p {
      font-size:1.2em; line-height:1.6; color:#ddd;
    }
    .cta {
      margin-top:30px;
    }
    .cta a {
      display:inline-block; padding:12px 25px;
      background:linear-gradient(90deg, #007BFF, #0056b3);
      color:#fff; border-radius:30px; text-decoration:none;
      font-weight:bold; font-size:16px;
      transition: transform 0.3s ease, background 0.3s ease;
    }
    .cta a:hover {
      background:linear-gradient(90deg, #0056b3, #004080);
      transform:scale(1.05);
    }
    footer {
      margin-top:80px; padding:20px; background:#f1f1f1;
      text-align:center; color:#333;
    }
  </style>
</head>
<body>
  <header>
    <h1>🗄️ Bienvenue dans le Classeur 🗄️</h1>
    <nav>
      <a href="accueil.php">🔍 Recherche</a>
    </nav>
  </header>

  <main>
    <h2>Explorez vos univers préférés</h2>
    <p>
      Retrouvez ici des détails captivants sur vos <strong>films</strong>, <strong>séries</strong>, 
      <strong>jeux vidéo</strong> et bien plus encore.<br>
      Plongez dans un monde de divertissement à portée de clic.
    </p>
    <div class="cta">
      <a href="fets.php">➡ Commencer l’exploration</a>
    </div>
  </main>
</body>
</html>
