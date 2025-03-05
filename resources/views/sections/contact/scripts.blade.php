<script>
  // Get all buttons with the 'tos-btn' class, the modal, and the close button
const tosButtons = document.querySelectorAll('.tos-btn');
const tosModal = document.getElementById('tosModal');
const closeBtn = tosModal.querySelector('.close');

// Loop through each button and add a click event listener
tosButtons.forEach(function(tosBtn) {
  tosBtn.addEventListener('click', function() {
    tosModal.style.display = 'block';
  });
});

// When the user clicks the close button, close the modal
closeBtn.addEventListener('click', function() {
  tosModal.style.display = 'none';
});

// Close the modal if the user clicks outside the modal content
window.addEventListener('click', function(event) {
  if (event.target === tosModal) {
    tosModal.style.display = 'none';
  }
});

</script>