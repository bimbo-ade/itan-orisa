<?php

/**
 * Template Name: Cultural Context Page
 *
 * 
 */

get_header();

$lt_page = get_page_by_path('love-triangle', OBJECT, 'story');
$lt_url  = $lt_page ? get_permalink($lt_page->ID) : '#';
$gods_archive = get_post_type_archive_link('god') ?: '#';
?>

<div class="cc-page">

    <section class="cc-hero">
        <div>
            <p>Cultural Context</p>
            <h1>Understanding <em>Yoruba Mythology</em> </h1>
            <p>A reference guide to the tradition, the people, and the stories behind this project.</p>
        </div>
    </section>

    <nav class="cc-sticky-nav" aria-label="Page sections">
        <a href="#cc-yoruba" class="cc-nav-link">The Yoruba People</a>
        <a href="#cc-orishas" class="cc-nav-link">The Òrìṣà</a>
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
                <span>Foundation</span>
            </div>
            <div>
                <h2>Foundation</h2>

                <p>The Yoruba are one of Africa's largest ethnic groups, over 45 million people spanning southwestern
                    Nigeria, Benin, and Togo. Through the transatlantic slave trade and later migrations, their
                    descendants
                    also built lasting communities in Brazil, Cuba, Haiti, Trinidad, and the United States. Even the
                    founding of their civilization has more than one telling — some traditions credit Oduduwa as father
                    of
                    the Yoruba people, others remember him as an outsider who earned his place through wisdom rather
                    than
                    birthright.</p>

                <details class="cc-deeper">
                    <summary>
                        <span>Go deeper: the sixteen communities &amp; the full Oduduwa story</span>
                        <span aria-hidden="true">+</span>
                    </summary>
                    <div>
                        <h3>Before Ile-Ife</h3>
                        <p>Some Yoruba oral traditions hold that the people existed long before Ile-Ife and the Oyo
                            Empire,
                            organized instead as sixteen independent communities, each with its own king, allied for
                            peace
                            and shared prosperity rather than ruled as one kingdom:</p>
                        <ul class="cc-communities-list">
                            <li>Ijugbe</li>
                            <li>Iraye</li>
                            <li>Iwinrin</li>
                            <li>Ideta (Idita)</li>
                            <li>Oke-Oja</li>
                            <li>Iloromu</li>
                            <li>Imojubi</li>
                            <li>Parakin</li>
                            <li>Ido</li>
                            <li>Odin (Odun)</li>
                            <li>Oke-Awo</li>
                            <li>Iloran</li>
                            <li>Omologun</li>
                        </ul>
                        <p class="cc-communities-note">Three further communities — Ita Yemoo, Idio, and Orun Oba Ado —
                            appear in some traditions but remain subjects of ongoing investigation. Some accounts also
                            hold
                            these early communities spoke a language called Ikedu, echoes of which some scholars argue
                            survive in the modern Ilaje dialect.</p>

                        <h3>The Arrival of Oduduwa</h3>
                        <p>One account presents Oduduwa as a visitor from the eastern forests who gradually earned the
                            trust
                            of the local people through knowledge of healing, herbal medicine, and community leadership.
                            Over time he learned the local language and customs, and his wisdom eventually earned him
                            the
                            chance to address the leaders of the confederate communities at Ile-Ero — advising them on
                            governance, peace, and development. As his influence grew, so did the number of people who
                            supported his leadership.</p>

                        <h3>Migration &amp; the Birth of New Kingdoms</h3>
                        <p>Like many civilizations, the Yoruba experienced rivalry and political struggle. Oral
                            tradition
                            describes a supremacy conflict that divided the confederate communities, sending many groups
                            migrating to new territories that would grow into kingdoms such as Oyo, Ijebu, Egba, Ondo,
                            Ekiti, and Ijesa. It's why Yoruba dialects still sound like family — similar, but each
                            carrying
                            its own accent shaped by centuries of separate movement.</p>
                    </div>
                </details>
            </div>
        </section>

        <section class="cc-section cc-section--alt" id="cc-orishas">
            <div>
                <span>02</span>
                <span>The Divine Forces</span>
            </div>
            <div>
                <h2>Who Are the Òrìṣà?</h2>
                <p>The Òrìṣà are divine spiritual beings in the traditional Yoruba religion. They serve different
                    purposes for and with human beings. Unlike Olódùmarè, who is believed to be the creator of the
                    universe, the Òrìṣà oversee different aspects of life and nature. According to historical
                    accounts, there are 201 gods in Yoruba culture</p>
                <p>
                    The worship of the Yoruba gods and goddesses emphasizes morality, respect for nature, community, and harmony with
                    spiritual forces. Today, the worship continues both in West Africa and throughout the African
                    diaspora.</p>
                <p>What distinguishes the Yoruba deities from many other mythological figures is their psychological
                    complexity. They are not archetypes of virtue they have flaws, make mistakes, experience
                    jealousy and grief, and their stories do not always resolve neatly. This complexity is not a modern
                    interpretation: it is intrinsic to how they have always been told.</p>

                <div class="cc-orisha-grid">
                    <p style="--oc:#D32F2F;"> Ṣàngó - Thunder</p>
                    <p style="--oc:#6A1B9A;">Ọya - Storms</p>
                    <p style="--oc:#2E7D32;"> Ògún - Iron</p>
                    <p style="--oc:#1565C0;"> Yẹmọja - Ocean</p>
                    <p style="--oc:#F9A825;">Ọ̀ṣun - Rivers</p>
                    <p style="--oc:#E8EAF4;"> Ọbàtálá - Creation</p>
                </div>
            </div>
        </section>

        <section class="cc-section" id="cc-oral">
            <div>
                <span>03</span>
                <span>The Tradition</span>
            </div>
            <div>
                <h2>Oral Tradition and Its Vulnerability</h2>
                <p>Despite its importance, Yoruba oral tradition faces several challenges:

                    The decline in the number of fluent Yoruba speakers and diverse branches of Yoruba among young
                    people.

                    Urbanization and modernization.

                    The dominance of English in schools.
                </p>
                <p>

                    Religious changes that discourage traditional practices.

                    The death of elderly custodians without proper documentation and proper passing down of cultural
                    heritage to the young ones.

                    Limited written and digital preservation.


                    If these traditions are not documented, valuable historical and cultural knowledge may disappear.
                </p>

                <p>Before writing became widespread, the Yoruba preserved their history through oral tradition — elders,
                    priests, kings, storytellers, and praise singers carrying knowledge from one generation to the next.
                    This tradition takes many forms:</p>

                <div class="cc-oral-types">
                    <span>Folktales</span>
                    <span>Proverbs (Òwe)</span>
                    <span>Myths &amp; Legends</span>
                    <span>Praise Poetry (Oríkì)</span>
                    <span>Ifá Verses (Odù Ifá)</span>
                    <span>Cultural Attire</span>
                    <span>Food</span>
                    <span>Songs &amp; Chants</span>
                </div>

            </div>
        </section>

        <section class="cc-section cc-section--alt" id="cc-diaspora">
            <div>
                <span>04</span>
                <span>The Journey</span>
            </div>
            <div>
                <h2>How These Stories Crossed the World</h2>
                <p>Yoruba culture spread globally mainly through the transatlantic slave trade between the sixteenth
                    and
                    nineteenth centuries. Enslaved Yoruba people carried their beliefs, language, music, stories, and
                    religious practices to the Americas and the Caribbean.

                    Today, Yoruba influence can be seen in:</p>
                <p>Religion

                    Santería (Cuba)

                    Candomblé (Brazil)

                    Trinidad Òrìṣà religion

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

            </div>
        </section>

        <section class="cc-section" id="cc-gap">
            <div>
                <span>05</span>
                <span>The Problem</span>
            </div>
            <div>
                <h2>Why the Visibility Gap Exists</h2>
                <p>Although Yoruba civilization has made enormous contributions to world culture, it often receives less
                    international attention than ancient civilizations such as Egypt, Greece, or Rome.

                    Reasons include:

                    Colonial education systems prioritized European history.
                </p>
                <p>

                    Many Yoruba traditions remained oral instead of written and visually recorded.

                    Limited funding for African historical research.

                    Western media rarely highlights African indigenous cultures.

                    Many important Yoruba manuscripts remain untranslated.

                    Inadequate preservation of historical sites and cultural heritage.
                </p>
                <p>

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
                <span>Today</span>
            </div>
            <div>
                <h2>Yoruba Mythology in Contemporary Culture</h2>
                <p>
                    Yoruba mythology continues to influence modern society.

                    Its influence can be found in:

                </p>
                <p>

                    <em>
                        Literature-
                    </em>

                    Authors continue to use Yoruba myths in novels, poetry, and drama. Nobel Prize winner Wole Soyinka
                    frequently draws from Yoruba cosmology.

                    Custodian of cultural practices should also help enlighten younglings about myths, proverbs and
                    majorly the indigenous practice of cultural displays and practices for record and future reference
                    purposes.
                </p>

                <p> <em>
                        Movies-
                    </em>

                    Films such as Black Panther incorporate visual and cultural elements inspired by Yoruba traditions.
                    Nigerian Yoruba-language films also portray traditional beliefs and legends.

                </p>
                <p>

                    <em> Music-</em>

                    Artists including King Sunny Ade, Asa, Burna Boy, and others reference Yoruba spirituality,
                    proverbs, and history in their music.
                </p>
                <p>

                    <em> Fashion-</em>

                    Traditional Yoruba clothing such as Agbada, Aso Oke, Gele, and Adire has gained international
                    popularity.

                </p>
                <p>
                    <em>Technology and Social Media-</em>


                    Young creators now use YouTube, TikTok, podcasts, and online archives to preserve Yoruba language,
                    folktales, and mythology for future generations.

                    Yoruba mythology remains a living tradition that continues to inspire creativity, identity, and
                    cultural pride around the world.
                </p>


            </div>
        </section>
        <section class="cc-section" id="cc-sources">
            <div>
                <span>07</span>
                <span>Go Deeper</span>
            </div>

            <div>
                <h2>Sources &amp; Further Reading</h2>

                <p>
                    The content on this site draws on the following books and historical
                    sources. These references provide a starting point for readers who
                    want to explore Yoruba history, mythology, religion, and culture in
                    greater depth.
                </p>

                <div class="cc-sources-list">

                    <div>
                        <h3>Foundational Histories</h3>
                        <ul>
                            <li>
                                Johnson, S. (1921).
                                <a href="https://openlibrary.org/books/OL13446224M/The_history_of_the_Yorubas"
                                    rel="noopener noreferrer">
                                    <em>The History of the Yorubas</em>
                                </a>
                                |
                                <a href="https://archive.org/details/historyofyorubas00john" rel="noopener noreferrer">
                                    Internet Archive
                                </a>
                            </li>

                            <li>
                                Law, R. (1977).
                                <a href="https://books.google.com/books?id=jfJfQgAACAAJ&dq=The+Oyo+Empire+c.1600%E2%80%931836"
                                    rel="noopener noreferrer">
                                    <em>The Oyo Empire c.1600–1836</em>
                                </a>
                            </li>

                            <li>
                                Akinruntan, F. O. (2016).
                                <a href=" https://thesun.ng/ugbo-a-kingdom-built-on-water/"
                                    rel="noopener noreferrer">
                                    <em>A History of the Oldest Kingdom in Yorubaland.</em></a>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h3>Religion &amp; Cosmology</h3>
                        <ul>
                            <li>
                                Abimbola, W. (1976).
                                <a href="https://books.google.com/books?id=M73AQgAACAAJ&dq=If%C3%A1:+An+Exposition+of+If%C3%A1+Literary+Corpus"
                                    rel="noopener noreferrer">
                                    <em>Ifá: An Exposition of Ifá Literary Corpus</em>
                                </a>
                            </li>

                            <li>
                                Mbiti, J. S. (1990).
                                <a href="https://books.google.com/books?id=eTUpo9lH-fYC&printsec=frontcover&dq=African+Religions+and+Philosophy"
                                    rel="noopener noreferrer">
                                    <em>African Religions and Philosophy</em>
                                </a>
                            </li>

                            <li>
                                Peel, J. D. Y. (2000).
                                <a href="https://books.google.com/books?id=CGouTXIOjXgC&printsec=frontcover&dq=Religious+Encounter+and+the+Making+of+the+Yoruba"
                                    rel="noopener noreferrer">
                                    <em>Religious Encounter and the Making of the Yoruba</em>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h3>Art, Culture &amp; Literature</h3>
                        <ul>
                            <li>
                                Drewal, H. J., Pemberton III, J., &amp; Abiodun, R. (1989).
                                <a href="https://books.google.com/books?id=UhaSQwAACAAJ&dq=Nine+Centuries+of+African+Art+and+Thought"
                                    rel="noopener noreferrer">
                                    <em>Yoruba: Nine Centuries of African Art and Thought</em>
                                </a>
                            </li>

                            <li>
                                Bascom, W. (1969).
                                <em>The Yoruba of Southwestern Nigeria.</em>
                            </li>

                            <li>
                                Soyinka, W. (1976).
                                <a href="https://books.google.com/books?id=8OGgm-ZvASAC&printsec=frontcover&dq=Myth,+Literature+and+the+African+World"
                                    rel="noopener noreferrer">
                                    <em>Myth, Literature and the African World</em>
                                </a>
                            </li>
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
                Explore the pantheon
            </a>
            <a href="<?php echo esc_url($lt_url); ?>" class="btn-ghost">
                Read the Love Triangle
            </a>
        </div>
    </section>



</div>
<?php get_footer(); ?>