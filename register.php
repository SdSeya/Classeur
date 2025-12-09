<?php
require 'config.php';

// Message si compte supprimé
$message = "";
if (isset($_GET['deleted']) && $_GET['deleted'] == 1) {
    $message = "✅ Votre compte a bien été supprimé. Vous pouvez créer un nouveau compte ci-dessous.";
}

// Traitement inscription
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    if ($stmt->execute([$username, $email, $password])) {
        // ✅ Redirection automatique vers accueil.php
        header("Location: accueil.php");
        exit;
    } else {
        echo "❌ Erreur lors de l'inscription.";
    }
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Inscription</title>
    <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #004080, #001933);
      margin:0; padding:0; color:#fff;
    }
    main {
      margin:40px auto; max-width:500px;
      background:#fff; color:#333;
      padding:30px; border-radius:12px;
      box-shadow:0 4px 12px rgba(0,0,0,0.15);
    }
    h2 { color:#007BFF; text-align:center; }
    form input {
      display:block; margin:10px auto; padding:10px;
      width:90%; border-radius:8px; border:1px solid #ccc;
    }
    form button {
      display:block; margin:20px auto; padding:10px 20px;
      background:#007BFF; color:#fff; border:none;
      border-radius:30px; font-weight:bold; cursor:pointer;
    }
    form button:hover { background:#0056b3; }
    .message {
      margin:20px 0; padding:15px;
      background:#e6ffe6; border:1px solid #28a745;
      border-radius:8px; color:#155724; text-align:center;
    }
  </style>
</head>
<body>
  <main>
    <h2>📝 Inscription</h2>

    <?php if ($message): ?>
      <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="post">
      <input type="text" name="username" placeholder="Nom d'utilisateur" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Mot de passe" required>
      <button type="submit">S'inscrire</button>
    </form>
  </main>
</body>
</html>
