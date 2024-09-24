<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/admin.css">
    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/navbar-loader.js" defer></script>

</head>
<body>
    <div id="navbar-container"></div>

    <section id="main-container">
        <main>
            <section class="analytics-container">
                <div class="grid-container">
                    <!-- Top Row Cards -->
                    <div class="card total-sales">
                        <h2>Total Sales</h2>
                        <p>$10,000</p>
                    </div>
                    <div class="card total-users">
                        <h2>Total Users</h2>
                        <p>500</p>
                    </div>
                    <div class="card date-today">
                        <h2>Date Today</h2>
                        <p>09/08/2024</p>
                    </div>

                    <!-- Bar Chart and Pie Chart Section -->
                    <div class="card bar-chart-container">
                        <h2>Sales Weekly Report</h2>
                        <canvas id="barChart"></canvas>
                    </div>
                    <div class="card pie-chart-container">
                        <h2>Most Bought Products</h2>
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </section>
        </main>
    </section>
  
    <!-- Initialize Chart.js -->
    <script>
        // Bar Chart
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Sales',
                    data: [1200, 1900, 3000, 5000, 2300, 2900, 3200],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Pie Chart
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Product A', 'Product B', 'Product C'],
                datasets: [{
                    label: 'Most Bought Products',
                    data: [300, 150, 100],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            }
        });
    </script>
</body>
</html>
