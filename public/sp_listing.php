<?php

$queryParams = [];

foreach ($_GET as $key => $value) {
    if (!empty($value)) {
        // Add the parameter to the query parameters array
        $queryParams[$key] = $value;
    }
}

// Prepare the API endpoint
$apiUrl = 'http://dev.borodin.services/api/designs/list';

// Check if there are any query parameters to send
if (!empty($queryParams)) {
    // Build the query string from the parameters array
    $queryString = http_build_query($queryParams);
    $url = $apiUrl . '?' . $queryString;
} else $url = $apiUrl;
$response = file_get_contents($url);
$designs = json_decode($response, true);



?>

<html>
 <link href="http://dev.borodin.uk/stroyka.html" id="dark-mode" rel="stylesheet" type="text/css"/>
 <head>
  <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
  <link href="styles.css" rel="stylesheet" type="text/css"/>
  <link href="./index_files/home1" id="dark-mode" rel="stylesheet" type="text/css"/>
  <meta content="no-cache" name="turbolinks-cache-control"/>
  <script async="" src="./index_files/tag" type="text/javascript">
  </script>
  <script defer="" src="./index_files/s1.js">
  </script>
  <script async="" src="./index_files/insight.min.js" type="text/javascript">
  </script>
  <script id="google_shimpl" src="./index_files/f.txt">
  </script>
  <script async="" src="./index_files/js" type="text/javascript">
  </script>
  <script async="" src="./index_files/config.js" type="text/javascript">
  </script>
  <script async="" src="./index_files/f(1).txt" type="text/javascript">
  </script>
  <script async="" src="./index_files/prebid-b78534b818cc797f93e478b0f5a8e9c2.js" type="text/javascript">
  </script>
  <script async="" type="text/javascript">
  </script>
  <script async="" src="./index_files/events.js" type="text/javascript">
  </script>
  <script async="" src="./index_files/fbevents.js">
  </script>
  <script async="" src="./index_files/core.js">
  </script>
  <script async="" src="./index_files/gtm.js">
  </script>
  <script async="" src="./index_files/main.15c91276.js">
  </script>
  <script async="" src="./index_files/insight.old.min.js">
  </script>
  <script defer="" src="./index_files/s1(1).js">
  </script>
  <script async="" src="./index_files/insight.min(1).js" type="text/javascript">
  </script>
  <script async="" src="./index_files/events(1).js" type="text/javascript">
  </script>
  <script async="" src="./index_files/fbevents(1).js">
  </script>
  <script async="" src="./index_files/core(1).js">
  </script>
  <script async="" src="./index_files/gtm(1).js">
  </script>
  <!-- Open Graph data -->
  <meta content="borodin.servicess - Selling quality house plans for generations" property="og:title"/>
  <meta content="borodin.servicess" property="og:site_name"/>
  <meta content="https://www.architecturaldesigns.com/" property="og:url"/>
  <meta content="Search our collection of 30k+ house plans by over 200 designers and architects to find the perfect home plan to build. All house plans can be modified." property="og:description"/>
  <meta content="website" property="og:type"/>
  <meta content="https://www.architecturaldesigns.com/assets/logo-0baf58dffe24002fac28656c197c0a8e85c6725a2e01f4b4fae66e7a061726d8.png" property="og:image"/>
  <meta content="1670722289810910" property="fb:app_id"/>
  <meta content="width=device-width, initial-scale=10, maximum-scale=1.0" name="viewport"/>
  <link data-turbolinks-track="reload" href="./index_files/plans_home-0967b0c93f9cf98b501f6f1acc579e5d75f24d8e121b2963f2ed3b56dbd882b4.css" media="all" rel="stylesheet"/>
  <script data-turbolinks-track="reload" src="./index_files/plans_home-d82ed62e1ba7dfbf0212047bf439e7e50e604107e35008d81c1fa44a02e78558.js">
  </script>
  <!-- Optimize plugin -->
  <script async="" src="./index_files/optimize.js">
  </script>
  
  <meta content="authenticity_token" name="csrf-param"/>
  <meta content="Ox_6nPB1xCHxxXN18jYjoPTBguTWIvm_Bu70I7RRVTDluqkVSO8tSlO-3IU3brf3lRbaXuPrM-uDVzWGZ9nTgg" name="csrf-token"/>
  <link href="./index_files/css" rel="stylesheet"/>
  <script src="./index_files/bb7ykz9swZqd.js" type="text/javascript">
  </script>
  <script type="text/javascript">
   function openshopperapproved(o){ var e="Microsoft Internet Explorer"!=navigator.appName?"yes":"no",n=screen.availHeight-90,r=940;return window.innerWidth<1400&&(r=620),window.open(this.href,"shopperapproved","location="+e+",scrollbars=yes,width="+r+",height="+n+",menubar=no,toolbar=no"),o.stopPropagation&&o.stopPropagation(),!1}!function(){for(var o=document.getElementsByClassName("shopperlink"),e=0,n=o.length;e<n;e++)o[e].onclick=openshopperapproved}();
  </script>
  <link href="./index_files/1198.css" rel="stylesheet" type="text/css"/>
  <meta content="As0hBNJ8h++fNYlkq8cTye2qDLyom8NddByiVytXGGD0YVE+2CEuTCpqXMDxdhOMILKoaiaYifwEvCRlJ/9GcQ8AAAB8eyJvcmlnaW4iOiJodHRwczovL2RvdWJsZWNsaWNrLm5ldDo0NDMiLCJmZWF0dXJlIjoiV2ViVmlld1hSZXF1ZXN0ZWRXaXRoRGVwcmVjYXRpb24iLCJleHBpcnkiOjE3MTk1MzI3OTksImlzU3ViZG9tYWluIjp0cnVlfQ==" http-equiv="origin-trial"/>
  <meta content="AgRYsXo24ypxC89CJanC+JgEmraCCBebKl8ZmG7Tj5oJNx0cmH0NtNRZs3NB5ubhpbX/bIt7l2zJOSyO64NGmwMAAACCeyJvcmlnaW4iOiJodHRwczovL2dvb2dsZXN5bmRpY2F0aW9uLmNvbTo0NDMiLCJmZWF0dXJlIjoiV2ViVmlld1hSZXF1ZXN0ZWRXaXRoRGVwcmVjYXRpb24iLCJleHBpcnkiOjE3MTk1MzI3OTksImlzU3ViZG9tYWluIjp0cnVlfQ==" http-equiv="origin-trial"/>
  <script src="./index_files/bb7ykz9swZqd(1).js" type="text/javascript">
  </script>
  <script type="text/javascript">
   function openshopperapproved(o){ var e="Microsoft Internet Explorer"!=navigator.appName?"yes":"no",n=screen.availHeight-90,r=940;return window.innerWidth<1400&&(r=620),window.open(this.href,"shopperapproved","location="+e+",scrollbars=yes,width="+r+",height="+n+",menubar=no,toolbar=no"),o.stopPropagation&&o.stopPropagation(),!1}!function(){for(var o=document.getElementsByClassName("shopperlink"),e=0,n=o.length;e<n;e++)o[e].onclick=openshopperapproved}();
  </script>
  <link href="./index_files/1198(1).css" rel="stylesheet" type="text/css"/>
  <meta content="AymqwRC7u88Y4JPvfIF2F37QKylC04248hLCdJAsh8xgOfe/dVJPV3XS3wLFca1ZMVOtnBfVjaCMTVudWM//5g4AAAB7eyJvcmlnaW4iOiJodHRwczovL3d3dy5nb29nbGV0YWdtYW5hZ2VyLmNvbTo0NDMiLCJmZWF0dXJlIjoiUHJpdmFjeVNhbmRib3hBZHNBUElzIiwiZXhwaXJ5IjoxNjk1MTY3OTk5LCJpc1RoaXJkUGFydHkiOnRydWV9" http-equiv="origin-trial"/>
  <script async="" src="./index_files/f(3).txt" type="text/javascript">
  </script>
  <meta content="AymqwRC7u88Y4JPvfIF2F37QKylC04248hLCdJAsh8xgOfe/dVJPV3XS3wLFca1ZMVOtnBfVjaCMTVudWM//5g4AAAB7eyJvcmlnaW4iOiJodHRwczovL3d3dy5nb29nbGV0YWdtYW5hZ2VyLmNvbTo0NDMiLCJmZWF0dXJlIjoiUHJpdmFjeVNhbmRib3hBZHNBUElzIiwiZXhwaXJ5IjoxNjk1MTY3OTk5LCJpc1RoaXJkUGFydHkiOnRydWV9" http-equiv="origin-trial"/>
 </head>
 <body class="" data-action="home1" data-ad-environment="production" data-controller="plans" data-gr-ext-installed="" data-new-gr-c-s-check-loaded="14.1133.0"/>
  <!-- Google Tag Manager (noscript) -->
  <!-- End Google Tag Manager (noscript) -->
  <div class="env-name-production">
  </div>
  <p class="notice">
  </p>
  <p class="alert">
  </p>
  <header>
   <div class="megamenu" style="display: none;">
    <div class="menu-container">
     <div class="width-100p clearfix">
      <div class="container styles-menu-items">
       <h3>
        Top Styles
       </h3>
       <div class="row">
        <div class="col-sm-3 col-xs-6">
         <p>
          <a href="https://www.architecturaldesigns.com/house-plans/styles/country">
           Country
          </a>
         </p>
        
        </div>
       </div>
       
      </div>
      <div class="container collections-menu-items">
       <h3>
        Top Collections
       </h3>
       <div class="row">
        <div class="col-sm-3 col-xs-6">
         <p>
          <a href="https://www.architecturaldesigns.com/house-plans/collections/exclusive">
           Exclusive
          </a>
         </p>
        </div>
       </div>
       
      </div>
     </div>
    </div>
   </div>
   <div class="home-flash">
   </div>
   <div class="" id="header">
    <div class="header-top">
     <div class="container">
      <div class="row">
       <div class="col-sm-12 clearfix">
        <div class="navbar-header">
         <button aria-controls="navbar" aria-expanded="false" class="navbar-toggle collapsed" data-target="#navbar" data-toggle="collapse" type="button">
          <span class="sr-only">
           Toggle navigation
          </span>
          <span class="icon-bar">
          </span>
          <span class="icon-bar">
          </span>
          <span class="icon-bar">
          </span>
         </button>
         <a class="navbar-brand hide-print" data-turbolinks="false" href="https://www.architecturaldesigns.com/">
          <img alt="borodin.servicess" class="img-responsive hidden-xs hidden-sm" src="./index_files/logo.png" title="borodin.servicess"/>
          <img alt="borodin.servicess" class="img-responsive visible-xs visible-sm" src="./index_files/logo.png" title="borodin.servicess"/>
         </a>
        </div>
        <div class="nav-mobile hidden visible-xs hide-print">
         <div class="search-wrapper">
          <a class="btn btn-search" href="https://www.architecturaldesigns.com/house-plans/search">
           <span class="search-icon icon-inline-align">
           </span>
           Search
          </a>
          <form accept-charset="UTF-8" action="https://www.architecturaldesigns.com/house-plans/plan_number_search" class="form-inline" method="get">
           <div class="input-group search-addon sm-srch-pln-mg">
            <input class="form-control dark-input-text width-154 exampleInputsearch" id="exampleInputsearch" name="num" placeholder="By Plan Number" type="text"/>
            <button class="input-group-addon search-addon">
             <span>
              GO
             </span>
            </button>
           </div>
          </form>
         </div>
        </div>
      
       </div>
      </div>
     </div>
    </div>
    <div class="header-filter hidden-xs">
     <div class="container">
      <div class="row slim-head">
       <div class="col-lg-12 col-md-12">
        <ul class="slim-menu clearfix">
         <li>
          <a class="btn btn-search" href="http://dev.borodin.uk/stroyka.html#">
           <span class="search-icon icon-inline-align">
           </span>
           Поиск
          </a>
         </li>
         <li>
          <a class="styles-menu-link" href="javascript:void(0);">
           Стили
          </a>
         </li>
         <li>
          <a class="collections-menu-link" href="javascript:void(0);">
           Коллекции
          </a>
         </li>
         <li>
          <a>
           Стоимость строительства
          </a>
         </li>
        </ul>
       </div>
      </div>
     </div>
    </div>
    <div class="header-filter stick-it">
     <div class="container">
      <div class="row slim-head">
       <div class="col-lg-12 col-md-12 menu-line">
        <ul class="slim-menu clearfix">
         <li>
          <a class="btn btn-search" href="http://dev.borodin.uk/stroyka.html#">
           <span class="search-icon icon-inline-align">
           </span>
           Поиск
          </a>
         </li>
         <li class="hidden-xs">
          <a class="styles-menu-link" href="javascript:void(0);">
           Стили
          </a>
         </li>
         <li class="hidden-xs">
          <a class="collections-menu-link" href="javascript:void(0);">
           Коллекции
          </a>
         </li>
         <li class="hidden-xs">
          <a>
           Стоимость строительства
          </a>
         </li>
        </ul>
        <div class="contact-hamburger">
         <div class="contact-number">
          Нужна помощь?
         </div>
         <button aria-controls="navbar" aria-expanded="false" class="navbar-toggle collapsed" data-target="#navbar" data-toggle="collapse" type="button">
          <span class="icon-bar">
          </span>
          <span class="icon-bar">
          </span>
          <span class="icon-bar">
          </span>
         </button>
        </div>
       </div>
      </div>
     </div>
    </div>

   </div>
   <div class="mob-megamenu" style="display: none;">
    <div class="menu-container">
     <div class="width-100p clearfix">
      <div class="action-items">
       <a href="javascript:void(0);" id="backBtn">
        <span class="back-btn">
         Back
        </span>
       </a>
       <a href="javascript:void(0);" id="cancelBtn">
        <span class="cancel-btn">
        </span>
       </a>
      </div>
      <div class="container styles-menu-items">
       <h3>
        Section 4
       </h3>
       <div class="row">
        <div class="col-xs-12">
         <p>
          <a href="https://www.architecturaldesigns.com/house-plans/styles/farmhouse">
           Farmhouse
          </a>
         </p>
        </div>
       </div>
       <div class="row margin-top-10">
        <div class="col-sm-12">
         <a class="view-all" href="https://www.architecturaldesigns.com/house-plans/styles">
          <h4>
           View All Styles
          </h4>
          <span>
          </span>
         </a>
        </div>
       </div>
      </div>
      <div class="container collections-menu-items">
       <h3>
        Top Collections
       </h3>
       <div class="row">
        <div class="col-xs-12">
         <p>
          <a href="https://www.architecturaldesigns.com/house-plans/collections/exclusive">
           collection
          </a>
         </p>
        </div>
       </div>
       <div class="row margin-top-10">
        <div class="col-sm-12">
         <a class="view-all" href="https://www.architecturaldesigns.com/house-plans/collections">
          <h4>
           View All Collections
          </h4>
          <span>
          </span>
         </a>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </header>
  <div class="plans_home plans_home1">
   <!-- / welcome messgae -->
   <div class="welcome-alert-box">
   </div>
   <!-- / slider -->
   <div id="banner">
   </div>
   <div class="home-page-slider">
    <div class="home-hero-image-container">
     <div class="visible-lg" style="background-image: url('https://assets.architecturaldesigns.com/home_desktop/1/original/Desktop_270038AF.jpg')">
     </div>
     <div class="visible-md" style="background-image: url('https://assets.architecturaldesigns.com/home_tablet_landscape/1/original/Tablet_Landscape_270038AF.jpg')">
     </div>
     <div class="visible-sm" style="background-image: url('https://assets.architecturaldesigns.com/home_tablet_potrait/1/original/Tablet_Portrait_270038AF.jpg')">
     </div>
     <div class="visible-xs" style="background-image: url('https://assets.architecturaldesigns.com/home_mobile/1/original/Mobile.jpg')">
     </div>
    </div>
    <div class="hero-image-headline">
     Тут можно купить больше чем дом..
    </div>
    <div class="basic-search home-new">
     <form accept-charset="UTF-8" action="/" method="get">
      <div class="container">
       <div id="plan_home_filter">
        <div class="filters">
          <!-- Design Category Dropdown -->
