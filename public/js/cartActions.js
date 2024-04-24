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
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
}

function changeCart(e) {
    {
        e.preventDefault()
        const cartKey = this.dataset.cartKey;
        const additionalId = this.dataset.additionalId;
        const url = e.target.checked ?  '/additional-add' : '/additional-remove'
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
                const discount = +document.querySelector('.client-discount-holder').dataset.discountPercent
                const controlSumNode = e.target.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.querySelector('.good-cost-holder');
                if (e.target.checked){
                    controlSumNode.innerHTML = +controlSumNode.innerHTML + (+this.dataset.additionalCost / 100 * (100 - discount))
                } else {
                    controlSumNode.innerHTML = +controlSumNode.innerHTML - (+this.dataset.additionalCost / 100 * (100 - discount))
                }
            })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}

document.querySelectorAll('.cancel-btn').forEach(btn => {
    btn.onclick = removeFromCart
})

document.querySelectorAll('.start_date').forEach(el => {
})


const beginingDatepickers = document.querySelectorAll('.begining-date')
beginingDatepickers.forEach(async item => {
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
        autoClose: true,
        format: 'dd/mm/yyyy',
        minDate: new Date()
    });
    const forbiddenDates = await fetch('/item/' + instance.el.dataset.itemId + '/get-unavailable-dates', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
    })
        .then(resp => resp.json())
        .then(response => {
            return response.forbiddenDates;
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
    instance.options.disableDayFn = (date) => {
        const day = date.getDate().toString().padStart(2, '0');
        const month = (date.getMonth() + 1).toString().padStart(2, '0');
        const year = date.getFullYear();
        const dateString = `${day}/${month}/${year}`;
        return forbiddenDates.includes(dateString);
    }
    instance.options.onSelect = async (e) => {
        const day = e.getDate().toString().padStart(2, '0');
        const month = (e.getMonth() + 1).toString().padStart(2, '0');
        const year = e.getFullYear();
        const rentStartDate = `${year}-${month}-${day}`;
        const responseData = await fetch('/item/' + instance.el.dataset.itemId + '/get-available-times', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },

            body: JSON.stringify({
                'start_date': rentStartDate
            })
        })
            .then(resp => resp.json())
            .then(response => {
                return response;
            })

        const availableTimes = responseData.availableTimes;
        const nextUnavailableDate = responseData.nextUnavailableDate;
        const selector = instance.el.parentNode.parentNode.querySelector('.rent-start-time')
        selector.parentNode.classList.remove('hide')
        selector.innerHTML = '<option value="" disabled selected>Выберите время:</option>'
        availableTimes.forEach(time => {
            selector.innerHTML += `<option value="${time}" class="black-text">${time}</option>`
        })
        M.FormSelect.init(selector, {});
        selector.onchange = async (e) => {
            try {
                const additionalsWrapper = e.target.parentNode.parentNode.parentNode.parentNode.querySelector('.additionals-wrapper');
                additionalsWrapper.innerHTML = ''
            } catch (e) {
            }
            const rentStartTime = e.target.value;
            const secondDatepicker = e.target.parentNode.parentNode.parentNode.querySelector('.ending-date');
            secondDatepicker.parentNode.classList.remove('hide')
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
                autoClose: true,
                format: 'dd/mm/yyyy',
                minDate: new Date(rentStartDate),
                disableDayFn: (date => {
                    if (nextUnavailableDate){
                        const day = date.getDate().toString().padStart(2, '0');
                        const month = (date.getMonth() + 1).toString().padStart(2, '0');
                        const year = date.getFullYear();
                        const dateString = `${year}-${month}-${day}`;
                        return nextUnavailableDate !== dateString;
                    }
                    return false;
                }),
                onSelect: async (e) => {
                    const day = e.getDate().toString().padStart(2, '0');
                    const month = (e.getMonth() + 1).toString().padStart(2, '0');
                    const year = e.getFullYear();
                    const rentEndDate = `${year}-${month}-${day}`;
                    const responseData = await fetch('/item/' + instance.el.dataset.itemId + '/get-next-rent-times', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },

                        body: JSON.stringify({
                            'finish_date': rentEndDate,
                            'finish_time': rentStartTime,
                        })
                    })
                        .then(resp => resp.json())
                        .then(response => {
                            return response;
                        })
                    const nextAvailableTimes = responseData.nextAvailableTimes;
                    const endTimeSelector = instance.el.parentNode.parentNode.querySelector('.rent-end-time')
                    endTimeSelector.parentNode.classList.remove('hide')
                    endTimeSelector.innerHTML = '<option value="" disabled selected>Выберите время:</option>'
                    nextAvailableTimes.forEach(time => {
                        endTimeSelector.innerHTML += `<option value="${time}" class="black-text">${time}</option>`
                    })
                    M.FormSelect.init(endTimeSelector, {});
                    endTimeSelector.onchange = async (e) => {
                        try {
                            const additionalsWrapper = e.target.parentNode.parentNode.parentNode.parentNode.querySelector('.additionals-wrapper');
                            additionalsWrapper.innerHTML = ''
                        } catch (e){}

                        const rentEndTime = e.target.value
                        var startDate = new Date(rentStartDate + ' ' + rentStartTime);
                        var endDate = new Date(rentEndDate + ' ' + rentEndTime);

                        var differenceMs = Math.abs(endDate.getTime() - startDate.getTime());

                        var differenceDays = Math.ceil(differenceMs / (1000 * 60 * 60 * 24)) ?? 1;
                        if (differenceDays >= 2) {
                            differenceDays--;
                        }
                        const sumHolder = e.target.parentNode.parentNode.parentNode.parentNode.querySelector('.good-cost-holder')

                        const discount = +document.querySelector('.client-discount-holder').dataset.discountPercent

                        const cost = +e.target.parentNode.parentNode.parentNode.parentNode.dataset.goodCost

                        if (discount) {
                            sumHolder.innerHTML = (+cost * differenceDays) / 100 * (100 - discount);
                        } else {
                            sumHolder.innerHTML = +cost * differenceDays;
                        }

                        try {
                            const additionalsWrapper = e.target.parentNode.parentNode.parentNode.parentNode.querySelector('.additionals-wrapper');
                            const additionalsOuterWrapper = e.target.parentNode.parentNode.parentNode.parentNode.querySelector('.additionals-outer-wrapper');
                            const additionalsResponse = await fetch('/get-available-additions', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                },
                                body: JSON.stringify({
                                    startDate: startDate,
                                    endDate: endDate,
                                    goodId: e.target.parentNode.parentNode.parentNode.parentNode.dataset.goodId
                                }),
                            })
                                .then(resp => resp.json())

                            additionalsResponse.additionals.forEach(additional => {
                                additionalsWrapper.innerHTML += `<p>
                                <label>
                                    <input type="checkbox"
                                           class="orange-text additional-checkbox"
                                           data-cart-key="${e.target.parentNode.parentNode.parentNode.parentNode.dataset.goodId}pixelrental${e.target.parentNode.parentNode.parentNode.parentNode.dataset.goodItemId}"
                                           data-additional-id="${additional.id}"
                                           data-additional-cost="${(additional.good.additional_cost > 0 && additional.good.additional_cost != null) ? additional.good.additional_cost : additional.good.cost}"/>
                                    <span>${additional.good.name_ru} <span
                                        class="white-text">(+ ${(additional.good.additional_cost > 0 && additional.good.additional_cost != null) ? additional.good.additional_cost : additional.good.cost}тг)</span></span>
                                </label>
                            </p>`
                            })

                            additionalsOuterWrapper.classList.remove('hide')

                            additionalsWrapper.querySelectorAll('.additional-checkbox').forEach(el => {
                                el.onchange = changeCart
                            })
                        } catch (e) {
                            console.log(e)
                        }
                    }
                }
            });
        }
    }
})

function placeOrder() {
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
    } else {
        errorTextHolder.innerHTML = 'Не все даты и время заполнены!'
    }
}

