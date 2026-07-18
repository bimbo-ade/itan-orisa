<?php
/**
 * Template Name: Cultural Context Page
 *
 * Entirely educational — no personal narrative.
 * Rule: if it says "the Yoruba people" — it belongs here.
 *
 * Classes used:
 *   .cc-page             — root wrapper
 *   .cc-hero             — hero section
 *   .cc-sticky-nav       — sticky section navigation
 *   .cc-nav-link         — individual nav link (JS adds .active)
 *   .cc-body             — wraps all sections
 *   .cc-section          — each content section (modifier: --alt)
 *   .cc-fact-strip       — stat blocks (Section 1)
 *   .cc-orisha-grid      — deity pill grid (Section 2)
 *   .cc-diaspora-strip   — horizontal country scroll (Section 4)
 *   .cc-tag-cloud        — contemporary culture tags (Section 6)
 *   .cc-sources-list     — sources and reading (Section 7)
 *   .cc-cta              — closing CTA
 *
 * Everything inside those components is targeted
 * by tag or position in CSS — no extra classes needed.
 */

get_header();

$about_page = get_page_by_path('about');
$lt_page = get_page_by_path('love-triangle');
$about_url = $about_page ? get_permalink($about_page->ID) : '#';
$lt_url = $lt_page ? get_permalink($lt_page->ID) : '#';
$gods_archive = get_post_type_archive_link('god') ?: '#';
?>

