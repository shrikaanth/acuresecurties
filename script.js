document.addEventListener('DOMContentLoaded', () => {
    const navbar = document.getElementById('navbar');
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const navMenu = document.getElementById('navMenu');
    const quoteForm = document.getElementById('quoteForm');
    const successModal = document.getElementById('successModal');
    const closeModal = document.getElementById('closeModal');
    const faqItems = document.querySelectorAll('.faq-item');

    // Navbar scroll effect
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }

    // Mobile menu toggle
    if (mobileMenuToggle && navMenu) {
        mobileMenuToggle.addEventListener('click', () => {
            mobileMenuToggle.classList.toggle('active');
            navMenu.classList.toggle('active');
        });
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = anchor.getAttribute('href');
            if (targetId === '#') return;

            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                const offset = 80;
                const targetPosition = targetElement.offsetTop - offset;

                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });

                if (navMenu && navMenu.classList.contains('active')) {
                    if (mobileMenuToggle) mobileMenuToggle.classList.remove('active');
                    navMenu.classList.remove('active');
                }
            }
        });
    });

    // Main quote form submission (if exists)
    if (quoteForm && successModal) {
        quoteForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const submitButton = quoteForm.querySelector('button[type="submit"]');
            if (!submitButton) return;

            const originalButtonText = submitButton.textContent;

            // Disable button and show loading state
            submitButton.disabled = true;
            submitButton.textContent = 'Submitting...';

            const formData = new FormData(quoteForm);
            const data = Object.fromEntries(formData);

            try {
                const response = await fetch('submit-quote.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (result.success) {
                    console.log('Quote Request Submitted:', result);
                    window.location.href = 'thankyou.html';
                    quoteForm.reset();
                } else {
                    throw new Error(result.message || 'Failed to submit quote request');
                }
            } catch (error) {
                console.error('Error submitting quote:', error);
                alert('There was an error submitting your quote request. Please try calling us directly at +1 (905) 399-9333');
            } finally {
                // Re-enable button
                submitButton.disabled = false;
                submitButton.textContent = originalButtonText;
            }
        });
    }

    // Hero form submission
    const heroQuoteForm = document.getElementById('heroQuoteForm');
    if (heroQuoteForm) {
        heroQuoteForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const submitButton = heroQuoteForm.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.textContent;

            // Disable button and show loading state
            submitButton.disabled = true;
            submitButton.textContent = 'Submitting...';

            const formData = new FormData(heroQuoteForm);
            const data = Object.fromEntries(formData);

            try {
                const response = await fetch('submit-quote.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (result.success) {
                    console.log('Quote Request Submitted:', result);
                    window.location.href = 'thankyou.html';
                    heroQuoteForm.reset();
                } else {
                    throw new Error(result.message || 'Failed to submit quote request');
                }
            } catch (error) {
                console.error('Error submitting quote:', error);
                alert('There was an error submitting your quote request. Please try calling us directly at +1 (905) 399-9333');
            } finally {
                // Re-enable button
                submitButton.disabled = false;
                submitButton.textContent = originalButtonText;
            }
        });
    }

    // Contact form submission (before footer)
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const submitButton = contactForm.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.textContent;

            // Disable button and show loading state
            submitButton.disabled = true;
            submitButton.textContent = 'Submitting...';

            const formData = new FormData(contactForm);
            const data = Object.fromEntries(formData);

            try {
                const response = await fetch('submit-quote.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (result.success) {
                    console.log('Quote Request Submitted:', result);
                    window.location.href = 'thankyou.html';
                    contactForm.reset();
                } else {
                    throw new Error(result.message || 'Failed to submit quote request');
                }
            } catch (error) {
                console.error('Error submitting quote:', error);
                alert('There was an error submitting your quote request. Please try calling us directly at +1 (905) 399-9333');
            } finally {
                // Re-enable button
                submitButton.disabled = false;
                submitButton.textContent = originalButtonText;
            }
        });
    }

    // Modal close handlers
    if (closeModal && successModal) {
        closeModal.addEventListener('click', () => {
            successModal.classList.remove('show');
        });

        successModal.addEventListener('click', (e) => {
            if (e.target === successModal) {
                successModal.classList.remove('show');
            }
        });
    }

    // FAQ accordion
    if (faqItems.length > 0) {
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            if (!question) return;

            question.addEventListener('click', () => {
                const isActive = item.classList.contains('active');

                faqItems.forEach(otherItem => {
                    otherItem.classList.remove('active');
                });

                if (!isActive) {
                    item.classList.add('active');
                }
            });
        });
    }

    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    const animatedElements = document.querySelectorAll('.service-card, .advantage-card, .step, .faq-item');
    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
});
