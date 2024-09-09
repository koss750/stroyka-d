@extends('layouts.alternative')


@section('canonical', '')


@section('additional_head')

    <main id="afterHeader">
        <div class="container" style="margin-top: 74px;">
            <h1 class="sr-only">Каталог проектов домов и бань</h1>
            <div class="row">
                @foreach ($designs as $design)
                <div class="col-sm-6">
                    <a href="{{ url('project', $design->id) }}" class="flipCard-link">
                        <article class="flipCard">
                            <div class="flipCard-Image">
                                <img src="{{ $design->image_url ? asset($design->image_url) : '' }}" alt="{{ $design->title }}" loading="lazy">
                            </div>
                            <div class="flipCard-Text">
                                <h3 class="title">{{ $design->title }}m<sup>2</sup></h3>
                                <h3 class="price">{{ $design->price }} руб.</h3>
                            </div>
                        </article>
                    </a>
                </div>
                @endforeach
                <div class="col-sm-4">
                    <article class="flipCard">
                        <div class="flipCard-Image">
                            <img src="/images/2_.jpg" alt="Расчет фундамента" loading="lazy">
                        </div>
                        <div class="flipCard-Text">
                            <h2>Рассчитать свой фундамент</h2>
                            <a href="/site#foundations_section" class="scroll-to-section">Подробнее</a>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <p>&copy; {{ date('Y') }} СТРОЙКА</p>
                </div>
                <div class="col-sm-4">
                    <nav>
                        <ul>
                            <li><a href="#">О нас</a></li>
                            <li><a href="#">Facebook</a></li>
                            <li><a href="#">Twitter</a></li>
                            <li><a href="#">Контакты</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check if there's a hash in the URL
        if (window.location.hash === '#container_new_section') {
            // Remove the hash from the URL
            history.replaceState(null, document.title, window.location.pathname);
            
            // Scroll to the section
            const section = document.querySelector('.container_new_section');
            if (section) {
                setTimeout(function() {
                    section.scrollIntoView({ behavior: 'smooth' });
                }, 100);
            }
        }

        // Add click event listener to all links with the 'scroll-to-section' class
        document.querySelectorAll('.scroll-to-section').forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                const isInternalLink = href.startsWith('#') || href.includes(window.location.origin);

                if (isInternalLink) {
                    e.preventDefault();
                    const targetId = href.split('#')[1];
                    const targetElement = document.querySelector('.' + targetId);

                    if (targetElement) {
                        targetElement.scrollIntoView({ behavior: 'smooth' });
                    } else {
                        // If the target is not on this page, navigate to the link
                        window.location.href = href;
                    }
                }
            });
        });
    });
    </script>

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "СТРОЙКА",
      "url": "https://xn--80ardojfh.com",
      "description": "Каталог проектов домов и бань. Расчет стоимости строительства и фундамента.",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https://xn--80ardojfh.com/search?q={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
    </script>
</body>
</html>