addMessage("Thank you for the information. I'll update our records.", 'incoming');document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 70,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Navbar behavior on scroll
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
                navbar.classList.remove('navbar-light');
                navbar.classList.add('navbar-white');
                navbar.classList.add('shadow-sm');
            } else {
                navbar.classList.remove('navbar-scrolled');
                navbar.classList.add('navbar-light');
                navbar.classList.remove('navbar-white');
                navbar.classList.remove('shadow-sm');
            }
        });
    }

    // Add animation to feature cards
    const featureCards = document.querySelectorAll('.feature-card');
    if (featureCards.length > 0) {
        // Simple animation when scrolling to the features section
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.2 });

        featureCards.forEach(card => {
            observer.observe(card);
        });
    }

    // Add animation to step cards
    const stepCards = document.querySelectorAll('.step-card');
    if (stepCards.length > 0) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Add a delay based on the card's position
                    const delay = Array.from(stepCards).indexOf(entry.target) * 150;
                    setTimeout(() => {
                        entry.target.classList.add('animated');
                    }, delay);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.2 });

        stepCards.forEach(card => {
            observer.observe(card);
        });
    }

    // Testimonial carousel (if added later)
    // This is a placeholder for future testimonial carousel functionality
    
    // Mobile menu toggle behavior
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    
    if (navbarToggler && navbarCollapse) {
        navbarToggler.addEventListener('click', function() {
            navbarCollapse.classList.toggle('show');
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!navbarToggler.contains(event.target) && !navbarCollapse.contains(event.target) && navbarCollapse.classList.contains('show')) {
                navbarCollapse.classList.remove('show');
            }
        });
    }
});