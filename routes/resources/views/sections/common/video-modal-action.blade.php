  
    
    <style>
        .text-container  img{
            max-width: 100%;
        }
        .close,.close2 {
            position: absolute !important;
            top: 5px  !important;
            right: 15px  !important;
            color: #c7c7c7  !important;
            font-size: 40px  !important;
            font-weight: bold  !important;
            transition: 0.3s  !important;
            opacity: 1  !important;
        }
        .close-text-modal{
            position: sticky !important;
            margin-left: 95%;
        }
    </style>


    <div class="modal" id="myModalTile"  tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close close-video-modal" data-dismiss="modal" aria-label="Close" style="z-index: 19;">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body p-0 text-center">
                    <video  height="315" id="vid-1" controls autoplay>
                        <source type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="myModalTile1"  tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" >
            <div class="modal-content" style="    min-height: 200px;max-height: 350px; overflow-y: scroll; height: max-content;">
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
    <div id="imageCarouselModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="imageCarouselModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="imageCarouselModalLabel">Image Carousel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
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
    function openPopupText(textdivId){
        var modal = document.getElementById("myModalTile1"); 
        var textdiv = document.getElementById(textdivId);
        $(".text-container").html(textdiv.innerHTML);
        console.log(textdiv)
        modal.style.display="block";
        setTimeout(
        function() 
        {
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
    function() 
    {
        $('#popupalert').modal('hide');
    }, 1000);
    // modalImg.src = img.href;
    $('#vid-1 source').attr('src',img.href);
    $("#vid-1")[0].load();
    $("#vid-1")[0].play();
    var span = document.getElementsByClassName("close")[0];

    span.onclick = function() {
      modal.style.display = "none";
    }
  }

  function openSlider(imagesData, baseUrl) {
      if (!Array.isArray(imagesData)) {
        console.error("imagesData is not an array:", imagesData);
        return;
      }

      var carouselInner = document.getElementById('carouselInner');
      carouselInner.innerHTML = '';

      // Create carousel items dynamically
      imagesData.forEach(function(imageData, index) {
        var imageUrl = baseUrl + '/' + imageData;
        var activeClass = index === 0 ? 'active' : '';

        var item = document.createElement('div');
        item.className = 'carousel-item ' + activeClass;

        var img = document.createElement('img');
        img.src = imageUrl;
        img.style.maxWidth =   '100%';
        img.alt = 'Slide ' + (index + 1);
        img.className = 'd-block w-100';
        item.appendChild(img);

        carouselInner.appendChild(item);
      });

      // Show the modal
      $('#imageCarouselModal').modal('show');

      // Initialize slider
      currentSlide = 0;
      showSlide(currentSlide);
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
    $(document).on('click','.close-video-modal', function(){
        $("#myModalTile").hide();
    });
    $(document).on('click','.close-text-modal', function(){
        $(".text-container").html('');
    });
  });

</script>