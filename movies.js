// movies.js — version robuste et avec diagnostics
// - attache des listeners directement aux boutons .toggle-desc après DOMContentLoaded
// - tente plusieurs méthodes pour trouver le panel (.desc-panel) à ouvrir
// - logs clairs pour diagnostiquer les problèmes
// - fallback : MutationObserver pour boutons ajoutés dynamiquement
(function () {
  'use strict';

  const STORAGE_KEY = 'openDescriptionsByMovie';
  const REVEALS = (window.REVEALS_BY_MOVIE && typeof window.REVEALS_BY_MOVIE === 'object') ? window.REVEALS_BY_MOVIE : {};

  function log(...args) { console.log('[movies.js]', ...args); }
  function warn(...args) { console.warn('[movies.js]', ...args); }
  function error(...args) { console.error('[movies.js]', ...args); }

  document.addEventListener('DOMContentLoaded', init);
  // also attempt to init if scripts loaded after DOMContentLoaded
  if (document.readyState === 'interactive' || document.readyState === 'complete') {
    setTimeout(init, 0);
  }

  function init() {
    log('init start — looking for toggle buttons and panels');
    try {
      const savedOpen = loadOpenState();
      log('restored open state:', savedOpen);

      bindAllToggles(savedOpen);

      // Observe future additions (rare) so new buttons still work
      observeMutations(savedOpen);

      // Quick diagnostic summary
      log('REVEALS keys count:', Object.keys(REVEALS).length);
      log('Found toggle buttons:', document.querySelectorAll('.toggle-desc').length);
      log('Found desc-panels:', document.querySelectorAll('.desc-panel').length);
    } catch (err) {
      error('init error', err);
    }
  }

  function bindAllToggles(savedOpen) {
    const buttons = Array.from(document.querySelectorAll('.toggle-desc'));
    if (!buttons.length) {
      warn('No .toggle-desc buttons found in DOM.');
    }
    buttons.forEach(btn => bindToggle(btn, savedOpen));
  }

  function bindToggle(btn, savedOpen) {
    if (!btn || !(btn instanceof Element)) return;
    // avoid double-binding
    if (btn.__moviesBound) return;
    btn.__moviesBound = true;

    // ensure button type to avoid form submit
    try { if (btn.tagName === 'BUTTON' && (!btn.getAttribute('type') || btn.getAttribute('type') !== 'button')) btn.setAttribute('type', 'button'); } catch(e){}

    const movieId = String(btn.dataset.movieId ?? '').trim();
    const panelId = btn.getAttribute('aria-controls') || '';
    const panelRow = document.getElementById(panelId) || findPanelRowByMovieId(movieId);

    if (!panelRow) {
      warn('Could not find panel row for button', btn, 'panelId=', panelId, 'movieId=', movieId);
    } else {
      const descPanel = panelRow.querySelector('.desc-panel') || panelRow.querySelector('.desc-text') || panelRow;
      if (!descPanel) {
        warn('Could not find .desc-panel inside', panelRow);
      } else {
        // set initial aria / open state
        const shouldBeOpen = Array.isArray(savedOpen) && savedOpen.includes(movieId);
        btn.setAttribute('aria-expanded', shouldBeOpen ? 'true' : 'false');
        if (shouldBeOpen) descPanel.classList.add('open');
        else descPanel.classList.remove('open');
      }
    }

    // click handler
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      handleToggle(btn);
    });

    // keyboard support on focusable element (Enter/Space)
    btn.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        handleToggle(btn);
      }
    });
  }

  function handleToggle(btn) {
    try {
      const movieId = String(btn.dataset.movieId ?? '').trim();
      const panelId = btn.getAttribute('aria-controls') || '';
      const panelRow = document.getElementById(panelId) || findPanelRowByMovieId(movieId);
      if (!panelRow) {
        warn('Toggle: panel row not found for', { button: btn, panelId, movieId });
        return;
      }
      const descPanel = panelRow.querySelector('.desc-panel') || panelRow.querySelector('.desc-text') || panelRow;
      if (!descPanel) {
        warn('Toggle: desc-panel not found inside row', panelRow);
        return;
      }

      const currentlyOpen = btn.getAttribute('aria-expanded') === 'true';
      if (currentlyOpen) {
        btn.setAttribute('aria-expanded', 'false');
        descPanel.classList.remove('open');
        removeFromOpen(movieId);
        log('Closed description for movie', movieId);
      } else {
        btn.setAttribute('aria-expanded', 'true');
        descPanel.classList.add('open');
        addToOpen(movieId);
        log('Opened description for movie', movieId);
        // render reveals for this movie (once)
        renderRevealsForMovie(movieId, panelRow);
        // scroll into view briefly
        setTimeout(() => {
          try { descPanel.scrollIntoView({ behavior: 'smooth', block: 'nearest' }); } catch(e){}
        }, 120);
      }
      persistOpenState();
    } catch (err) {
      error('handleToggle error', err);
    }
  }

  function findPanelRowByMovieId(movieId) {
    if (!movieId) return null;
    // Try ids like desc-<id>
    const byId = document.getElementById('desc-' + movieId);
    if (byId) return byId;
    // Try matching data attributes
    const candidate = document.querySelector('.desc-row .reveals-container[data-movie-id="' + movieId + '"]');
    if (candidate) return candidate.closest('.desc-row') || candidate.closest('tr') || null;
    return null;
  }

  // Reveal rendering
  function renderRevealsForMovie(movieId, trElement) {
    if (!movieId || !trElement) return;
    const container = trElement.querySelector('.reveals-container[data-movie-id="' + movieId + '"]');
    if (!container) {
      // try to find any reveals-container inside this tr
      const alt = trElement.querySelector('.reveals-container');
      if (alt) {
        return renderRevealsForMovie(movieId, trElement); // will find the alt next call
      }
      warn('renderReveals: container not found for movie', movieId, trElement);
      return;
    }
    if (container.dataset.rendered === '1') {
      log('renderReveals: already rendered for', movieId);
      return;
    }

    const reveals = REVEALS[String(movieId)] || [];
    if (!reveals.length) {
      container.innerHTML = '<div class="small"><em>Aucun reveal pour ce film.</em></div>';
      container.dataset.rendered = '1';
      log('renderReveals: no reveals for', movieId);
      return;
    }

    // create rows
    const frag = document.createDocumentFragment();
    reveals.forEach(r => {
      const row = document.createElement('div');
      row.className = 'reveal-row';
      const col1 = document.createElement('div');
      col1.className = 'mono';
      col1.textContent = r.id ?? '';
      const col2 = document.createElement('div');
      col2.className = 'note';
      col2.textContent = r.comment ?? '';
      const col3 = document.createElement('div');
      col3.className = 'small';
      col3.style.textAlign = 'right';
      col3.innerHTML = (r.revealed_at ? escapeHtml(r.revealed_at) : '') + '<br><span class="small mono" style="opacity:.85">' + escapeHtml(r.session_token || '') + '</span>';
      row.appendChild(col1);
      row.appendChild(col2);
      row.appendChild(col3);
      frag.appendChild(row);
    });
    container.appendChild(frag);
    container.dataset.rendered = '1';
    log('renderReveals: rendered', reveals.length, 'reveals for', movieId);
  }

  // Persistence helpers
  function loadOpenState() {
    try {
      const raw = localStorage.getItem(STORAGE_KEY) || '[]';
      const arr = JSON.parse(raw);
      return Array.isArray(arr) ? arr.map(String) : [];
    } catch (e) {
      warn('Could not parse saved open state', e);
      return [];
    }
  }
  let _openCache = loadOpenState();
  function addToOpen(id) { if (!id) return; if (!_openCache.includes(String(id))) _openCache.push(String(id)); }
  function removeFromOpen(id) { if (!id) return; _openCache = _openCache.filter(x => x !== String(id)); }
  function persistOpenState() {
    try { localStorage.setItem(STORAGE_KEY, JSON.stringify(_openCache || [])); log('persisted open state', _openCache); }
    catch (e) { warn('Failed to persist open state', e); }
  }

  // utilities
  function escapeHtml(s) {
    if (s === null || s === undefined) return '';
    return String(s)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#039;');
  }

  // Observe DOM mutations to bind toggles inserted after initial load
  function observeMutations(savedOpen) {
    try {
      const obs = new MutationObserver(mutations => {
        let added = false;
        for (const m of mutations) {
          for (const node of Array.from(m.addedNodes || [])) {
            if (!(node instanceof Element)) continue;
            if (node.matches && node.matches('.toggle-desc')) {
              bindToggle(node, savedOpen);
              added = true;
            } else {
              const nested = node.querySelector && node.querySelector('.toggle-desc');
              if (nested) {
                bindAllToggles(savedOpen);
                added = true;
              }
            }
          }
        }
        if (added) log('MutationObserver: new toggles bound');
      });
      obs.observe(document.body, { childList: true, subtree: true });
    } catch (e) {
      warn('MutationObserver not available or failed', e);
    }
  }
})();