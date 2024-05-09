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
            .then(() => {
                enableAllOtherOptions(e.target.parentNode.parentNode.dataset.goodId, e.target.parentNode.parentNode.dataset.goodItemId)
                e.target.parentNode.parentNode.remove()
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
}

window.onload = function () {
    document.querySelector('.client-discount-holder').classList.remove('hide')
    document.querySelector('.main-loader').classList.add('hide')
};

const loaderElement = `
                                            <div class="col s12 center loader-holder">
                                                <div class="preloader-wrapper active">
                                                    <div class="spinner-layer spinner-orange-only">
                                                        <div class="circle-clipper left">
                                                            <div class="circle"></div>
                                                        </div><div class="gap-patch">
                                                            <div class="circle"></div>
                                                        </div><div class="circle-clipper right">
                                                            <div class="circle"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
`

function changeCart(e) {
    {
        e.preventDefault()
        const cartKey = this.dataset.cartKey;
        const additionalId = this.dataset.additionalId;
        const url = e.target.checked ? '/additional-add' : '/additional-remove'
        e.target.disabled = true
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({
                cart_key: cartKey,
                additional_id: additionalId,
            }),
        })
            .then(() => {
                const amountOfDays = e.target.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.dataset.amountOfDays ?? 1
                var discount = +document.querySelector('.client-discount-holder').dataset.discountPercent
                const controlSumNode = e.target.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.querySelector('.good-cost-holder');
                if (isNaN(discount)) {
                    discount = 0
                }
                if (e.target.checked) {
                    controlSumNode.innerHTML = (+controlSumNode.innerHTML + (+this.dataset.additionalCost / 100 * (100 - discount)) * amountOfDays)
                } else {
                    controlSumNode.innerHTML = (+controlSumNode.innerHTML - (+this.dataset.additionalCost / 100 * (100 - discount)) * amountOfDays)
                }
                e.target.disabled = false
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
}

document.querySelectorAll('.cancel-btn').forEach(btn => {
    btn.onclick = removeFromCart
})

document.querySelectorAll('.field-label').forEach(el => {
    el.onclick = e => {
        e.target.previousSibling.previousSibling.click()
    }
})

document.querySelectorAll('.start_date').forEach(el => {
})

const itemIdPickers = document.querySelectorAll('.item-id-selector')

itemIdPickers.forEach(async item => {
    item.parentNode.insertAdjacentHTML('afterend', loaderElement)
    const availableItems = await fetch('/good/' + item.parentNode.parentNode.parentNode.dataset.goodId + '/get-items', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
    })
        .then(async resp => {
            return await resp.json()
        })
        .then(response => {
            item.parentNode.parentNode.querySelector('.loader-holder').remove()
            item.parentNode.classList.remove('hide')
            return response.available_items;
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
    item.innerHTML = '<option value="" disabled selected>Подберите свободный вариант:</option>'
    availableItems.forEach(avItem => {
        item.innerHTML += `<option value="${avItem.id}">${avItem.good.name} (${avItem.id})</option>`
    })
    var itemSelect = M.FormSelect.init(item, {})
    itemSelect.el.onchange = async (e) => {
        const selectedItemId = e.target.value
        await changeCartKey(e.target.dataset.goodId, selectedItemId, e.target.dataset.oldItemId)
        await changeFieldsItemId(e.target, e.target.dataset.goodId, selectedItemId)
        e.target.parentNode.parentNode.parentNode.parentNode.parentNode.dataset.goodItemId = selectedItemId
        if (e.target.dataset.oldItemId) {
            await enableAllOtherOptions(e.target.dataset.goodId, e.target.dataset.oldItemId);
        }
        await disableAllOtherOptions(e.target.dataset.goodId, e.target.value)
        e.target.dataset.oldItemId = selectedItemId;
        const item = e.target.parentNode.parentNode.parentNode.parentNode.querySelector('.begining-date')
        var instance = M.Datepicker.init(item, {
            i18n: {
                months:
                    [
                        'Январь',
                        'Февраль',
                        'Март',
                        'Апрель',
                        'Май',
                        'Июнь',
                        'Июль',
                        'Август',
                        'Сентябрь',
                        'Октябрь',
                        'Ноябрь',
                        'Декабрь'
                    ],

                monthsShort: [
                    'Янв',
                    'Фев',
                    'Мар',
                    'Апр',
                    'Май',
                    'Июн',
                    'Июл',
                    'Авг',
                    'Сен',
                    'Окт',
                    'Ноя',
                    'Дек'
                ],
                weekdays:
                    [
                        'Воскресенье',
                        'Понедельник',
                        'Вторник',
                        'Среда',
                        'Четверг',
                        'Пятница',
                        'Суббота'
                    ],
                weekdaysShort:
                    [
                        'Вс',
                        'Пн',
                        'Вт',
                        'Ср',
                        'Чт',
                        'Пт',
                        'Сб'
                    ],
                weekdaysAbbrev: [
                    'Вс',
                    'Пн',
                    'Вт',
                    'Ср',
                    'Чт',
                    'Пт',
                    'Сб'
                ],
                cancel: 'Отменить',
                clear: 'Очистить',
                done: 'ОК'
            },
            firstDay: 1,
            format: 'dd/mm/yyyy',
            minDate: new Date(),
            autoClose: true
        });
        item.parentNode.insertAdjacentHTML('afterend', loaderElement)
        const forbiddenDates = await fetch('/item/' + selectedItemId + '/get-unavailable-dates', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
        })
            .then(async resp => {
                return await resp.json()
            })
            .then(response => {
                item.parentNode.parentNode.querySelector('.loader-holder').remove()
                item.parentNode.classList.remove('hide')
                return response.forbiddenDates;
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
        instance.options.disableDayFn = (date) => {
            const day = date.getDate().toString().padStart(2, '0');
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            const year = date.getFullYear();
            const dateString = `${year}-${month}-${day}`;
            return forbiddenDates.includes(dateString);
        }
        instance.options.onSelect = async (e) => {
            const day = e.getDate().toString().padStart(2, '0');
            const month = (e.getMonth() + 1).toString().padStart(2, '0');
            const year = e.getFullYear();
            const rentStartDate = `${year}-${month}-${day}`;
            item.parentNode.insertAdjacentHTML('afterend', loaderElement)
            const selector = instance.el.parentNode.parentNode.querySelector('.rent-start-time')

            const responseData = await fetch('/item/' + selectedItemId + '/get-available-times', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },

                body: JSON.stringify({
                    'start_date': rentStartDate
                })
            })
                .then(async resp => {
                    return await resp.json()
                })
                .then(response => {
                    item.parentNode.parentNode.querySelector('.loader-holder').remove()
                    selector.parentNode.classList.remove('hide')
                    return response;
                })

            const availableTimes = responseData.availableTimes;
            const nextUnavailableDate = responseData.nextUnavailableDate;
            selector.innerHTML = '<option value="" disabled selected>Выберите время:</option>'
            availableTimes.forEach(time => {
                selector.innerHTML += `<option value="${time}" class="black-text">${time}</option>`
            })
            M.FormSelect.init(selector, {});
            selector.onchange = async (e) => {
                e.target.parentNode.parentNode.parentNode.insertAdjacentHTML('afterend', loaderElement)
                try {
                    const additionalsWrapper = e.target.parentNode.parentNode.parentNode.parentNode.querySelector('.additionals-wrapper');
                    additionalsWrapper.innerHTML = ''
                } catch (e) {
                }
                const rentStartTime = e.target.value;
                const secondDatepicker = e.target.parentNode.parentNode.parentNode.parentNode.querySelector('.ending-date');
                const responseData = await fetch('/item/' + selectedItemId + '/get-rent-end-dates', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        'start_date': rentStartDate,
                    })
                })
                    .then(async resp => {
                        return await resp.json()
                    })
                    .then(response => {
                        e.target.parentNode.parentNode.parentNode.parentNode.querySelector('.loader-holder').remove();
                        secondDatepicker.parentNode.classList.remove('hide')
                        return response;
                    })
                const availableRentEndDates = responseData.availableDates
                const secondDatepickerInstance = M.Datepicker.init(secondDatepicker, {
                    i18n: {
                        months:
                            [
                                'Январь',
                                'Февраль',
                                'Март',
                                'Апрель',
                                'Май',
                                'Июнь',
                                'Июль',
                                'Август',
                                'Сентябрь',
                                'Октябрь',
                                'Ноябрь',
                                'Декабрь'
                            ],

                        monthsShort: [
                            'Янв',
                            'Фев',
                            'Мар',
                            'Апр',
                            'Май',
                            'Июн',
                            'Июл',
                            'Авг',
                            'Сен',
                            'Окт',
                            'Ноя',
                            'Дек'
                        ],
                        weekdays:
                            [
                                'Воскресенье',
                                'Понедельник',
                                'Вторник',
                                'Среда',
                                'Четверг',
                                'Пятница',
                                'Суббота'

                            ],
                        weekdaysShort:
                            [
                                'Вс',
                                'Пн',
                                'Вт',
                                'Ср',
                                'Чт',
                                'Пт',
                                'Сб'
                            ],

                        weekdaysAbbrev: [
                            'Вс',
                            'Пн',
                            'Вт',
                            'Ср',
                            'Чт',
                            'Пт',
                            'Сб'
                        ],
                        cancel: 'Отменить',
                        clear: 'Очистить',
                        done: 'ОК'
                    },
                    firstDay: 1,
                    format: 'dd/mm/yyyy',
                    minDate: new Date(rentStartDate),
                    autoClose: true,
                    disableDayFn: (date => {
                        if (availableRentEndDates.length > 0) {
                            const day = date.getDate().toString().padStart(2, '0');
                            const month = (date.getMonth() + 1).toString().padStart(2, '0');
                            const year = date.getFullYear();
                            const dateString = `${year}-${month}-${day}`;
                            return !availableRentEndDates.includes(dateString);
                        }
                        return false;
                    }),
                    onSelect: async (e) => {
                        const day = e.getDate().toString().padStart(2, '0');
                        const month = (e.getMonth() + 1).toString().padStart(2, '0');
                        const year = e.getFullYear();
                        const rentEndDate = `${year}-${month}-${day}`;
                        secondDatepickerInstance.el.parentNode.insertAdjacentHTML('afterend', loaderElement)
                        const endTimeSelector = instance.el.parentNode.parentNode.querySelector('.rent-end-time')
                        const responseData = await fetch('/item/' + selectedItemId + '/get-next-rent-times', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },

                            body: JSON.stringify({
                                'finish_date': rentEndDate,
                                'start_date': rentStartDate,
                                'start_time': rentStartTime,
                            })
                        })
                            .then(async resp => {
                                return await resp.json()
                            })
                            .then(response => {
                                secondDatepickerInstance.el.parentNode.parentNode.querySelector('.loader-holder').remove()
                                endTimeSelector.parentNode.classList.remove('hide')
                                return response;
                            })
                        const nextAvailableTimes = responseData.nextAvailableTimes;
                        endTimeSelector.innerHTML = '<option value="" disabled selected>Выберите время:</option>'
                        nextAvailableTimes.forEach(time => {
                            endTimeSelector.innerHTML += `<option value="${time}" class="black-text">${time}</option>`
                        })
                        M.FormSelect.init(endTimeSelector, {});
                        endTimeSelector.onchange = async (e) => {
                            try {
                                const additionalsWrapper = e.target.parentNode.parentNode.parentNode.parentNode.parentNode.querySelector('.additionals-wrapper');
                                additionalsWrapper.innerHTML = ''
                            } catch (e) {
                            }

                            const rentEndTime = e.target.value
                            var startDate = new Date(rentStartDate + ' ' + rentStartTime);
                            var endDate = new Date(rentEndDate + ' ' + rentEndTime);

                            var differenceMs = Math.abs(endDate.getTime() - startDate.getTime());

                            var differenceDays = Math.ceil(differenceMs / (1000 * 60 * 60 * 24)) ?? 1;
                            e.target.parentNode.parentNode.parentNode.parentNode.parentNode.dataset.amountOfDays = differenceDays;

                            const sumHolder = e.target.parentNode.parentNode.parentNode.parentNode.parentNode.querySelector('.good-cost-holder')

                            const discount = +document.querySelector('.client-discount-holder').dataset.discountPercent

                            const cost = +e.target.parentNode.parentNode.parentNode.parentNode.parentNode.dataset.goodCost

                            if (discount) {
                                sumHolder.innerHTML = (+cost * differenceDays) / 100 * (100 - discount);
                            } else {
                                sumHolder.innerHTML = +cost * differenceDays;
                            }

                            try {

                                const additionalsWrapper = e.target.parentNode.parentNode.parentNode.parentNode.parentNode.querySelector('.additionals-wrapper');
                                const additionalsOuterWrapper = e.target.parentNode.parentNode.parentNode.parentNode.parentNode.querySelector('.additionals-outer-wrapper');
                                e.target.parentNode.parentNode.parentNode.insertAdjacentHTML('afterEnd', loaderElement)
                                const additionalsResponse = await fetch('/get-available-additions', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': csrfToken,
                                    },
                                    body: JSON.stringify({
                                        startDate: rentStartDate,
                                        startTime: rentStartTime,
                                        endDate: rentEndDate,
                                        endTime: rentEndTime,
                                        goodId: e.target.parentNode.parentNode.parentNode.parentNode.parentNode.dataset.goodId,
                                        cartKey: `${e.target.parentNode.parentNode.parentNode.parentNode.parentNode.dataset.goodId}pixelrental${selectedItemId}`
                                    }),
                                })
                                    .then(async resp => {
                                        e.target.parentNode.parentNode.parentNode.parentNode.querySelector('.loader-holder').remove()
                                        return await resp.json()
                                    })
                                    .catch(e => {
                                        console.log(e)
                                    })

                                additionalsResponse.additionals.forEach(additional => {
                                    if (additional.available) {
                                        additionalsWrapper.innerHTML += `<p>
                                    <label>
                                        <input type="checkbox"
                                               class="orange-text additional-checkbox"
                                               data-cart-key="${e.target.parentNode.parentNode.parentNode.parentNode.parentNode.dataset.goodId}pixelrental${selectedItemId}"
                                               data-additional-id="${additional.id}"
                                               data-additional-cost="${(additional.good.additional_cost > 0 && additional.good.additional_cost != null) ? additional.good.additional_cost : additional.good.cost}"
                                               />
                                        <span>${additional.good.name_ru} <span
                                            class="white-text">(+ ${(additional.good.additional_cost > 0 && additional.good.additional_cost != null) ? additional.good.additional_cost : additional.good.cost}тг)</span></span>
                                    </label>
                                </p>`
                                    } else {
                                        additionalsWrapper.innerHTML += `<p>
                                    <label>
                                        <input type="checkbox"
                                               class="orange-text additional-checkbox"
                                               disabled
                                               data-cart-key="${e.target.parentNode.parentNode.parentNode.parentNode.dataset.goodId}pixelrental${selectedItemId}"
                                               data-additional-id="${additional.id}"
                                               data-additional-cost="${(additional.good.additional_cost > 0 && additional.good.additional_cost != null) ? additional.good.additional_cost : additional.good.cost}"
                                               />
                                        <span>${additional.good.name_ru} <span
                                            class="white-text">(Недоступно на выбранные даты и время)</span></span>
                                    </label>
                                </p>`
                                    }
                                })
                                if (additionalsResponse.additionals.length > 0) {
                                    additionalsOuterWrapper.classList.remove('hide')

                                    additionalsWrapper.querySelectorAll('.additional-checkbox').forEach(el => {
                                        el.onchange = changeCart
                                    })
                                }
                            } catch (e) {
                                console.log(e)
                            }
                        }
                    }
                });
            }
        }

    }

})


