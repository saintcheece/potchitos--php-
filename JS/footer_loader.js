document.addEventListener("DOMContentLoaded", function () {
  console.log("read");
    fetch('../public/layout/footer.html')
      .then(response => response.text())
      .then(data => {
        document.getElementById('footer-placeholder').innerHTML = data;
      })
      .catch(error => console.error('Error loading header:', error));
  });