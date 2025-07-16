// Global variables
let currentSlide = 0;
let autoPlayInterval;

// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    initializeWebsite();
});

function initializeWebsite() {
    console.log('Initializing website...');
    
    // Initialize carousel
    initCarousel();
    
    // Initialize mobile menu
    initMobileMenu();
    
    // Initialize scroll effects
    initScrollEffects();
    
    // Initialize interactive elements
    initInteractiveElements();
    
    console.log('Website initialized successfully!');
}

// Carousel Functions
function initCarousel() {
    const slides = document.querySelectorAll('.carousel-slide');
    const indicators = document.querySelectorAll('.indicator');
    
    if (!slides.length) return;
    
    // Start auto-play
    startAutoPlay();
    
    // Add event listeners to carousel controls
    const prevBtn = document.querySelector('.carousel-btn.prev');
    const nextBtn = document.querySelector('.carousel-btn.next');
    
    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            changeSlide(-1);
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            changeSlide(1);
        });
    }
    
    // Add event listeners to indicators
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', function() {
            goToSlide(index);
        });
    });
    
    // Touch support
    const carouselContainer = document.querySelector('.carousel-container');
    if (carouselContainer) {
        let touchStartX = 0;
        
        carouselContainer.addEventListener('touchstart', function(e) {
            touchStartX = e.touches[0].clientX;
        }, { passive: true });
        
        carouselContainer.addEventListener('touchend', function(e) {
            const touchEndX = e.changedTouches[0].clientX;
            const diff = touchStartX - touchEndX;
            
            if (Math.abs(diff) > 50) {
                if (diff > 0) {
                    changeSlide(1); // Swipe left - next
                } else {
                    changeSlide(-1); // Swipe right - prev
                }
            }
        }, { passive: true });
    }
    
    // Keyboard support
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft') {
            changeSlide(-1);
        } else if (e.key === 'ArrowRight') {
            changeSlide(1);
        }
    });
    
    // Pause on hover
    const hero = document.querySelector('.hero');
    if (hero) {
        hero.addEventListener('mouseenter', stopAutoPlay);
        hero.addEventListener('mouseleave', startAutoPlay);
    }
}

function showSlide(index) {
    const slides = document.querySelectorAll('.carousel-slide');
    const indicators = document.querySelectorAll('.indicator');
    
    // Remove active class from all
    slides.forEach(slide => slide.classList.remove('active'));
    indicators.forEach(indicator => indicator.classList.remove('active'));
    
    // Add active class to current
    if (slides[index]) {
        slides[index].classList.add('active');
    }
    if (indicators[index]) {
        indicators[index].classList.add('active');
    }
}

function nextSlide() {
    const slides = document.querySelectorAll('.carousel-slide');
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
}

function prevSlide() {
    const slides = document.querySelectorAll('.carousel-slide');
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    showSlide(currentSlide);
}

function changeSlide(direction) {
    stopAutoPlay();
    
    if (direction === 1) {
        nextSlide();
    } else {
        prevSlide();
    }
    
    startAutoPlay();
}

function goToSlide(index) {
    stopAutoPlay();
    currentSlide = index;
    showSlide(currentSlide);
    startAutoPlay();
}

function startAutoPlay() {
    stopAutoPlay(); // Clear any existing interval
    autoPlayInterval = setInterval(nextSlide, 5000);
}

function stopAutoPlay() {
    if (autoPlayInterval) {
        clearInterval(autoPlayInterval);
        autoPlayInterval = null;
    }
}

// Mobile Menu
function initMobileMenu() {
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    
    if (!mobileMenuToggle || !navMenu) return;
    
    mobileMenuToggle.addEventListener('click', function() {
        navMenu.classList.toggle('active');
        mobileMenuToggle.classList.toggle('active');
    });
    
    // Close menu when clicking outside
    document.addEventListener('click', function(e) {
        if (!mobileMenuToggle.contains(e.target) && !navMenu.contains(e.target)) {
            navMenu.classList.remove('active');
            mobileMenuToggle.classList.remove('active');
        }
    });
    
    // Close menu when clicking on links
    navMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', function() {
            navMenu.classList.remove('active');
            mobileMenuToggle.classList.remove('active');
        });
    });
}

// Scroll Effects
function initScrollEffects() {
    let ticking = false;
    
    window.addEventListener('scroll', function() {
        if (!ticking) {
            requestAnimationFrame(function() {
                handleScrollEffects();
                ticking = false;
            });
            ticking = true;
        }
    });
    
    // Initial call
    handleScrollEffects();
}

