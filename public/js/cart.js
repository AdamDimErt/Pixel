document.addEventListener('DOMContentLoaded', function () {
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    const cartCountContainer = document.getElementById('cart-count'); // assuming you have an element with id 'cart-count'

    addToCartButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.dataset.productId;
            fetch('/add-to-cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({ product_id: productId }),
            })
        .then(response => response.json())
            .then(data => {
                if (data.success) {
                    M.toast({html: 'Product added to cart!'});
                    fetch('/get-cart-count', {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                    })
                .then(response => response.json())
                    .then(cartData => {
                        cartCountContainer.textContent = cartData.cartCount;
                    })
                    .catch(error => {
                        console.error('Error fetching cart count:', error);
                    });
                } else {
                    M.toast({html: 'Failed to add product to cart.'});
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while adding the product to the cart.');
            });
        });
    });
});
