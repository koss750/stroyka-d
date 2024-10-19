@extends('layouts.alternative')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-body">
                    <h2 class="text-center mb-4">Подтверждение регистрации юридического лица</h2>
                    
                    <div class="alert alert-info" role="alert">
                        <h4 class="alert-heading">Важное уведомление:</h4>
                        <p>Уважаемый пользователь, мы рады приветствовать вас на нашей платформе!</p>
                        <p>В рамках нашей процедуры обеспечения качества и безопасности, мы проверяем и утверждаем все регистрации юридических лиц. Обычно членство в нашей системе является платным.</p>
                        <p>Однако, в связи с запуском нашего сервиса, мы предлагаем специальные условия: в течение первых двух месяцев стоимость членства составит всего 1 рубль в месяц. Это позволит вам ознакомиться с нашими услугами и оценить их преимущества.</p>
                        <p>Для передачи ваших данных на проверку администратору, необходимо произвести символический платеж в размере 1 рубля. Кнопка для оплаты находится в конце страницы.</p>
                        <hr>
                        <p class="mb-0">Важно: вы можете отменить членство в любое время, уведомив нас за 1 неделю, или приостановить его на неопределенный срок, связавшись с нашей службой поддержки по адресу info@стройка.com.</p>
                    </div>

                    <h4 class="mt-4 mb-3">Данные вашей регистрации:</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Название компании:</strong> {{ $company_name }}</p>
                            <p><strong>ИНН:</strong> {{ $inn }}</p>
                            <p><strong>КПП:</strong> {{ $kpp }}</p>
                            <p><strong>ОГРН:</strong> {{ $ogrn }}</p>
                            <p><strong>Юридический адрес:</strong> {{ $legal_address }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Фактический адрес:</strong> {{ $physical_address }}</p>
                            <p><strong>Email:</strong> {{ $email }}</p>
                            <p><strong>Телефон:</strong> {{ $phone }}</p>
                            <p><strong>Дополнительный телефон:</strong> {{ $additional_phone }}</p>
                            <p><strong>Контактное лицо:</strong> {{ $contact_name }}</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h5>Выбранные регионы предоставления услуг:</h5>
                        <ul>
                            @foreach($selected_regions as $region)
                                <li>{{ $region }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="mt-4 text-center">
                        <p>Для завершения регистрации и передачи данных на проверку, пожалуйста, нажмите кнопку ниже:</p>
                        <!-- Placeholder for the payment button -->
                        <button id="complete_registration" class="btn btn-primary" disabled>Завершить регистрацию (1 ₽)</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Placeholder for payment processing logic
    document.addEventListener('DOMContentLoaded', function() {
        const completeRegistrationButton = document.getElementById('complete_registration');
        completeRegistrationButton.disabled = false;

        completeRegistrationButton.addEventListener('click', function() {
            // Add payment processing logic here
            alert('Функционал оплаты будет добавлен позже.');
        });
    });
</script>
@endsection