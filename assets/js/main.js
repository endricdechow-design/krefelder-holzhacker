/**
 * Holzhacker – Frontend-Skripte
 * Mobile Navigation, Header-Zustand, aktive Sektion, Reveal-Animation, Datei-Upload.
 */
(function () {
	'use strict';

	var body = document.body;
	var header = document.getElementById('site-header');
	var toggle = document.querySelector('.nav-toggle');
	var nav = document.getElementById('site-nav');

	/* ---------- Mobile Navigation ---------- */
	function setNav(open) {
		body.classList.toggle('nav-open', open);
		if (toggle) {
			toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
		}
	}

	if (toggle && nav) {
		toggle.addEventListener('click', function () {
			setNav(!body.classList.contains('nav-open'));
		});

		nav.addEventListener('click', function (e) {
			if (e.target.closest('a')) {
				setNav(false);
			}
		});

		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && body.classList.contains('nav-open')) {
				setNav(false);
				toggle.focus();
			}
		});

		window.matchMedia('(min-width: 64em)').addEventListener('change', function (mq) {
			if (mq.matches) {
				setNav(false);
			}
		});
	}

	/* ---------- Header beim Scrollen einfärben ---------- */
	if (header) {
		var onScroll = function () {
			header.classList.toggle('is-scrolled', window.scrollY > 40);
		};
		onScroll();
		window.addEventListener('scroll', onScroll, { passive: true });
	}

	/* ---------- Aktiven Menüpunkt markieren ---------- */
	var links = Array.prototype.slice.call(document.querySelectorAll('.nav__list a[href*="#"]'));
	var sections = links
		.map(function (link) {
			var id = link.hash ? link.hash.slice(1) : '';
			return id ? document.getElementById(id) : null;
		})
		.filter(Boolean);

	if ('IntersectionObserver' in window && sections.length) {
		var spy = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (!entry.isIntersecting) {
					return;
				}
				links.forEach(function (link) {
					var active = link.hash === '#' + entry.target.id;
					link.classList.toggle('is-active', active);
					if (active) {
						link.setAttribute('aria-current', 'location');
					} else {
						link.removeAttribute('aria-current');
					}
				});
			});
		}, { rootMargin: '-45% 0px -50% 0px' });

		sections.forEach(function (s) { spy.observe(s); });
	}

	/* ---------- Reveal-Animation ---------- */
	var revealTargets = document.querySelectorAll('.section__header, .about__text, .card, .cert, .gallery__item, .reviews, .contact__intro, .form');

	if ('IntersectionObserver' in window) {
		var reveal = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-visible');
					reveal.unobserve(entry.target);
				}
			});
		}, { threshold: 0.12 });

		revealTargets.forEach(function (el) {
			el.classList.add('reveal');
			reveal.observe(el);
		});
	}

	/* ---------- Datei-Upload: Dateiname anzeigen & Drag-and-Drop ---------- */
	var input = document.getElementById('photo');
	var drop = document.querySelector('.upload');

	if (input && drop) {
		var text = drop.querySelector('.upload__text');

		var updateLabel = function () {
			var file = input.files && input.files[0];
			text.textContent = file ? file.name : text.getAttribute('data-default');
			drop.classList.toggle('has-file', !!file);
		};

		input.addEventListener('change', updateLabel);

		['dragenter', 'dragover'].forEach(function (type) {
			drop.addEventListener(type, function (e) {
				e.preventDefault();
				drop.classList.add('is-dragover');
			});
		});

		['dragleave', 'drop'].forEach(function (type) {
			drop.addEventListener(type, function (e) {
				e.preventDefault();
				drop.classList.remove('is-dragover');
			});
		});

		drop.addEventListener('drop', function (e) {
			var files = e.dataTransfer && e.dataTransfer.files;
			if (files && files.length && files[0].type.indexOf('image/') === 0) {
				input.files = files;
				updateLabel();
			}
		});
	}
})();
