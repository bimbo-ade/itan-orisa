/* =============================================================
   love-story.js  —  v2 "The Triangle"

   Vanilla, no dependencies, no build step.

   1.  Word-by-word heading reveal          [data-lt-split]
   2.  Section reveal                       [data-lt-reveal]
   3.  Stage cross-fade + accent travel     [data-lt-stage] / [data-tone]
   4.  Scroll progress, HUD, chapter rail   [data-lt-chapter]
   5.  Parallax on plates                   [data-lt-parallax]
   6.  Drifting dust canvas
   7.  Cursor bloom
   8.  Ambient audio with fade in/out
   ============================================================= */

(function () {
  'use strict';

  var root = document.querySelector('[data-lt]');
  if (!root) return;

  var reduced = matchMedia('(prefers-reduced-motion: reduce)').matches;
  var fine = matchMedia('(hover: hover) and (pointer: fine)').matches;

  var TONES = {
    ogun: '#4f9a72',
    oya: '#8b6ad6',
    sango: '#d9483f',
    ash: '#b9a67e'
  };

  /* -----------------------------------------------------------
     1. SPLIT HEADINGS
  ----------------------------------------------------------- */

  function split(el) {
    if (el.dataset.split === 'done') return;

    var walker = document.createTreeWalker(el, NodeFilter.SHOW_TEXT);
    var nodes = [];
    while (walker.nextNode()) nodes.push(walker.currentNode);

    var i = 0;

    nodes.forEach(function (node) {
      if (!node.nodeValue.trim()) return;

      var frag = document.createDocumentFragment();

      node.nodeValue.split(/(\s+)/).forEach(function (chunk) {
        if (!chunk) return;

        if (!chunk.trim()) {
          frag.appendChild(document.createTextNode(' '));
          return;
        }

        var outer = document.createElement('span');
        outer.className = 'lt-word';

        var inner = document.createElement('span');
        inner.textContent = chunk;
        inner.style.setProperty('--d', (i * 0.055).toFixed(3) + 's');
        i++;

        outer.appendChild(inner);
        frag.appendChild(outer);
      });

      node.parentNode.replaceChild(frag, node);
    });

    el.dataset.split = 'done';
  }

  var headings = [].slice.call(root.querySelectorAll('[data-lt-split]'));
  if (!reduced) headings.forEach(split);

  /* -----------------------------------------------------------
     2. REVEAL
  ----------------------------------------------------------- */

  var revealables = [].slice
    .call(root.querySelectorAll('[data-lt-reveal]'))
    .concat(headings)
    .concat([].slice.call(root.querySelectorAll('.lt-force')));

  if (reduced || !('IntersectionObserver' in window)) {
    revealables.forEach(function (el) { el.classList.add('is-in'); });
  } else {
    var revealObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('is-in');
        revealObserver.unobserve(entry.target);
      });
    }, { rootMargin: '0px 0px -12% 0px', threshold: 0.12 });

    revealables.forEach(function (el) { revealObserver.observe(el); });
  }

  /* -----------------------------------------------------------
     3. STAGE + ACCENT
  ----------------------------------------------------------- */

  var layers = [].slice.call(root.querySelectorAll('.lt-stage__layer'));
  var stageSections = [].slice.call(root.querySelectorAll('[data-lt-stage]'));
  var railLinks = [].slice.call(document.querySelectorAll('[data-lt-rail]'));
  var nowValue = document.querySelector('.lt-hud__now-value');

  var currentStage = null;
  var currentTone = null;

  function setStage(name) {
    if (name === currentStage) return;
    currentStage = name;

    root.classList.toggle('is-stage-off', name === 'none');

    layers.forEach(function (layer) {
      layer.classList.toggle('is-active', layer.dataset.stage === name);
    });
  }

  function setTone(tone) {
    if (tone === currentTone) return;
    currentTone = tone;
    root.style.setProperty('--accent', TONES[tone] || 'var(--bone-dim)');
  }

  if ('IntersectionObserver' in window && stageSections.length) {
    var stageObserver = new IntersectionObserver(function (entries) {
      // pick the most visible section currently on screen
      var best = null;
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        if (!best || entry.intersectionRatio > best.intersectionRatio) best = entry;
      });
      if (!best) return;

      var el = best.target;
      setStage(el.dataset.ltStage);
      if (el.dataset.tone) setTone(el.dataset.tone);

      var label = el.getAttribute('data-lt-chapter-label');
      var id = el.getAttribute('data-lt-chapter');

      if (nowValue) {
        nowValue.textContent = label
          ? label
          : (el.classList.contains('lt-hero') ? 'The Love Triangle' : nowValue.textContent);
      }

      railLinks.forEach(function (link) {
        link.classList.toggle('is-current', !!id && link.dataset.ltRail === id);
      });
    }, { threshold: [0.15, 0.4, 0.7], rootMargin: '-25% 0px -25% 0px' });

    stageSections.forEach(function (s) { stageObserver.observe(s); });
  }

  /* -----------------------------------------------------------
     4. SCROLL: progress, HUD, parallax
  ----------------------------------------------------------- */

  var progress = document.querySelector('[data-lt-progress]');
  var hud = document.querySelector('[data-lt-hud]');
  var rail = document.querySelector('.lt-rail');
  var parallaxEls = [].slice.call(root.querySelectorAll('[data-lt-parallax]'));

  var lastY = window.scrollY;
  var ticking = false;

  function onScroll() {
    var y = window.scrollY;
    var max = document.documentElement.scrollHeight - window.innerHeight;
    var pct = max > 0 ? Math.min(1, y / max) : 0;

    if (progress) progress.style.width = (pct * 100).toFixed(2) + '%';

    if (hud) hud.classList.toggle('is-visible', y > window.innerHeight * 0.6);
    if (rail) rail.classList.toggle('is-visible', y > window.innerHeight * 0.9 && pct < 0.96);

    if (!reduced) {
      var vh = window.innerHeight;
      parallaxEls.forEach(function (el) {
        var r = el.getBoundingClientRect();
        if (r.bottom < -200 || r.top > vh + 200) return;
        var mid = (r.top + r.height / 2 - vh / 2) / vh; // -1 … 1
        el.style.transform = 'translate3d(0,' + (mid * -22).toFixed(2) + 'px,0) scale(1.06)';
      });
    }

    lastY = y;
    ticking = false;
  }

  function requestScroll() {
    if (ticking) return;
    ticking = true;
    requestAnimationFrame(onScroll);
  }

  window.addEventListener('scroll', requestScroll, { passive: true });
  window.addEventListener('resize', requestScroll);
  onScroll();

  /* smooth anchor jumps from the rail */
  railLinks.forEach(function (link) {
    link.addEventListener('click', function (e) {
      var target = document.querySelector(link.getAttribute('href'));
      if (!target) return;
      e.preventDefault();
      target.scrollIntoView({ behavior: reduced ? 'auto' : 'smooth', block: 'start' });
    });
  });

  /* -----------------------------------------------------------
     5. DUST
  ----------------------------------------------------------- */

  var canvas = root.querySelector('.lt-dust');

  if (canvas && !reduced) {
    var ctx = canvas.getContext('2d');
    var dpr = Math.min(window.devicePixelRatio || 1, 2);
    var motes = [];
    var running = true;

    function sizeCanvas() {
      canvas.width = window.innerWidth * dpr;
      canvas.height = window.innerHeight * dpr;
      canvas.style.width = window.innerWidth + 'px';
      canvas.style.height = window.innerHeight + 'px';
      ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

      var count = Math.round((window.innerWidth * window.innerHeight) / 26000);
      count = Math.max(24, Math.min(90, count));

      motes = [];
      for (var i = 0; i < count; i++) {
        motes.push({
          x: Math.random() * window.innerWidth,
          y: Math.random() * window.innerHeight,
          r: Math.random() * 1.4 + 0.3,
          vx: (Math.random() - 0.5) * 0.16,
          vy: -(Math.random() * 0.22 + 0.04),
          a: Math.random() * 0.4 + 0.08,
          p: Math.random() * Math.PI * 2
        });
      }
    }

    function accentRGB() {
      var hex = TONES[currentTone] || '#cfc7b8';
      return [
        parseInt(hex.slice(1, 3), 16),
        parseInt(hex.slice(3, 5), 16),
        parseInt(hex.slice(5, 7), 16)
      ];
    }

    function tick() {
      if (!running) return;
      ctx.clearRect(0, 0, window.innerWidth, window.innerHeight);

      var c = accentRGB();

      motes.forEach(function (m) {
        m.p += 0.01;
        m.x += m.vx + Math.sin(m.p) * 0.18;
        m.y += m.vy;

        if (m.y < -10) { m.y = window.innerHeight + 10; m.x = Math.random() * window.innerWidth; }
        if (m.x < -10) m.x = window.innerWidth + 10;
        if (m.x > window.innerWidth + 10) m.x = -10;

        ctx.beginPath();
        ctx.arc(m.x, m.y, m.r, 0, Math.PI * 2);
        ctx.fillStyle = 'rgba(' + c[0] + ',' + c[1] + ',' + c[2] + ',' + m.a + ')';
        ctx.fill();
      });

      requestAnimationFrame(tick);
    }

    sizeCanvas();
    window.addEventListener('resize', sizeCanvas);
    document.addEventListener('visibilitychange', function () {
      running = !document.hidden;
      if (running) tick();
    });
    tick();
  }

  /* -----------------------------------------------------------
     6. CURSOR BLOOM
  ----------------------------------------------------------- */

  var cursor = root.querySelector('.lt-cursor');

  if (cursor && fine && !reduced) {
    var cx = window.innerWidth / 2;
    var cy = window.innerHeight / 2;
    var tx = cx;
    var ty = cy;

    window.addEventListener('mousemove', function (e) {
      tx = e.clientX;
      ty = e.clientY;
    }, { passive: true });

    (function follow() {
      cx += (tx - cx) * 0.08;
      cy += (ty - cy) * 0.08;
      cursor.style.transform = 'translate3d(' + cx + 'px,' + cy + 'px,0)';
      requestAnimationFrame(follow);
    })();
  }

  /* -----------------------------------------------------------
     7. AMBIENT AUDIO
  ----------------------------------------------------------- */

  var audio = document.getElementById('lt-ambience');
  var soundBtn = document.querySelector('[data-lt-sound]');

  if (audio && soundBtn) {
    var TARGET = 0.35;
    var fadeTimer = null;
    var on = false;

    function fade(to, done) {
      clearInterval(fadeTimer);
      fadeTimer = setInterval(function () {
        var delta = to - audio.volume;
        if (Math.abs(delta) < 0.02) {
          audio.volume = to;
          clearInterval(fadeTimer);
          if (done) done();
          return;
        }
        audio.volume = Math.max(0, Math.min(1, audio.volume + delta * 0.12));
      }, 40);
    }

    function setOn(next) {
      on = next;
      soundBtn.setAttribute('aria-pressed', String(on));
      soundBtn.setAttribute('aria-label', on ? 'Turn story ambience off' : 'Turn story ambience on');

      if (on) {
        audio.volume = 0;
        var p = audio.play();
        if (p && p.catch) p.catch(function () { setOn(false); });
        fade(TARGET);
      } else {
        fade(0, function () { audio.pause(); });
      }
    }

    soundBtn.addEventListener('click', function () { setOn(!on); });

    document.addEventListener('visibilitychange', function () {
      if (!on) return;
      fade(document.hidden ? 0.06 : TARGET);
    });
  }
})();




// CULTURAL CONTEXT JS FOR NAV
(function () {
  var sections = document.querySelectorAll('.cc-section');
  var links = document.querySelectorAll('.cc-nav-link');
  if (!sections.length || !links.length) return;
  var observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (!entry.isIntersecting) return;
      links.forEach(function (l) { l.classList.remove('active'); });
      var active = document.querySelector(
        '.cc-nav-link[href="#' + entry.target.id + '"]'
      );
      if (active) active.classList.add('active');
    });
  }, { threshold: 0.3 });
  sections.forEach(function (s) { observer.observe(s); });
}());



// GODS FAQ TOGGLE
document.querySelectorAll('.god-faq details').forEach(function (d) {
  d.addEventListener('toggle', function () {
    var plus = d.querySelector('summary span:last-child');
    if (plus) plus.textContent = d.open ? '−' : '+';
  });
});
