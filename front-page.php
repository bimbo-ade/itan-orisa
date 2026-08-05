<?php
/**
 * front-page.php
 * 
 */

get_header();

$gods_link = get_post_type_archive_link('god') ?: '#';
$cc_page = get_page_by_path('cultural-context');
$about_page = get_page_by_path('about');
$lt_page = get_page_by_path('love-triangle');
$cc_link = $cc_page ? get_permalink($cc_page->ID) : '#';
$about_link = $about_page ? get_permalink($about_page->ID) : '#';
$lt_link = $lt_page ? get_permalink($lt_page->ID) : '#';

$sango_posts = get_posts(['post_type' => 'god', 'name' => 'sango', 'posts_per_page' => 1]);
$oya_posts = get_posts(['post_type' => 'god', 'name' => 'oya', 'posts_per_page' => 1]);
$ogun_posts = get_posts(['post_type' => 'god', 'name' => 'ogun', 'posts_per_page' => 1]);

$sango_link = $sango_posts ? get_permalink($sango_posts[0]->ID) : '#';
$oya_link = $oya_posts ? get_permalink($oya_posts[0]->ID) : '#';
$ogun_link = $ogun_posts ? get_permalink($ogun_posts[0]->ID) : '#';
?>

<div class="hp">

    <?php // ============================================================
    // 1. HERO
    // ============================================================ ?>
    <section class="hp-hero">
        <div>
            <p>Yoruba Mythology &mdash; Nigeria, West Africa</p>
            <h1>
                <span>&#204;t&#224;n &#210;r&#236;&#351;&#224;</span>
                The Gods of Yoruba.
                Told the way they deserve to be.
            </h1>
            <a href="<?php echo esc_url($gods_link); ?>" class="btn-primary">
                Meet the Gods
            </a>
        </div>
    </section>

    <?php // ============================================================
    // 2. FEATURED STORY — LOVE TRIANGLE
    // ============================================================ ?>
    <section class="hp-story">
        <div>
            <p>Featured Story</p>

            <div class="hp-story-card">
                <div aria-hidden="true"></div><!-- overlay -->

                <div aria-hidden="true"></div><!-- gradient band -->

                <div><!-- card body -->
                    <h2>She left the Smith for the Storm</h2>

                    <p>
                        Ọya was Ogun&#8217;s wife first. Then &#350;&#224;ng&#243; arrived &#8212;
                        all thunder, fire, and war. What happened next became one of the most
                        famous stories in Yoruba mythology. Three gods. One woman.
                        A rivalry that still echoes.
                    </p>

                    <ul>
                        <li style="--cp:#FF6B4A;"><span aria-hidden="true"></span>&#350;&#224;ng&#243;</li>
                        <li style="--cp:#9B7FE0;"><span aria-hidden="true"></span>Ọya</li>
                        <li style="--cp:#4FA876;"><span aria-hidden="true"></span>Ogun</li>
                    </ul>

                    <a href="<?php echo esc_url($lt_link); ?>" class="btn-primary">
                        Read the Love Triangle
                    </a>
                </div>

                <div aria-hidden="true"></div><!-- image placeholder -->
            </div>
        </div>
    </section>

    <?php // ============================================================
    // 3. GOD CARDS
    // ============================================================ ?>
    <section class="hp-gods">
        <div>
            <p>The Gods</p>

            <div>
                <a href="<?php echo esc_url($sango_link); ?>" style="--gc:#FF6B4A;"
                    aria-label="Explore &#350;&#224;ng&#243;">
                    <div>
                        <h3>&#350;&#224;ng&#243;</h3>
                        <p>God of Thunder, Lightning &amp; Justice</p>
                    </div>
                    <p>The King who became a god. The god who never stopped being a king.</p>
                    <span aria-hidden="true">Explore &#350;&#224;ng&#243; &rarr;</span>
                </a>

                <a href="<?php echo esc_url($oya_link); ?>" style="--gc:#9B7FE0;" aria-label="Explore Ọya">
                    <div>
                        <h3>Ọya</h3>
                        <p>Goddess of Wind, Storms &amp; Transformation</p>
                    </div>
                    <p>Nothing in her world stays the same. That is exactly how she wants it.</p>
                    <span aria-hidden="true">Explore Ọya &rarr;</span>
                </a>

                <a href="<?php echo esc_url($ogun_link); ?>" style="--gc:#4FA876;" aria-label="Explore Ogun">
                    <div>
                        <h3>Ogun</h3>
                        <p>God of Iron, War &amp; Labour</p>
                    </div>
                    <p>He built the tools that shaped the world. He also destroyed with them.</p>
                    <span aria-hidden="true">Explore Ogun &rarr;</span>
                </a>
            </div>
        </div>
    </section>

    <?php // ============================================================
    // 4. CULTURAL GROUNDING
    // ============================================================ ?>
    <section class="hp-culture">
        <div>
            <p>The Tradition</p>
            <div>
                <h2>These are not fictional gods.</h2>
                <p>
                    The Orishas are the divine forces at the centre of Yoruba cosmology &#8212;
                    a living spiritual tradition from Nigeria and West Africa, still actively
                    practised by millions across the world. These stories were told long before
                    they were written down, and they are still being told today.
                </p>
                <a href="<?php echo esc_url($cc_link); ?>">
                    Read about the Yoruba tradition &rarr;
                </a>
            </div>
            
        </div>
    </section>

    <?php // ============================================================
    // 5. PANTHEON TEASER
    // ============================================================ ?>
    <section class="hp-pantheon">
        <div>
            <p>The Pantheon</p>
            <div><!-- two-col content wrapper -->
                <div><!-- text body -->
                    <h2>
                        Three gods.<br>
                        <em>For now.</em>
                    </h2>
                    <p>
                        The Yoruba tradition includes hundreds of Orishas. This site begins with
                        &#350;&#224;ng&#243;, Ogun and Ọya &#8212; and the story that connects them.
                        More will follow.
                    </p>
                    <a href="<?php echo esc_url($gods_link); ?>" class="btn-ghost">
                        Explore the Pantheon
                    </a>
                </div>
                <div><!-- triangle image -->
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/triangle.svg"
                        alt="The divine triangle connecting Ṣàngó, Ọya and Ogun" width="400" height="400"
                        loading="lazy">
                </div>
            </div>
        </div>
    </section>

    <?php // ============================================================
    // 6. ABOUT / MISSION TEASER
    // ============================================================ ?>
    <section class="hp-about">
        <div>
            <p>About This Project</p>
            <div>
                <h2>ITAN was built because the doorway didn&#8217;t exist.</h2>
                <p>
                    Yoruba mythology deserves the same digital presence as Greek, Norse and
                    Egyptian traditions. This project is an attempt to build that &#8212;
                    one story at a time.
                </p>
                <a href="<?php echo esc_url($about_link); ?>">
                    Read about the project &rarr;
                </a>
            </div>
        </div>
    </section>

</div>

<?php get_footer(); ?>