function handleScrollEffects() {
    const scrollY = window.pageYOffset;
    
    // Header effect
    updateHeader(scrollY);
    
    // Floating image effect
    updateFloatingImage(scrollY);
    
    // Parallax effect
    updateParallax(scrollY);
    
    // Floating icon in hero
    updateFloatingIcon(scrollY);
}

function updateHeader(scrollY) {
    const header = document.querySelector('.header');
    if (!header) return;
    
    if (scrollY > 50) {
        header.style.background = 'linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%)';
        header.style.boxShadow = '0 4px 20px rgba(0,0,0,0.15)';
    } else {
        header.style.background = 'linear-gradient(135deg, #2e7d32 0%, #4caf50 100%)';
        header.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
    }
}

function updateFloatingImage(scrollY) {
    const floatingIcon = document.querySelector('.floating-icon');
    const scrollFloatingImage = document.querySelector('.scroll-floating-image');
    
    if (!floatingIcon || !scrollFloatingImage) return;
    
    // Calculate rotation based on scroll speed and position
    const rotationDegrees = scrollY * 0.5; // Adjust multiplier for rotation speed
    
    if (scrollY > 200) {
        // Hide original icon from banner with smooth transition
        floatingIcon.style.opacity = '0';
        floatingIcon.style.transform = 'translateY(-50%) scale(0.8)';
        
        // Show floating image on the right side
        scrollFloatingImage.classList.add('visible');
        scrollFloatingImage.style.position = 'fixed';
        scrollFloatingImage.style.right = '30px';
        scrollFloatingImage.style.top = '50%';
        scrollFloatingImage.style.transform = 'translateY(-50%)';
        scrollFloatingImage.style.opacity = '0.9';
        
        // Rotate image based on scroll position
        const img = scrollFloatingImage.querySelector('img');
        if (img) {
            img.style.transform = `rotate(${rotationDegrees}deg)`;
            img.style.transition = 'transform 0.1s ease-out'; // Smooth rotation
        }
    } else {
        // Show original icon in banner with smooth transition
        floatingIcon.style.opacity = '1';
        floatingIcon.style.transform = 'translateY(-50%) scale(1)';
        
        // Hide floating image but keep it ready
        scrollFloatingImage.style.opacity = '0';
        scrollFloatingImage.classList.remove('visible');
        
        // Reset floating image rotation when back to top
        const img = scrollFloatingImage.querySelector('img');
        if (img) {
            img.style.transform = 'rotate(0deg)';
            img.style.transition = 'transform 0.3s ease';
        }
    }
    
    // Also rotate the icon in banner based on scroll (when visible)
    if (scrollY < 200) {
        const bannerImg = floatingIcon.querySelector('img');
        if (bannerImg) {
            bannerImg.style.transform = `rotate(${rotationDegrees}deg)`;
            bannerImg.style.transition = 'transform 0.1s ease-out';
        }
    }
}

function updateParallax(scrollY) {
    const parallaxLayers = document.querySelectorAll('.parallax-layer');
    
    parallaxLayers.forEach((layer, index) => {
        const speed = (index + 1) * 0.2;
        const yPos = -(scrollY * speed);
        layer.style.transform = `translateY(${yPos}px)`;
    });
}

function updateFloatingIcon(scrollY) {
    const floatingIcon = document.querySelector('.floating-icon');
    
    if (!floatingIcon) return;
    
    // Simple animation for the icon in hero section
    if (scrollY < 200) {
        const scrollProgress = scrollY / 200;
        const scale = 1 + (scrollProgress * 0.1);
        const rotate = scrollProgress * 45;
        
        const img = floatingIcon.querySelector('img');
        if (img) {
            // Keep the original spinning animation but add slight scroll effects
            const currentTransform = img.style.transform || '';
            if (!currentTransform.includes('rotate')) {
                img.style.transform = `scale(${scale}) rotate(${rotate}deg)`;
                
            }
        }
    }
}

function initScrollEffects() {
    let ticking = false;
    
    window.addEventListener('scroll', function() {
        if (!ticking) {
            requestAnimationFrame(function() {
                handleScrollEffects();
                ticking = false;
            });
            ticking = true;
        }
    });
    
    // Initial call
    handleScrollEffects();
}