<select name="category">
    <option value="">Выберите категорию дизайна</option>
    <option value="df_cat_1">Дома из профилированного бруса</option>
    <option value="df_cat_2">Бани из клееного бруса</option>
    <option value="df_cat_3">Дома из блоков</option>
    <option value="df_cat_4">Дома из оцилиндрованного бревна</option>
    <option value="df_cat_5">Бани из бруса камерной сушки</option>
    <!-- Continue for other categories -->
    <option value="df_cat_22">Дома из бруса лиственницы</option>
</select>

<!-- Floors Dropdown -->
<select name="baseType">
    <option value="">Выберите количество этажей</option>
    <option value="1 этаж">1 этаж</option>
    <option value="2 этажа">2 этажа</option>
    <option value="2 этажа (мансарда)">2 этажа (мансарда)</option>
    <option value="2 этажа + мансарда">2 этажа + мансарда</option>
    <option value="3 этажа">3 этажа</option>
</select>
          <label for="area_min">
            Мин.площадь
           </label>
           <div id="area_min">
            <input min="0" name="size_from" placeholder="от" type="number">
           </div>
           <button class="btn btn-search" type="submit">
          <span class="search-icon icon-inline-align">
          </span>
          Найти
         </button>
        </div>
        
       </div>
      </div>
     </form>
    </div>
   </div>
   <!-- / features -->
   
    
     <div class="row">
      <div class="col-md-12 view-all-head">
       <div class="head-title">
        <!-- / features -->
       </div>
      </div>
     </div>
     <div class="row">
      
          <?php

