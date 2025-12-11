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
    nav a { margin:0 15px; text-decoration:none; color:#fff; font-weight:bold; }
    nav a:hover { color:#ffd700; }
    main { margin:40px auto; max-width:600px; text-align:center; }
    input[type="text"] {
      padding:12px; width:80%; border-radius:8px; border:none;
      font-size:16px; margin-top:20px;
    }
    button {
      margin-top:15px; padding:10px 20px;
      background:linear-gradient(90deg, #007BFF, #0056b3);
      color:#fff; border:none; border-radius:30px;
      font-size:16px; font-weight:bold; cursor:pointer;
    }
    button:hover { background:linear-gradient(90deg, #0056b3, #004080); }
    .error {
      margin-top:20px; padding:15px;
      background:#ffdddd; color:#900;
      border:1px solid #900; border-radius:8px;
      font-weight:bold;
    }
    footer {
      margin-top:60px; padding:20px; background:#f1f1f1;
      text-align:center; color:#333;
    }
  </style>
</head>
<body>
  <header>
    <h1>🗄️ Bienvenue dans le Classeur</h1>
    <nav>
      <a href="movies_list.php">Films</a>
      <a href="serie.php">Séries</a>
      <a href="accueil.php">Recherche</a>
    </nav>
  </header>

  <main>
    <h2>Bienvenue dans le Classeur</h2>
    <p>Retrouvez ici des détail de film, de série, de jeux vidéo et bien plus...</p>
  </main>

  <footer>
    <p>© <?php echo date('Y'); ?> Mon site</p>
  </footer>
</body>
</html>
