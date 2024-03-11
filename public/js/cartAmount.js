const addToCartButtons = document.querySelectorAll('.add-btn');
const removeFromCartButtons = document.querySelectorAll('.substract-btn');
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

addToCartButtons.forEach(button => {
    button.addEventListener('click', function (e) {
        const productId = this.dataset.productId;
        const productCost = this.dataset.productCost;
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
                if (data.hasOwnProperty('error')) {
                    M.toast({html: `<i class="material-icons orange-text text-darken-4">error_outline</i>` + data.error});
                } else {
                    e.target.parentNode.parentNode.querySelector('.cart-view-counter').innerHTML = +e.target.parentNode.parentNode.querySelector('.cart-view-counter').innerHTML + 1
                    e.target.parentNode.parentNode.parentNode.querySelector('.good-cost-holder').innerHTML = +e.target.parentNode.parentNode.querySelector('.cart-view-counter').innerHTML * productCost
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
});
removeFromCartButtons.forEach(button => {
    button.addEventListener('click', function (e) {
        const productId = this.dataset.productId;
        const productCost = this.dataset.productCost;
        fetch('/remove-from-cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({ product_id: productId }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.hasOwnProperty('error')) {
                    M.toast({html: `<i class="material-icons orange-text text-darken-4">error_outline</i>` + data.error});
                } else {
                    if (+e.target.parentNode.parentNode.querySelector('.cart-view-counter').innerHTML > 1){
                        e.target.parentNode.parentNode.querySelector('.cart-view-counter').innerHTML = +e.target.parentNode.parentNode.querySelector('.cart-view-counter').innerHTML - 1
                        e.target.parentNode.parentNode.parentNode.querySelector('.good-cost-holder').innerHTML = +e.target.parentNode.parentNode.querySelector('.cart-view-counter').innerHTML * productCost
                    } else {
                        e.target.parentNode.parentNode.parentNode.parentNode.remove();
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
});
