<script>
  function openTileImage(imageId) {
    var modal = document.getElementById("myModalTileimage1");
    var img = document.getElementById(imageId);
    var description = document.getElementById('description_' + imageId).innerHTML;
    var modalImg = document.getElementById("img02");
    var captionText = document.getElementById("caption");
    modal.style.display = "block";
    modalImg.src = img.src;
    captionText.innerHTML = description;

    var span = document.getElementsByClassName("close")[0];

    document.addEventListener('click', function(event) {
    // Check if the clicked element is the close button within your modal
    if (event.target.classList.contains('close') && event.target.closest('#myModalTileimage1')) {
        // Get the modal
        var modal = document.getElementById("myModalTileimage1");
        // Close the modal
        modal.style.display = "none";
    }
});
  }

  $(document).ready(function() {
    $(document).on('click', '.btnsearch', function() {
        $('.searchform').submit();
    });
  });

</script>