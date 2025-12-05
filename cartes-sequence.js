/* cards-reveal.js
   - Gestion séquentielle des cartes
   - Accessibilité : clavier, aria-live, focus management
   - Persistance : sauvegarde des cartes révélées dans localStorage
   - Modification : la première carte ne s'affiche que lorsque l'utilisateur appuie sur "Continuer"
   (fichier inchangé fonctionnel ; styling est maintenant dans styles.css)
*/

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', init);

  function init() {
    // Footer year
    const yearEl = document.getElementById('year');
    if (yearEl) yearEl.textContent = new Date().getFullYear();

    const cardsContainer = document.getElementById('cardsContainer');
    if (!cardsContainer) return;

    const persistKey = cardsContainer.dataset.persistKey || 'cards-sequence';
    const cards = Array.from(cardsContainer.querySelectorAll('.card'));
    const announceEl = document.getElementById('announce');
    const startBtn = document.getElementById('startBtn');

    // Normalize structure: ensure each card has proper index and .card-content wrapper exists
    cards.forEach((c, i) => {
      c.dataset.index = i;
      const content = c.querySelector('.card-content');
      if (!content) {
        const wrapper = document.createElement('div');
        wrapper.className = 'card-content';
        while (c.firstChild) wrapper.appendChild(c.firstChild);
        c.appendChild(wrapper);
      }
      // Ensure cards are focusable for keyboard navigation
      if (!c.hasAttribute('tabindex')) c.setAttribute('tabindex', '0');
    });

    // Load persisted revealed indices (array of indexes)
    const saved = loadPersist(persistKey);

    if (Array.isArray(saved) && saved.length > 0) {
      // If user has saved progress, restore it (may include the first card)
      applyRevealedFromSaved(cards, saved);
      // If first card was already revealed, hide/disable startBtn
      if (saved.includes(0) && startBtn) {
        startBtn.disabled = true;
        startBtn.setAttribute('aria-expanded', 'true');
      }
    } else {
      // Default behaviour requested : DO NOT show any card until user clicks "Continuer"
      cards.forEach(card => hideCard(card, false));
      // ensure startBtn is enabled
      if (startBtn) {
        startBtn.disabled = false;
        startBtn.setAttribute('aria-expanded', 'false');
      }
      persistRevealed(cards, persistKey);
    }

    // Start button: reveal the first card (index 0)
    if (startBtn) {
      startBtn.addEventListener('click', function (e) {
        e.preventDefault();
        const first = cardsContainer.querySelector('.card[data-index="0"]');
        if (first && first.classList.contains('hidden')) {
          revealCard(first, true);
          persistRevealed(cards, persistKey);
          // focus the revealed card slightly after reveal for smoothness
          setTimeout(() => first.focus(), 150);
          // disable/hide start button after use
          startBtn.disabled = true;
          startBtn.setAttribute('aria-expanded', 'true');
        }
      });
    }

    // Click delegation
    cardsContainer.addEventListener('click', function (e) {
      const card = e.target.closest('.card');
      if (!card) return;
      if (card.classList.contains('hidden')) return; // ignore hidden clicks
      revealNextFrom(card.dataset.index);
    });

    // Keyboard handling: Enter/Space => reveal next; Arrow keys navigate visible cards
    cardsContainer.addEventListener('keydown', function (e) {
      const targetCard = e.target.closest('.card');
      if (!targetCard) return;

      switch (e.key) {
        case 'Enter':
        case ' ':
          e.preventDefault();
          if (!targetCard.classList.contains('hidden')) revealNextFrom(targetCard.dataset.index);
          break;
        case 'ArrowRight':
          focusRelativeVisible(targetCard, +1);
          break;
        case 'ArrowLeft':
          focusRelativeVisible(targetCard, -1);
          break;
        case 'Home':
          focusFirstVisible();
          break;
        case 'End':
          focusLastVisible();
          break;
      }
    });

    // Controls
    const resetBtn = document.getElementById('resetCards');
    const revealAllBtn = document.getElementById('revealAll');

    if (resetBtn) resetBtn.addEventListener('click', resetCards);
    if (revealAllBtn) revealAllBtn.addEventListener('click', revealAll);

    // Settings panel toggling and palette handling (lightweight, kept simple)
    setupSettings();

    /* ----- Functions ----- */

    function revealNextFrom(currentIndex) {
      const nextIndex = Number(currentIndex) + 1;
      const next = cardsContainer.querySelector(`.card[data-index="${nextIndex}"]`);
      if (next) {
        revealCard(next, true);
        setTimeout(() => next.focus(), 150);
        persistRevealed(cards, persistKey);
      } else {
        announce('Toutes les cartes sont affichées.');
      }
    }

    function revealCard(card, announceIt) {
      card.classList.remove('hidden');
      card.classList.add('revealed');
      card.setAttribute('aria-expanded', 'true');
      if (announceIt) announce(`Affiché : ${getCardTitle(card)}`);
    }

    function hideCard(card, announceIt) {
      card.classList.add('hidden');
      card.classList.remove('revealed');
      card.setAttribute('aria-expanded', 'false');
      if (announceIt) announce(`Caché : ${getCardTitle(card)}`);
    }

    function resetCards() {
      // hide all cards and re-enable start button
      cards.forEach(card => hideCard(card, false));
      persistRevealed(cards, persistKey);
      const first = cardsContainer.querySelector('.card[data-index="0"]');
      if (first) first.focus();
      // re-enable start button so user can "Continuer" again
      if (startBtn) {
        startBtn.disabled = false;
        startBtn.setAttribute('aria-expanded', 'false');
      }
      announce('Affichage réinitialisé.');
    }

    function revealAll() {
      cards.forEach(card => revealCard(card, false));
      persistRevealed(cards, persistKey);
      // disable startBtn if all revealed (since first is visible)
      if (startBtn) {
        startBtn.disabled = true;
        startBtn.setAttribute('aria-expanded', 'true');
      }
      announce('Toutes les cartes sont affichées.');
    }

    function applyRevealedFromSaved(cardsList, savedIndexes) {
      const toReveal = new Set(savedIndexes.map(Number));
      cardsList.forEach((card, i) => {
        if (toReveal.has(i)) revealCard(card, false);
        else hideCard(card, false);
      });
    }

    function persistRevealed(cardsList, key) {
      const revealed = cardsList
        .map((c, i) => ({ c, i }))
        .filter(x => !x.c.classList.contains('hidden'))
        .map(x => x.i);
      try {
        localStorage.setItem(key, JSON.stringify(revealed));
      } catch (err) {
        // ignore storage errors (e.g. private mode)
      }
    }

    function loadPersist(key) {
      try {
        const raw = localStorage.getItem(key);
        return raw ? JSON.parse(raw) : null;
      } catch (err) {
        return null;
      }
    }

    function getCardTitle(card) {
      const t = card.querySelector('.card-title');
      return t ? t.textContent.trim() : `carte ${card.dataset.index}`;
    }

    function announce(text) {
      if (!announceEl) return;
      announceEl.textContent = text;
    }

    function focusRelativeVisible(currentCard, delta) {
      const visible = cards.filter(c => !c.classList.contains('hidden'));
      const idx = visible.indexOf(currentCard);
      if (idx === -1) return;
      const nextIdx = Math.max(0, Math.min(visible.length - 1, idx + delta));
      visible[nextIdx].focus();
    }

    function focusFirstVisible() {
      const visible = cards.filter(c => !c.classList.contains('hidden'));
      if (visible.length) visible[0].focus();
    }

    function focusLastVisible() {
      const visible = cards.filter(c => !c.classList.contains('hidden'));
      if (visible.length) visible[visible.length - 1].focus();
    }

    function setupSettings() {
      const root = document.documentElement;
      const primaryInput = document.getElementById('primaryColor');
      const bgInput = document.getElementById('bgColor');
      const darkModeCheckbox = document.getElementById('darkMode');
      const resetBtnPalette = document.getElementById('resetBtn');
      const toggleSettingsBtn = document.getElementById('toggleSettings');
      const settingsPanel = document.getElementById('settings');

      const defaults = {
        primary: getComputedStyle(root).getPropertyValue('--primary').trim() || '#1d4ed8',
        bg: getComputedStyle(root).getPropertyValue('--bg').trim() || '#f8fafc',
        dark: false
      };

      const savedPalette = JSON.parse(localStorage.getItem('uiSettings') || '{}');
      const initial = {
        primary: savedPalette.primary || defaults.primary,
        bg: savedPalette.bg || defaults.bg,
        dark: typeof savedPalette.dark === 'boolean' ? savedPalette.dark : defaults.dark
      };

      setVar('--primary', initial.primary);
      setVar('--bg', initial.bg);
      if (primaryInput) primaryInput.value = toHex(initial.primary);
      if (bgInput) bgInput.value = toHex(initial.bg);
      if (darkModeCheckbox) darkModeCheckbox.checked = initial.dark;
      applyDarkMode(initial.dark);

      if (primaryInput) primaryInput.addEventListener('input', (e) => {
        setVar('--primary', e.target.value);
        saveSetting('primary', e.target.value);
      });
      if (bgInput) bgInput.addEventListener('input', (e) => {
        setVar('--bg', e.target.value);
        saveSetting('bg', e.target.value);
      });
      if (darkModeCheckbox) darkModeCheckbox.addEventListener('change', (e) => {
        applyDarkMode(e.target.checked);
        saveSetting('dark', e.target.checked);
      });

      if (resetBtnPalette) resetBtnPalette.addEventListener('click', () => {
        setVar('--primary', defaults.primary);
        setVar('--bg', defaults.bg);
        if (primaryInput) primaryInput.value = toHex(defaults.primary);
        if (bgInput) bgInput.value = toHex(defaults.bg);
        if (darkModeCheckbox) darkModeCheckbox.checked = defaults.dark;
        applyDarkMode(defaults.dark);
        localStorage.removeItem('uiSettings');
      });

      if (toggleSettingsBtn) toggleSettingsBtn.addEventListener('click', () => {
        const hidden = settingsPanel.classList.toggle('hidden');
        settingsPanel.setAttribute('aria-hidden', String(hidden));
        toggleSettingsBtn.setAttribute('aria-expanded', String(!hidden));
      });

      function setVar(name, value) { root.style.setProperty(name, value); }
      function saveSetting(key, value) {
        const cur = JSON.parse(localStorage.getItem('uiSettings') || '{}');
        cur[key] = value;
        localStorage.setItem('uiSettings', JSON.stringify(cur));
      }
      function applyDarkMode(enabled) {
        if (enabled) {
          setVar('--bg', '#0b1220');
          setVar('--card', '#071024');
          setVar('--text', '#e6eef8');
          setVar('--muted', '#9fb1cc');
        } else {
          const savedBg = JSON.parse(localStorage.getItem('uiSettings') || '{}').bg || defaults.bg;
          setVar('--bg', savedBg);
          setVar('--card', '#ffffff');
          setVar('--text', '#0f172a');
          setVar('--muted', '#64748b');
        }
      }
      function toHex(color) {
        if (!color) return '#000000';
        color = color.trim();
        if (color.startsWith('#')) return color;
        const m = color.match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)/i);
        if (!m) return '#000000';
        return '#' + [1,2,3].map(i => Number(m[i]).toString(16).padStart(2,'0')).join('');
      }
    }
  }
})();