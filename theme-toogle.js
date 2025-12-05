// theme-toggle.js
// Gère la bascule thème clair/sombre et la persistance dans localStorage (clé: uiSettings)
// Attache un bouton #themeToggle (défini dans movies_list.php)
(function () {
  'use strict';

  const STORAGE_KEY = 'uiSettings';

  document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('themeToggle');
    if (!btn) return;

    // Read saved settings
    let uiSettings = {};
    try {
      uiSettings = JSON.parse(localStorage.getItem(STORAGE_KEY) || '{}') || {};
    } catch (e) {
      uiSettings = {};
    }

    const isDark = typeof uiSettings.dark === 'boolean' ? uiSettings.dark : false;
    apply(isDark, false);

    btn.addEventListener('click', () => {
      const currentlyDark = document.body.classList.contains('dark-theme');
      apply(!currentlyDark, true);
    });

    // Also respond to system-level changes (optional)
    if (window.matchMedia) {
      const mq = window.matchMedia('(prefers-color-scheme: dark)');
      mq.addEventListener && mq.addEventListener('change', (e) => {
        // only apply if user hasn't explicitly chosen a preference
        const saved = JSON.parse(localStorage.getItem(STORAGE_KEY) || '{}') || {};
        if (typeof saved.dark === 'boolean') return;
        apply(e.matches, false);
      });
    }

    function apply(dark, persist) {
      if (dark) {
        document.body.classList.add('dark-theme');
        btn.setAttribute('aria-pressed', 'true');
        btn.innerHTML = '🌙 Sombre';
      } else {
        document.body.classList.remove('dark-theme');
        btn.setAttribute('aria-pressed', 'false');
        btn.innerHTML = '☀️ Clair';
      }
      if (persist) {
        try {
          const cur = JSON.parse(localStorage.getItem(STORAGE_KEY) || '{}') || {};
          cur.dark = dark;
          localStorage.setItem(STORAGE_KEY, JSON.stringify(cur));
        } catch (e) { /* ignore */ }
      }
    }
  });
})();