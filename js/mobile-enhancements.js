// Mobile Enhancements for Better Responsiveness

document.addEventListener('DOMContentLoaded', function() {
    
    // COMPREHENSIVE CHECK: Skip ALL mobile enhancements on product page
    const isProductPage = window.location.pathname.includes('product.php');
    if (isProductPage) {
        console.log('Product page detected - skipping ALL mobile enhancements to prevent conflicts');
        return;
    }
    
    // Fix mobile slider height and positioning
    function fixMobileSlider() {
        if (window.innerWidth <= 767) {
            const sliderItems = document.querySelectorAll('.item-slick1');
            const viewportHeight = window.innerHeight;
            
            sliderItems.forEach(item => {
                item.style.height = viewportHeight + 'px';
                item.style.minHeight = viewportHeight + 'px';
                item.style.width = '100vw';
                item.style.marginLeft = 'calc(-50vw + 50%)';
                item.style.marginRight = 'calc(-50vw + 50%)';
                item.style.display = 'flex';
                item.style.alignItems = 'center';
                item.style.justifyContent = 'flex-start';
                item.style.backgroundSize = 'contain';
            });
            
            // Ensure slider text is properly positioned and left-aligned
            const sliderTexts = document.querySelectorAll('.layer-slick1');
            sliderTexts.forEach(text => {
                text.style.position = 'relative';
                text.style.zIndex = '2';
                text.style.textAlign = 'left';
                text.style.margin = '0';
                text.style.padding = '0';
            });
            
            // Position the flex container on the left
            const flexContainers = document.querySelectorAll('.flex-col-l-m');
            flexContainers.forEach(container => {
                container.style.display = 'flex';
                container.style.flexDirection = 'column';
                container.style.alignItems = 'flex-start';
                container.style.justifyContent = 'center';
                container.style.textAlign = 'left';
                container.style.height = '100%';
                container.style.margin = '0';
                container.style.padding = '0 0 0 40px';
            });
        }
    }
    
    // Fix mobile header positioning
    function fixMobileHeader() {
        if (window.innerWidth <= 991) {
            const mobileHeader = document.querySelector('.wrap-header-mobile');
            if (mobileHeader) {
                mobileHeader.style.position = 'fixed';
                mobileHeader.style.top = '0';
                mobileHeader.style.left = '0';
                mobileHeader.style.right = '0';
                mobileHeader.style.zIndex = '1000';
            }
            
            // Adjust body padding for mobile
            document.body.style.paddingTop = '0';
        } else {
            document.body.style.paddingTop = '130px';
        }
    }
    
    // Remove any text shadows from mobile elements
    function removeTextShadows() {
        if (window.innerWidth <= 767) {
            const allElements = document.querySelectorAll('*');
            allElements.forEach(element => {
                element.style.textShadow = 'none';
                element.style.webkitTextShadow = 'none';
                element.style.filter = 'none';
                element.style.webkitFilter = 'none';
            });
            
            // Specifically target slider text
            const sliderTexts = document.querySelectorAll('.layer-slick1 .cl2');
            sliderTexts.forEach(text => {
                text.style.textShadow = 'none';
                text.style.webkitTextShadow = 'none';
                text.style.filter = 'none';
                text.style.webkitFilter = 'none';
                text.style.boxShadow = 'none';
                text.style.webkitBoxShadow = 'none';
            });
        }
    }
    
    // Fix mobile icon shadows
    function fixMobileIcons() {
        if (window.innerWidth <= 991) {
            const mobileIcons = document.querySelectorAll('.wrap-header-mobile .icon-header-item i');
            mobileIcons.forEach(icon => {
                icon.style.textShadow = 'none';
                icon.style.webkitTextShadow = 'none';
                icon.style.filter = 'none';
                icon.style.webkitFilter = 'none';
                icon.style.boxShadow = 'none';
                icon.style.webkitBoxShadow = 'none';
            });
        }
    }
    
    // Ensure proper mobile viewport
    function setMobileViewport() {
        const viewport = document.querySelector('meta[name="viewport"]');
        if (viewport) {
            viewport.setAttribute('content', 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no');
        }
    }
    
    // Fix mobile slider navigation
    function fixMobileSliderNav() {
        if (window.innerWidth <= 767) {
            const arrows = document.querySelectorAll('.arrow-slick1');
            arrows.forEach(arrow => {
                arrow.style.fontSize = '40px';
                arrow.style.opacity = '0.8';
            });
            
            // Ensure navigation arrows are visible on mobile
            const wrapSlick = document.querySelector('.wrap-slick1');
            if (wrapSlick) {
                wrapSlick.addEventListener('touchstart', function() {
                    arrows.forEach(arrow => {
                        arrow.style.opacity = '1';
                    });
                });
                
                setTimeout(function() {
                    arrows.forEach(arrow => {
                        arrow.style.opacity = '0.8';
                    });
                }, 2000);
            }
        }
    }
    
    // MOBILE-SPECIFIC WISHLIST FIX - Disabled to prevent conflicts with main wishlist functionality
    function fixMobileWishlist() {
        // Completely disable mobile wishlist enhancements to prevent conflicts
        // The main wishlist functionality in index.php and product.php handles everything properly
        console.log('Mobile wishlist fix disabled - using main page wishlist functionality');
        return;
    }
    
    // Function to update wishlist count immediately on mobile
    function updateMobileWishlistCount(change) {
        if (window.innerWidth <= 767) {
            console.log('Updating mobile wishlist count by:', change);
            
            // Find the wishlist count element in header
            const headerWishlist = document.querySelector('.icon-header-noti[href="wishlist-view.php"]');
            if (headerWishlist) {
                let currentCount = parseInt(headerWishlist.getAttribute('data-notify')) || 0;
                currentCount = Math.max(0, currentCount + change);
                
                // Update the count immediately
                headerWishlist.setAttribute('data-notify', currentCount);
                
                // Also update any text content if it exists
                if (headerWishlist.textContent.trim() !== '' && !isNaN(parseInt(headerWishlist.textContent.trim()))) {
                    headerWishlist.textContent = currentCount;
                }
                
                console.log('Mobile wishlist count updated to:', currentCount);
            }
        }
    }
    
    // Initialize all mobile fixes
    function initMobileFixes() {
        fixMobileSlider();
        fixMobileHeader();
        removeTextShadows();
        fixMobileIcons();
        setMobileViewport();
        fixMobileSliderNav();
        fixMobileWishlist(); // Add mobile wishlist fix
    }
    
    // Run on page load
    initMobileFixes();
    
    // Run on window resize
    window.addEventListener('resize', function() {
        setTimeout(initMobileFixes, 100);
    });
    
    // Run on orientation change
    window.addEventListener('orientationchange', function() {
        setTimeout(initMobileFixes, 500);
    });
    
    // Ensure mobile fixes are applied after any dynamic content loads
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList') {
                setTimeout(initMobileFixes, 100);
            }
        });
    });
    
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
    
    // Fix for mobile touch events
    if ('ontouchstart' in window) {
        document.addEventListener('touchstart', function() {
            // Ensure mobile header stays visible
            const mobileHeader = document.querySelector('.wrap-header-mobile');
            if (mobileHeader) {
                mobileHeader.style.position = 'fixed';
                mobileHeader.style.top = '0';
            }
        });
    }
    
    // Fix for mobile scroll issues
    let scrollTimeout;
    window.addEventListener('scroll', function() {
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(function() {
            if (window.innerWidth <= 991) {
                const mobileHeader = document.querySelector('.wrap-header-mobile');
                if (mobileHeader) {
                    mobileHeader.style.position = 'fixed';
                    mobileHeader.style.top = '0';
                }
            }
        }, 10);
    });
    
    // Ensure mobile menu works properly
    const mobileMenuToggle = document.querySelector('.btn-show-menu-mobile');
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function() {
            const mobileMenu = document.querySelector('.menu-mobile');
            if (mobileMenu) {
                mobileMenu.style.display = mobileMenu.style.display === 'block' ? 'none' : 'block';
            }
        });
    }
    
    // Fix mobile search modal
    const searchToggle = document.querySelector('.js-show-modal-search');
    if (searchToggle) {
        searchToggle.addEventListener('click', function() {
            const searchModal = document.querySelector('.modal-search-header');
            if (searchModal) {
                searchModal.style.display = 'block';
                searchModal.style.bottom = '0';
            }
        });
    }
    
    // Fix mobile cart panel
    const cartToggle = document.querySelector('.js-show-cart');
    if (cartToggle) {
        cartToggle.addEventListener('click', function() {
            const cartPanel = document.querySelector('.wrap-header-cart');
            if (cartPanel) {
                cartPanel.style.right = '0';
            }
        });
    }
    
    // Close mobile modals when clicking outside
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('modal-search-header')) {
            e.target.style.bottom = '101%';
        }
        
        if (e.target.classList.contains('js-hide-cart')) {
            const cartPanel = document.querySelector('.wrap-header-cart');
            if (cartPanel) {
                cartPanel.style.right = '-100%';
            }
        }
    });
    
    // Ensure proper mobile spacing
    function adjustMobileSpacing() {
        if (window.innerWidth <= 767) {
            const sections = document.querySelectorAll('section');
            sections.forEach(section => {
                if (section.classList.contains('section-slide')) {
                    section.style.marginTop = '0';
                    section.style.paddingTop = '0';
                    section.style.width = '100vw';
                    section.style.overflow = 'hidden';
                }
            });
            
            const containers = document.querySelectorAll('.container');
            containers.forEach(container => {
                container.style.paddingLeft = '15px';
                container.style.paddingRight = '15px';
            });
            
            // Ensure slider takes full viewport height and width
            const sliderItems = document.querySelectorAll('.item-slick1');
            sliderItems.forEach(item => {
                item.style.height = window.innerHeight + 'px';
                item.style.minHeight = window.innerHeight + 'px';
                item.style.width = '100vw';
                item.style.marginLeft = 'calc(-50vw + 50%)';
                item.style.marginRight = 'calc(-50vw + 50%)';
                item.style.display = 'flex';
                item.style.alignItems = 'center';
                item.style.justifyContent = 'flex-start';
                item.style.backgroundSize = 'contain';
            });
            
            // Ensure slider wrapper takes full width
            const sliderWrappers = document.querySelectorAll('.wrap-slick1');
            sliderWrappers.forEach(wrapper => {
                wrapper.style.width = '100vw';
                wrapper.style.overflow = 'hidden';
            });
            
            // Position the flex containers on the left
            const flexContainers = document.querySelectorAll('.flex-col-l-m');
            flexContainers.forEach(container => {
                container.style.display = 'flex';
                container.style.flexDirection = 'column';
                container.style.alignItems = 'flex-start';
                container.style.justifyContent = 'center';
                container.style.textAlign = 'left';
                container.style.height = '100%';
                container.style.margin = '0';
                container.style.padding = '0 0 0 40px';
            });
        }
    }
    
    // Run spacing adjustment
    adjustMobileSpacing();
    
    // Re-run on resize
    window.addEventListener('resize', adjustMobileSpacing);
    
    // Additional mobile wishlist fix for dynamic content
    if (window.innerWidth <= 767) {
        // Wait for the page to be fully loaded
        window.addEventListener('load', function() {
            setTimeout(fixMobileWishlist, 200);
        });
        
        // Also run after a longer delay to catch any late-loaded content
        setTimeout(fixMobileWishlist, 2000);
    }
});
