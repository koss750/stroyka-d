<header id="headerBar">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-4 col-sm-2">
                <div class="headerLogo">
                    <a href="https://xn--80ardojfh.com">
                        <img src="{{ asset('assets/images/logo5.png') }}" alt="Стройка.com" class="logo-image">
                    </a>
                </div>
            </div>
            <div class="col-5 col-sm-3 search-container">
                <div class="searchBar">
                    <input type="text" id="search-input" placeholder="Поиск по сайту..." autocomplete="off">
                    <div id="autocomplete-results" class="autocomplete-results"></div>
                </div>
            </div>
            <div class="col-3 col-sm-7">
                <div class="headerMenu">
                    <ul class="nav">
                        @guest
                            <li><a href="#" class="signup-btn-individual">Физические лица</a></li>
                            <li><a href="#" class="signup-btn-legal">Юридические лица</a></li>
                            <li><a href="#" class="login-btn">Войти</a></li>
                        @endguest
                        @auth
                            <li class="dropdown">
                                <a href="/orders" class="dropdown-toggle">Личный Кабинет</a>
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item logout-btn">Выйти</a>
                                </div>
                            </li>
                        @endauth
                    </ul>
                </div>
                <div class="hamburger-menu">
                    <i class="fas fa-bars"></i>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Login Popup -->
<div id="login-popup" class="popup">
    <div class="popup-content">
        <span class="close">&times;</span>
        <h2 class="mb-4">Вход</h2>
        <form id="login-form">
            @csrf
            <div class="form-group">
                <label for="login-email">Email</label>
                <input type="email" class="form-control" id="login-email" name="email" required>
            </div>
            <div class="form-group">
                <label for="login-password">Пароль</label>
                <input type="password" class="form-control" id="login-password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Войти</button>
        </form>
    </div>
</div>

<!-- Signup Popup for Individual Users -->
<div id="signup-popup-individual" class="popup">
    <div class="popup-content">
        <span class="close">&times;</span>
        <h2 class="mb-4">Регист��ация физического лица</h2>
        <form id="signup-form-individual">
            <div class="form-group">
                <label for="individual-name">Имя</label>
                <input type="text" class="form-control" id="individual-name" name="name" required>
            </div>
            <div class="form-group">
                <label for="individual-email">E-mail</label>
                <input type="email" class="form-control" id="individual-email" name="email" required>
            </div>
            <div class="form-group">
                <label for="individual-password">Пароль</label>
                <input type="password" class="form-control" id="individual-password" name="password" required>
            </div>
            <div class="form-group">
                <label for="individual-password-confirmation">Подтвердите пароль</label>
                <input type="password" class="form-control" id="individual-password-confirmation" name="password_confirmation" required>
            </div>
            <div class="form-group">
                <label for="individual-region-select">Регион</label>
                <select class="form-control" id="individual-region-select" name="region_code" required>
                    <option value="">Выберите Ваш Регион</option>
                    <!-- Options will be populated dynamically -->
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Зарегистрироваться</button>
        </form>
    </div>
</div>

