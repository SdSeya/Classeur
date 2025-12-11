<?php
/**
 * movies_list.php
 * Version : corrections pour s'assurer que les boutons fonctionnent (type="button" + IDs stables)
 */

declare(strict_types=1);

// Charger la configuration : prefer config.php, fallback to db_config.php
$configPathPrimary = __DIR__ . '/config.php';
$configPathFallback = __DIR__ . '/db_config.php';
if (file_exists($configPathPrimary)) {
    $config = require $configPathPrimary;
} elseif (file_exists($configPathFallback)) {
    $config = require $configPathFallback;
} else {
    http_response_code(500);
    echo 'Missing config.php or db_config.php - crée le fichier config.php (voir exemple).';
    exit;
}

// Connexion PDO en utilisant la config
$dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8mb4', $config['db_host'], $config['db_name']);
try {
    $pdo = new PDO($dsn, $config['db_user'], $config['db_pass'], $config['pdo_options']);
} catch (PDOException $e) {
    http_response_code(500);
    echo 'Erreur de connexion à la base de données : ' . htmlspecialchars($e->getMessage(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    exit;
}

function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }

$tokenFilter = isset($_GET['token']) ? trim($_GET['token']) : '';

try {
    // Liste des films
    $stmt = $pdo->query("
        SELECT m.id, m.slug, m.title, m.description
        FROM movies m
        ORDER BY m.id
    ");
    $movies = $stmt->fetchAll();

    // Charge tous les reveals (on les exposera côté client groupés par movie_id)
    if ($tokenFilter !== '') {
        $stmt = $pdo->prepare("
            SELECT r.id, r.session_token, r.movie_id, r.comment, r.revealed_at
            FROM movie_reveals r
            WHERE r.session_token = :token
            ORDER BY r.revealed_at ASC
        ");
        $stmt->execute([':token' => $tokenFilter]);
        $reveals = $stmt->fetchAll();
    } else {
        $stmt = $pdo->query("
            SELECT r.id, r.session_token, r.movie_id, r.comment, r.revealed_at
            FROM movie_reveals r
            ORDER BY r.movie_id, r.revealed_at ASC
        ");
        $reveals = $stmt->fetchAll();
    }
} catch (Exception $e) {
    http_response_code(500);
    echo "Erreur DB : " . h($e->getMessage());
    exit;
}

// Grouper les reveals par movie_id pour usage côté client
$revealsByMovie = [];
foreach ($reveals as $r) {
    $mid = (string)($r['movie_id'] ?? '');
    if ($mid === '') continue;
    if (!isset($revealsByMovie[$mid])) $revealsByMovie[$mid] = [];
    $revealsByMovie[$mid][] = $r;
}

// JSON safe pour injection côté client
$revealsJson = json_encode($revealsByMovie, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);


?><!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="Détails des films Avengers : descriptions et navigation séquentielle entre cartes." />
  <title>Classeur - Film: Batman</title>

  <!-- Feuille de style séquentielle -->
  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <!-- Skip link pour l'accessibilité -->
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" role="banner">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo" aria-hidden="true">A</div>
        <div class="brand-text">
          <strong class="site-title">Mes détails de film</strong>
          <small class="site-sub">Batman</small>
        </div>
      </div>

      <nav class="main-nav" role="navigation" aria-label="Navigation principale">
        <nav class="main-nav" role="navigation" aria-label="Navigation principale">
  <a href="accueil.php" class="nav-link">Accueil</a>
  <a href="movies_list.php" class="nav-link">Films</a>
  <a href="serie.php" class="nav-link">Series</a>
      </nav>
    </div>
  </header>

  <main class="container" id="main" role="main">
    <section class="hero" aria-labelledby="hero-title">
      <div class="hero-content">
        <h1 id="hero-title">Rapport sur les films Batman</h1>
        <p class="lead">Ici se trouvent quelques détails sur les films Batman. Appuie sur "Continuer" pour afficher la première carte, puis clique sur une carte visible (ou appuie Entrée / Espace) pour afficher la suivante.</p>

        <p class="cta">
          <button class="btn primary" id="startBtn" aria-controls="cardsContainer" aria-expanded="false">Continuer</button>
          <a href="#" class="btn ghost" id="learnBtn">En savoir plus</a>
        </p>
      </div>

      <div class="hero-illustration" aria-hidden="false">
        <picture>
          <source srcset="Batman.jpg" type="image/jpeg">
          <img class="hero-img" src="Batman.jpg" alt="Écran affichant du code coloré" />
        </picture>
      </div>
    </section>

    <!-- CARDS : chaque .card contient .card-content (utile pour l'animation) -->
    <section class="grid progressive-cards" aria-label="Fonctionnalités séquentielles" id="cardsContainer" data-persist-key="avengers-sequence">
      <p class="sr-only" id="announce" aria-live="polite" aria-atomic="true"></p>

      <!-- Par défaut toutes les cartes sont cachées : la première s'affichera seulement après 'Continuer' -->
      <article class="card hidden" data-index="0" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Batman (1989)</h3>
          <p class="card-body">Lorsqu'une fusillade éclate à l'usine chimique Axis entre la police et un groupe de gangsters dirigé par Jack Napier, Batman réagit bien sûr. Au cours du combat qui s'ensuit, le méchant est jeté dans une cuve de produits chimiques et laissé pour mort.
Mais ce n’est qu’un leurre bien-sûr. Il ressort de la cuve, transformé en un fou connu sous le nom de Joker. C'est à Batman de l'arrêter avant qu'il n'empoisonne la population de Gotham avec un gaz mortel, le Smylex, qui provoque des rires hystériques chez ses victimes avant qu'elles ne périssent.</p>
        <picture>
          <source srcset="batman89.jpg" type="image/jpeg">
          <img class="hero-img" src="batman89.jpg" alt="Écran affichant du code coloré" />
        </picture>
        </div>
      </article>

      <article class="card hidden" data-index="1" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Batman Returns (1992)</h3>
          <p class="card-body">Après avoir vaincu le Joker, Batman doit affronter son prochain ennemi, le Pingouin, qui s'est associé à un millionnaire miteux, Max Shreck, pour s'échapper des égouts sous Gotham.
Batman a entamé une relation amoureuse avec la secrétaire de Shreck, Selina Kyle (alias Catwoman) et à la fin, ce n'est pas seulement au complot du Pingouin d'enlever et d'assassiner les premiers-nés des citoyens de Gotham que Batman doit faire face, mais aussi à la soif de vengeance de Catwoman contre Shreck.</p>
        <picture>
          <source srcset="Batmanr.jpg" type="image/jpeg">
          <img class="hero-img" src="Batmanr.jpg" alt="Écran affichant du code coloré" />
        </picture>
        </div>
      </article>

      <article class="card hidden" data-index="2" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Batman Forever (1995)</h3>
          <p class="card-body">Batman affronte à la fois Double-Face et le Riddler. Ce film présente également Robin à un public moderne.
Alors que Batman tente d'abandonner son personnage de combattant du crime pour vivre une vie normale avec Chase Meridian, le Riddler découvre sa véritable identité, grâce à un appareil à ondes cérébrales qu'il a inventé, ce qui conduit à la capture de Chase et à la prise de conscience par Bruce qu'il sera toujours Batman.</p>
        <picture>
          <source srcset="batmanf.jpg" type="image/jpeg">
          <img class="hero-img" src="abatmanf.jpg" alt="Écran affichant du code coloré" />
        </picture>
        </div>
      </article>

      <article class="card hidden" data-index="3" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Batman and Robin (1997)</h3>
          <p class="card-body">Batman et Robin ajoutent Batgirl à leur équipe, le trio affronte le Dr Freeze et Poison Ivy. Nous apercevons aussi leur homme de main masqué, Bane. Le meilleur moment est sans doute celui où le Dr Freeze fait 7 000 jeux de mots sur la glace.</p>
        <picture>
          <source srcset="batmaner.jpg" type="image/jpeg">
          <img class="hero-img" src="batmaner.jpg" alt="Écran affichant du code coloré" />
        </picture>
        </div>
      </article>

      <article class="card hidden" data-index="4" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Batman Begins (2005)</h3>
          <p class="card-body">Ce film suit Bruce Wayne depuis le meurtre de ses parents jusqu'à son voyage à travers le monde, où il apprend à se battre et est recruté dans la Ligue des ombres par Henri Ducard.
Lorsqu'il rentre enfin chez lui, Batman doit affronter l'Épouvantail qui utilise une toxine altérant l'esprit pour provoquer des hallucinations terrifiantes.</p>
        <picture>
          <source srcset="batmanb.jpg" type="image/jpeg">
          <img class="hero-img" src="batmanb.jpg" alt="Écran affichant du code coloré" />
        </picture>
        </div>
      </article>

      <article class="card hidden" data-index="4" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">The Dark Knight (2008)</h3>
          <p class="card-body">Batman affronte son ennemi juré le plus dangereux, le Joker.
Le Joker prend le contrôle du monde du crime organisé de Gotham, agence un complot sournois et défigure le procureur de la ville, Harvey Dent, tout en essayant de forcer Batman à briser sa seule règle : refuser de tuer un seul de ses ennemis.</p>
        <picture>
          <source srcset="batmantdk.jpg" type="image/jpeg">
          <img class="hero-img" src="batmantdk.jpg" alt="Écran affichant du code coloré" />
        </picture>
        </div>
      </article>

      <article class="card hidden" data-index="4" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">The Dark Knight Rises (2012)</h3>
          <p class="card-body">Batman est devenu un reclus depuis qu'il a convaincu le commissaire Gordon de le blâmer pour le carnage de Harvey Dent, et par conséquent, Batman n'a pas été vu depuis huit ans. La réalité de sa vie à combattre des criminels tous les soirs s'est également imposée à Bruce, alors qu'une visite chez le médecin montre la litanie des façons dont son corps a commencé à se détériorer. Il n'est donc pas du tout préparé à affronter Bane, un ancien membre de la Ligue des Ombres, qui vient à Gotham pour achever le plan de Ra's Al Ghul de détruire la ville.</p>
        <picture>
          <source srcset="batmantdkr.jpg" type="image/jpeg">
          <img class="hero-img" src="batmantdkr.jpg" alt="Écran affichant du code coloré" />
        </picture>
        </div>
      </article>

      <article class="card hidden" data-index="4" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">Batman vs Superman : Dawn of Justice (2016)</h3>
          <p class="card-body">Batman vs Superman reprend 18 mois après les événements de Man of Steel de 2013. Bruce Wayne combat les méchants depuis 20 ans. Il considère Superman comme une menace existentielle pour l'humanité. Pendant ce temps, Lex Luthor élabore ses propres plans pour faire face à Superman, notamment en se procurant un tas de kryptonite et en accédant au corps du général Zod.
Batman apprend l'existence de la réserve de kryptonite à Lexcorp et la vole, ce qui lui permet de créer un costume alimenté par la kryptonite pour vaincre Superman.</p>
        <picture>
          <source srcset="batmanvss.jpg" type="image/jpeg">
          <img class="hero-img" src="batmanvss.jpg" alt="Écran affichant du code coloré" />
        </picture>
        </div>
      </article>

      <article class="card hidden" data-index="4" tabindex="0" role="button" aria-expanded="false">
        <div class="card-content">
          <h3 class="card-title">The Batman (2022)</h3>
          <p class="card-body">Batman fait équipe avec le commissaire Gordon et Catwoman pour affronter le Riddler et le Pingouin.</p>
        <picture>
          <source srcset="tbatman.jpg" type="image/jpeg">
          <img class="hero-img" src="tbatman.jpg" alt="Écran affichant du code coloré" />
        </picture>
        </div>
      </article>
    </section>

    <div class="controls" style="margin-top:0.8rem">
      <button id="resetCards" class="btn ghost" title="Réinitialiser l'affichage des cartes">Réinitialiser</button>
      <button id="revealAll" class="btn" title="Afficher toutes les cartes">Afficher tout</button>
    </div>
  </main>

  <footer class="site-footer" role="contentinfo">
    <div class="container footer-inner">
      <div>© <span id="year"></span> Ton site — construit pour être édité.</div>
      <div><a href="#" class="muted">Mentions</a></div>
    </div>
  </footer>

  <!-- Panneau de réglages léger -->
  <aside class="settings" id="settings" aria-hidden="true">
    <h4>Personnaliser</h4>

    <label class="setting-row">
      <span>Couleur principale</span>
      <input id="primaryColor" type="color" value="#1d4ed8" />
    </label>

    <label class="setting-row">
      <span>Couleur fond</span>
      <input id="bgColor" type="color" value="#f8fafc" />
    </label>

    <label class="setting-row">
      <input id="darkMode" type="checkbox" />
      <span>Mode sombre</span>
    </label>

    <div class="settings-actions">
      <button id="resetBtn" class="btn ghost">Réinitialiser</button>
      <button id="toggleSettings" class="btn" aria-expanded="false">Paramètres</button>
    </div>
  </aside>

  <!-- Script principal -->
  <script src="script.js" defer></script>
</body>
</html>
