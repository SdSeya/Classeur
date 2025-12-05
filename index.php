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
  <title>Classeur — Films: Avengers</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container" role="main">
    <header class="header">
      <div class="title-group">
        <h1>Classeur — Films: Avengers</h1>
        <div class="small">Cliquez sur "Voir la description" pour afficher la description et les reveals associés.</div>
      </div>

      <div class="center" style="gap:12px">
        <div class="small">Année</div>
        <div id="year" class="small" style="font-weight:700;margin-left:6px"></div>
        <button id="themeToggle" aria-pressed="false" title="Basculer thème">☀️ Clair</button>
      </div>
    </header>

    <section>
      <h2>Filtrer par token de session</h2>
      <form method="get" class="inline" action="">
        <label for="token" class="small">Token :</label>
        <input id="token" name="token" value="<?php echo h($tokenFilter); ?>" placeholder="Entrez un token (optionnel)..." />
        <button type="submit">Filtrer</button>
        <?php if ($tokenFilter !== ''): ?>
          <a class="link" href="<?php echo h(basename(__FILE__)); ?>" style="margin-left:12px">Afficher tout</a>
        <?php endif; ?>
      </form>
    </section>

    <section style="margin-top:18px">
      <h2>Résumé des films</h2>
      <div class="table-wrap" aria-hidden="<?php echo empty($movies) ? 'true' : 'false'; ?>">
        <table role="table" aria-label="Liste des films">
          <thead style="display:none">
            <tr><th>#</th><th>Slug</th><th>Titre</th></tr>
          </thead>
          <tbody>
            <?php foreach ($movies as $i => $m):
              $panelId = 'desc-' . $m['id'];
              $btnId   = 'btn-desc-' . $m['id'];
            ?>
              <tr class="film-row" tabindex="-1" aria-labelledby="<?php echo h($panelId); ?>">
                <td class="film-id"><?php echo h($m['id']); ?></td>

                <td class="film-meta">
                  <div class="film-title">
                    <?php echo h($m['title']); ?>
                    <span class="film-slug"><?php echo h($m['slug']); ?></span>
                  </div>
                  <div class="small">Cliquez sur "Voir la description" pour afficher la description et les reveals associés.</div>
                </td>

                <td class="film-actions">
                  <!-- Important: type="button" to avoid accidental form submit -->
                  <button type="button"
                          id="<?php echo h($btnId); ?>"
                          class="toggle-desc"
                          data-movie-id="<?php echo h($m['id']); ?>"
                          aria-controls="<?php echo h($panelId); ?>"
                          aria-expanded="false">
                    Voir la description
                  </button>
                </td>
              </tr>

              <tr class="desc-row" id="<?php echo h($panelId); ?>" role="region" aria-labelledby="<?php echo h($btnId); ?>">
                <td colspan="3">
                  <!-- desc-panel : this is the element we animate and toggle -->
                  <div class="desc-panel">
                    <div class="desc-text">
                      <?php echo $m['description'] !== null && $m['description'] !== '' ? h($m['description']) : '<em class="small">Aucune description disponible.</em>'; ?>
                    </div>

                    <div class="reveals-section" style="margin-top:12px">
                      <h3 style="margin:0 0 8px 0;font-size:0.95rem">Reveals pour ce film</h3>
                      <div class="small" style="margin-bottom:8px">Les reveals s'affichent seulement après avoir ouvert cette description.</div>
                      <div class="reveals-container" data-movie-id="<?php echo h($m['id']); ?>">
                        <!-- JS injectera le contenu ici (tableau de reveals) -->
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>

    <footer class="small" style="margin-top:18px">
      <div>Script d'affichage — protège et révise avant usage en production.</div>
    </footer>
  </div>

  <!-- Exposer les reveals groupés par movie_id au JS; JSON sécurisé -->
  <script>window.REVEALS_BY_MOVIE = <?php echo $revealsJson ?? '{}'; ?>;</script>

  <script src="cards-sequence.js" defer></script>
  <script src="theme-toggle.js" defer></script>
  <script src="films.js" defer></script>
  <script>
    // Footer year filler
    document.addEventListener('DOMContentLoaded', function(){ var y=document.getElementById('year'); if(y) y.textContent = new Date().getFullYear(); });
  </script>
</body>
</html>