<!-- Signup Popup for Legal Entities -->
<div id="signup-popup-legal" class="popup">
    <div class="popup-content">
        <span class="close">&times;</span>
        <h2 class="mb-4">Регистрация юридического лица</h2>
        <form id="signup-form-legal">
            <div class="form-group">
                <label for="inn">ИНН</label>
                <input type="text" class="form-control" id="inn" name="inn" required>
                <button type="button" id="check-inn" class="btn btn-secondary mt-2">Проверить</button>
            </div>
            <div id="company-confirmation" style="display: none;">
                <p>Найдена компания: <span id="found-company-name"></span></p>
                <p>Это ваша компания?</p>
                <button type="button" id="confirm-company" class="btn btn-primary">Да</button>
                <button type="button" id="reject-company" class="btn btn-secondary">Нет</button>
            </div>
            <div id="additional-fields" style="display: none;">
                <div class="form-group">
                    <label for="company_name">Название фирмы</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" readonly>
                </div>
                <div class="form-group">
                    <label for="kpp">КПП</label>
                    <input type="text" class="form-control" id="kpp" name="kpp" readonly>
                </div>
                <div class="form-group">
                    <label for="ogrn">ОГРН</label>
                    <input type="text" class="form-control" id="ogrn" name="ogrn" readonly>
                </div>
                <div class="form-group">
                    <label for="legal_address">ЮР. адрес фирмы</label>
                    <input type="text" class="form-control" id="legal_address" name="legal_address" readonly>
                </div>
                <div class="form-group">
                    <label for="physical_address">ФИЗ. Адрес</label>
                    <input type="text" class="form-control" id="physical_address" name="physical_address" required>
                </div>
                <div class="form-group">
                    <label for="email">Адрес эл. Почты</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Номер телефона организации</label>
                    <input type="tel" class="form-control" id="phone" name="phone" required>
                </div>
                <input type="hidden" id="state_status" name="state_status">
                <input type="hidden" id="company_age" name="company_age">
                
                <div class="form-group">
                    <label for="additional_phone">Второй контактный номер тел.</label>
                    <input type="text" class="form-control" id="additional_phone" name="additional_phone" required>
                </div>
                <div class="form-group">
                    <label for="contact_name">Имя контактного лица</label>
                    <input type="text" class="form-control" id="contact_name" name="contact_name" required>
                </div>
                <div class="form-group">
                    <label for="region-input">Регионы</label>
                    <input type="text" class="form-control" id="region-input" placeholder="Введите регионы предоставления ваших услуг">
                    <div id="selected-regions" class="mt-2"></div>
                    <input type="hidden" id="region-codes" name="region_codes">
                </div>

                <!--Звёздочки на обязательных полях-->
            </div>
            <button type="submit" class="btn btn-primary btn-block" style="display: none;">Зарегистрироваться</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('.assign-executor').on('click', function() {
            var projectId = $(this).data('project-id');
            $('#disclaimerModal').modal('show');
            $('.modal-backdrop').css('z-index', 0);
            $('#acceptDisclaimer').off('click').on('click', function() {
                $('#disclaimerModal').modal('hide');
                loadExecutors(projectId);
            });
        });

        function loadExecutors(projectId) {
            fetch(`/api/projects/${projectId}/available-executors`)
                .then(response => response.json())
                .then(data => {
                    const executorList = document.getElementById('executorList');
                    executorList.innerHTML = '';
                    
                    data.executors.forEach(executor => {
                        const li = document.createElement('li');
                        li.className = 'list-group-item d-flex justify-content-between align-items-center';
                        li.innerHTML = `
                            ${executor.name}
                            <button class="btn btn-sm btn-primary select-executor" data-executor-id="${executor.id}" data-project-id="${projectId}">Выбрать</button>
                        `;
                        executorList.appendChild(li);
                    });

                    const executorModal = new bootstrap.Modal(document.getElementById('executorModal'));
                    executorModal.show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Ошибка при загрузке списка исполнителей');
                });
        }

        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('select-executor')) {
                const executorId = event.target.getAttribute('data-executor-id');
                const projectId = event.target.getAttribute('data-project-id');
                
                fetch(`/api/projects/${projectId}/assign-executors`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ executor_ids: [executorId] })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    const executorModal = bootstrap.Modal.getInstance(document.getElementById('executorModal'));
                    executorModal.hide();
                    // Optionally, refresh the page or update the UI
                    location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Ошибка при назначении исполителя');
                });
            }
        });
         const hamburger = document.querySelector('.hamburger-menu');
         const mobileMenu = document.createElement('div');
         mobileMenu.className = 'mobile-menu';
         mobileMenu.innerHTML = `
             <ul>
                 @guest
                    <li><a href="#" class="signup-btn-individual">Физические лица</a></li>
                    <li><a href="#" class="signup-btn-legal">Юридические лица</a></li>
                @endguest
                @auth
                    <li><a href="/orders">Личный Кабинет</a></li>
                @endauth
             </ul>
         `;
         document.querySelector('.headerMenu').appendChild(mobileMenu);

         hamburger.addEventListener('click', function() {
             mobileMenu.classList.toggle('active');
         });

         // Close menu when clicking outside
         document.addEventListener('click', function(event) {
             if (!hamburger.contains(event.target) && !mobileMenu.contains(event.target)) {
                 mobileMenu.classList.remove('active');
             }
         });

         const signupPopupIndividual = document.getElementById('signup-popup-individual');
         const signupPopupLegal = document.getElementById('signup-popup-legal');
         const signupBtnsIndividual = document.querySelectorAll('.signup-btn-individual');
         const signupBtnsLegal = document.querySelectorAll('.signup-btn-legal');
         const closeBtns = document.querySelectorAll('.close');

         signupBtnsIndividual.forEach(btn => {
             btn.addEventListener('click', function(e) {
                 e.preventDefault();
                 signupPopupIndividual.style.display = 'block';
             });
         });

         signupBtnsLegal.forEach(btn => {
             btn.addEventListener('click', function(e) {
                 e.preventDefault();
                 signupPopupLegal.style.display = 'block';
             });
         });

         closeBtns.forEach(btn => {
             btn.addEventListener('click', function() {
                 signupPopupIndividual.style.display = 'none';
                 signupPopupLegal.style.display = 'none';
             });
         });

         window.addEventListener('click', function(event) {
             if (event.target == signupPopupIndividual) {
                 signupPopupIndividual.style.display = 'none';
             }
             if (event.target == signupPopupLegal) {
                 signupPopupLegal.style.display = 'none';
             }
         });

         // Initialize Typeahead for region selection
         const regionInput = document.getElementById('region-input');
         const selectedRegionsContainer = document.getElementById('selected-regions');
         const regionCodesInput = document.getElementById('region-codes');
         let regions = [];
         let selectedRegions = new Set();

         // Fetch all regions when the page loads
         fetch('/api/regions')
             .then(response => response.json())
             .then(data => {
                 regions = data;
                 initTypeahead();
             });

         function initTypeahead() {
             $(regionInput).typeahead({
                 source: regions,
                 display: 'name',
                 items: 'all',
                 afterSelect: function(item) {
                     addRegion(item);
                     this.$element[0].value = '';
                 }
             });
         }

         function addRegion(region) {
             if (!selectedRegions.has(region.code)) {
                 selectedRegions.add(region.code);
                 const badge = document.createElement('span');
                 badge.className = 'badge badge-primary mr-2 mb-2';
                 badge.style.color = 'black';
                 badge.textContent = `${region.name} (${region.code})`;
                 
                 const removeBtn = document.createElement('span');
                 removeBtn.className = 'ml-1 cursor-pointer';
                 removeBtn.innerHTML = '&times;';
                 removeBtn.onclick = () => removeRegion(region.code, badge);
                 
                 badge.appendChild(removeBtn);
                 selectedRegionsContainer.appendChild(badge);
                 updateRegionCodes();
             }
         }

         function removeRegion(code, element) {
             selectedRegions.delete(code);
             element.remove();
             updateRegionCodes();
         }

         function updateRegionCodes() {
             regionCodesInput.value = JSON.stringify(Array.from(selectedRegions));
         }

         // Handle form submission
         document.getElementById('signup-form-legal').addEventListener('submit', function(e) {
             e.preventDefault();
             const formData = new FormData(this);
             
             // Convert region_codes to JSON string
             const regionCodes = Array.from(selectedRegions);
             formData.set('region_codes', JSON.stringify(regionCodes));

             // Add password validation
             const password = formData.get('password');
             const passwordConfirmation = formData.get('password_confirmation');

             if (password !== passwordConfirmation) {
                 alert('Пароли не совпадают');
                 return;
             }

             if (password.length < 8) {
                 alert('Пароль должен содержать не менее 8 символов');
                 return;
             }

             fetch('/api/register-legal-entity', {
                 method: 'POST',
                 body: formData
             })
             .then(response => response.json())
             .then(data => {
                 if (data.success) {
                     alert('Регистрация успешна!');
                     document.getElementById('signup-popup-legal').style.display = 'none';
                 } else {
                     alert('Ошибка при регистрации: ' + data.message);
                 }
             })
             .catch(error => {
                 console.error('Error:', error);
                 alert('Произошла ошибка при отправке формы');
             });
         });

         const dropdowns = document.querySelectorAll('.dropdown');
         dropdowns.forEach(dropdown => {
             const menu = dropdown.querySelector('.dropdown-menu');
             dropdown.addEventListener('mouseenter', () => {
                 menu.style.display = 'block';
                 setTimeout(() => {
                     menu.style.opacity = '1';
                     menu.style.transform = 'translateY(0)';
                 }, 10);
             });
             dropdown.addEventListener('mouseleave', () => {
                 menu.style.opacity = '0';
                 menu.style.transform = 'translateY(-10px)';
                 setTimeout(() => {
                     menu.style.display = 'none';
                 }, 300);
             });
         });

         // Smooth scrolling for anchor links
         document.querySelectorAll('a[href^="#"]').forEach(anchor => {
             anchor.addEventListener('click', function (e) {
                 e.preventDefault();

                 const href = this.getAttribute('href');
                 if (href !== '#') {
                     const targetElement = document.querySelector(href);
                     if (targetElement) {
                         targetElement.scrollIntoView({
                             behavior: 'smooth'
                         });
                     }
                 }
             });
         });

         // Login popup functionality
         const loginPopup = document.getElementById('login-popup');
         const loginBtns = document.querySelectorAll('.login-btn');
         const loginCloseBtn = loginPopup.querySelector('.close');

         loginBtns.forEach(btn => {
             btn.addEventListener('click', function(e) {
                 e.preventDefault();
                 loginPopup.style.display = 'block';
             });
         });

         loginCloseBtn.addEventListener('click', function() {
             loginPopup.style.display = 'none';
         });

         window.addEventListener('click', function(event) {
             if (event.target == loginPopup) {
                 loginPopup.style.display = 'none';
             }
         });

         // Handle login form submission
         document.getElementById('login-form').addEventListener('submit', function(e) {
             e.preventDefault();
             const formData = new FormData(this);

             fetch('/login', {
                 method: 'POST',
                 body: formData
             })
             .then(response => response.json())
             .then(data => {
                 if (data.success) {
                     window.location.reload(); // Reload the page to reflect logged-in state
                 } else {
                     alert(data.message || 'Ошибка входа. Пожалуйста, проверьте ваши данные.');
                 }
             })
             .catch(error => {
                 console.error('Error:', error);
                 alert('Произошла ошибка при входе');
             });
         });

         // Logout functionality
         const logoutBtn = document.querySelector('.logout-btn');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Try to get the CSRF token
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
                
                // Prepare headers
                const headers = {
                    'Content-Type': 'application/json',
                };
                
                // Add CSRF token if available
                if (csrfToken) {
                    headers['X-CSRF-TOKEN'] = csrfToken;
                }

                fetch('/logout', {
                    method: 'POST',
                    headers: headers,
                })
                .then(response => {
                    if (response.ok) {
                        window.location.reload();
                    } else {
                        throw new Error('Logout failed');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Ошибка при выходе из системы');
                });
            });
        }

         $(document).ready(function() {
             const searchInput = $('#search-input');
             const autocompleteResults = $('#autocomplete-results');

             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });

             searchInput.on('input', function() {
                 const query = $(this).val();

                 if (query.length >= 2) {
                     $.ajax({
                         url: '/search-designs',
                         method: 'GET',
                         data: { query: query },
                         success: function(data) {
                             displayAutocompleteResults(data);
                         },
                         error: function(xhr, status, error) {
                             console.error('Error details:', xhr.responseText);
                             console.error('Status:', status);
                             console.error('Error:', error);
                         }
                     });
                 } else {
                     autocompleteResults.hide();
                 }
             });

             function displayAutocompleteResults(results) {
                 autocompleteResults.empty();

                 if (results.length > 0) {
                     results.forEach(function(design) {
                         const item = $('<div>')
                             .addClass('autocomplete-item')
                             .text(design.title)
                             .on('click', function() {
                                 window.location.href = '/project/' + design.id;
                             });
                         autocompleteResults.append(item);
                     });
                     autocompleteResults.show();
                 } else {
                     autocompleteResults.hide();
                 }
             }

             $(document).on('click', function(event) {
                 if (!$(event.target).closest('.searchBar').length) {
                     autocompleteResults.hide();
                 }
             });
         });

         const individualRegionSelect = document.getElementById('individual-region-select');
         
         // Fetch all regions when the page loads
         fetch('/api/regions')
             .then(response => response.json())
             .then(regions => {
                 regions.forEach(region => {
                     const option = new Option(`${region.name} (${region.code})`, region.code);
                     individualRegionSelect.add(option);
                 });
             });

         // Handle individual signup form submission
         document.getElementById('signup-form-individual').addEventListener('submit', function(e) {
             e.preventDefault();
             const formData = new FormData(this);
             
             fetch('/api/register-individual', {
                 method: 'POST',
                 body: formData,
                 headers: {
                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                 }
             })
             .then(response => response.json())
             .then(data => {
                 if (data.success) {
                     alert('Регистрация успешна!');
                     document.getElementById('signup-popup-individual').style.display = 'none';
                 } else {
                     alert('Ошибка при регистрации: ' + data.message);
                 }
             })
             .catch(error => {
                 console.error('Error:', error);
                 alert('Произошла ошибка при отправке формы');
             });
         });

         // Phone number formatting function
         function formatPhoneNumber(input) {
             const placeholder = '+7 (___) ___-__-__';
             
             input.placeholder = placeholder;

             input.addEventListener('focus', function() {
                 if (this.value === '') {
                     this.value = '+7 (';
                 }
             });

             input.addEventListener('input', function(e) {
                 let value = e.target.value.replace(/\D/g, '');
                 
                 if (value.length > 0 && value[0] !== '7') {
                     value = '7' + value;
                 }
                 
                 let formattedValue = '';
                 if (value.length > 0) {
                     formattedValue = '+7 ';
                     if (value.length > 1) {
                         formattedValue += '(' + value.substring(1, 4);
                     }
                     if (value.length > 4) {
                         formattedValue += ') ' + value.substring(4, 7);
                     }
                     if (value.length > 7) {
                         formattedValue += '-' + value.substring(7, 9);
                     }
                     if (value.length > 9) {
                         formattedValue += '-' + value.substring(9, 11);
                     }
                 }
                 
                 e.target.value = formattedValue;
             });

             input.addEventListener('blur', function(e) {
                 let value = e.target.value.replace(/\D/g, '');
                 if (value.length < 11) {
                     e.target.value = '';
                     e.target.placeholder = placeholder;
                 }
             });
         }

         // Apply formatting to both phone input fields
         const phoneInput = document.getElementById('phone');
         const additionalPhoneInput = document.getElementById('additional_phone');
         
         formatPhoneNumber(phoneInput);
         formatPhoneNumber(additionalPhoneInput);

         const companyNameInput = document.getElementById('company-name');
         const companySuggestions = document.getElementById('company-suggestions');
         const addressInput = document.getElementById('address');
         /*
         companyNameInput.addEventListener('input', function() {
             if (this.value.length >= 3) {
                 fetchCompanySuggestions(this.value);
             } else {
                 companySuggestions.innerHTML = '';
                 companySuggestions.style.display = 'none';
             }
         });
         */
         function fetchCompanySuggestions(query) {
             const apiUrl = `https://search-maps.yandex.ru/v1?apikey=c896bbf6-dbb9-49a4-bee9-42adf644e3fe&text=${encodeURIComponent(query)}&lang=ru_RU`;

             fetch(apiUrl)
                 .then(response => response.json())
                 .then(data => {
                     displayCompanySuggestions(data.features);
                 })
                 .catch(error => console.error('Error:', error));
         }

         function displayCompanySuggestions(suggestions) {
             companySuggestions.innerHTML = '';
             if (suggestions.length > 0) {
                 suggestions.forEach(suggestion => {
                     const item = document.createElement('div');
                     item.classList.add('suggestion-item');
                     
                     const nameElement = document.createElement('div');
                     nameElement.classList.add('suggestion-name');
                     nameElement.textContent = suggestion.properties.name;
                     item.appendChild(nameElement);

                     const addressElement = document.createElement('div');
                     addressElement.classList.add('suggestion-details');
                     addressElement.textContent = suggestion.properties.CompanyMetaData.address;
                     item.appendChild(addressElement);

                     if (suggestion.properties.CompanyMetaData.Phones && suggestion.properties.CompanyMetaData.Phones.length > 0) {
                         const phoneElement = document.createElement('div');
                         phoneElement.classList.add('suggestion-details');
                         phoneElement.textContent = suggestion.properties.CompanyMetaData.Phones[0].formatted;
                         item.appendChild(phoneElement);
                     }

                     item.addEventListener('click', function() {
                         selectCompany(suggestion);
                     });
                     companySuggestions.appendChild(item);
                 });
                 companySuggestions.style.display = 'block';
             } else {
                 companySuggestions.style.display = 'none';
             }
         }

         function selectCompany(company) {
             companyNameInput.value = company.properties.name;
             addressInput.value = company.properties.CompanyMetaData.address;
             if (company.properties.CompanyMetaData.Phones && company.properties.CompanyMetaData.Phones.length > 0) {
                 phoneInput.value = company.properties.CompanyMetaData.Phones[0].formatted;
             }
             companySuggestions.style.display = 'none';
         }

         // Close suggestions when clicking outside
         document.addEventListener('click', function(event) {
             if (!companyNameInput.contains(event.target) && !companySuggestions.contains(event.target)) {
                 companySuggestions.style.display = 'none';
             }
         });

        const innInput = document.getElementById('inn');
        const checkInnButton = document.getElementById('check-inn');
        const companyConfirmation = document.getElementById('company-confirmation');
        const foundCompanyName = document.getElementById('found-company-name');
        const confirmCompanyButton = document.getElementById('confirm-company');
        const rejectCompanyButton = document.getElementById('reject-company');
        const additionalFields = document.getElementById('additional-fields');
        const submitButton = document.querySelector('#signup-form-legal button[type="submit"]');

        let lastCheckedInn = '';
        let isCompanyActive = false;

        checkInnButton.addEventListener('click', function() {
            const inn = innInput.value.trim();
            if (inn) {
                checkCompany(inn);
            } else {
                alert('Пожалуйста, введите ИНН');
            }
        });

        confirmCompanyButton.addEventListener('click', function() {
            if (isCompanyActive) {
                companyConfirmation.style.display = 'none';
                additionalFields.style.display = 'block';
                submitButton.style.display = 'block';
                checkInnButton.style.display = 'none';
                lastCheckedInn = innInput.value.trim();
            } else {
                alert('Извините, регистрация доступна только для активных компаний.');
                resetForm();
            }
        });

        rejectCompanyButton.addEventListener('click', function() {
            resetForm();
        });

        innInput.addEventListener('input', function() {
            if (innInput.value.trim() !== lastCheckedInn) {
                resetForm();
            }
        });

        function resetForm() {
            companyConfirmation.style.display = 'none';
            additionalFields.style.display = 'none';
            submitButton.style.display = 'none';
            checkInnButton.style.display = 'block';
            lastCheckedInn = '';
            isCompanyActive = false;
            
            // Clear all form fields except INN
            const form = document.getElementById('signup-form-legal');
            const inputs = form.querySelectorAll('input:not(#inn)');
            inputs.forEach(input => input.value = '');
            selectedRegions.clear();
            selectedRegionsContainer.innerHTML = '';
            updateRegionCodes();
        }

        function checkCompany(inn) {
            console.log('Checking company with INN:', inn);
            fetch('/api/check-company', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ inn: inn })
            })
            .then(response => response.json())
            .then(data => {
                console.log('API response:', data);
                if (data.success) {
                    foundCompanyName.textContent = data.company_name;
                    companyConfirmation.style.display = 'block';
                    isCompanyActive = data.state_status === "ACTIVE";
                    if (!isCompanyActive) {
                        alert('Внимание: эта компания не активна. Регистрация невозможна.');
                    }
                    populateFields(data);
                } else {
                    alert('Компания не найдена. Пожалуйста, пр��ерьте ИНН и попробуйте снова.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Произошла ошибка при проверке ИНН');
            });
        }

        function populateFields(data) {
            document.getElementById('company_name').value = data.company_name;
            document.getElementById('kpp').value = data.kpp;
            document.getElementById('ogrn').value = data.ogrn;
            document.getElementById('legal_address').value = data.address;
            
            // Convert OGRN date to a readable format
            const ogrnDate = new Date(parseInt(data.ogrn_date));
            document.getElementById('company_age').value = ogrnDate.toLocaleDateString('ru-RU');
        }
     });
</script>