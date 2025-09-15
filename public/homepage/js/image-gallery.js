// Image Gallery Functionality for Deals of the Day Section

/**
 * Switch the main product image when thumbnail is clicked
 * @param {string} imageUrl - The URL of the image to display
 * @param {HTMLElement} thumbnailElement - The clicked thumbnail element
 */
function switchMainImage(imageUrl, thumbnailElement) {
    const mainImage = document.getElementById('mainProductImage');
    if (mainImage) {
        mainImage.style.backgroundImage = `url('${imageUrl}')`;
        
        // Remove active class from all thumbnails and reset border styling
        const thumbnails = document.querySelectorAll('.thumbnail-image');
        thumbnails.forEach(thumb => {
            thumb.classList.remove('active');
            thumb.style.borderColor = 'transparent';
        });
        
        // Add active class to clicked thumbnail and set border styling
        if (thumbnailElement) {
            thumbnailElement.classList.add('active');
            thumbnailElement.style.borderColor = '#007bff';
        }
    }
}

// Add hover effects and click handlers when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    const thumbnails = document.querySelectorAll('.thumbnail-image');
    
    thumbnails.forEach(thumbnail => {
        // Add hover effect
        thumbnail.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1)';
            this.style.transition = 'transform 0.3s ease';
        });
        
        thumbnail.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
        
        // Add click effect
        thumbnail.addEventListener('click', function() {
            const imageUrl = this.getAttribute('data-image');
            switchMainImage(imageUrl, this);
        });
    });
    
    // Add hover effect to main image
    const mainImage = document.getElementById('mainProductImage');
    if (mainImage) {
        mainImage.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
            this.style.transition = 'transform 0.3s ease';
        });
        
        mainImage.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    }
});

// Add CSS for active thumbnail state
const style = document.createElement('style');
style.textContent = `
    .thumbnail-image.active {
        border: 2px solid #007bff !important;
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.5) !important;
    }
    
    .thumbnail-image:hover {
        opacity: 0.8;
    }
    
    .main-product-image {
        transition: transform 0.3s ease;
    }
`;
document.head.appendChild(style);