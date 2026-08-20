<?php
/**
 * Template Name: Accessibility

 */

get_header();

while (have_posts()):
    the_post();

    $intro = get_field('a11y_intro');
    $last_updated = get_field('a11y_last_updated');
    ?>

    <div class="a11y-page">

        <header class="a11y-header">
            <h1><?php the_title(); ?></h1>
            <?php if ($intro): ?>
                <p class="a11y-intro"><?php echo esc_html($intro); ?></p>
            <?php endif; ?>
            <?php if ($last_updated): ?>
                <p class="a11y-updated">Last updated: <?php echo esc_html($last_updated); ?></p>
            <?php endif; ?>
        </header>

        <div class="a11y-body">
           
                <h2>Our Commitment</h2>
                <p>Ìtàn Òrìṣà is built to be usable by as many people as possible, regardless of ability or how they browse the
                    web. Accessibility is not an afterthought; it is considered throughout the design and development of the
                    site, section by section.</p>

                <h2>What We've Built In</h2>
                <ul>
                    <li><strong>Keyboard navigation.</strong> The mobile menu, FAQ accordions, and links can be operated without
                        a mouse using keyboard controls such as Tab, Enter, and Space.</li>
                    <li><strong>Visible focus states.</strong> Interactive elements have clear focus indicators when navigated
                        using a keyboard, making it easier to see where you are on the page.</li>
                    <li><strong>Reduced motion support.</strong>
                        If your device or browser is set to reduce motion, animations and transitions across the site are
                        automatically reduced or disabled where appropriate.</li>
                    <li><strong>Semantic structure.</strong> HThe site uses meaningful headings, landmarks, labels, and ARIA
                        attributes where appropriate to help communicate the structure and purpose of content to assistive
                        technologies.</li>
                    <li><strong>Alt text on meaningful images.</strong> Meaningful images, including symbols and artefacts, are
                        given descriptive alternative text. Decorative and atmospheric imagery is marked so that it can be
                        ignored by screen readers.</li>
                </ul>


                <h2>Feedback</h2>
                <p>Accessibility is an ongoing process, and there may still be parts of the site that could be improved.

                    If you experience difficulty using any part of Ìtàn Òrìṣà, I would genuinely like to hear about it. When
                    getting in touch, it is helpful to include the page you were visiting, the device and browser you were
                    using, and any assistive technology involved.

                    Your feedback can help identify problems that may otherwise be missed and improve the experience for future
                    visitors.</p>
        </div>

    </div>

<?php endwhile; ?>
<?php get_footer(); ?>