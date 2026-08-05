<?php
/**
 * Template Name: About Page
 
 */

get_header();

$gods_archive = get_post_type_archive_link('god') ?: '#';
$cc_page = get_page_by_path('cultural-context');
$lt_page = get_page_by_path('love-triangle');
$cc_url = $cc_page ? get_permalink($cc_page->ID) : '#';
$lt_url = $lt_page ? get_permalink($lt_page->ID) : '#';
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
            <a href="<?php echo esc_url($gods_archive); ?>" class="btn-primary">
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
            <p>Growing up in Nigeria, the Orishas weren't unknown. They appeared in films, conversations, books and
                everyday culture. &#350;&#224;ng&#243;, Ọya, Ogun were names I had always heard.</p>
            <p> But when I looked beyond home, something changed.</p>
            <p>Online, in games, films, comics and modern digital experiences, it was almost impossible to find Yoruba
                mythology represented alongside traditions like Greek or Norse mythology. Zeus, Thor and Odin had become
                global cultural icons. The Orishas rarely appeared in those same spaces.</p>
            <p>That absence stayed with me.</p>
            <p>This project is my attempt to help build the kind of digital doorway these stories deserve.</p>
        </div>
    </section>
    <section class="ab-section ab-section--mid">

        <header>
            <span>What This Is</span>
            <h2>More than a name.</h2>
        </header>

        <div>

            <div class="ab-name-grid">

                <div>
                    <strong>Ìtàn</strong>
                    <em>Story. Memory. History.</em>

                    <p>
                        In Yoruba, Ìtàn is more than a tale. It carries memory,
                        identity and the stories passed from one generation to the next.
                    </p>
                </div>

                <div>
                    <strong>Òrìṣà</strong>
                    <em>The divine forces of Yoruba tradition.</em>

                    <p>
                        The Òrìṣà are not distant, perfect beings. They are powerful,
                        complex personalities whose stories continue to shape Yoruba
                        culture today.
                    </p>

                </div>

            </div>

            <p>
                Together, <strong>Ìtàn Òrìṣà</strong> simply means
                <em>"The Stories of the Orishas."</em>
            </p>

            <p>
                This website exists to tell those stories in a way that feels modern,
                cinematic and easy to explore without losing the culture they come from.
                Rather than replacing traditional or academic sources, it aims to become
                a doorway that encourages curiosity and deeper learning.
            </p>

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
                        <p>Every story, name, domain, and relationship on this site is drawn from documented academic
                            and cultural sources. Where traditions conflict or versions differ, that is noted  
                            because that is the nature of oral tradition, not a mistake.</p>
                    </div>
                </li>
                <li>
                    <div>
                        <h3>Playful tone is not disrespect</h3>
                        <p>These stories have survived centuries, crossed oceans, and outlasted empires partly because
                            they have always been told by people who loved them enough to make them interesting. That is
                            the tradition this project tries to continue.</p>
                    </div>
                </li>
                <li>
                    <div>
                        <h3>A living project</h3>
                        <p>The Yoruba pantheon includes hundreds of Orishas. This site currently focuses on three and
                            the story that connects them. More will be added   this is not a finished monument.
                        </p>
                    </div>
                </li>
            </ol>
            <a href="<?php echo esc_url($cc_url); ?>">
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
            <p>This project was built as part of an MA in Web Design &amp; Content Planning at the University of
                Greenwich. It began as a coursework brief and became something more personal   a question about
                why the stories I grew up around were so absent from the digital spaces where other mythologies thrived.
            </p>
            <p>The short answer was: no one had built the right space for them yet. So this is an attempt to do that.
            </p>
        </div>
    </section>

    <section class="ab-cta">
        <h2>Ready to meet them?</h2>
        <p>Every god has a page. Every relationship has a story.</p>
        <div>
            <a href="<?php echo esc_url($gods_archive); ?>" class="btn-primary">
                Explore the Gods
            </a>
            <a href="<?php echo esc_url($lt_url); ?>" class="btn-ghost">
                Read the Love Triangle
            </a>
        </div>
    </section>

</div>
<?php get_footer(); ?>