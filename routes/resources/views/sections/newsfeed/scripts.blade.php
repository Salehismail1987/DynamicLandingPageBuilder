<script
  src="https://code.jquery.com/jquery-1.12.4.min.js"
  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
  crossorigin="anonymous"></script>
<script>
           console.log('asdasd')
      var page =0;
        $.ajax({
        url:"<?=url('get_feed_data_ajax');?>",
        data:{
          page :page,
          _token: "{{ csrf_token() }}"
        },
        type:'get', 
        success :function(data){
      
            if(data ==""){
                $("#loadMore").hide();
                $(".btn-loadmore").hide();
                $("#noMore").show();
                return;
            }
            page++;
            $('#feed-container').append(data)
           
        }
    })
  $(document).on("click", ".menuitem2", function() {
    <?php if ($navBarSettings->enable=='1'){?>
            $('body, html').animate({
                scrollTop: $($(this).attr('href')).offset().top - 105
            }, 1000);
            <?php }else{?>
            $('body, html').animate({
                scrollTop: $($(this).attr('href')).offset().top - 50
            }, 1000);
            <?php  }?> 

    // var page =0;

    // function  loadmore(){
    //   console.log('asdasd')
    //   var page =0;
    //     $.ajax({
    //     url:"<?=url('get_feed_data_ajax');?>",
    //     data:{
    //       page :page,
    //       _token: "{{ csrf_token() }}"
    //     },
    //     type:'get', 
    //     success :function(data){
      
    //         if(data ==""){
    //             $("#loadMore").hide();
    //             $(".btn-loadmore").hide();
    //             $("#noMore").show();
    //             return;
    //         }
    //         page++;
    //         $('#feed-container').append(data)
           
    //     }
    // })
    //     }

    }) 
    function  loadmore(){
      // var page =0;
      console.log(page)
        $.ajax({
        url:"<?=url('get_feed_data_ajax');?>",
        data:{
          page :page,
          _token: "{{ csrf_token() }}"
        },
        type:'get', 
        success :function(data){
          
            if(data ==""){
                $("#loadMore").hide();
                $("#noMore").show();
                return;
            }
            page++;
            $('#feed-container').append(data)
           
        }
    })
        }
</script>