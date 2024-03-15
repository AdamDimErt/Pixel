const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

function removeFromCart(e) {
    {
        const productId = this.dataset.productId;
        fetch('/remove-from-cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({product_id: productId}),
        })
            .then(response => {
                e.target.parentNode.parentNode.remove()
                console.log(response.json())
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
}

document.querySelectorAll('.cancel-btn').forEach(btn => {
    btn.onclick = removeFromCart
})

