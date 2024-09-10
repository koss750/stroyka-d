@props(['id', 'title', 'image'])

<div id="paymentModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content modal-content-payment">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Купить смету</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5">
                        <form id="paymentForm">
                            @guest
                                <div class="form-group">
                                    <label for="name">Имя:</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Телефон:</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Создать пароль:</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            @endguest

                            <div class="form-group">
                                <label for="card-number">Номер карты:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="card-number" name="card-number" required placeholder="1234 5678 9012 3456" maxlength="19">
                                    <div class="input-group-append">
                                        <span class="input-group-text card-type-icon" id="card-type-icon"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="expiry-date">Срок действия:</label>
                                    <input type="text" class="form-control" id="expiry-date" name="expiry-date" required placeholder="MM/YY" maxlength="5">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cvv">CVV:</label>
                                    <input type="password" class="form-control" id="cvv" name="cvv" required placeholder="123" maxlength="3">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cardholder-name">Имя владельца карты:</label>
                                <input type="text" class="form-control" id="cardholder-name" name="cardholder-name" required>
                            </div>

                            <button type="submit" class="btn btn-outline-light">Оплатить 200 руб.</button>
                        </form>
                        <div id="orderStatus" class="mt-3"></div>
                    </div>
                    <div class="col-md-7">
                        <h5>Проект {{ $title }}</h5>
                        <img src="{{ $image }}" alt="{{ $title }}" class="img-fluid mb-3">
                        <h5>Выбранные параметры:</h5>
                        <ul class="list-unstyled">
                            <li><strong>Фундамент:</strong> <span id="modal_foundation"></span></li>
                            <li><strong>Домокомплект:</strong> <span id="modal_dd"></span></li>
                            <li><strong>Кровля:</strong> <span id="modal_roof"></span></li>
                        </ul>
                        <p class="mt-3">После оплаты смета будет доступна для скачивания 30 дней через личный кабинет.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .modal-content-payment {
        margin: 5% auto;
        width: 90%;
        max-width: 100%;
    }
    #paymentModal .modal-content {
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    #paymentModal .modal-header {
        border-bottom: none;
        padding: 20px 30px;
    }
    #paymentModal .modal-body {
        padding: 20px 30px;
    }
    #paymentModal .form-control {
        border-radius: 5px;
        border: 1px solid #ced4da;
        padding: 10px 15px;
    }
    #paymentModal .btn-primary {
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        padding: 12px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }
    #paymentModal .btn-primary:hover {
        background-color: #0056b3;
    }
    .card-type-icon {
        width: 40px;
        height: 25px;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }
    .card-type-visa {
        background-image: url('https://www.visa.com.ua/dam/VCOM/regional/ve/romania/blogs/hero-image/visa-logo-800x450.jpg');
    }
    .card-type-mastercard {
        background-image: url('https://platform.vox.com/wp-content/uploads/sites/2/chorus/uploads/chorus_asset/file/13674554/Mastercard_logo.jpg?quality=90&strip=all&crop=0,16.666666666667,100,66.666666666667');
    }
    .card-type-mir {
        background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTtw96jpVRrOTWcYjCpZLNpyV5ESnloAvRU5A&s');
    }

    .input-group-append {
        position: absolute;
        right: 10px;
        top: 19%;
        z-index: 10;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let configurationDescriptions = {};
    var modal = document.getElementById('paymentModal');
    modal.addEventListener('show.bs.modal', function () {
        function removePrefix(text, prefix) {
            return text.startsWith(prefix) ? text.slice(prefix.length).trim() : text;
        }

        var foundationText = document.getElementById('title_label_foundation').textContent;
        var foundationDescription = removePrefix(foundationText, 'Фундамент -');
        document.getElementById('modal_foundation').textContent = foundationDescription;
        var ddText = document.getElementById('title_label_dd').textContent;
        var ddDescription = removePrefix(ddText, 'Домокомплект -');
        document.getElementById('modal_dd').textContent = ddDescription;

        var roofText = document.getElementById('title_label_roof').textContent;
        var roofDescription = removePrefix(roofText, 'Кровля -');
        document.getElementById('modal_roof').textContent = roofDescription;

        configurationDescriptions = {
            foundation: foundationDescription,
            dd: ddDescription,
            roof: roofDescription
        };

        console.log(configurationDescriptions);
    });

    document.getElementById('paymentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        processPayment();
    });

    // Card number formatting and type detection
    document.getElementById('card-number').addEventListener('input', function (e) {
        var target = e.target;
        var position = target.selectionEnd;
        var length = target.value.length;
        
        target.value = target.value.replace(/[^\d]/g, '').replace(/(.{4})/g, '$1 ').trim();
        target.selectionEnd = position += ((target.value.charAt(position - 1) === ' ' && target.value.charAt(length - 1) === ' ' && length !== target.value.length) ? 1 : 0);

        // Detect card type
        var cardType = 'unknown';
        var firstDigit = target.value.charAt(0);
        if (firstDigit === '4') {
            cardType = 'visa';
        } else if (firstDigit === '5') {
            cardType = 'mastercard';
        } else if (firstDigit === '2') {
            cardType = 'mir';
        }

        // Display card logo
        var cardTypeIcon = document.getElementById('card-type-icon');
        cardTypeIcon.className = 'input-group-text card-type-icon';
        if (cardType !== 'unknown') {
            cardTypeIcon.classList.add('card-type-' + cardType);
        }
    });

    // Expiry date formatting
    document.getElementById('expiry-date').addEventListener('input', function (e) {
        var target = e.target;
        var position = target.selectionEnd;
        var length = target.value.length;
        
        target.value = target.value.replace(/[^\d]/g, '').substring(0, 4);
        if (target.value.length > 2) {
            target.value = target.value.substring(0, 2) + '/' + target.value.substring(2);
        }
        
        if (length !== target.value.length) {
            position = target.value.length;
        }
        target.selectionEnd = position;
    });

    function processPayment() {
        var formColumn = document.querySelector('#paymentModal .col-md-7');
        var isLoggedIn = @auth true @else false @endauth;
        var formData = new FormData(document.getElementById('paymentForm'));

        // Show loading spinner
        formColumn.innerHTML = `
            <div class="text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Обработка платежа...</span>
                </div>
                <p class="mt-3">Обработка платежа...</p>
            </div>
        `;

        // Function to register order
        function registerOrder() {
            const designId = '{{ $id }}';  // Use the id prop directly
            const paymentAmount = 200; // Assuming the payment amount is fixed at 200 rubles

            return fetch('/register-order-smeta', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    design_id: designId,
                    selected_configuration: JSON.stringify(selectedOptionRefs),
                    configuration_descriptions: JSON.stringify(configurationDescriptions),
                    payment_amount: paymentAmount,
                    order_type: 'smeta'
                })
            }).then(response => response.json());
        }

        // Process payment and register order
        (isLoggedIn ? Promise.resolve() : fetch('/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(Object.fromEntries(formData))
        }).then(response => response.json()))
        .then(() => registerOrder())
        .then(data => {
            if (isLoggedIn) {
                formColumn.innerHTML = `
                    <div class="text-center">
                        <h4 class="mb-4">Заказ подтвержден</h4>
                        <p>Спасибо за ваш заказ! Номер заказа: ${data.orderId}</p>
                        <a href="/my-orders" class="btn btn-outline-light">Перейти к заказам</a>
                    </div>
                `;
            } else {
                formColumn.innerHTML = `
                    <div class="text-center">
                        <h4 class="mb-4">Заказ подтвержден</h4>
                        <p>Спасибо за ваш заказ! Номер заказа: ${data.orderId}</p>
                        <p>Пожалуйста, проверьте вашу электронную почту и перейдите по ссылке для подтверждения.</p>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            formColumn.innerHTML = `
                <div class="text-center">
                    <h4 class="mb-4">Ошибка</h4>
                    <p>Произошла ошибка при обработке вашего заказа. Пожалуйста, попробуйте еще раз позже.</p>
                </div>
            `;
        });
    }
});
</script>