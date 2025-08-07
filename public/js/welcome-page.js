// Welcome Page JavaScript
document.addEventListener("DOMContentLoaded", function () {
    // Initialize AOS (Animate On Scroll)
    if (typeof AOS !== "undefined") {
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100,
            easing: "ease-out-cubic",
        });
    }

    // Statistics Counter Animation
    function animateCounter() {
        const counters = document.querySelectorAll(".stat-number[data-target]");

        counters.forEach((counter) => {
            const target = parseInt(counter.getAttribute("data-target"));
            const increment = target / 200; // Animation duration control
            let current = 0;

            const timer = setInterval(() => {
                current += increment;
                counter.textContent = Math.floor(current);

                if (current >= target) {
                    counter.textContent = target.toLocaleString();
                    clearInterval(timer);
                }
            }, 10);
        });
    }

    // Intersection Observer for statistics animation
    const statsSection = document.querySelector(".py-20.bg-gradient-to-r");
    if (statsSection) {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        animateCounter();
                        observer.unobserve(entry.target);
                    }
                });
            },
            {
                threshold: 0.5,
            }
        );

        observer.observe(statsSection);
    }

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            if (target) {
                target.scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            }
        });
    });

    // Parallax effect for hero background
    let ticking = false;

    function updateParallax() {
        const scrolled = window.pageYOffset;
        const rate = scrolled * -0.5;
        const heroSection = document.querySelector(
            'section[style*="background-image"]'
        );

        if (heroSection) {
            heroSection.style.transform = `translateY(${rate}px)`;
        }

        ticking = false;
    }

    function requestTick() {
        if (!ticking) {
            requestAnimationFrame(updateParallax);
            ticking = true;
        }
    }

    window.addEventListener("scroll", requestTick);

    // Enhanced floating elements animation
    const floatingElements = document.querySelectorAll(".floating-element");

    floatingElements.forEach((element, index) => {
        // Add random movement
        setInterval(() => {
            const randomX = Math.random() * 20 - 10;
            const randomY = Math.random() * 20 - 10;

            element.style.transform = `translate(${randomX}px, ${randomY}px)`;
        }, 2000 + index * 500);

        // Add rotation animation
        element.style.animation += `, rotate-slow ${
            3 + index
        }s linear infinite`;
    });

    // Add custom CSS for rotation animation
    const style = document.createElement("style");
    style.textContent = `
        @keyframes rotate-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .floating-element {
            transition: transform 0.5s ease-in-out;
        }
        
        /* Custom hover effects */
        .transform:hover {
            transform: scale(1.05) !important;
        }
        
        /* Enhanced button animations */
        .bg-blue-600:hover {
            box-shadow: 0 20px 25px -5px rgba(59, 130, 246, 0.4), 0 10px 10px -5px rgba(59, 130, 246, 0.04);
        }
        
        .border-white:hover {
            box-shadow: 0 20px 25px -5px rgba(255, 255, 255, 0.2), 0 10px 10px -5px rgba(255, 255, 255, 0.04);
        }
    `;
    document.head.appendChild(style);

    // Loading state for buttons
    document.querySelectorAll("a[href]").forEach((link) => {
        link.addEventListener("click", function () {
            // Add loading state if it's an internal link
            if (this.hostname === window.location.hostname) {
                const originalText = this.innerHTML;
                this.innerHTML =
                    '<i class="fas fa-spinner fa-spin mr-2"></i>Loading...';
                this.classList.add("pointer-events-none", "opacity-75");

                // Reset after a short delay if navigation doesn't occur
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.classList.remove("pointer-events-none", "opacity-75");
                }, 3000);
            }
        });
    });

    // Add scroll indicator
    const scrollIndicator = document.createElement("div");
    scrollIndicator.className =
        "fixed bottom-8 left-1/2 transform -translate-x-1/2 z-50 transition-opacity duration-300";
    scrollIndicator.innerHTML = `
        <div class="animate-bounce bg-white/20 backdrop-blur-sm rounded-full p-3 text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    `;

    document.body.appendChild(scrollIndicator);

    // Hide scroll indicator after scrolling
    window.addEventListener("scroll", () => {
        if (window.pageYOffset > 100) {
            scrollIndicator.style.opacity = "0";
        } else {
            scrollIndicator.style.opacity = "1";
        }
    });

    console.log("Welcome page initialized successfully!");
});
