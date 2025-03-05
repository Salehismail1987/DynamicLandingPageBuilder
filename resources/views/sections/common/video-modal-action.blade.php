<style>
  .text-container img {
    max-width: 100%;
  }

  .close,
  .close2 {
    position: absolute !important;
    top: 5px !important;
    right: 15px !important;
    color: #c7c7c7 !important;
    font-size: 40px !important;
    font-weight: bold !important;
    transition: 0.3s !important;
    opacity: 1 !important;
  }

  .close-text-modal {
    position: sticky !important;
    margin-left: 95%;
  }

  .carousel-container {
    position: relative;
    width: 100%;
    text-align: center;
  }

  .carousel-slide {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
  }

  .carousel-item {
    display: none;
    text-align: center;
  }

  .carousel-item.active {
    display: block;
  }

  .modal-content-1 {
    width: 700px;
    margin: 30px auto;
    position: relative;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, .2);
    border-radius: 6px;
    outline: 0;
  }

  .carousel-item img {
    margin: 0 auto;
  }

  .modal-dialog-1 {
    width: 700px;
    margin: 30px auto;
  }

  .modal-dialog-1 {
    width: auto;
    margin: 0 auto;
  }

  .text-modal {
    min-height: 580px;
    max-height: 580px;
  }

  @media (max-width: 576px) {
    .popup-height {
      height: 350px !important;
    }

    .modal-content-1 {
      height: 400px !important;
    }

    .modal-content-1 {
      overflow-x: hidden;
      padding: 10px;
      max-width: 90%;
      max-height: 400px ! important;
      min-height: 400px;
      margin: 30px auto;
    }
  }
  .carousel-container img {
    max-height: 2% !important;
    max-width: 85% !important;
    height: 100%;
    object-fit: contain;
    display: block;
    margin: 0 auto;
  }
</style>

<div class="modal" id="myModalTile" tabindex="-1" role="dialog" style="z-index:999999">
  <div class="modal-dialog-1 modal-md modal-custom-width" role="document">
    <div class="modal-content-1">
      <button type="button" class="close close-video-modal" data-dismiss="modal" aria-label="Close" style="z-index: 19;">
        <span aria-hidden="true">&times;</span>
      </button>
      <div class="modal-body p-0 text-center popup-height" style="height:580px;display:flex;justify-content:center;align-items:center;">
        <video height="480" id="vid-1" class="modal-video" controls autoplay>
          <source type="video/mp4">
        </video>
      </div>
    </div>
  </div>
</div>
<div class="modal" id="myModalTile1" tabindex="-1" role="dialog" style="z-index:999999">
  <div class="modal-dialog-1 modal-md modal-custom-width" role="document">
    <div class="modal-content-1 text-modal" style="overflow-y: scroll; height: max-content;">
      <button type="button" class="close close2 close-text-modal" data-dismiss="modal" aria-label="Close" style="z-index: 19;">
        <span aria-hidden="true">&times;</span>
      </button>
      <div class="modal-body ">
        <div class='text-container ' style="padding:1vi;">

        </div>
      </div>
    </div>
  </div>
