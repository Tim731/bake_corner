// public/js/cart.js

function updateCartCount() {
    $.ajax({
        url: "/cart/count", // Use a relative URL here
        method: 'GET',
        success: function(data) {
            $('#cartCount').text(data.count);
        },
        error: function(error) {
            console.error('Error updating cart count:', error);
        }
    });
}

// Make the function globally accessible
window.updateCartCount = updateCartCount;

// Call updateCartCount() on page load
$(document).ready(function() {
    updateCartCount();
});
