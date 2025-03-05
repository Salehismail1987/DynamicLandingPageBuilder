<script>
   $('.playmutevideo').on('click', function() {
      if ($(".header-slider-video").prop('muted')) {
         $(".header-slider-video").prop('muted', false)

         $('.playmutevideo').attr('src', '<?= url('assets/front/img/volumn.jpg') ?>');
      } else {
         $(".header-slider-video").prop('muted', true)
         $('.playmutevideo').attr('src', '<?= url('assets/front/img/muted.jpg') ?>');
      }
   });
   $(document).ready(function() {

      $('.likes-banner').on('click', function() {
         $('#likesModal').modal('show');
      });

      $('.close-modal').on('click', function() {
         $('#likesModal').fadeOut();
      });

      $('#likesModal').on('click', function(e) {
         if ($(e.target).is('#likesModal')) {
            $(this).fadeOut();
         }
      });

      if (window.location.search.includes("editwebsite=true")) {
         // Apply the CSS style
         $(".my-nav-bar").css("top", "90px");
      }
   });
</script>