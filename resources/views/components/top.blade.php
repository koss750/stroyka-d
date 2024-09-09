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
            <div class="col-8 col-sm-10">
                <div class="row align-items-center">
                    <div class="col-12 col-sm-5 search-container">
                        <div class="searchBar">
                            <input type="text" id="search-input" placeholder="Поиск по сайту..." autocomplete="off">
                            <div id="autocomplete-results" class="autocomplete-results"></div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-7">
                        <div class="headerMenu">
                            <ul class="nav">
                                @guest
                                    <li><a href="#" class="signup-btn-individual">Физические лица</a></li>
                                    <li><a href="#" class="signup-btn-legal">Юридические лица</a></li>
                                    <li><a href="#" class="login-btn">Войти</a></li>
                                @endguest
                                @auth
                                    <li class="dropdown">
                                        <a href="/my-account" class="dropdown-toggle">Личный Кабинет</a>
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
                <input type="email" class="form-control no-text-transform" id="login-email" name="email" required>
            </div>
            <div class="form-group">
                <label for="login-password">Пароль</label>
                <input type="password" class="form-control" id="login-password" name="password" required>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input custom-checkbox" id="remember-me" name="remember">
                <label class="form-check-label" for="remember-me">Запомнить меня</label>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Войти</button>
        </form>
    </div>
</div>

