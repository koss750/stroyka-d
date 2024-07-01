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