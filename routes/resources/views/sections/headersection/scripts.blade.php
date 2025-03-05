<script>
    
      $('.playmutevideo').on('click', function() {
         if( $(".header-slider-video").prop('muted') ){
            $(".header-slider-video").prop('muted',false)
            
            $('.playmutevideo').attr('src', '<?= url('assets/front/img/volumn.jpg') ?>');
         }else{
            $(".header-slider-video").prop('muted',true)
            $('.playmutevideo').attr('src', '<?= url('assets/front/img/muted.jpg') ?>');
         }
      });
</script>