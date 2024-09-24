document.addEventListener("DOMContentLoaded", function () {
    fetch('components/side-bar.php')
      .then(response => response.text())
      .then(data => {
        document.getElementById('sidebar-placeloader').innerHTML = data;
      })
      .catch(error => console.error('Error loading sidebar:', error));
});
