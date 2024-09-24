
document.addEventListener('DOMContentLoaded', () => {
    fetch('components/navbar.php')
    .then(response => response.text())
        .then(data => {
            document.getElementById('navbar-container').innerHTML = data;
        });
});