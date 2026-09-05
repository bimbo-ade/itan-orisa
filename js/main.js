document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('.god-faq details').forEach(function(d) {
        d.addEventListener('toggle', function() {
            var plus = d.querySelector('summary span');
            if (plus) plus.textContent = d.open ? '−' : '+';
        });
    });

    const stickyNav = document.querySelector('.cc-sticky-nav');
    
    if (stickyNav) {
        const navLinks = document.querySelectorAll('.cc-nav-link');
        
        const targetSections = [];
        navLinks.forEach(link => {
            const hash = link.getAttribute('href');
            if (hash && hash.startsWith('#')) {
                const section = document.querySelector(hash);
                if (section) targetSections.push(section);
            }
        });

        const observerOptions = {
            root: null,
            rootMargin: '-20% 0px -60% 0px', 
            threshold: 0
        };

        const scrollSpyObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const activeId = '#' + entry.target.id;
                    
                    navLinks.forEach(link => {
                        if (link.getAttribute('href') === activeId) {
                            link.classList.add('active');
                
                            link.scrollIntoView({
                                behavior: 'smooth',
                                block: 'nearest',
                                inline: 'center'
                            });
                        } else {
                            link.classList.remove('active');
                        }
                    });
                }
            });
        }, observerOptions);

        // Bind sections to active tracking matrix lanes
        targetSections.forEach(section => scrollSpyObserver.observe(section));
    }

});






    const chapters = document.querySelectorAll(
        '.love-chapter'
    );

    const chapterDots = document.querySelectorAll(
        '.love-chapter-rail a'
    );

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {

                    chapterDots.forEach((dot) => {
                        dot.classList.remove('active');
                    });

                    const activeDot = document.querySelector(
                        `.love-chapter-rail a[href="#${entry.target.id}"]`
                    );

                    if (activeDot) {
                        activeDot.classList.add('active');
                    }
                }
            });
        }, {
            threshold: 0.5
        }
    );

    chapters.forEach((chapter) => {
        observer.observe(chapter);
    });
