<script>
     $(document).on('click','.read_more_link',function(){
    var div_id = $(this).data('value');
    $(".read_more_link_"+div_id).hide();
    $(".read_less_link_"+div_id).show();
    $(".read_more_block_"+div_id).show();    
  });

  $(document).on('click','.read_less_link',function(){
    var div_id = $(this).data('value');
    $(".read_more_link_"+div_id).show();
    $(".read_less_link_"+div_id).hide();
    $(".read_more_block_"+div_id).hide();
  });
</script>