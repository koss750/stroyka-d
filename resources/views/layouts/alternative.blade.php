<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Стройка.com')</title>
    <meta name="description" content="@yield('description', '')" />
    <link rel="canonical" href="@yield('canonical', '')" />
    <link rel="icon" type="image/x-icon" href="https://xn--80ardojfh.com/assets/images/fav.ico">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link rel="font" href="https://xn--80ardojfh.com/assets/fonts/font.ttf"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="https://xn--80ardojfh.com/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://xn--80ardojfh.com/assets/css/style.css">
    @yield('additional_head')
</head>
<body>
    <header id="headerBar">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="headerLogo"><a href="/">Стройка.com</a></div>
                </div>
                <div class="col-sm-3">
                    <div class="searchBar"><input type="text" placeholder="Поиск по сайту..."></div>
                </div>
                <div class="col-sm-7">
                    <x-menu />
                </div>
            </div>
        </div>
    </header>

    <section id="afterHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="mainHeading">
                        <h1>@yield('main_heading', 'Профессиональное строительство')</h1>
                        <p>@yield('sub_heading', 'Проекты строительства домов и бань для проживания')</p>
                    </div>
                </div>
            </div>
            @yield('content')
        </div>
    </section>

    <x-podval />

    <script src="https://xn--80ardojfh.com/assets/js/jquery.min.js"></script>
    <script src="https://xn--80ardojfh.com/assets/js/bootstrap.min.js"></script>
    @yield('additional_scripts')

    <script>
        window.onscroll = function () {
            var header = document.querySelector("header");
            if (window.pageYOffset > 0) {
                header.classList.add("sticky");
            } else {
                header.classList.remove("sticky");
            }
        };
    </script>
</body>
</html>