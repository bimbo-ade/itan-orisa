/**
 * ================================================================
 * MAIN.JS — YOUR THEME'S JAVASCRIPT
 * ================================================================
 *
 * JavaScript runs in the BROWSER (not the server like PHP).
 * It handles interactivity — things that happen when users
 * click, scroll, type etc.
 *
 * This file is loaded by WordPress via functions.php (wp_enqueue_script).
 *
 * ================================================================
 */


/**
 * DOMContentLoaded fires when the HTML is fully loaded and parsed.
 * We wrap all our code in this so we don't try to manipulate
 * elements before they exist on the page.
 */
document.addEventListener('DOMContentLoaded', function() {


    // ============================================================
    // STICKY HEADER — adds a class when user scrolls down
    // ============================================================
    // This lets us style the header differently once the user scrolls
    // (e.g. make background more opaque, shrink the logo etc.)

    const header = document.querySelector('.site-header');

    if (header) {
        window.addEventListener('scroll', function() {
            // If user has scrolled more than 50px from the top
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
                // Now you can target .site-header.scrolled in CSS
            } else {
                header.classList.remove('scrolled');
            }
        });
    }


    // ============================================================
    // SMOOTH SCROLL — smooth scrolling for anchor links
    // ============================================================
    // Anchor links are links like <a href="#about"> that jump
    // to a section on the same page. By default they jump instantly.
    // This makes them scroll smoothly instead.

    // querySelectorAll returns ALL elements matching the selector
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    // a[href^="#"] means: <a> tags whose href STARTS WITH "#"

    anchorLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {

            const targetId = this.getAttribute('href'); // e.g. "#about"
            const targetElement = document.querySelector(targetId);

            if (targetElement) {
                e.preventDefault(); // Stop the default instant jump

                // Get the header height so we don't scroll it behind the fixed nav
                const headerHeight = header ? header.offsetHeight : 0;
                const targetPosition = targetElement.offsetTop - headerHeight - 20;

                // Smooth scroll to the target
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth' // The magic keyword for smooth scrolling
                });
            }
        });
    });


    // ============================================================
    // FADE IN ON SCROLL — elements appear as you scroll to them
    // ============================================================
    // This uses the Intersection Observer API — a modern, performant
    // way to detect when elements enter the viewport (visible area).

    // First, add the initial hidden state class to elements we want to animate
    const fadeElements = document.querySelectorAll('.story-card, .about-text, .about-image');

    fadeElements.forEach(function(el) {
        el.classList.add('fade-in-ready');
        // We'll define .fade-in-ready and .fade-in-visible in CSS
    });

    // Create an Intersection Observer
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            // entry.isIntersecting is true when the element is visible in viewport
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in-visible');
                // Once it's visible, stop observing it (no need to re-animate)
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,  // Trigger when 10% of the element is visible
        rootMargin: '0px 0px -50px 0px' // Trigger 50px before the element reaches the bottom
    });

    // Tell the observer to watch each element
    fadeElements.forEach(function(el) {
        observer.observe(el);
    });


});
// End of DOMContentLoaded


/**
 * ============================================================
 * ADD THESE TO YOUR style.css FOR THE FADE ANIMATIONS TO WORK
 * ============================================================
 *
 * .fade-in-ready {
 *     opacity: 0;
 *     transform: translateY(30px);
 *     transition: opacity 0.6s ease, transform 0.6s ease;
 * }
 *
 * .fade-in-visible {
 *     opacity: 1;
 *     transform: translateY(0);
 * }
 *
 * ============================================================
 */
