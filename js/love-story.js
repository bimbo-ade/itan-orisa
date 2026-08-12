/**
 * love-story.js
 * Everything for the Love Triangle page in one file:
 *   1. Scroll reveal (.love-reveal → .is-visible)
 *   2. Ambient sound toggle (off by default, always)
 *   3. Split-text word reveal (.love-split)
 *   4. Continuous scroll-linked parallax (.love-parallax-img / -fade)
 *   5. Ember particles (canvas)
 *   6. Cursor glow (hero, fine-pointer devices only)
 *   7. Scroll progress bar + chapter rail
 *
 * Effects 3–7 fully skip initialization under prefers-reduced-
 * motion — not just visually suppressed, they never run at all,
 * which is better for both correctness and battery/performance.
 */
(function () {
    'use strict';

    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var story = document.querySelector('.love-story');
    if (!story) return;


    // ------------------------------------------------------------
    // 1. SCROLL REVEAL — runs regardless of reduced-motion (it
    // controls VISIBILITY, not just decoration; if this didn't
    // run, whole sections would stay invisible forever). Under
    // reduced motion it just shows everything immediately instead
    // of animating it in.
    // ------------------------------------------------------------
    (function scrollReveal() {
        var revealEls = document.querySelectorAll('.love-reveal');
        if (!revealEls.length) return;

        if (reduceMotion || !('IntersectionObserver' in window)) {
            revealEls.forEach(function (el) {
                el.classList.add('is-visible');
            });
            return;
        }

        var revealObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -80px 0px' });

        revealEls.forEach(function (el) { revealObserver.observe(el); });
    })();


    // ------------------------------------------------------------
    // 2. AMBIENT SOUND TOGGLE — off by default, always. Only a
    // click can start it; nothing here ever autoplays. Button/
    // audio elements only exist in the DOM if an ambient file was
    // set in ACF, so these selectors safely find nothing otherwise.
    // ------------------------------------------------------------
    (function soundToggle() {
        var soundBtn = document.querySelector('.love-sound-toggle');
        var audioEl = document.getElementById('love-ambience');
        var soundLabel = soundBtn ? soundBtn.querySelector('.love-sound-label') : null;
        if (!soundBtn || !audioEl) return;

        var STORAGE_KEY = 'love-story-ambience';
        audioEl.volume = 0.35;

        function setSoundState(isOn) {
            soundBtn.setAttribute('aria-pressed', isOn ? 'true' : 'false');
            soundBtn.setAttribute('aria-label', isOn ? 'Turn story ambience off' : 'Turn story ambience on');
            if (soundLabel) soundLabel.textContent = isOn ? 'Sound on' : 'Sound off';
        }

        soundBtn.addEventListener('click', function () {
            var isOn = soundBtn.getAttribute('aria-pressed') === 'true';
            if (isOn) {
                audioEl.pause();
                setSoundState(false);
                localStorage.setItem(STORAGE_KEY, 'off');
            } else {
                audioEl.play().catch(function () { /* fail silently */ });
                setSoundState(true);
                localStorage.setItem(STORAGE_KEY, 'on');
            }
        });

        // Restore the visual state on return visits. Actual auto-
        // resume depends on the browser's autoplay policy — if
        // it's blocked, we don't lie about the state.
        if (localStorage.getItem(STORAGE_KEY) === 'on') {
            audioEl.play().then(function () {
                setSoundState(true);
            }).catch(function () {
                setSoundState(false);
                localStorage.setItem(STORAGE_KEY, 'off');
            });
        }
    })();


    // Everything below is pure motion/decoration — skip entirely
    // under reduced motion rather than running it and hiding the
    // result with CSS.
    if (reduceMotion) return;


    // ------------------------------------------------------------
    // 3. SPLIT-TEXT WORD REVEAL
    // ------------------------------------------------------------
    (function splitText() {
        var targets = document.querySelectorAll('.love-split');
        if (!targets.length) return;

        targets.forEach(function (el) {
            var words = el.textContent.trim().split(/\s+/);
            el.textContent = '';

            words.forEach(function (word, i) {
                var outer = document.createElement('span');
                outer.className = 'word';

                var inner = document.createElement('span');
                inner.className = 'word-inner';
                inner.textContent = word;
                inner.style.transitionDelay = (i * 0.045) + 's';

                outer.appendChild(inner);
                el.appendChild(outer);
                if (i < words.length - 1) el.appendChild(document.createTextNode(' '));
            });
        });

        if ('IntersectionObserver' in window) {
            var splitObserver = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        splitObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.4 });

            targets.forEach(function (el) { splitObserver.observe(el); });
        } else {
            targets.forEach(function (el) { el.classList.add('is-visible'); });
        }
    })();


    // ------------------------------------------------------------
    // 4. SCROLL-LINKED PARALLAX
    // ------------------------------------------------------------
    (function scrollParallax() {
        var imgTargets = document.querySelectorAll('.love-parallax-img');
        var fadeTargets = document.querySelectorAll('.love-parallax-fade');
        if (!imgTargets.length && !fadeTargets.length) return;

        var ticking = false;

        function update() {
            var vh = window.innerHeight;

            imgTargets.forEach(function (el) {
                var rect = el.getBoundingClientRect();
                var centerOffset = (rect.top + rect.height / 2) - vh / 2;
                var y = Math.max(-60, Math.min(60, centerOffset * 0.08));
                el.style.setProperty('--parallax-y', y + 'px');
            });

            fadeTargets.forEach(function (el) {
                var rect = el.getBoundingClientRect();
                var visibleRatio = 1 - Math.min(1, Math.max(0,
                    Math.abs((rect.top + rect.height / 2) - vh / 2) / (vh / 1.4)
                ));
                el.style.setProperty('--parallax-opacity', (0.3 + visibleRatio * 0.7).toFixed(2));
                el.style.setProperty('--parallax-blur', ((1 - visibleRatio) * 4).toFixed(1) + 'px');
            });

            ticking = false;
        }

        window.addEventListener('scroll', function () {
            if (!ticking) {
                requestAnimationFrame(update);
                ticking = true;
            }
        }, { passive: true });

        update();
    })();


    // ------------------------------------------------------------
    // 5. EMBER PARTICLES
    // ------------------------------------------------------------
    (function embers() {
        var canvas = document.querySelector('.love-embers');
        if (!canvas) return;

        var ctx = canvas.getContext('2d');
        var particles = [];
        var count = window.innerWidth < 700 ? 18 : 40;
        var dpr = Math.min(window.devicePixelRatio || 1, 2);

        function resize() {
            canvas.width = window.innerWidth * dpr;
            canvas.height = window.innerHeight * dpr;
            canvas.style.width = window.innerWidth + 'px';
            canvas.style.height = window.innerHeight + 'px';
            ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
        }
        resize();
        window.addEventListener('resize', resize);

        function makeParticle() {
            return {
                x: Math.random() * window.innerWidth,
                y: window.innerHeight + Math.random() * 100,
                r: Math.random() * 2 + 0.5,
                speed: Math.random() * 0.6 + 0.2,
                drift: (Math.random() - 0.5) * 0.4,
                alpha: Math.random() * 0.5 + 0.2,
                hue: Math.random() > 0.5 ? '200,162,74' : '166,56,39'
            };
        }
        for (var i = 0; i < count; i++) {
            var p = makeParticle();
            p.y = Math.random() * window.innerHeight;
            particles.push(p);
        }

        var visible = true;
        document.addEventListener('visibilitychange', function () {
            visible = !document.hidden;
        });

        function tick() {
            if (visible) {
                ctx.clearRect(0, 0, window.innerWidth, window.innerHeight);
                particles.forEach(function (p) {
                    p.y -= p.speed;
                    p.x += p.drift;
                    if (p.y < -10) Object.assign(p, makeParticle(), { y: window.innerHeight + 10 });

                    ctx.beginPath();
                    ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                    ctx.fillStyle = 'rgba(' + p.hue + ',' + p.alpha + ')';
                    ctx.fill();
                });
            }
            requestAnimationFrame(tick);
        }
        tick();
    })();


    // ------------------------------------------------------------
    // 6. CURSOR GLOW — hero only, fine-pointer devices only
    // ------------------------------------------------------------
    (function cursorGlow() {
        if (!window.matchMedia('(pointer: fine)').matches) return;

        var hero = document.querySelector('.love-hero');
        var glow = document.querySelector('.love-cursor-glow');
        if (!hero || !glow) return;

        var targetX = 0, targetY = 0, currentX = 0, currentY = 0;

        hero.addEventListener('mouseenter', function () {
            glow.classList.add('is-active');
        });
        hero.addEventListener('mouseleave', function () {
            glow.classList.remove('is-active');
        });
        hero.addEventListener('mousemove', function (e) {
            var rect = hero.getBoundingClientRect();
            targetX = e.clientX - rect.left;
            targetY = e.clientY - rect.top;
        });

        function lerp() {
            currentX += (targetX - currentX) * 0.08;
            currentY += (targetY - currentY) * 0.08;
            glow.style.transform = 'translate3d(' + currentX + 'px, ' + currentY + 'px, 0) translate(-50%, -50%)';
            requestAnimationFrame(lerp);
        }
        lerp();
    })();


    // ------------------------------------------------------------
    // 7. PROGRESS BAR + CHAPTER RAIL
    // ------------------------------------------------------------
    (function progress() {
        var bar = document.querySelector('.love-progress-bar');
        var railLinks = document.querySelectorAll('.love-chapter-rail a');
        var chapterSections = document.querySelectorAll('[data-chapter]');

        if (bar) {
            var ticking = false;
            window.addEventListener('scroll', function () {
                if (ticking) return;
                ticking = true;
                requestAnimationFrame(function () {
                    var max = document.documentElement.scrollHeight - window.innerHeight;
                    var pct = max > 0 ? (window.scrollY / max) * 100 : 0;
                    bar.style.setProperty('--scroll-progress', pct.toFixed(1) + '%');
                    ticking = false;
                });
            }, { passive: true });
        }

        if (railLinks.length && chapterSections.length && 'IntersectionObserver' in window) {
            var railObserver = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (!entry.isIntersecting) return;
                    var num = entry.target.getAttribute('data-chapter');
                    railLinks.forEach(function (link) {
                        link.classList.toggle('is-active', link.getAttribute('data-chapter') === num);
                    });
                });
            }, { rootMargin: '-45% 0px -50% 0px' });

            chapterSections.forEach(function (section) { railObserver.observe(section); });
        }
    })();

})();