function initFloatingImageClick() {
    const scrollFloatingImage = document.querySelector('.scroll-floating-image');
    if (!scrollFloatingImage) return;
    
    scrollFloatingImage.style.cursor = 'pointer';
    
    // Click to scroll to top
    scrollFloatingImage.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // Simple hover effect
    scrollFloatingImage.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-50%) scale(1.1)';
    });
    
    scrollFloatingImage.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(-50%) scale(1)';
    });
} heroRect = heroSection.getBoundingClientRect();
    
    if (heroRect.bottom > 0 && heroRect.top < window.innerHeight) {
        const scrollProgress = Math.abs(heroRect.top) / heroRect.height;
        const scale = 1 + (scrollProgress * 0.3);
        const rotate = scrollProgress * 180;
        
        floatingIcon.style.transform = `scale(${scale}) rotate(${rotate}deg)`;
    }


// Interactive Elements
function initInteractiveElements() {
    // Mouse follower
    initMouseFollower();
    
    // Click ripples
    initClickRipples();
    
    // Smooth scrolling
    initSmoothScrolling();
    
    // Button hover effects
    initButtonEffects();
    
    // Fade in animations
    initFadeInAnimations();
    
    // Floating image click
    initFloatingImageClick();
}

function initMouseFollower() {
    const mouseFollower = document.querySelector('.mouse-follower');
    if (!mouseFollower) return;
    
    document.addEventListener('mousemove', function(e) {
        mouseFollower.style.left = (e.clientX - 10) + 'px';
        mouseFollower.style.top = (e.clientY - 10) + 'px';
    });
}

function initClickRipples() {
    document.addEventListener('click', function(e) {
        createRipple(e.clientX, e.clientY);
    });
}

function createRipple(x, y) {
    const ripple = document.createElement('div');
    ripple.style.cssText = `
        position: fixed;
        left: ${x - 25}px;
        top: ${y - 25}px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(76,175,80,0.6) 0%, transparent 70%);
        pointer-events: none;
        z-index: 10000;
        animation: ripple 0.6s ease-out;
    `;
    
    document.body.appendChild(ripple);
    
    setTimeout(function() {
        if (ripple && ripple.parentNode) {
            ripple.parentNode.removeChild(ripple);
        }
    }, 600);
}

function initSmoothScrolling() {
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            
            if (target) {
                const header = document.querySelector('.header');
                const headerHeight = header ? header.offsetHeight : 0;
                const targetPosition = target.offsetTop - headerHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
}

function initButtonEffects() {
    document.querySelectorAll('button').forEach(function(button) {
        button.addEventListener('mouseenter', function() {
            if (!this.classList.contains('carousel-btn')) {
                this.style.transform = 'translateY(-2px)';
            }
        });
        
        button.addEventListener('mouseleave', function() {
            if (!this.classList.contains('carousel-btn')) {
                this.style.transform = 'translateY(0)';
            }
        });
    });
}

function initFadeInAnimations() {
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    
    const elementsToAnimate = [
        '.featured-article',
        '.latest-article',
        '.service-item',
        '.announcement-item'
    ];
    
    elementsToAnimate.forEach(function(selector) {
        document.querySelectorAll(selector).forEach(function(element, index) {
            element.style.opacity = '0';
            element.style.transform = 'translateY(30px)';
            element.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
            observer.observe(element);
        });
    });
}

function initFloatingImageClick() {
    const scrollFloatingImage = document.querySelector('.scroll-floating-image');
    if (!scrollFloatingImage) return;
    
    scrollFloatingImage.style.cursor = 'pointer';
    scrollFloatingImage.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

// Click animations for cards
document.addEventListener('DOMContentLoaded', function() {
    const selectors = ['.featured-article', '.latest-article', '.service-item', '.announcement-item'];
    
    selectors.forEach(function(selector) {
        document.querySelectorAll(selector).forEach(function(element) {
            element.addEventListener('click', function() {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });
    });
});

// Handle window resize
window.addEventListener('resize', function() {
    if (window.innerWidth > 768) {
        const navMenu = document.querySelector('.nav-menu');
        const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
        
        if (navMenu) navMenu.classList.remove('active');
        if (mobileMenuToggle) mobileMenuToggle.classList.remove('active');
    }
});

// Cleanup on page unload
window.addEventListener('beforeunload', function() {
    stopAutoPlay();
});

// CSS Animation for ripple effect
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple {
        0% {
            transform: scale(0);
            opacity: 1;
        }
        100% {
            transform: scale(4);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);