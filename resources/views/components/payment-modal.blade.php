@props(['id'])
<script>
    function handleOrderSubmission(isExample = false) {

if(isExample) {
    document.getElementById('exampleSmetaBtn').innerHTML = 'Загрузка...';
} else {
    console.log('is not example');
}
var formData = new FormData();
formData.append('selectedOptions', JSON.stringify(selectedOptionRefs));
formData.append('selectedOptionPrices', JSON.stringify(selectedOptionPrices));
formData.append('totalPrice', document.getElementById('totalPrice').textContent);
formData.append('designId', isExample ? '1' : {{ $id }});
//formData.append('designId', '1');

fetch('/register-order', {
method: 'POST',
body: formData,
headers: {
    'X-CSRF-TOKEN': '{{ csrf_token() }}'
}
})
.then(response => response.json())
.then(data => {
if (isExample) {
    // For example Smeta, directly initiate download
    document.getElementById('exampleSmetaBtn').innerHTML = 'Пример сметы (скачать)';
    window.open('http://tmp.mirsmet.com/process-order/' + data.orderId, '_blank');
} else {
    // For paid order, send AJAX request and then redirect
    fetch('http://tmp.стройка.com/process-order/' + data.orderId, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            window.location.href = '/order';
        } else {
            console.error('Error processing order');
        }
    })
    .catch(error => {
            console.error('Error processing order:', error);
            // Optionally, you can still redirect or show an error message
           // window.location.href = '/order';
        });
}
})
.catch(error => {
    console.error('Error:', error);
});


}
</script>
<div id="paymentModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Информация для оплаты</h2>
        <form id="paymentForm">
            <label for="name">Имя:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required
                @auth
                    value="{{ Auth::user()->email }}"
                    readonly
                @endauth
            >
            
            <label for="phone">Телефон:</label>
            <input type="tel" id="phone" name="phone" required>
            
            @guest
                <label for="password">Создать пароль:</label>
                <input type="password" id="password" name="password" required>
            @endguest
            
            <button type="submit" class="btn btn-primary">Оплатить 200 руб.</button>
            <div id="orderStatus"></div>
        </form>
    </div>
</div>