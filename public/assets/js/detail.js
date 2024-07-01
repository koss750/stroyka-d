document.addEventListener('DOMContentLoaded', function() {
    console.log('loaded');

    const carousel = document.querySelector('#carouselExampleIndicators');
    const carouselInstance = new bootstrap.Carousel(carousel, {
        interval: false, // Disable auto sliding
        keyboard: false, // Disable keyboard controls
        touch: false // Disable swiping
    });

    const thumbnails = carousel.querySelectorAll('.carousel-indicators li');
    const mainImages = carousel.querySelectorAll('.carousel-inner .carousel-item');

    carousel.addEventListener('click', function(event) {
        const clickedThumbnail = event.target.closest('.carousel-indicators li');
        if (clickedThumbnail) {
            const index = Array.from(thumbnails).indexOf(clickedThumbnail);
            carouselInstance.to(index);
            event.preventDefault();
        }
    });

    carousel.addEventListener('slid.bs.carousel', function() {
        const activeIndex = Array.from(mainImages).findIndex(img => img.classList.contains('active'));
        thumbnails.forEach((thumbnail, index) => {
            if (index === activeIndex) {
                thumbnail.classList.add('active');
            } else {
                thumbnail.classList.remove('active');
            }
        });
    });

    // Handle arrow controls
    const prevControl = carousel.querySelector('.carousel-control-prev');
    const nextControl = carousel.querySelector('.carousel-control-next');

    prevControl.addEventListener('click', function(event) {
        console.log('Previous arrow clicked');
        carouselInstance.prev();
        event.preventDefault();
    });

    nextControl.addEventListener('click', function(event) {
        console.log('Next arrow clicked');
        carouselInstance.next();
        event.preventDefault();
    }); 


    var modal = document.getElementById("paymentModal");
    var btn = document.querySelector(".buyNowBtn");
    var span = document.getElementsByClassName("close")[0];

    var group = [
        document.getElementById("group_211"),
        document.getElementById("group_213"),
        document.getElementById("group_215")
    ];
    group.forEach(function(group) {
            group.remove();
        });
    
    if (btn) {
        btn.addEventListener('click', function() {
            console.log('clicked');
            modal.style.display = "block";
        });
    }



    if (span) {
        span.addEventListener('click', function() {
            modal.style.display = "none";
        });
    }

    window.addEventListener('click', function(event) {
        if (event.target == modal) {
            console.log('clicked');
            modal.style.display = "none";
        }
    });

    

    function handleOrderSubmission(isExample = false) {

        if(isExample) {
            document.getElementById('exampleSmetaBtn').innerHTML = 'Загрузка...';
        } else {
            console.log('is not example');
        }
    var formData = new FormData();
    formData.append('selectedOptions', JSON.stringify(selectedOptionRefs));
    formData.append('selectedOptionPrices', JSON.stringify(selectedOptionPrices));
    formData.append('totalPrice', document.getElementById('totalPrice').textContent);
    formData.append('designId', isExample ? '1' : '{{ $design->id }}');

    fetch('/register-order', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (isExample) {
            // For example Smeta, directly initiate download
            window.open('http://tmp.mirsmet.com/process-order/' + data.orderId, '_blank');
        } else {
            // For paid order, show button in modal
            var downloadBtn = document.createElement('a');
            downloadBtn.href = 'http://tmp.mirsmet.com/process-order/' + data.orderId;
            downloadBtn.textContent = 'Перейти в Личный Кабинет';
            downloadBtn.className = 'btn btn-primary';
            document.getElementById('orderStatus').innerHTML = '';
            document.getElementById('orderStatus').appendChild(downloadBtn);
        }
    })
    .catch(error => {
            console.error('Error:', error);
        });

    
}

var form = document.getElementById("paymentForm");
if (form) {
    console.log('form exists');
    form.addEventListener('submit', function(e) {
        console.log('clicked');
        e.preventDefault();
        handleOrderSubmission(false);
    });
}

// Event listener for the example Smeta download button
var exampleSmetaBtn = document.getElementById("exampleSmetaBtn");
if (exampleSmetaBtn) {
    console.log('example exists');
    exampleSmetaBtn.addEventListener('click', function(e) {
        console.log('clicked');
        e.preventDefault();
        handleOrderSubmission(true);
    });
}
});
// Event listener for the payment form submission