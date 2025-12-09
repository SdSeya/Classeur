<?php
// profile.php
session_start();
require 'config.php';

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Récupère les infos de l'utilisateur
$stmt = $pdo->prepare("SELECT username, email, created_at FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if (!$user) {
    echo "❌ Utilisateur introuvable.";
    exit;
}

$message = "";

// Traitement mise à jour
if (isset($_POST['update'])) {
    $newEmail = trim($_POST['email']);
    $newPassword = $_POST['password'];

    if (!empty($newEmail)) {
        $stmt = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
        $stmt->execute([$newEmail, $_SESSION['user_id']]);
        $message .= "✅ Email mis à jour.<br>";
    }

    if (!empty($newPassword)) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->execute([$hashedPassword, $_SESSION['user_id']]);
        $message .= "✅ Mot de passe mis à jour.<br>";
    }

    // Rafraîchir infos
    $stmt = $pdo->prepare("SELECT username, email, created_at FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
}

// Traitement suppression
if (isset($_POST['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);

    session_destroy();
    header("Location: register.php?deleted=1");
    exit;
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Profil utilisateur</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #004080, #001933);
      margin:0; padding:0; color:#fff;
    }
    header {
      background: linear-gradient(90deg, #007BFF, #0056b3);
      padding:20px; text-align:center;
      box-shadow:0 2px 8px rgba(0,0,0,0.2);
    }
    nav a { margin:0 15px; text-decoration:none; color:#fff; font-weight:bold; }
    nav a:hover { color:#ffd700; }
    main {
      margin:40px auto; max-width:600px;
      background:#fff; color:#333;
      padding:30px; border-radius:12px;
      box-shadow:0 4px 12px rgba(0,0,0,0.15);
    }
    h2 { color:#007BFF; }
    .info { margin:15px 0; }
    .label { font-weight:bold; color:#0056b3; }
    .message { margin:20px 0; padding:15px; background:#e6ffe6; border:1px solid #28a745; border-radius:8px; color:#155724; }
    form input { display:block; margin:10px 0; padding:10px; width:100%; border-radius:8px; border:1px solid #ccc; }
    form button {
      padding:10px 20px; background:#007BFF; color:#fff;
      border:none; border-radius:30px; font-weight:bold; cursor:pointer;
    }
    form button:hover { background:#0056b3; }
    .delete-btn {
      background:#dc3545; margin-top:20px;
    }
    .delete-btn:hover { background:#a71d2a; }
    footer {
      margin-top:60px; padding:20px; background:#f1f1f1;
      text-align:center; color:#333;
    }
  </style>
</head>
<body>
  <header>
    <h1>👤 Profil utilisateur</h1>
    <nav>
      <a href="accueil.php">Accueil</a>
      <a href="movies_list.php">Films</a>
      <a href="serie.php">Séries</a>
      <a href="logout.php">Déconnexion</a>
    </nav>
  </header>

  <main>
    <h2>Bienvenue <?php echo htmlspecialchars($user['username']); ?> !</h2>
    <div class="info"><span class="label">Nom d’utilisateur :</span> <?php echo htmlspecialchars($user['username']); ?></div>
    <div class="info"><span class="label">Email :</span> <?php echo htmlspecialchars($user['email']); ?></div>
    <div class="info"><span class="label">Date d’inscription :</span> <?php echo htmlspecialchars($user['created_at']); ?></div>

    <?php if ($message): ?>
      <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>

    <h3>Modifier mes informations</h3>
    <form method="post">
      <input type="email" name="email" placeholder="Nouvel email (laisser vide si inchangé)">
      <input type="password" name="password" placeholder="Nouveau mot de passe (laisser vide si inchangé)">
      <button type="submit" name="update">Mettre à jour</button>
    </form>

    <h3>Supprimer mon compte</h3>
    <form method="post" onsubmit="return confirm('⚠️ Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.');">
      <button type="submit" name="delete" class="delete-btn">Supprimer mon compte</button>
    </form>
  </main>

  <footer>
    <p>© <?php echo date('Y'); ?> Mon site</p>
  </footer>
</body>
</html>
