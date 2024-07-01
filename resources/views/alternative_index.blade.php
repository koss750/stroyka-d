<html>
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>СТРОЙКА</title>
      <meta name="description" content="" />
      <link rel="canonical" href="" />
      <link rel="icon" type="image/x-icon" href="assets/images/fav.ico">
      <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
      <meta http-equiv="Pragma" content="no-cache" />
      <meta http-equiv="Expires" content="0" />
      <link rel="font" href="https://xn--80ardojfh.com/assets/fonts/font.ttf"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
      <link rel="stylesheet" href="https://xn--80ardojfh.com/assets/css/style.css"/>
      <script src="https://xn--80ardojfh.com/assets/js/jquery.min.js"></script>
      <link href="https://xn--80ardojfh.com/assets/css/bootstrap.min.css" rel="stylesheet"/>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
   </head>
<body>
      <header id="headerBar">
         <div class="container">
            <div class="row">
               <div class="col-sm-2">
                  <div class="headerLogo"><a href="./">Стройка.com</a></div>
               </div>
               <div class="col-sm-3">
                  <div class="searchBar"><input type="text" placeholder="Поиск по сайту..."></div>
               </div>
               <div class="col-sm-7">
                  <div class="headerMenu">
                     <ul class="nav">
                        <li><a href="#">Физические лица</a></li>
                        <li><a href="#">Юридические лица</a></li>
                        <li><a href="#">Личный Кабинет</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         </div>
      </header>
      <section id="afterHeader">
         <div class="container">
            <div class="row">
               <div class="col-sm-12">
                  <div class="mainHeading">
                     <h1>Профессиональное строительство</h1>
                     <p>Проекты строительства домов и бань для проживания</p>
                  </div>
               </div>
            </div>
            <div class="row">
               @foreach ($designs as $design)
               <div class="col-sm-4">
                  <div class="flipCard">
                     <div class="flipCard-Image"><img src="{{ ($design->image_url) ? asset($design->image_url) : '' }}"></div>
                     <div class="flipCard-Text">
                        <h3>{{ $design->materialDescription }} <span style="font-size: 15px;">{{ $design->size }} м2</span></h3>
                        <p>{{ $design->price }} p.</p>
                        <a href="/project/{{ $design->id }}">{{ $design->title }}</a>
                     </div>
                  </div>
               </div>
            @endforeach
               <div class="col-sm-4">
                  <div class="flipCard">
                     <div class="flipCard-Image"><img src="assets/images/card-img2.jpg"></div>
                     <div class="flipCard-Text">
                        <h3>Рассчитать свой</h3>
                        <p>фундамент</p>
                        <a href="#">Подробнее</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <footer>
         <div class="container">
            <div class="row">
               <div class="col-sm-4">
                  <p>© 2021 Your Company</p>
               </div>
               <div class="col-sm-4">
                   <ul>
                       <li><a href="#">About us</a></li>
                       <li><a href="#">Facebook</a></li>
                       <li><a href="#">Twitter</a></li>
                       <li><a href="#">Contacts</a></li>
                   </ul>
               </div>
            </div>
         </div>
      </footer>
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
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>
      </footer>
   </body>
</html>