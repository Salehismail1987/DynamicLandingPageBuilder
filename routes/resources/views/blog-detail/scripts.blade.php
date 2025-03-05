<?php echo isset($postscript) ? $postscript : ''; ?>
<script>
        function carouselNormalization() {
            var items = $('#myCarousel2 .item'), //grab all slides
                heights = [], //create empty array to store height values
                tallest; //create variable to make note of the tallest slide

            if (items.length) {
                function normalizeHeights() {
                    items.each(function() { //add heights to array
                        heights.push($(this).height());
                    });
                    tallest = Math.max.apply(null, heights); //cache largest value
                    items.each(function() {
                        $(this).css('min-height', tallest + 'px');
                    });
                };
                normalizeHeights();

                $(window).on('resize orientationchange', function() {
                    tallest = 0, heights.length = 0; //reset vars
                    items.each(function() {
                        $(this).css('min-height', '0'); //reset min-height
                    });
                    normalizeHeights(); //run it again 
                });
            }
        }
        $('#myCarousel').carousel({
            pause: 'none'
        })
        $('#myCarousel2').carousel({
            pause: 'none'
        });
        $(document).ready(function() {
            // var header_height = $('#header').outerHeight();
            // $('#myLinks').css({'margin-top':header_height+'px'});

            $('.new-action-btn').on('click',function () {
                $('#popupalert').modal('hide');
            })

            carouselNormalization();
            $(document).on("click", ".btnbars", function() {
                
                $('#myLinks').toggle('slow');
            });
            $(document).on("click", ".menuitem", function() {
                $('#myLinks').toggle('slow');
            });
            var playstatus = '0';
            var playaudio = <?= ($audioFiles->audio_auto_play) ?>;
            $(document).on("click", "body", function() {
                if (playaudio) {
                    playaudio = false;
                    playstatus = '1';
                    $('.playmuteaudio').attr('src', '<?= url('assets/front/img/volumn.jpg') ?>');
                    var aud = document.getElementById("myAudio");
                    if(aud){
                        aud.play();
                        aud.onended = function() {
                            $('.playmuteaudio').attr('src', '<?= url('assets/front/img/muted.jpg') ?>');
                            playstatus = '0';
                        };
                    }
                   

                }
            });

            var width = $(window).width();
            if (width > 990) {
                $('.vertical-center').find('.outer').each(function() {
                    $(this).height($(this).closest('.row').height());
                });
                var carousel_height = $('.header-carousel').height();
                console.log(carousel_height);
                if(carousel_height<600){
                    // $('.headerdiv').height(629);
                    $('.headerdiv').height(carousel_height+25);
                }else{
                    $('.headerdiv').height(carousel_height+25);
                }
               
            } else {
                $('#hero').css('overflow-y', 'hidden');
            }
            $('.main-content').css('margin-top', $('#header').height()+10);
            $('#myLinks').css('height', $(window).height()-$('#header').height());
          
            <?php if (false && $audioFiles->audio_auto_play == '1') { ?>
                setTimeout(
                    function() {
                        if (playaudio) {
                            playstatus = '1';
                            $('.playmuteaudio').attr('src', '<?= url('assets/front/img/volumn.jpg') ?>');
                            var aud = document.getElementById("myAudio");
                            aud.play();
                            aud.onended = function() {
                                $('.playmuteaudio').attr('src', '<?= url('assets/front/img/muted.jpg') ?>');
                                playstatus = '0';
                            };
                        }
                    }, 10000);
            <?php } ?>
            $(document).on("click", ".playmuteaudio", function() {
                playaudio = false;
                if (playstatus == '1') {
                    playstatus = '0';
                    document.getElementById("myAudio").pause();
                    $('.playmuteaudio').attr('src', '<?= url('assets/front/img/muted.jpg') ?>');
                } else {
                    playstatus = '1';
                    $('.playmuteaudio').attr('src', '<?= url('assets/front/img/volumn.jpg') ?>');
                    var aud = document.getElementById("myAudio");
                    aud.play();
                    aud.onended = function() {
                        $('.playmuteaudio').attr('src', '<?= url('assets/front/img/muted.jpg') ?>');
                        playstatus = '0';
                    };

                }
            });

            var hoursMaxHeight = Math.max.apply(null, $(".daily-hours-div-to-calculate-height li .singledailyhour").map(function() {
                return $(this).outerHeight();
            }).get());
          
            $(".dailyhourslist li .singledailyhour").css('height', (hoursMaxHeight + 50) + 'px');
            $('.daily-hours-div-to-calculate-height').hide();

            var maxHeightGallery = Math.max.apply(null, $(".sample-carousel-images .gallary_slider_description_text").map(function() {
                return $(this).outerHeight();
            }).get());
            $("#myCarousel2 .gallary_slider_description_text").css('height', (maxHeightGallery + 30) + 'px');

            $('.sample-carousel-images').hide();
        });

        $(document).on('click','.playaudiofile',function(){
            var aud = document.getElementById("myAudio");
            aud.play();
        });
        $(document).ready(function() {
            
            var width = $(window).width();
            <?php if ($alertPopupSetting->popup_active == '1') { ?>
                $('#popupalert').modal('show');
            <?php } ?>

            var slides = 7;
            <?php if (!$headerImages->slideronoff) { ?>
                if (width < 800) {
                    $('.headerslider').hide();
                }
            <?php } ?>
            if (width < 1200) {
                //$('.bodycontent').css('margin-top',$('.headerdiv').height()-600);
                slides = 4;
            }
            if (width < 1000) {
                //$('.bodycontent').css('margin-top',$('.headerdiv').height()-500);
                slides = 2;
            }
            if (width < 800) {
                //$('.bodycontent').css('margin-top',$('.headerdiv').height()+50);
                slides = 1;
            }
            if (width < 800) {
                $('.headerdiv').css('width', 'auto');
            }

            if (width < 781) {
                $('.headerdiv').css('width', '100%');
            }
            $('.trending-ads-slide').slick({
                infinite: true,
                slidesToShow: slides,
                arrows: true,
                prevArrow: "<button type='button' class='slick-prev pull-left' style='z-index: 999999;'><span class='glyphicon glyphicon-chevron-left'></span></button>",
                nextArrow: "<button type='button' class='slick-next pull-right' style='z-index: 999999;'><span class='glyphicon glyphicon-chevron-right'></span></button>"
            });
     
            $('#myvideocrousel').carousel({
                pause: 'none'
            });
        });
        $(document).on('click','.playaudiofile',function(){
            let volumeicon ="<?php echo url('assets/front/img/volumn.jpg');?>";
            let closeaudioicon= "<?php echo url('assets/front/img/muted.jpg');?>";
            $('.playmuteaudio').attr('src', volumeicon);
            var aud = document.getElementById("myAudio");
            aud.play();
            aud.onended = function() {
                $('.playmuteaudio').attr('src', closeaudioicon);
                playstatus = '0';
            };
        });

        function toggleIcon(e) {
            $(e.target)
                .prev('.panel-heading')
                .find(".more-less")
                .toggleClass('glyphicon-plus glyphicon-minus');
        }
        $('.panel-group').on('hidden.bs.collapse', toggleIcon);
        $('.panel-group').on('shown.bs.collapse', toggleIcon);

    </script>

    <?php echo isset($postscript) ? $postscript : ''; ?>

    <?php echo $siteSettings->home_scripts; ?>


    <!-- Popup JS -->
    <script src="<?= url('assets/front/popup'); ?>/js/modalAnimate.js"></script>
    <script>
        //demo 01
        $("#unfolding").modalAnimate();
        $(document).on("click", ".menuitem", function() {
        
            <?php if ($navBarSettings->enable=='1'){?>
            $('body, html').animate({
                scrollTop: $($(this).attr('href')).offset().top - 105
            }, 1000);
            <?php }else{?>
            $('body, html').animate({
                scrollTop: $($(this).attr('href')).offset().top - 50
            }, 1000);
            <?php  }?>
           
        });
    </script>