<div class="cc-page">

    <section class="cc-hero">
        <div aria-hidden="true"></div>
        <div>
            <span>Cultural Context</span>
            <h1>Understanding Yoruba Mythology</h1>
            <p>A reference guide to the tradition, the people, and the stories behind this project.</p>
        </div>
    </section>

    <nav class="cc-sticky-nav" aria-label="Page sections">
        <a href="#cc-yoruba" class="cc-nav-link">The Yoruba People</a>
        <a href="#cc-orishas" class="cc-nav-link">The Orishas</a>
        <a href="#cc-oral" class="cc-nav-link">Oral Tradition</a>
        <a href="#cc-diaspora" class="cc-nav-link">The Diaspora</a>
        <a href="#cc-gap" class="cc-nav-link">The Visibility Gap</a>
        <a href="#cc-contemporary" class="cc-nav-link">Today</a>
        <a href="#cc-sources" class="cc-nav-link">Sources</a>
    </nav>

    <div class="cc-body">

        <section class="cc-section" id="cc-yoruba">
            <div>
                <span>01</span>
                <small>Foundation</small>
            </div>
            <div>
                <h2>Who Are the Yoruba People?</h2>
                <p>The Yoruba are one of the largest ethnic groups in Africa, numbering over 40 million people. They
                    originate primarily from south-western Nigeria, with significant populations in the Republic of
                    Benin and Togo. Their civilisation is among the most ancient in sub-Saharan Africa &#8212; the city
                    of Ile-Ife, considered the spiritual birthplace of the Yoruba people, is believed to be where human
                    existence itself began, according to Yoruba cosmology.</p>
                <p>Yoruba society has historically been organised around a system of city-states, each with its own Oba
                    (king) and a rich tradition of governance, art, trade, and spiritual practice. The Oyo Empire, which
                    reached its peak between the 17th and 19th centuries, was one of the largest and most powerful
                    states in West African history &#8212; and the political context from which several of the most
                    important Orisha stories emerge.</p>
                <p>Yoruba culture is notable for its sophisticated artistic tradition &#8212; terracotta and bronze
                    sculptures from Ile-Ife dating to the 12th century are considered among the finest examples of
                    naturalistic art in the pre-colonial world. This artistic sensibility extends to their oral and
                    spiritual tradition, where stories are not simply recounted but performed, layered, and alive.</p>

                <div class="cc-fact-strip">
                    <div>
                        <strong>40M+</strong>
                        <span>Yoruba speakers worldwide</span>
                    </div>
                    <div>
                        <strong>3</strong>
                        <span>Primary West African nations</span>
                    </div>
                    <div>
                        <strong>~12th C</strong>
                        <span>Ile-Ife terracotta sculptures</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="cc-section cc-section--alt" id="cc-orishas">
            <div>
                <span>02</span>
                <small>The Divine Forces</small>
            </div>
            <div>
                <h2>What Are the Orishas?</h2>
                <p>Orishas (&#210;r&#236;&#351;&#224;) are the divine forces at the centre of Yoruba religious
                    cosmology. They are not gods in the remote, untouchable sense of the word &#8212; they are
                    intermediaries between the supreme deity Ol&#243;d&#249;mar&#232; and human beings, governing the
                    forces of nature, aspects of human experience, and the space between the living and the ancestral
                    dead.</p>
                <p>The Yoruba tradition recognises hundreds of Orishas, each with distinct domains, symbols, colours,
                    sacred numbers, and modes of worship. Some are associated with natural phenomena &#8212;
                    &#350;&#224;ng&#243; with thunder, Ọya with storms and wind, Yemoja with the ocean, Ọ&#351;un with
                    rivers. Others govern human experience &#8212; Esu mediates communication and crossroads, Obatala
                    governs creation and moral clarity, Ogun presides over iron, labour, and war.</p>
                <p>What distinguishes the Orishas from many other mythological figures is their psychological
                    complexity. They are not archetypes of virtue &#8212; they have flaws, make mistakes, experience
                    jealousy and grief, and their stories do not always resolve neatly. This complexity is not a modern
                    interpretation: it is intrinsic to how they have always been told.</p>

                <div class="cc-orisha-grid">
                    <div style="--oc:#D32F2F;"> &#350;&#224;ng&#243; &#8212; Thunder</div>
                    <div style="--oc:#6A1B9A;">Ọya &#8212; Storms</div>
                    <div style="--oc:#2E7D32;"> Ogun &#8212; Iron</div>
                    <div style="--oc:#1565C0;"> Yemoja &#8212; Ocean</div>
                    <div style="--oc:#F9A825;">Ọ&#351;un &#8212; Rivers</div>
                    <div style="--oc:#E8EAF4;"> Obatala &#8212; Creation</div>
                </div>
            </div>
        </section>

        <section class="cc-section" id="cc-oral">
            <div>
                <span>03</span>
                <small>The Tradition</small>
            </div>
            <div>
                <h2>Oral Tradition and Its Vulnerability</h2>
                <p>Yoruba mythology was not written down &#8212; it was performed. The primary vehicle for these stories
                    is If&#225;, an intricate divination system that encodes hundreds of narratives (od&#249;) governing
                    every aspect of human experience. If&#225; priests (babalawos) spend years learning this oral
                    corpus, and the system was inscribed on UNESCO&#8217;s Intangible Cultural Heritage list in 2008.
                </p>
                <p>But oral traditions are inherently vulnerable. They depend on living practitioners, on communities
                    that value transmission, and on conditions that allow knowledge to pass from generation to
                    generation. Colonisation, Christianisation, and the disruption caused by the Transatlantic Slave
                    Trade all placed enormous pressure on the continuity of Yoruba spiritual knowledge &#8212; in some
                    regions, dramatically reducing the number of practitioners who could carry it forward.</p>
                <p>What survived did so through extraordinary resilience. In West Africa, the tradition persisted
                    despite missionary suppression. In the diaspora, it was encoded into new forms &#8212;
                    Candombl&#233;, Santer&#237;a, Vodou &#8212; where Orisha identities were sometimes masked beneath
                    Catholic saint names in a form of spiritual camouflage that allowed the tradition to continue when
                    direct practice would have been dangerous.</p>
                <p>This context matters when engaging with these stories. They are not ancient curiosities that have
                    been safely preserved. They are living knowledge that has been actively fought for.</p>
            </div>
        </section>

        <section class="cc-section cc-section--alt" id="cc-diaspora">
            <div>
                <span>04</span>
                <small>The Journey</small>
            </div>
            <div>
                <h2>How These Stories Crossed the World</h2>
                <p>Between the 16th and 19th centuries, the Transatlantic Slave Trade forcibly displaced millions of
                    Yoruba people across the Atlantic. They arrived in the Caribbean, in South America, and in North
                    America &#8212; stripped of legal identity but not of memory. The Orishas travelled with them.</p>
                <p>In Cuba, Yoruba religion became Luc&#250;m&#237;, also known as Santer&#237;a or Regla de Ocha.
                    Orishas were syncretised with Catholic saints &#8212; &#350;&#224;ng&#243; became St Barbara, Ọya
                    became Our Lady of Candelaria. The practice survives and thrives today, with millions of
                    practitioners across Cuba, the United States, and the Cuban diaspora.</p>
                <p>In Brazil, it became Candombl&#233; &#8212; one of the most vibrant Afro-Brazilian spiritual
                    traditions, centred particularly in the state of Bahia. &#350;&#224;ng&#243; is Xang&#244;, Ọya is
                    Ians&#227;, Ọ&#351;un is Oxum. The Orishas retained their identities across the translation.</p>
                <p>In Trinidad and Tobago, the Orisha tradition (also called Shango) has been practised since the 19th
                    century and received formal religious recognition in 1998. The scale of this diaspora spread is
                    remarkable: a tradition that originated in West Africa now has millions of practitioners across
                    multiple continents.</p>

                <div class="cc-diaspora-strip">
                    <div>
                        <span>&#127475;&#127468;</span>
                        <strong>Nigeria</strong>
                        <span>Yoruba religion</span>
                    </div>
                    <span aria-hidden="true">&rarr;</span>
                    <div>
                        <span>&#127461;&#127482;</span>
                        <strong>Cuba</strong>
                        <span>Santer&#237;a</span>
                    </div>
                    <span aria-hidden="true">&rarr;</span>
                    <div>
                        <span>&#127463;&#127479;</span>
                        <strong>Brazil</strong>
                        <span>Candombl&#233;</span>
                    </div>
                    <span aria-hidden="true">&rarr;</span>
                    <div>
                        <span>&#127481;&#127481;</span>
                        <strong>Trinidad</strong>
                        <span>Orisha / Shango</span>
                    </div>
                    <span aria-hidden="true">&rarr;</span>
                    <div>
                        <span>&#127482;&#127480;</span>
                        <strong>USA</strong>
                        <span>If&#225; revival</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="cc-section" id="cc-gap">
            <div>
                <span>05</span>
                <small>The Problem</small>
            </div>
            <div>
                <h2>Why the Visibility Gap Exists</h2>
                <p>Greek and Norse mythology dominate the digital landscape &#8212; games, films, interactive platforms,
                    streaming series. Yoruba mythology, despite being equally rich and structurally complex, does not.
                    Understanding why requires looking at the structural conditions that shape which cultural content
                    gets adapted and amplified.</p>
                <p>The first factor is colonial knowledge hierarchies. European academic institutions have spent
                    centuries treating Western mythologies as the default reference points for comparative religion and
                    literature. African oral traditions were frequently categorised as folklore rather than mythology
                    &#8212; a distinction that carried significant implications for how seriously they were studied and
                    how broadly they were disseminated.</p>
                <p>The second factor is the digital production gap. The games, films, and platforms that have made Greek
                    and Norse mythology globally familiar were produced primarily by American and European studios. The
                    infrastructure for producing equivalent content about African mythologies &#8212; the studios, the
                    investment, the institutional knowledge &#8212; is newer and still developing.</p>
                <p>The third factor is the complexity of diaspora identity. For communities whose connection to Yoruba
                    tradition runs through the trauma of the slave trade, the question of how to engage with and
                    represent these stories publicly is not simple. None of these factors mean the gap is permanent.
                    They mean that closing it requires deliberate effort &#8212; and that the effort is worth making.
                </p>
            </div>
        </section>

        <section class="cc-section cc-section--alt" id="cc-contemporary">
            <div>
                <span>06</span>
                <small>Today</small>
            </div>
            <div>
                <h2>Yoruba Mythology in Contemporary Culture</h2>
                <p>Despite the structural barriers described above, Yoruba mythology has a growing contemporary presence
                    &#8212; and that presence is accelerating.</p>
                <p>In literature, Nnedi Okorafor&#8217;s work &#8212; particularly <em>Lagoon</em> (2014), set in Lagos
                    and engaging directly with Nigerian mythology &#8212; and Wole Soyinka&#8217;s plays, which draw
                    extensively on Orisha narrative, represent the tradition in serious literary fiction. In popular
                    music, Beyonc&#233;&#8217;s <em>Lemonade</em> (2016) made explicit use of Ọ&#351;un imagery,
                    introducing the Orisha to a global mainstream audience. Burna Boy and other Afrobeats artists
                    regularly reference Yoruba spiritual concepts in their work.</p>
                <p>In gaming, the Orishas have appeared in titles including <em>Smite</em>, and independent developers
                    have increasingly turned to African mythologies. The global success of Black Panther&#8217;s
                    fictional Wakandan mythology demonstrated the scale of audience appetite for African-rooted
                    storytelling. UNESCO recognition of If&#225; in 2008 gave the tradition international institutional
                    acknowledgment.</p>

                <div class="cc-tag-cloud">
                    <span>Nnedi Okorafor</span>
                    <span>Beyonc&#233; &#8212; Lemonade</span>
                    <span>Wole Soyinka</span>
                    <span>Burna Boy</span>
                    <span>Smite (game)</span>
                    <span>UNESCO If&#225; recognition</span>
                    <span>Afrofuturism</span>
                    <span>Candombl&#233; revival</span>
                </div>
            </div>
        </section>

        <section class="cc-section" id="cc-sources">
            <div>
                <span>07</span>
                <small>Go Deeper</small>
            </div>
            <div>
                <h2>Sources &amp; Further Reading</h2>
                <p>The content on this site draws on the following sources. This is a starting point for readers who
                    want to go further.</p>

                <div class="cc-sources-list">
                    <div>
                        <h3>Academic Foundations</h3>
                        <ul>
                            <li>Bascom, William. <em>Ifa Divination: Communication Between Gods and Men in West
                                    Africa.</em> Indiana University Press, 1969.</li>
                            <li>Idowu, E. Bolaji. <em>Ol&#243;d&#249;mar&#232;: God in Yoruba Belief.</em> Longmans,
                                1962.</li>
                            <li>Abiodun, Rowland. <em>Yoruba Art and Language.</em> Cambridge University Press, 2014.
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3>Diaspora and Religion</h3>
                        <ul>
                            <li>Brandon, George. <em>Santeria from Africa to the New World.</em> Indiana University
                                Press, 1993.</li>
                            <li>Matory, J. Lorand. <em>Black Atlantic Religion.</em> Princeton University Press, 2005.
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3>Contemporary &amp; Cultural</h3>
                        <ul>
                            <li>Okorafor, Nnedi. <em>Lagoon.</em> Hodder &amp; Stoughton, 2014.</li>
                            <li>Soyinka, Wole. <em>Myth, Literature and the African World.</em> Cambridge University
                                Press, 1976.</li>
                            <li>UNESCO. <em>If&#225; Divination System.</em> Inscribed 2008.</li>
                        </ul>
                    </div>
                </div>

              
            </div>
        </section>

    </div>

    <section class="cc-cta">
        <h2>Ready to meet the gods?</h2>
        <p>The context is here. The stories are one click away.</p>
        <div>
            <a href="<?php echo esc_url($gods_archive); ?>" class="btn-primary">
                Explore the Orishas
            </a>
            <a href="<?php echo esc_url($lt_url); ?>" class="btn-ghost">
                Read the Love Triangle
            </a>
        </div>
    </section>

    <script>
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
    </script>

</div>
<?php get_footer(); ?>