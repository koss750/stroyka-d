<header id="headerBar">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-4 col-sm-2">
                <div class="headerLogo"><a href="https://xn--80ardojfh.com">Стройка.com</a></div>
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
                        <li><a href="#" class="signup-btn">Физические лица</a></li>
                        <li><a href="#" class="signup-btn">Юридические лица</a></li>
                        <li class="dropdown">
                            <a href="/orders" class="dropdown-toggle">Личный Кабинет</a>
                            <div class="dropdown-menu">
                                <a href="/logout" class="dropdown-item">Выйти</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="hamburger-menu">
                    <i class="fas fa-bars"></i>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Signup Popup -->
<div id="signup-popup" class="popup">
    <div class="popup-content">
        <span class="close">&times;</span>
        <h2>Регистрация</h2>
        <form id="signup-form">
            <input type="text" placeholder="Имя" required>
            <input type="email" placeholder="Email" required>
            <input type="password" placeholder="Пароль" required>
            <button type="submit">Зарегистрироваться</button>
        </form>
    </div>
</div>

<script>
 

    // Add any other JavaScript related to the top menu here
</script>
<script>
      document.addEventListener('DOMContentLoaded', function() {
         const hamburger = document.querySelector('.hamburger-menu');
         const mobileMenu = document.createElement('div');
         mobileMenu.className = 'mobile-menu';
         mobileMenu.innerHTML = `
             <ul>
                 <li><a href="#" class="signup-btn">Физические лица</a></li>
                 <li><a href="#" class="signup-btn">Юридические лица</a></li>
                 <li><a href="/orders">Личный Кабинет</a></li>
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

         // Signup popup functionality
         const popup = document.getElementById('signup-popup');
         const signupBtns = document.querySelectorAll('.signup-btn');
         const closeBtn = document.querySelector('.close');

         signupBtns.forEach(btn => {
             btn.addEventListener('click', function(e) {
                 e.preventDefault();
                 popup.style.display = 'block';
             });
         });

         closeBtn.addEventListener('click', function() {
             popup.style.display = 'none';
         });

         window.addEventListener('click', function(event) {
             if (event.target == popup) {
                 popup.style.display = 'none';
             }
         });

         // Handle form submission
         document.getElementById('signup-form').addEventListener('submit', function(e) {
             e.preventDefault();
             // Add your signup logic here
             alert('Форма отправлена!');
             popup.style.display = 'none';
         });

         // Autocomplete search functionality
         const searchInput = document.getElementById('search-input');
         const autocompleteResults = document.getElementById('autocomplete-results');

         searchInput.addEventListener('input', function() {
             const searchQuery = this.value.trim();
             if (searchQuery.length >= 2) {
                 fetch('/search-designs', {
                     method: 'GET',
                     headers: {
                         'Content-Type': 'application/json'
                     },
                     body: JSON.stringify({ searchQuery: searchQuery }),
                 })
                 .then(response => response.json())
                 .then(data => {
                     const autocompleteItems = data.map(design => {
                         return `<div class="autocomplete-item"><a href="/projects/${design.id}">${design.title}</a></div>`;
                     }).join('');
                     autocompleteResults.innerHTML = autocompleteItems;
                     autocompleteResults.style.display = 'block';
                 })
                 .catch(error => {
                     console.error('Error:', error);
                 });
             } else {
                 autocompleteResults.style.display = 'none';
             }
         });

         document.addEventListener('click', function(event) {
             if (!searchInput.contains(event.target) && !autocompleteResults.contains(event.target)) {
                 autocompleteResults.style.display = 'none';
             }
         });

         // Smooth scrolling for anchor links
         document.querySelectorAll('a[href^="#"]').forEach(anchor => {
             anchor.addEventListener('click', function (e) {
                 e.preventDefault();

                 document.querySelector(this.getAttribute('href')).scrollIntoView({
                     behavior: 'smooth'
                 });
             });
         });
      });

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
    });
      </script>

<style>
    /* Add any styles specific to the top menu here */
    .mobile-top-bar {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background-color: #fff;
        padding: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        z-index: 1000;
        text-align: center;
    }

    @media (max-width: 1500px) {
        .mobile-top-bar {
            display: block;
        }
    }
    @media (max-width: 768px) {
    header {
        transition: display 0.3s ease;
    } 
}
    /* Add any other styles related to the top menu here */
    .dropdown {
        position: relative;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        z-index: 1000;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }

    .dropdown-item {
        display: block;
        padding: 10px 15px;
        color: #333;
        text-decoration: none;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
    }
</style>