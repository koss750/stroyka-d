@extends('layouts.alternative')

@section('title', $design->title)
@section('description', '')
@section('canonical', '')

@section('additional_head')
<script src="https://xn--80ardojfh.com/assets/js/detail.js"></script>
@endsection

@section('main_heading', 'Профессиональное строительство')
@section('sub_heading', 'Проекты строительства домов и бань для проживания')

            @section('content')
            <div class="row">
               <div class="col-lg-6 col-md-12">
                <x-image-carousel :jpgImageUrls="$jpgImageUrls" :thumbImageUrls="$thumbImageUrls" />
                  <div class="price-tag">
                     <h4><span id="totalPrice">{{ $design->etiketka }}</span> руб.</h4>
                  </div>
                  <div class="buttons col-12">
                  <button class="btn btn-outline-light" id="exampleSmetaBtn">Пример сметы (скачать)</button>
                  <button class="btn btn-outline-light buyNowBtn" id="buyNow">Купить смету (тест без платежа)</button>
                  </div>
                  <div class="buttons col-12">
                    <button class="btn btn-outline-light" disabled>Пример проекта (скачать)</button>
                    <button class="btn btn-outline-light" disabled>Купить проект</button>
                  </div>
               </div>
               <div class="col-lg-6 col-md-12">
               

               @component('components.optionGroup', [
                    'groupName' => 'foundation',
                    'options' => $nestedData['foundations'],
                    'label' => 'Фундамент'
                ])
                @endcomponent

                @component('components.optionGroup', [
                    'groupName' => 'dd',
                    'options' => $nestedData['dd_options'],
                    'label' => 'Домокомплект'
                ])
                @endcomponent

                @component('components.optionGroup', [
                    'groupName' => 'roof',
                    'options' => $nestedData['roofs'],
                    'label' => 'Кровля'
                ])
                @endcomponent

                    
               </div>
            </div>
      <!-- Payment Modal -->
      <x-payment-modal />
      <x-modal-carousel />
      @endsection
      @section('additional_scripts')
    <script>
let currentImageIndex = 0;
let imageUrls = [];

function openImageModal(imgSrc) {
    var modal = document.getElementById("image_modal");
    var modalImg = document.getElementById("image_modal_img");
    modal.style.display = "block";
    modalImg.src = imgSrc;
    
    // Find the index of the clicked image
    currentImageIndex = imageUrls.indexOf(imgSrc);
}

function changeModalImage(step) {
    currentImageIndex += step;
    if (currentImageIndex >= imageUrls.length) {
        currentImageIndex = 0;
    } else if (currentImageIndex < 0) {
        currentImageIndex = imageUrls.length - 1;
    }
    document.getElementById("image_modal_img").src = imageUrls[currentImageIndex];
}

document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById("image_modal");
    var span = document.getElementsByClassName("image_modal_close")[0];

    // Populate imageUrls array
    imageUrls = Array.from(document.querySelectorAll('.carousel-item img')).map(img => img.src);

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Close the modal when clicking outside the image
    modal.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Prevent clicks on the image from closing the modal
    document.getElementById("image_modal_img").onclick = function(event) {
        event.stopPropagation();
    }

    // Add keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (modal.style.display === "block") {
            if (e.key === "ArrowLeft") {
                changeModalImage(-1);
            } else if (e.key === "ArrowRight") {
                changeModalImage(1);
            } else if (e.key === "Escape") {
                modal.style.display = "none";
            }
        }
    });
});
</script>
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
@endsection