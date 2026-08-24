
// CULTURAL CONTEXT JS FOR NAV
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



// GODS FAQ TOGGLE
document.querySelectorAll('.god-faq details').forEach(function (d) {
  d.addEventListener('toggle', function () {
    var plus = d.querySelector('summary span:last-child');
    if (plus) plus.textContent = d.open ? '−' : '+';
  });
});


