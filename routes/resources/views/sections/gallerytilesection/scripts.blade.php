<script>
  function openTileImage(imageId) {
    var modal = document.getElementById("myModalTileimage01");
    console.log('asdfsadf');

    var img = document.getElementById(imageId);
    var description = document.getElementById('description_' + imageId).innerHTML;
    var modalImg = document.getElementById("img002");
    var captionText = document.getElementById("caption");
    modal.style.display = "block";
    modalImg.src = img.src;
    captionText.innerHTML = description;
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
</script>