function placeOrder(e) {
    const errorTextHolder = document.querySelector('.error-text')
    errorTextHolder.innerHTML = '';
    var flag = true;
    document.querySelectorAll('[required]').forEach(field => {
        if (!field.value) {
            flag = false;
            return null;
        }
    })
    if (flag) {
        document.querySelector('#order-placement-form').submit()
        e.target.onclick = () => {
        }
    } else {
        errorTextHolder.innerHTML = 'Не все даты и время заполнены!'
    }
}

function disableAllOtherOptions(goodId, itemId) {
    var selects = document.querySelectorAll(`select[data-good-id="${goodId}"]`);
    selects.forEach(select => {
        const options = select.querySelectorAll('option');
        options.forEach(option => {
            if (option.value === itemId) {
                option.disabled = true;
            }
        })
        M.FormSelect.init(select, {})
    })
}

function enableAllOtherOptions(goodId, itemId) {
    var selects = document.querySelectorAll(`select[data-good-id="${goodId}"]`);
    selects.forEach(select => {
        const options = select.querySelectorAll('option');
        options.forEach(option => {
            if (option.value === itemId) {
                option.disabled = false;
            }
        })
        M.FormSelect.init(select, {})
    })
}

function changeFieldsItemId(node, goodId, itemId){
    node.parentNode.parentNode.parentNode.parentNode.querySelectorAll('.input-field').forEach(el => {
        const select = el.querySelector('select')
        if (select) {
            const nameSplitted = select.name.split('[');
            select.name = `${goodId}pixelrental${itemId}[${nameSplitted[1]}`
        }
        const dateInput = el.querySelector('input.datepicker')
        if (dateInput) {
            const nameSplitted = dateInput.name.split('[');
            dateInput.name = `${goodId}pixelrental${itemId}[${nameSplitted[1]}`
        }
    })
}

async function changeCartKey(goodId, itemId, oldItemId){
    fetch('/change-cart-key', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({
            key_to_remove: `${goodId}pixelrental${oldItemId}`,
            key_to_set: `${goodId}pixelrental${itemId}`
        }),
    })
}

