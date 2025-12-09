<?php
session_start();
?>
<header>
  <h1>🎬 Bienvenue dans le Classeur</h1>
  <nav>
    <a href="accueil.php">Accueil</a>
    <a href="movies_list.php">Films</a>
    <a href="serie.php">Séries</a>
    <a href="contact.php">Contact</a>

    <?php if (isset($_SESSION['user_id'])): ?>
      <!-- Si l’utilisateur est connecté -->
      <span style="margin-left:20px; color:#ffd700;">
        👋 Bonjour <?php echo htmlspecialchars($_SESSION['username']); ?>
      </span>
      <a href="logout.php">Déconnexion</a>
    <?php else: ?>
      <!-- Si l’utilisateur n’est pas connecté -->
      <a href="login.php">Connexion</a>
      <a href="register.php">Inscription</a>
    <?php endif; ?>
  </nav>
</header>
