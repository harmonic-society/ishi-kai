/**
 * Ishi-kai Theme - Main JavaScript
 *
 * @package Ishi_Kai_Theme
 */

(function() {
    'use strict';

    /**
     * Mobile Menu Toggle
     */
    function initMobileMenu() {
        const menuToggle = document.querySelector('.menu-toggle');
        const navigation = document.querySelector('.main-navigation');

        if (!menuToggle || !navigation) {
            return;
        }

        menuToggle.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';

            this.setAttribute('aria-expanded', !isExpanded);
            navigation.classList.toggle('is-open');

            // Update aria-label
            if (isExpanded) {
                this.setAttribute('aria-label', 'メニューを開く');
            } else {
                this.setAttribute('aria-label', 'メニューを閉じる');
            }
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!navigation.contains(event.target) && !menuToggle.contains(event.target)) {
                menuToggle.setAttribute('aria-expanded', 'false');
                navigation.classList.remove('is-open');
                menuToggle.setAttribute('aria-label', 'メニューを開く');
            }
        });

        // Close menu on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && navigation.classList.contains('is-open')) {
                menuToggle.setAttribute('aria-expanded', 'false');
                navigation.classList.remove('is-open');
                menuToggle.setAttribute('aria-label', 'メニューを開く');
                menuToggle.focus();
            }
        });
    }

    /**
     * Smooth Scroll for Anchor Links
     */
    function initSmoothScroll() {
        const links = document.querySelectorAll('a[href^="#"]');

        links.forEach(function(link) {
            link.addEventListener('click', function(event) {
                const targetId = this.getAttribute('href');

                if (targetId === '#') {
                    return;
                }

                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    event.preventDefault();

                    const headerHeight = document.querySelector('.site-header')?.offsetHeight || 0;
                    const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - headerHeight;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });

                    // Update focus for accessibility
                    targetElement.setAttribute('tabindex', '-1');
                    targetElement.focus();
                }
            });
        });
    }

    /**
     * Header Scroll Effect
     */
    function initHeaderScroll() {
        const header = document.querySelector('.site-header');

        if (!header) {
            return;
        }

        let lastScrollTop = 0;
        const scrollThreshold = 100;

        window.addEventListener('scroll', function() {
            const currentScrollTop = window.pageYOffset || document.documentElement.scrollTop;

            if (currentScrollTop > scrollThreshold) {
                header.classList.add('is-scrolled');
            } else {
                header.classList.remove('is-scrolled');
            }

            lastScrollTop = currentScrollTop;
        }, { passive: true });
    }

    /**
     * Lazy Load Images (for browsers that don't support native lazy loading)
     */
    function initLazyLoad() {
        if ('loading' in HTMLImageElement.prototype) {
            // Native lazy loading is supported
            const images = document.querySelectorAll('img[loading="lazy"]');
            images.forEach(function(img) {
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                }
            });
        } else {
            // Fallback to Intersection Observer
            const lazyImages = document.querySelectorAll('img[data-src]');

            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver(function(entries, observer) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            const image = entry.target;
                            image.src = image.dataset.src;
                            image.removeAttribute('data-src');
                            imageObserver.unobserve(image);
                        }
                    });
                });

                lazyImages.forEach(function(image) {
                    imageObserver.observe(image);
                });
            } else {
                // Fallback for older browsers
                lazyImages.forEach(function(image) {
                    image.src = image.dataset.src;
                });
            }
        }
    }

    /**
     * Form Validation Enhancement
     */
    function initFormValidation() {
        const forms = document.querySelectorAll('form');

        forms.forEach(function(form) {
            const submitButton = form.querySelector('[type="submit"]');

            if (submitButton) {
                form.addEventListener('submit', function() {
                    submitButton.disabled = true;
                    submitButton.classList.add('is-loading');
                });
            }
        });
    }

    /**
     * Initialize all functions when DOM is ready
     */
    function init() {
        initMobileMenu();
        initSmoothScroll();
        initHeaderScroll();
        initLazyLoad();
        initFormValidation();
    }

    // Run init when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
