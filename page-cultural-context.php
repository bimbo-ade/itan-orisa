<?php
/**
 * Template Name: Cultural Context Page
 *
 * 
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
                <p>When people hear the word Yoruba, they often think of Ile-Ife, the Oyo Empire, or Oduduwa. But what
                    if the story began much earlier?

                    The Yoruba are one of Africa's largest ethnic groups, with a population of over 45 million people.
                    They are found mainly in southwestern Nigeria, as well as parts of Benin and Togo. Through the
                    transatlantic slave trade and later migrations, Yoruba descendants also established vibrant
                    communities in Brazil, Cuba, Haiti, Trinidad and Tobago, the United States, and many other parts of
                    the world.

                    Yet behind this well-known history lies a deeper story—one preserved in oral traditions and passed
                    down through generations.</p>
                <p>According to some Yoruba oral traditions, the Yoruba people existed long before the rise of Ile-Ife
                    and the Oyo Empire.

                    These traditions speak of sixteen independent confederate communities, each governed by its own king
                    and leadership. Rather than existing as a single kingdom, these communities are said to have formed
                    an alliance to promote peace, cooperation, and collective prosperity.</p>
                <p>One of the most fascinating chapters in Yoruba history concerns the arrival of Oduduwa.

                    While many traditions celebrate Oduduwa as the founding father of the Yoruba people, another oral
                    and historical account presents a different narrative. In this version, Oduduwa arrived as a visitor
                    from the eastern forests. He gradually gained the trust of the local people through his knowledge of
                    healing, herbal medicine, organization, and community leadership.

                    Over time, he learned the language and customs of the people and became respected by both the
                    inhabitants and their rulers. His wisdom eventually earned him the opportunity to address the
                    leaders of the confederate communities at Ile-Ero, where he advised them on governance, peace, and
                    development.

                    As his influence grew, so did the number of people who supported his leadership.</p>

                <!-- <div class="cc-fact-strip">
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
                </div> -->
            </div>
        </section>

        <section class="cc-section cc-section--alt" id="cc-orishas">
            <div>
                <span>02</span>
                <small>The Divine Forces</small>
            </div>
            <div>
                <h2>Who Are the Orishas?</h2>
                <p>The Orishas are divine spiritual beings in the traditional Yoruba religion. They serve different
                    purposes for and with human beings. Unlike Olódùmarè, who is believed to be the creator of the
                    universe, the Orishas oversee different aspects of life and nature. According to historical
                    accounts, there are 201 gods in Yoruba culture</p>
                <p>
                    The worship of Orishas emphasizes morality, respect for nature, community, and harmony with
                    spiritual forces. Today, Orisha worship continues both in West Africa and throughout the African
                    diaspora.</p>
                <p>What distinguishes the Orishas from many other mythological figures is their psychological
                    complexity. They are not archetypes of virtue they have flaws, make mistakes, experience
                    jealousy and grief, and their stories do not always resolve neatly. This complexity is not a modern
                    interpretation: it is intrinsic to how they have always been told.</p>

                <div class="cc-orisha-grid">
                    <div style="--oc:#D32F2F;"> &#350;&#224;ng&#243; - Thunder</div>
                    <div style="--oc:#6A1B9A;">Ọya - Storms</div>
                    <div style="--oc:#2E7D32;"> Ogun - Iron</div>
                    <div style="--oc:#1565C0;"> Yemoja - Ocean</div>
                    <div style="--oc:#F9A825;">Ọ&#351;un - Rivers</div>
                    <div style="--oc:#E8EAF4;"> Obatala - Creation</div>
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
                <p>Despite its importance, Yoruba oral tradition faces several challenges:

                    The decline in the number of fluent Yoruba speakers and diverse branches of Yoruba among young
                    people.

                    Urbanization and modernization.

                    The dominance of English in schools.

                    Religious changes that discourage traditional practices.

                    The death of elderly custodians without proper documentation and proper passing down of cultural
                    heritage to the young ones.

                    Limited written and digital preservation.


                    If these traditions are not documented, valuable historical and cultural knowledge may disappear.
                </p>

            </div>
        </section>

        <section class="cc-section cc-section--alt" id="cc-diaspora">
            <div>
                <span>04</span>
                <small>The Journey</small>
            </div>
            <div>
                <h2>How These Stories Crossed the World</h2>
                <p>Yoruba culture spread globally mainly through the transatlantic slave trade between the sixteenth and
                    nineteenth centuries. Enslaved Yoruba people carried their beliefs, language, music, stories, and
                    religious practices to the Americas and the Caribbean.

                    Today, Yoruba influence can be seen in:</p>
                <p>Religion

                    Santería (Cuba)

                    Candomblé (Brazil)

                    Trinidad Orisha religion

                    Lukumí traditions


                    These religions preserve many Yoruba gods, rituals, songs, and ceremonies.

                    Music

                    Yoruba rhythms have influenced Afro-Cuban music, samba, jazz, reggae, Afrobeat, and many modern
                    musical styles.

                    Literature

                    Writers such as Wole Soyinka, Amos Tutuola, and D. O. Fagunwa introduced Yoruba mythology and
                    philosophy to international audiences.

                    Film and Popular Culture

                    Yoruba mythology appears in Hollywood films, comics, novels, and video games. Characters inspired by
                    Shango, Ogun, and Oshun have become internationally recognized.
                </p>

                <!-- <div class="cc-diaspora-strip">
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
                </div> -->
            </div>
        </section>

        <section class="cc-section" id="cc-gap">
            <div>
                <span>05</span>
                <small>The Problem</small>
            </div>
            <div>
                <h2>Why the Visibility Gap Exists</h2>
                <p>Although Yoruba civilization has made enormous contributions to world culture, it often receives less
                    international attention than ancient civilizations such as Egypt, Greece, or Rome.

                    Reasons include:

                    Colonial education systems prioritized European history.

                    Many Yoruba traditions remained oral instead of written and visually recorded.

                    Limited funding for African historical research.

                    Western media rarely highlights African indigenous cultures.

                    Many important Yoruba manuscripts remain untranslated.

                    Inadequate preservation of historical sites and cultural heritage.


                    Bridging these gaps requires:

                    Increased academic research.

                    Digital preservation both visual and audio.

                    Translation of Yoruba texts and learning of Yoruba language for proper assimilation.

                    Government investment in museums and archives.

                    Teaching African history in schools.

                    Supporting local scholars and storytellers.
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
                <p> 
Yoruba mythology continues to influence modern society.
 
Its influence can be found in:
 
Literature
 
Authors continue to use Yoruba myths in novels, poetry, and drama. Nobel Prize winner Wole Soyinka frequently draws from Yoruba cosmology.
 
Custodian of cultural practices should also help enlighten younglings about myths, proverbs and majorly the indigenous practice of cultural displays and practices for record and future reference purposes.
 
Movies
 
Films such as Black Panther incorporate visual and cultural elements inspired by Yoruba traditions. Nigerian Yoruba-language films also portray traditional beliefs and legends.
 
Music
 
Artists including King Sunny Ade, Asa, Burna Boy, and others reference Yoruba spirituality, proverbs, and history in their music.
 
Fashion
 
Traditional Yoruba clothing such as Agbada, Aso Oke, Gele, and Adire has gained international popularity.
 
Technology and Social Media
 
Young creators now use YouTube, TikTok, podcasts, and online archives to preserve Yoruba language, folktales, and mythology for future generations.
 
Yoruba mythology remains a living tradition that continues to inspire creativity, identity, and cultural pride around the world.
 </p>

                <!-- <div class="cc-tag-cloud">
                    <span>Nnedi Okorafor</span>
                    <span>Beyonc&#233; Lemonade</span>
                    <span>Wole Soyinka</span>
                    <span>Burna Boy</span>
                    <span>Smite (game)</span>
                    <span>UNESCO If&#225; recognition</span>
                    <span>Afrofuturism</span>
                    <span>Candombl&#233; revival</span>
                </div> -->
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

                <!-- <div class="cc-sources-list">
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
                </div> -->


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