
	
    @include('components.header')

<body>
@include('components.top')
    <main>
        <section class="section-main">
        
            <section class="section-01">
            
                <div class="container_new_section" style="margin-top:105px" >
                @include('partials.tab-navigator', ['items' => [
                        ['url' => '/my-orders', 'label' => 'Заказы'],
                        ['url' => '/suppliers', 'label' => 'Исполнители'],
                        ['url' => '/messages', 'label' => 'Мои переписки'],
                        ['url' => '/profile', 'label' => 'Мои данные'],
                    ]])
                    <div class="inner">
                    
                        <div class="box">
                            <div class="image">
                                <img src="/assets/images/orders.jpeg" alt="Заказы" loading="lazy">
                            </div>
                            <div class="content">
                                <a href="/my-orders" aria-label="Заказы">
                                    <h2><span>Заказы</span></h2>
                                    <span class="cta">Перейти</span>
                                </a>
                            </div>
                        </div>
                        <div class="box">
                            <div class="image">
                                <img src="/assets/images/contractors.jpeg" alt="Исполнители" loading="lazy">
                            </div>
                            <div class="content">
                                <a href="/suppliers" aria-label="Исполнители">
                                    <h2><span>Исполнители</span></h2>
                                    <span class="cta">Перейти</span>
                                </a>
                            </div>
                        </div>
                        <div class="box">
                            <div class="image">
                                <img src="/assets/images/messages.jpeg" alt="Переписки" loading="lazy">
                            </div>
                            <div class="content">
                                <a href="/messages" aria-label="Переписки">
                                    <h2><span>Мои переписки</span></h2>
                                    <span class="cta">Перейти</span>
                                </a>
                            </div>
                        </div>
                        <div class="box">
                            <div class="image">
                                <img src="/assets/images/profile.webp" alt="Мои данные" loading="lazy">
                            </div>
                            <div class="content">
                                <a href="/profile" aria-label="Мои данные">
                                    <h2><span>Мои данные</span></h2>
                                    <span class="cta">Перейти</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </main>

    <script>
        // Existing JavaScript
    </script>

    @include('components.podval')

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "Стройка.com",
      "url": "https://xn--80ardojfh.com",
      "description": "Проекты и сметы для домов и бань. Расчет фундаментов.",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https://xn--80ardojfh.com/search?q={search_term_string}",
        "query-input": "required name=search_term_string"
      },
      "mainEntity": {
        "@type": "SiteNavigationElement",
        "name": "Основные категории",
        "description": "Основные разделы проектов и смет",
        "hasPart": [
          {
            "@type": "WebPage",
            "name": "Дома из Бревна",
            "description": "Проекты и сметы домов из бревна",
            "url": "https://xn--80ardojfh.com/browse/doma_iz_brevna"
          },
          {
            "@type": "WebPage",
            "name": "Дома из Бруса",
            "description": "Проекты и сметы домов из бруса",
            "url": "https://xn--80ardojfh.com/browse/doma_iz_brusa"
          },
          {
            "@type": "WebPage",
            "name": "Бани из бревна",
            "description": "Проекты и сметы бань из бревна",
            "url": "https://xn--80ardojfh.com/browse/bani_iz_brevna"
          },
          {
            "@type": "WebPage",
            "name": "Бани из бруса",
            "description": "Проекты и сметы бань из бруса",
            "url": "https://xn--80ardojfh.com/browse/bani_iz_brusa"
          }
        ]
      }
    }
    </script>
</body>
</html>