echo "<hr>";
foreach ($designs as $design) {
    echo "<div class='plan-card col-md-6 col-lg-4'>
            <div class='sbst-listing-box has-video'>
                <a href='{$design['link']}'>
                    <div class='image-box async-bg-image' style='height: 182px; background-image: url(&quot;" . $design['image_url'] . "&quot;);'></div>
                </a>
                <div class='plan-sub-header'>
                    <a class='plan-caption' href='{$design['link']}'>{$design['main_category']} {$design['size']} кв.м</a>
                </div>
                <a href='{$design['link']}'>
                    <ul class='info'>
                        <li><span class='h3 ft-supm-bg'>{$design['title']}</span></li>
                        <li><span class='h3 ft-supm-bg'>{$design['rooms']} Комнат</span></li>
                        <li><span class='h3 ft-supm-bg'>от ".number_format($design['price']/1000000, 2, '.', '')."М руб.</span></li>
                    </ul>
                </a>
            </div>
        </div>";
}


?>
      </div>
     </div>
    </div>
   <!-- FOOTER -->
  <footer id="footer">
   <!-- Same footer used for customer facing site and designer portal layout -->
   <div class="top-footer">
    <div class="container">
     <div class="link-newsletter">
      <div class="all-links">
       <section>
        <h5>
         НАЙТИ ВАШ ПЛАН
        </h5>
        <div class="links">
         <div class="link-box">
          <a href="http://dev.borodin.uk/stroyka.html#">
           Планы Домов
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Горячие Планы!
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Новые
          </a>
         </div>
         <div class="link-box">
          <a href="http://dev.borodin.uk/stroyka.html#">
           Стили
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Коллекции
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Проекты Клиентов
          </a>
         </div>
         <div class="link-box">
          <a href="http://dev.borodin.uk/stroyka.html#">
           Недавно Проданные
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Самые Популярные
          </a>
         </div>
        </div>
       </section>
       <section>
        <h5>
         УСЛУГИ
        </h5>
        <div class="links">
         <div class="link-box">
          <a href="http://dev.borodin.uk/stroyka.html#">
           Что Включено
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Отчет о Стоимости Строительства
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Модификации
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Индивидуальные Проекты
          </a>
         </div>
         <div class="link-box">
          <a href="http://dev.borodin.uk/stroyka.html#">
           Для Строителей
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Для Агентов по Недвижимости
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Для Дизайнеров
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Стать Партнером
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Запрос на Удаление Фото
          </a>
         </div>
         <div class="link-box">
          <a href="http://dev.borodin.uk/stroyka.html#">
           Изменения в Существующих Заказах
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Товары и Услуги для Дома
          </a>
         </div>
        </div>
        <div class="margin-top-30">
         <h5>
          ПОЛИТИКА
         </h5>
         <div class="links">
          <div class="link-box">
           <a href="http://dev.borodin.uk/stroyka.html#">
            Политика Возврата
           </a>
           <a href="http://dev.borodin.uk/stroyka.html#">
            Политика Доставки
           </a>
          </div>
         </div>
        </div>
       </section>
       <section>
        <h5>
         О НАС
        </h5>
        <div class="links">
         <div class="link-box">
          <a href="http://dev.borodin.uk/stroyka.html#">
           Наша История
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Ценообразование
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Отзывы
          </a>
         </div>
         <div class="link-box">
          <a href="http://dev.borodin.uk/stroyka.html#">
           Отзывы Клиентов
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Авторские Права
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Часто Задаваемые Вопросы
          </a>
         </div>
         <div class="link-box">
          <a href="http://dev.borodin.uk/stroyka.html#">
           Контакты
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Инициатива по Посадке Деревьев
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Блог
          </a>
         </div>
        </div>
       </section>
      </div>
      <div class="newsletter-section">
       <div class="logo">
        <img alt="borodin.servicess" class="img-responsive" src="./index_files/logo-0baf58dffe24002fac28656c197c0a8e85c6725a2e01f4b4fae66e7a061726d8.webp" title="borodin.servicess"/>
       </div>
       <div class="numbers">
        <div class="country">
         РОССИЯ И СНГ
         <span>
          Звоните в любое время
         </span>
         <span>
          8-800-2000-600
         </span>
        </div>
        <div class="country">
         Великобритания
         <span>
          01622 242528
         </span>
        </div>
       </div>
      </div>
     </div>
  
    </div>
   </div>
   <div class="bottom-footer">
    <div class="container">
     <div class="copy-right">
      All house plans are copyright ©2023 by the architects and designers represented on our web site
     </div>
     <div class="links">
      <a href="https://www.architecturaldesigns.com/terms-and-conditions">
       Terms
      </a>
      <a href="https://www.architecturaldesigns.com/privacy-policy">
       Privacy Policy
      </a>
     </div>
    </div>
   </div>
   <!-- /.modal -->
  </footer>
 </body>
</html>