<!-- Signup Popup for Individual Users -->
<div id="signup-popup-individual" class="popup">
    <div class="popup-content">
        <span class="close">&times;</span>
        <h2 class="mb-4">Регистрация физического лица</h2>
        <form id="signup-form-individual">
            <div class="form-group">
                <label for="individual-name">Имя</label>
                <input type="text" class="form-control" id="individual-name" name="name" required>
            </div>
            <div class="form-group">
                <label for="individual-email">E-mail</label>
                <input type="email" class="form-control no-text-transform" id="individual-email" name="email" required>
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
                    <input type="text" class="form-control no-text-transform" id="physical_address" name="physical_address" required>
                </div>
                <div class="form-group">
                    <label for="email">Адрес эл. Почты</label>
                    <input type="email" class="form-control no-text-transform" id="email" name="email" required>
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
                <label for="legal-password">Пароль</label>
                <input type="password" class="form-control" id="legal-password" name="password" required>
            </div>
            <div class="form-group">
                <label for="legal-password-confirmation">Подтвердите пароль</label>
                <input type="password" class="form-control" id="legal-password-confirmation" name="password_confirmation" required>
            </div>
                <div class="form-group">
                    <label for="region-input">Поиск регионов</label>
                    <input type="text" class="form-control" id="region-input" placeholder="Введите регионы предоставления ваших услуг">
                    <div id="region-suggestions" class="region-suggestions"></div>
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

        $('#acceptDisclaimer').on('click', function() {
            $('#disclaimerModal').modal('hide');
            loadExecutors(projectId);
            loadRegions();
        });
    });

    // Ensure the close button works
    $('.modal .close, .modal .btn-secondary').on('click', function() {
        $(this).closest('.modal').modal('hide');
    });

    let currentProjectId;
    let selectedExecutorId;

    

    function loadRegions() {
        $.ajax({
            url: '/api/regions',
            method: 'GET',
            success: function(regions) {
                const regionSelect = $('#region-select');
                regionSelect.empty();
                regions.forEach(function(region) {
                    regionSelect.append($('<option>', {
                        value: region.id,
                        text: region.name
                    }));
                });
                // Set default region (user's region) if authenticated
                @auth
                    regionSelect.val('{{ auth()->user()->region_id }}');
                @endauth
                $('#executorModal').modal('show');
            },
            error: function() {
                alert('Ошибка при загрузке регионов');
            }
        });
    }

    $('#confirm-region').on('click', function() {
        loadExecutors(currentProjectId);
    });

    function loadExecutors(projectId) {
        $.ajax({
            url: '/api/projects/' + projectId + '/available-executors',
            method: 'GET',
            success: function(response) {
                if (Array.isArray(response) && response.length > 0) {
                    var executorHtml = '';
                    response.forEach(function(executor) {
                        executorHtml += `
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="card contact-bx">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="image-bx me-3">
                                                <img src="${executor.profile_picture_url || '{{ asset('images/users/default.jpg') }}'}" alt="${executor.company_name}" class="rounded-circle" width="90">
                                                <span class="active"></span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="fs-18 font-w600 mb-0">${executor.company_name}</h6>
                                                <p class="fs-14">${executor.type_of_organisation || 'N/A'}</p>
                                                <div class="mt-2">
                                                    <button class="btn btn-sm btn-primary select-executor" data-executor-id="${executor.id}" data-project-id="${projectId}">Запросить</button>
                                                    <a href="/app-profile/${executor.id}" class="btn btn-sm btn-outline-primary" target="_blank">Профиль</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    $('#executorList').html(executorHtml);
                } else {
                    $('#executorList').html('<p>Нет доступных исполнителей в выбранном регионе</p>');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX error:', textStatus, errorThrown);
                alert('Ошибка при загрузке списка исполнителей: ' + textStatus);
            }
        });
    }

    $(document).on('click', '.select-executor', function() {
        selectedExecutorId = $(this).data('executor-id');
        const executorName = $(this).closest('.card').find('.font-w600').text();
        const executorImg = $(this).closest('.card').find('img').attr('src');

        $('#executorList').hide();
        $('#selected-executor').show();
        $('#selected-executor-img').attr('src', executorImg);
        $('#selected-executor-name').text(executorName);
    });

    $('#send-message').on('click', function() {
        const message = $('#message-to-executor').val();
        if (!message) {
            alert('Пожалуйста, введите сообщение для исполнителя');
            return;
        }

        $.ajax({
            url: '/api/projects/' + currentProjectId + '/contact-executor',
            method: 'POST',
            data: {
                executor_id: selectedExecutorId,
                message: message
            },
            success: function(response) {
                $('#executorModal').modal('hide');
                alert('Сообщение отправлено исполнителю');
                updateProjectExecutor(currentProjectId, selectedExecutorId, response.executor_company_name);
            },
            error: function() {
                alert('Ошибка при отправке сообщения исполнителю');
            }
        });
    });

    function updateProjectExecutor(projectId, executorId, executorCompanyName) {
        const assignButton = $(`.assign-executor[data-project-id="${projectId}"]`);
        assignButton.replaceWith(`<span class="selected-executor">${executorCompanyName}</span>`);
    }
        
         const hamburger = document.querySelector('.hamburger-menu');
         const mobileMenu = document.createElement('div');
         mobileMenu.className = 'mobile-menu';
         mobileMenu.innerHTML = `
             <ul>
                 @guest
                    <li><a href="#" class="signup-btn-individual">Физические лица</a></li>
                    <li><a href="#" class="signup-btn-legal">Юридические лица</a></li>
                    <li><a href="#" class="login-btn">Войти</a></li>
                @endguest
                @auth
                    <li><a href="/orders">Личный Кабинет</a></li>
                    <a href="#" class="dropdown-item logout-btn">Выйти</a>
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

         // Region selection functionality
         const regionInput = document.getElementById('region-input');
         const regionSuggestions = document.getElementById('region-suggestions');
         const selectedRegionsContainer = document.getElementById('selected-regions');
         const regionCodesInput = document.getElementById('region-codes');
         let regions = [];
         let selectedRegions = new Set();

         // Fetch all regions when the page loads
         fetch('/api/regions')
             .then(response => response.json())
             .then(data => {
                 regions = data;
                 displayAllRegions();
             })
             .catch(error => console.error('Error fetching regions:', error));

         regionInput.addEventListener('input', function() {
             const query = this.value.toLowerCase();
             const filteredRegions = regions.filter(region => 
                 region.name.toLowerCase().includes(query) ||
                 region.code.toLowerCase().includes(query)
             );
             displayAllRegions(filteredRegions);
         });

         function displayAllRegions(regionsToDisplay = regions) {
             regionSuggestions.innerHTML = '';
             regionsToDisplay.forEach(region => {
                 const div = document.createElement('div');
                 div.className = 'region-option';
                 
                 const checkbox = document.createElement('input');
                 checkbox.type = 'checkbox';
                 checkbox.id = `region-${region.code}`;
                 checkbox.checked = selectedRegions.has(region.code);
                 checkbox.addEventListener('change', () => toggleRegion(region));

                 const label = document.createElement('label');
                 label.htmlFor = `region-${region.code}`;
                 label.textContent = `${region.name} (${region.code})`;

                 div.appendChild(checkbox);
                 div.appendChild(label);
                 regionSuggestions.appendChild(div);
             });
         }

         function toggleRegion(region) {
             if (selectedRegions.has(region.code)) {
                 selectedRegions.delete(region.code);
             } else {
                 selectedRegions.add(region.code);
             }
             updateSelectedRegionsDisplay();
             updateRegionCodes();
         }

         function updateSelectedRegionsDisplay() {
             selectedRegionsContainer.innerHTML = '';
             selectedRegions.forEach(code => {
                 const region = regions.find(r => r.code === code);
                 if (region) {
                     const badge = document.createElement('span');
                     badge.className = 'badge badge-primary mr-2 mb-2';
                     badge.style.color = 'black';
                     badge.textContent = `${region.name} (${region.code})`;
                     
                     const removeBtn = document.createElement('span');
                     removeBtn.className = 'ml-1 cursor-pointer';
                     removeBtn.innerHTML = '&times;';
                     removeBtn.onclick = () => {
                         selectedRegions.delete(code);
                         updateSelectedRegionsDisplay();
                         updateRegionCodes();
                         displayAllRegions();
                     };
                     
                     badge.appendChild(removeBtn);
                     selectedRegionsContainer.appendChild(badge);
                 }
             });
         }

         function updateRegionCodes() {
             regionCodesInput.value = JSON.stringify(Array.from(selectedRegions));
         }

        document.addEventListener('DOMContentLoaded', function() {
            const individualForm = document.getElementById('signup-form-individual');
            const legalForm = document.getElementById('signup-form-legal');

            if (individualForm) {
                individualForm.addEventListener('submit', handleSubmit);
            }

            if (legalForm) {
                legalForm.addEventListener('submit', handleLegalSubmit);
            }

            function handleSubmit(e) {
                e.preventDefault();
                
                // Disable the submit button to prevent double submission
                const submitButton = this.querySelector('button[type="submit"]');
                if (submitButton) {
                    submitButton.disabled = true;
                }

                const formData = new FormData(this);
                const url = this.id === 'signup-form-individual' ? '/api/register' : '/api/register-legal-entity';
                
                fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        this.reset(); // Reset the form
                        this.closest('.popup').style.display = 'none'; // Close the popup
                    } else {
                        alert('Ошибка при регистрации: ' + (data.message || 'Неизвестная ошибка'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Произошла ошибка при отправке формы');
                })
                .finally(() => {
                    // Re-enable the submit button
                    if (submitButton) {
                        submitButton.disabled = false;
                    }
                });
            }

            function handleLegalSubmit(e) {
                e.preventDefault();
                console.log('Form submitted');
                
                const formData = new FormData(this);
                console.log('FormData created', Object.fromEntries(formData));
                
                fetch('/api/register-legal-entity', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => {
                    console.log('Response received', response);
                    return response.json();
                })
                .then(data => {
                    console.log('Data received', data);
                    if (data.success) {
                        alert(data.message);
                        this.reset(); // Reset the form
                        selectedRegions.clear(); // Clear selected regions
                        updateSelectedRegionsDisplay(); // Update the display
                        this.closest('.popup').style.display = 'none'; // Close the popup
                    } else {
                        alert('Ошибка при регистрации: ' + (data.message || 'Неизвестная ошибка'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Произошла ошибка при отправке формы');
                });
            }
        });
    });
</script>

<style>
    @media (max-width: 575px) {
        .headerLogo {
            text-align: left;
        }
        .search-container {
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .headerMenu {
            text-align: right;
        }
        .headerMenu .nav {
            justify-content: flex-end;
        }
        .headerMenu .nav li {
            margin-left: 10px;
        }
    }

    @media (min-width: 501px) {
        .hamburger-menu {
            display: none;
        }
    }

    .region-suggestions {
        border: 1px solid #ddd;
        max-height: 200px;
        overflow-y: auto;
        background-color: white;
        width: 100%;
    }

    .region-option {
        padding: 5px 10px;
        cursor: pointer;
    }

    .region-option:hover {
        background-color: #f0f0f0;
    }

    .region-option input[type="checkbox"] {
        margin-right: 10px;
    }
</style>
<script>
        
        let selectedRegions = new Set();

         
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
                     alert(data.message);
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
                window.location.reload();
             });
         });

         // Logout functionality

         $(document).ready(function() {

            const logoutBtn = document.querySelector('.logout-btn');
            if (logoutBtn) {
                logoutBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    fetch('/logout', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        credentials: 'same-origin'
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
                     alert(data.message);
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
         /*
         document.addEventListener('click', function(event) {
             if (!companyNameInput.contains(event.target) && !companySuggestions.contains(event.target)) {
                 companySuggestions.style.display = 'none';
             }
         });
         */

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
                    alert('Компания не найдена. Пожалуйста, проверьте ИНН и опробуйте снова.');
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
</script>