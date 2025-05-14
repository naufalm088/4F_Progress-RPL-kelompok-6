document.addEventListener('DOMContentLoaded', function() {
    // ========== Common Functionality ==========
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            // Skip if it's a link to another page
            if (this.getAttribute('href').startsWith('#') && 
                !this.getAttribute('href').includes('.html')) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            }
        });
    });
    
    // Mobile menu toggle
    const hamburgerMenu = document.querySelector('.hamburger-menu');
    if (hamburgerMenu) {
        hamburgerMenu.addEventListener('click', function() {
            const dropdown = this.querySelector('.dropdown-menu');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });
    }

    // ========== Certificate Verification (for main page) ==========
    if (document.getElementById('certificate-modal')) {
        const certificateLink = document.querySelector('a[href="#certificate"]');
        const modal = document.getElementById('certificate-modal');
        const closeModal = document.querySelector('.close-modal');
        
        if (certificateLink && modal) {
            certificateLink.addEventListener('click', function(e) {
                e.preventDefault();
                modal.style.display = 'block';
                document.body.style.overflow = 'hidden';
                document.getElementById('certificate-number').value = '';
                document.querySelector('.certificate-result').style.display = 'none';
                document.querySelector('.login-required').style.display = 'none';
            });
        }
        
        if (closeModal) {
            closeModal.addEventListener('click', function() {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            });
        }
        
        window.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
        
        const mockCertificates = {
            'DEA-2023-1001': {
                serial: 'DEA-2023-1001',
                product: 'Infinity Necklace (Silver)',
                date: 'March 15, 2023',
                status: 'Authentic',
                owner: 'user123@example.com',
                name: 'Ericka',
                price: 'Rp. 739.012',
                image: 'sertif.PNG'
            },
            'DEA-2023-1002': {
                serial: 'DEA-2023-1002',
                product: 'Crystal Clamshell Ring',
                date: 'April 2, 2023',
                status: 'Authentic',
                owner: 'user456@example.com',
                name: 'John Doe',
                price: 'Rp. 500.000',
                image: 'ring1.PNG'
            }
        };

        const lookupBtn = document.getElementById('lookup-btn');
        const certNumberInput = document.getElementById('certificate-number');
        const certResult = document.querySelector('.certificate-result');
        const loginRequired = document.querySelector('.login-required');
        
        function isLoggedIn() {
            return localStorage.getItem('deaSilverLoggedIn') === 'true';
        }
        
        function getCurrentUser() {
            return localStorage.getItem('deaSilverUserEmail');
        }
        
        function generateCertificateHTML(certData) {
            return `
            <article class="certificate" role="document" aria-label="Purchase Certificate">
                <h1 class="title">Certificate of Authenticity</h1>
                <section class="details">
                    <div class="field">
                        <div class="field-label">Owner Name</div>
                        <div class="field-value">${certData.name}</div>
                    </div>
                    <div class="field">
                        <div class="field-label">Product</div>
                        <div class="field-value">${certData.product}</div>
                    </div>
                    <div class="field">
                        <div class="field-label">Purchase Date</div>
                        <div class="field-value">${certData.date}</div>
                    </div>
                    <div class="field">
                        <div class="field-label">Price</div>
                        <div class="field-value">${certData.price}</div>
                    </div>
                    <div class="field">
                        <div class="field-label">Serial Number</div>
                        <div class="field-value">${certData.serial}</div>
                    </div>
                    <div class="field">
                        <div class="field-label">Status</div>
                        <div class="field-value">${certData.status}</div>
                    </div>
                </section>
                <section class="image-section">
                    <img src="${certData.image}" alt="${certData.product}" />
                </section>
            </article>
            <button id="print-cert" class="btn">Print Certificate</button>
            `;
        }
        
        if (lookupBtn) {
            lookupBtn.addEventListener('click', function() {
                const certNumber = certNumberInput.value.trim();
                
                if (!certNumber) {
                    alert('Please enter a certificate number');
                    return;
                }
                
                if (!isLoggedIn()) {
                    loginRequired.style.display = 'block';
                    alert('Please login to verify certificates');
                    return;
                }
                
                setTimeout(() => {
                    if (mockCertificates[certNumber]) {
                        const cert = mockCertificates[certNumber];
                        
                        if (cert.owner && cert.owner !== getCurrentUser()) {
                            alert('This certificate is registered to another account');
                            return;
                        }
                        
                        certResult.innerHTML = generateCertificateHTML(cert);
                        certResult.style.display = 'block';
                        loginRequired.style.display = 'none';
                        
                        document.getElementById('print-cert').addEventListener('click', function() {
                            window.print();
                        });
                    } else {
                        alert('Certificate not found. Please check the number and try again.');
                    }
                }, 800);
            });
        }
    }

    // ========== User Authentication ==========
    const loginLinks = document.querySelectorAll('a[href="#login"]');
    loginLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const email = prompt('Enter your email to login:');
            if (email) {
                localStorage.setItem('deaSilverLoggedIn', 'true');
                localStorage.setItem('deaSilverUserEmail', email);
                alert(`Logged in as ${email}\n\nNow you can verify certificates and make purchases.`);
            }
        });
    });
    
    const registerLinks = document.querySelectorAll('a[href="#register"]');
    registerLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const email = prompt('Enter your email to register:');
            if (email) {
                localStorage.setItem('deaSilverLoggedIn', 'true');
                localStorage.setItem('deaSilverUserEmail', email);
                alert(`Account created and logged in as ${email}\n\nNow you can verify certificates and make purchases.`);
            }
        });
    });
    
    // ========== Shop Page Functionality ==========
    if (document.querySelector('.shop-section')) {
        // Filter functionality
        const categoryFilter = document.getElementById('category');
        const sortFilter = document.getElementById('sort');
        const productCards = document.querySelectorAll('.product-card');
        
        if (categoryFilter && sortFilter) {
            categoryFilter.addEventListener('change', filterProducts);
            sortFilter.addEventListener('change', sortProducts);
        }
        
        function filterProducts() {
            const selectedCategory = categoryFilter.value;
            
            productCards.forEach(card => {
                card.style.display = (selectedCategory === 'all' || card.dataset.category === selectedCategory) 
                    ? 'block' 
                    : 'none';
            });
        }
        
        function sortProducts() {
            const sortBy = sortFilter.value;
            const productsContainer = document.querySelector('.shop-grid');
            const products = Array.from(productCards);
            
            products.sort((a, b) => {
                const priceA = parseInt(a.dataset.price);
                const priceB = parseInt(b.dataset.price);
                
                switch(sortBy) {
                    case 'price-low': return priceA - priceB;
                    case 'price-high': return priceB - priceA;
                    default: return 0;
                }
            });
            
            productsContainer.innerHTML = '';
            products.forEach(product => productsContainer.appendChild(product));
        }
        
        // Wishlist functionality
        document.querySelectorAll('.wishlist-btn').forEach(button => {
            button.addEventListener('click', function() {
                this.classList.toggle('active');
                const productName = this.closest('.product-card').querySelector('h3').textContent;
                const action = this.classList.contains('active') ? 'added to' : 'removed from';
                alert(`${productName} ${action} wishlist`);
            });
        });
        
        // Add to cart functionality
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                if (!localStorage.getItem('deaSilverLoggedIn')) {
                    alert('Please login to add items to your cart');
                    return;
                }
                
                const productCard = this.closest('.product-card');
                const productName = productCard.querySelector('h3').textContent;
                const productPrice = productCard.querySelector('.price').textContent;
                
                // In a real app, you would add to cart system here
                alert(`Added to cart: ${productName}\n${productPrice}`);
                
                // Example cart counter update
                const cartIcon = document.querySelector('a[href="#cart"]');
                if (cartIcon) {
                    let count = parseInt(cartIcon.dataset.count) || 0;
                    count++;
                    cartIcon.dataset.count = count;
                    cartIcon.innerHTML = `<i class="fas fa-shopping-cart"></i> (${count})`;
                }
            });
        });
    }

    // ========== Scroll Animations ==========
    const animateOnScroll = function() {
        const elements = document.querySelectorAll('.category-card, .collection-card, .offer-card, .product-card');
        
        elements.forEach(element => {
            const elementPosition = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            
            if (elementPosition < windowHeight - 100) {
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }
        });
    };
    
    // Initialize animation state
    const animatedElements = document.querySelectorAll('.category-card, .collection-card, .offer-card, .product-card');
    animatedElements.forEach(element => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
    });
    
    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll();
});