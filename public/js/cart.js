document.addEventListener('DOMContentLoaded', function () {
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    const cartCountContainer = document.querySelector('.in-cart-item-counter');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', async function () {
            const productId = this.dataset.productId;
            const selectedAdditionals = document.querySelectorAll('.additional-checkbox:checked');
            const additionalIds = [];
            selectedAdditionals.forEach(additional => {
                additionalIds.push(additional.dataset.additionalId);
            });

            await fetch('/add-to-cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({
                    product_id: productId,
                    additional_ids: additionalIds
                }),
            })
                .then(async response => {
                    return await response.json();
                })
                .then(async data => {
                    if (data.hasOwnProperty('error')) {
                        M.toast({html: `<i class="material-icons orange-text text-darken-4">error_outline</i>` + data.error});
                    } else {
                        if (data.success) {
                            M.toast({html: 'Продукт успешно добавлен в корзину!'});
                            await fetch('/get-cart-count', {
                                method: 'GET',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                },
                            })
                                .then(async response => await response.json())
                                .then(async cartData => {
                                    cartCountContainer.innerHTML = cartData.cartCount;
                                })
                                .catch(error => {
                                    console.error('Не получилось посчитать количество товаров в корзине:', error);
                                });
                        } else {
                            M.toast({html: 'Не удалось добавить товар в корзину.'});
                        }
                    }
                })
                .catch(error => {
                    console.log(error)
                    M.toast({html: 'Не удалось добавить товар в корзину.'});
                });
        });
    });
});
