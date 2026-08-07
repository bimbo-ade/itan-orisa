<?php
/*
Template Name: Accessibility
*/

get_header();
?>

<main class="accessibility-page">

    <section class="accessibility-hero">
        <div class="container">

            <span class="eyebrow">Accessibility</span>

            <h1>Designed To Be Experienced By Everyone</h1>

            <p class="lead">
                Itàn Orìṣà is designed to be inclusive, readable and accessible.
                Accessibility has been considered throughout the design process,
                from typography and colour choices to keyboard navigation,
                responsive layouts and semantic HTML.
            </p>

        </div>
    </section>


    <section class="accessibility-section">
        <div class="container">

            <h2>Design Principles</h2>

            <div class="accessibility-grid">

                <article>
                    <h3>Readable Typography</h3>
                    <p>
                        Large headings, generous spacing and clear hierarchy help
                        readers scan content comfortably across desktop and mobile
                        devices.
                    </p>
                </article>

                <article>
                    <h3>Colour & Contrast</h3>
                    <p>
                        Although the site embraces a dark visual style to create
                        the atmosphere of mythological storytelling, text colours
                        have been chosen to maintain strong contrast against their
                        backgrounds wherever possible.
                    </p>
                </article>

                <article>
                    <h3>Keyboard Navigation</h3>
                    <p>
                        Interactive elements including navigation, buttons,
                        accordions and links can be accessed using only the
                        keyboard, with visible focus states throughout.
                    </p>
                </article>

                <article>
                    <h3>Responsive Design</h3>
                    <p>
                        Layouts adapt across phones, tablets and desktop screens,
                        ensuring content remains readable without horizontal
                        scrolling.
                    </p>
                </article>

            </div>

        </div>
    </section>


    <section class="accessibility-section">
        <div class="container">

            <h2>Accessibility Features</h2>

            <ul class="accessibility-list">
                <li>Semantic HTML5 landmarks and heading structure.</li>
                <li>Alternative text provided for meaningful imagery.</li>
                <li>Decorative images hidden from screen readers where appropriate.</li>
                <li>Keyboard-accessible navigation and interactive controls.</li>
                <li>Visible hover and focus states.</li>
                <li>Responsive layouts across different screen sizes.</li>
                <li>Consistent navigation throughout the website.</li>
                <li>Clear language and readable content structure.</li>
            </ul>

        </div>
    </section>


    <section class="accessibility-section">
        <div class="container">

            <h2>Known Limitations</h2>

            <p>
                This project explores a visually immersive experience using
                atmospheric imagery and dramatic colour palettes. While care has
                been taken to maximise readability, some artistic elements may
                not meet every accessibility preference. Future iterations will
                continue improving colour contrast, motion preferences and screen
                reader optimisation.
            </p>

        </div>
    </section>


    <section class="accessibility-section">
        <div class="container">

            <h2>Standards</h2>

            <p>
                This website has been designed with reference to the
                <strong>Web Content Accessibility Guidelines (WCAG) 2.2 AA</strong>
                and modern HTML accessibility best practices where appropriate.
            </p>

        </div>
    </section>

</main>

<?php get_footer(); ?>