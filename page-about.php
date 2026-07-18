<?php
/**
 * Template Name: About Page
 *
 * Personal and project-focused only.
 * Rule: if it says "I" — it belongs here.
 * Cultural education lives in page-cultural-context.php.
 *
 * Classes used:
 *   .about-page          — root wrapper (scopes all CSS)
 *   .ab-hero             — hero section
 *   .ab-pull-quote       — atmospheric quote break
 *   .ab-section          — generic section (modifier: --dark / --mid)
 *   .ab-name-grid        — Ìtàn / Òrìṣà definition blocks
 *   .ab-approach-list    — numbered approach items
 *   .ab-cta              — closing CTA section
 *
 * Everything inside those components is targeted
 * by tag or position in CSS — no extra classes needed.
 */

get_header();

$gods_archive = get_post_type_archive_link( 'god' ) ?: '#';
$cc_page      = get_page_by_path( 'cultural-context' );
$lt_page      = get_page_by_path( 'love-triangle' );
$cc_url       = $cc_page ? get_permalink( $cc_page->ID ) : '#';
$lt_url       = $lt_page ? get_permalink( $lt_page->ID ) : '#';
?>

<div class="about-page">

    <section class="ab-hero">

        <div>
            <span>&#204;t&#224;n &#210;r&#236;&#351;&#224;</span>
            <h1>
                Old Gods.<br>
                <em>New Telling.</em>
            </h1>
            <p>A personal project. A cultural gap. An attempt to do something about both.</p>
            <a href="<?php echo esc_url( $gods_archive ); ?>" class="btn-primary">
                Meet the Orishas
            </a>
        </div>
    </section>

    <div class="ab-pull-quote">
        <blockquote>
            &#8220;The stories were always there. The modern doorway wasn&#8217;t.&#8221;
        </blockquote>
    </div>

    <section class="ab-section ab-section--dark">
        <header>
            <span>Why This Exists</span>
            <h2>I grew up knowing these gods existed.</h2>
        </header>
        <div>
            <p>Growing up, I was aware of Yoruba myths &#8212; &#350;&#224;ng&#243;, Ọya, Ogun. But I could never find them the way I could find Zeus or Thor. Not in games. Not in films. Not in the kind of engaging digital spaces that made Greek and Norse mythology feel alive for my generation.</p>
            <p>They existed in textbooks. In academic PDFs. In pages that treated them as historical artefacts rather than the complex, dramatic, genuinely fascinating characters they are.</p>
            <p>That bothered me. It still does. So I built this instead.</p>
        </div>
    </section>

    <section class="ab-section ab-section--mid">
        <header>
            <span>What This Is</span>
            <h2>What is &#204;t&#224;n &#210;r&#236;&#351;&#224;?</h2>
        </header>
        <div>
            <div class="ab-name-grid">
                <div>
                    <strong>&#204;t&#224;n</strong>
                    <em>Story. History. Narrative.</em>
                    <p>Not legend. Not myth in the dismissive sense. Story &#8212; with everything that implies about truth, memory, and meaning.</p>
                </div>
                <div>
                    <strong>&#210;r&#236;&#351;&#224;</strong>
                    <em>The divine forces in Yoruba cosmology.</em>
                    <p>Not gods in the distant, untouchable sense &#8212; but complex beings with personalities, flaws, relationships, and very human drama.</p>
                </div>
            </div>
            <p>&#204;t&#224;n &#210;r&#236;&#351;&#224; is an interactive storytelling website. Its purpose is to build the modern doorway that does not yet exist &#8212; and to make Yoruba mythology as accessible, engaging, and culturally present as the mythologies that already dominate the digital space.</p>
            <p>It is not trying to replace academic sources, or to claim a single authoritative version of these stories. It is trying to make you want to find out more.</p>
        </div>
    </section>

    <section class="ab-section ab-section--dark">
        <header>
            <span>How This Was Made</span>
            <h2>How the content was built.</h2>
        </header>
        <div>
            <ol class="ab-approach-list">
                <li>
                    <div>
                        <h3>Researched, not invented</h3>
                        <p>Every story, name, domain, and relationship on this site is drawn from documented academic and cultural sources. Where traditions conflict or versions differ, that is noted &#8212; because that is the nature of oral tradition, not a mistake.</p>
                    </div>
                </li>
                <li>
                    <div>
                        <h3>Playful tone is not disrespect</h3>
                        <p>These stories have survived centuries, crossed oceans, and outlasted empires partly because they have always been told by people who loved them enough to make them interesting. That is the tradition this project tries to continue.</p>
                    </div>
                </li>
                <li>
                    <div>
                        <h3>A living project</h3>
                        <p>The Yoruba pantheon includes hundreds of Orishas. This site currently focuses on three and the story that connects them. More will be added &#8212; this is not a finished monument.</p>
                    </div>
                </li>
            </ol>
            <a href="<?php echo esc_url( $cc_url ); ?>">
                Read about the Yoruba tradition in depth &rarr;
            </a>
        </div>
    </section>

    <section class="ab-section ab-section--mid">
        <header>
            <span>The Person Behind This</span>
            <h2>About the creator</h2>
        </header>
        <div>
            <p>This project was built as part of an MA in Web Design &amp; Content Planning at the University of Greenwich. It began as a coursework brief and became something more personal &#8212; a question about why the stories I grew up around were so absent from the digital spaces where other mythologies thrived.</p>
            <p>The short answer was: no one had built the right space for them yet. So this is an attempt to do that.</p>
        </div>
    </section>

    <section class="ab-cta">
        <h2>Ready to meet them?</h2>
        <p>Every god has a page. Every relationship has a story.</p>
        <div>
            <a href="<?php echo esc_url( $gods_archive ); ?>" class="btn-primary">
                Explore the Gods
            </a>
            <a href="<?php echo esc_url( $lt_url ); ?>" class="btn-ghost">
                Read the Love Triangle
            </a>
        </div>
    </section>

</div>
<?php get_footer(); ?>