</div>
<div id="imageCarouselModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="imageCarouselModalLabel" aria-hidden="true" style="z-index: 9999;">
  <div class="modal-dialog-1 modal-md modal-custom-width" role="document" style="height: fit-content;">
    <div class="modal-content-1">
      <div class="modal-header">
        <h5 class="modal-title" id="imageCarouselModalLabel">Image Carousel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body popup-height" style="height:580px;">
        <!-- Carousel Structure -->
        <div id="imageCarouselContainer" class="carousel-container">
          <div id="carouselInner" class="carousel-slide">
            <!-- Dynamic content will be inserted here -->
          </div>
          <!-- Controls -->
          <div class="carousel-controls">
            <a class="left carousel-control control-slider" style="margin-top: 10%;" onclick="changeSlide(-1)"><span class="glyphicon glyphicon-chevron-left ccleft"></span></a>
            <a class="right carousel-control control-slider" style="margin-top: 10%;" onclick="changeSlide(1)"><span class="glyphicon glyphicon-chevron-right ccright"></span></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const myModal = document.getElementById('myModalTile');
    myModal.addEventListener('hidden.bs.modal', function() {
      const video = myModal.querySelector('.modal-video');
      if (video) {
        video.pause();
        video.currentTime = 0; // Reset video to start
      }
    });
  });

  function openPopupText(textdivId) {
    var modal = document.getElementById("myModalTile1");
    var textdiv = document.getElementById(textdivId);
    $(".text-container").html(textdiv.innerHTML);
    console.log(textdiv)
    modal.style.display = "block";
    setTimeout(
      function() {
        $('#popupalert').modal('hide');
      }, 1000);
    var span = document.getElementsByClassName("close2")[0];

    span.onclick = function() {
      modal.style.display = "none";
    }
  }

  function openVideo(imageId) {
    var modal = document.getElementById("myModalTile");

    var img = document.getElementById(imageId);
    var modalImg = document.getElementById("vid-1");
    var captionText = document.getElementById("caption");
    modal.style.display = "block";
    setTimeout(
      function() {
        $('#popupalert').modal('hide');
      }, 1000);
    // modalImg.src = img.href;
    $('#vid-1 source').attr('src', img.href);
    $("#vid-1")[0].load();
    $("#vid-1")[0].play();
    var span = document.getElementsByClassName("close")[0];

    span.onclick = function() {
      modal.style.display = "none";
      $("#vid-1")[0].pause();
      $("#vid-1")[0].currentTime = 0;
    }
  }

    function openSlider(imagesData, baseUrl) {
    if (!Array.isArray(imagesData)) {
      console.error("imagesData is not an array:", imagesData);
      return;
    }

    var carouselInner = document.getElementById('carouselInner');
    var controls = document.querySelectorAll('.carousel-control'); // Select the arrows
    carouselInner.innerHTML = '';

    // Check the number of images and toggle the visibility of controls
    if (imagesData.length > 1) {
      controls.forEach(control => control.style.display = 'block');
    } else {
      controls.forEach(control => control.style.display = 'none');
    }

    // Create carousel items dynamically
    imagesData.forEach(function(imageData, index) {
      var imageUrl = baseUrl + '/' + imageData;
      var activeClass = index === 0 ? 'active' : '';

      var item = document.createElement('div');
      item.className = 'carousel-item ' + activeClass;
      var img = document.createElement('img');
      img.id = 'carousel-slider-image-popup' + index;
      img.src = imageUrl;
      img.style.maxWidth = '85%';
      img.alt = 'Slide ' + (index + 1);
      img.className = 'd-block w-100';
      item.appendChild(img);
      img.onclick = function() {
        openPopupImage(img.id);
      };
      carouselInner.appendChild(item);
    });

    // Show the modal
    $('#imageCarouselModal').modal('show');

    // Initialize slider
    currentSlide = 0;
    showSlide(currentSlide);
  }

  function openPopupImage(imageId) {
    var modal = document.getElementById("myModalTileimage01");

    var img = document.getElementById(imageId);
    //var description = document.getElementById('description_' + imageId).innerHTML;
    var modalImg = document.getElementById("img002");
    var captionText = document.getElementById("caption");
    modal.style.display = "block";
    modalImg.src = img.src;
    //captionText.innerHTML = description;
    document.addEventListener('click', function(event) {
      // Check if the clicked element is the close button within your modal
      if (event.target.classList.contains('close') && event.target.closest('#myModalTileimage01')) {
        // Get the modal
        var modal = document.getElementById("myModalTileimage01");
        // Close the modal
        modal.style.display = "none";
      }
    });

  }

  function showSlide(slideIndex) {
    var slides = document.getElementsByClassName('carousel-item');
    if (slideIndex >= slides.length) {
      currentSlide = 0;
    }
    if (slideIndex < 0) {
      currentSlide = slides.length - 1;
    }
    for (var i = 0; i < slides.length; i++) {
      slides[i].style.display = 'none';
    }
    slides[currentSlide].style.display = 'block';
  }

  function changeSlide(direction) {
    currentSlide += direction;
    showSlide(currentSlide);
  }

  $(document).ready(function() {
    $(document).on('click', '.btnsearch', function() {
      $('.searchform').submit();
    });
    $(document).on('click', '.close-video-modal', function() {
      $("#myModalTile").hide();
    });
    $(document).on('click', '.close-text-modal', function() {
      $(".text-container").html('');
    });
  });
</script>