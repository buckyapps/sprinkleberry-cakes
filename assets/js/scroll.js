/**
 * Sprinkle Berry Cakes - Scroll Animations
 * Optimized for Safari iOS
 */
document.addEventListener('DOMContentLoaded', function () {
  const header = document.getElementById('site-header');
  if (header) {
    window.addEventListener('scroll', function () {
      header.classList.toggle('scrolled', window.scrollY > 40);
    }, { passive: true });
  }

  const toggle = document.getElementById('menu-toggle');
  const overlay = document.getElementById('menu-overlay');
  function setMenu(open) {
    document.body.classList.toggle('menu-open', open);
    if (toggle) toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    if (overlay) {
      if (open) overlay.removeAttribute('hidden');
      else overlay.setAttribute('hidden', '');
    }
  }
  if (toggle) {
    toggle.addEventListener('click', function () {
      setMenu(!document.body.classList.contains('menu-open'));
    });
  }
  if (overlay) {
    overlay.addEventListener('click', function () { setMenu(false); });
  }
  document.querySelectorAll('.main-nav a').forEach(function (link) {
    link.addEventListener('click', function () { setMenu(false); });
  });
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') setMenu(false);
  });

  // Very generous on mobile / Safari so animations fire early
  const isMobile = window.matchMedia('(max-width: 900px)').matches;
  const observerOptions = {
    root: null,
    rootMargin: isMobile ? '50px 0px -10px 0px' : '0px 0px -40px 0px',
    threshold: 0.01
  };

  const observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
      } else {
        entry.target.classList.remove('visible');
      }
    });
  }, observerOptions);

  // Force initial off-screen state then observe
  document.querySelectorAll('.cake-card, .gallery-item, .fade-up').forEach(function (el) {
    el.classList.remove('visible');
    observer.observe(el);
  });

  // Pre-select order type when arriving from a category page
  const params = new URLSearchParams(window.location.search);
  const orderType = params.get('order');
  const typeSelect = document.getElementById('order_type');
  if (orderType && typeSelect) {
    typeSelect.value = orderType;
  }

  // Gallery lightbox
  const lightbox = document.getElementById('lightbox');
  const lightboxImg = document.getElementById('lightbox-img');
  const lightboxClose = document.getElementById('lightbox-close');
  const lightboxStage = document.getElementById('lightbox-stage');

  function openLightbox(src, alt) {
    if (!lightbox || !lightboxImg) return;
    lightboxImg.src = src;
    lightboxImg.alt = alt || '';
    lightboxImg.classList.remove('is-zoomed');
    lightbox.removeAttribute('hidden');
    document.body.classList.add('lightbox-open');
  }

  function closeLightbox() {
    if (!lightbox || !lightboxImg) return;
    lightbox.setAttribute('hidden', '');
    lightboxImg.src = '';
    lightboxImg.classList.remove('is-zoomed');
    document.body.classList.remove('lightbox-open');
  }

  document.querySelectorAll('.gallery-item img').forEach(function (img) {
    img.addEventListener('click', function (e) {
      e.preventDefault();
      e.stopPropagation();
      openLightbox(img.currentSrc || img.src, img.alt);
    });
  });

  if (lightboxClose) lightboxClose.addEventListener('click', closeLightbox);
  if (lightbox) {
    lightbox.addEventListener('click', function (e) {
      if (e.target === lightbox || e.target === lightboxStage) closeLightbox();
    });
  }
  if (lightboxImg) {
    lightboxImg.addEventListener('click', function (e) {
      e.stopPropagation();
      lightboxImg.classList.toggle('is-zoomed');
      if (lightboxStage) lightboxStage.scrollTop = 0;
    });
  }
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') closeLightbox();
  });

  // Smooth scroll for in-page links
  document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
      const targetId = this.getAttribute('href');
      if (!targetId || targetId === '#') return;
      const target = document.querySelector(targetId);
      if (target) {
        e.preventDefault();
        const headerHeight = header ? header.offsetHeight : 80;
        const top = target.getBoundingClientRect().top + window.pageYOffset - headerHeight;
        window.scrollTo({ top: top, behavior: 'smooth' });
      }
    });
  });
});
