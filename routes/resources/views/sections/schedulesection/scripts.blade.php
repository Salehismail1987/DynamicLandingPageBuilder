<!-- (Hsssan) Find the height of tallest card then assign it to all cards -->
<script>
    $(document).ready(function() {
    var tallestCardHeight = 0;
        setTimeout(function(){
            $('.singledailyhourheight').each(function() {
                var cardHeight = $(this).height();
                if (cardHeight > tallestCardHeight) {
                    tallestCardHeight = cardHeight;
                }
            });
            $('.singledailyhourheight').height(tallestCardHeight);
        },3000);
    });
</script>