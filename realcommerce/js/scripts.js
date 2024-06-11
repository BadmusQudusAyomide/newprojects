function validateForm(form) {
    let isValid = true;
    let message = '';

    const fields = form.querySelectorAll('input[required], textarea[required], select[required]');
    fields.forEach(field => {
        if (field.value.trim() === '') {
            message += `${field.name} is required.\n`;
            isValid = false;
        }
    });

    const password = form.querySelector('input[name="password"]');
    const confirmPassword = form.querySelector('input[name="confirm_password"]');
    if (password && confirmPassword && password.value !== confirmPassword.value) {
        message += 'Passwords do not match.\n';
        isValid = false;
    }

    if (!isValid) {
        alert(message);
    }

    return isValid;
}

// Event listener for form submission
document.addEventListener('DOMContentLoaded', () => {
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', (event) => {
            if (!validateForm(form)) {
                event.preventDefault();
            }
        });
    });
});

// Function to add items to the cart
function addToCart(productId, quantity) {
    let cart = JSON.parse(localStorage.getItem('cart')) || {};
    if (cart[productId]) {
        cart[productId] += quantity;
    } else {
        cart[productId] = quantity;
    }
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
    alert('Item added to cart');
}

// Function to update the cart count display
function updateCartCount() {
    const cart = JSON.parse(localStorage.getItem('cart')) || {};
    const count = Object.values(cart).reduce((sum, quantity) => sum + quantity, 0);
    document.getElementById('cart-count').innerText = count;
}

// Function to remove items from the cart
function removeFromCart(productId) {
    let cart = JSON.parse(localStorage.getItem('cart')) || {};
    if (cart[productId]) {
        delete cart[productId];
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartCount();
        alert('Item removed from cart');
    }
}

// Event listener for responsive navigation
document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('menu-toggle');
    const nav = document.querySelector('nav ul');
    menuToggle.addEventListener('click', () => {
        nav.classList.toggle('open');
    });
    updateCartCount();
});



