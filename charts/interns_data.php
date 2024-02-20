<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interns Data Chart</title>
    <link href="../css/dist/output.css" rel="stylesheet">
</head>
<?php 
session_start();
$username = isset($_GET["username"]) ? $_GET["username"] : (isset($_SESSION["username"]) ? $_SESSION["username"] : "Unknown");
include "../dashboard/admin_navs.php";
?>
<body>
<div class="md:ml-48 xl:ml-48 lg:48">
    <div class="flex items-center justify-between px-6 py-5 font-semibold border-b border-gray-100">
        <div class="md:w-5/6">
            <canvas id="myChart"></canvas>
        </div>
        <div id="totalValue" class="md:w-1/6 text-center"></div> 
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Function to generate random color for each bar
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    // Add a script to fetch data and update the chart
    fetch('fetch school total.php')
        .then(response => response.json())
        .then(data => {
            // Call a function to update the chart with the fetched data
            updateChart(data);
        })
        .catch(error => console.error('Error fetching data:', error));

    function updateChart(data) {
        var ctx = document.getElementById('myChart').getContext('2d');
        var totalInterns = data.reduce((sum, item) => sum + parseInt(item.total,  10),  0);

    // Display the total number of interns
    document.getElementById('totalValue').textContent = `Total Interns: ${totalInterns}`;

        // Initialize window.myChart if it doesn't exist
        if (!window.myChart) {
            window.myChart = {};
        }

        // Check if the chart already exists
        if (!window.myChart.chart) {
            window.myChart.chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.map(item => item.school),
                    datasets: [{
                        label: 'Interns Data',
                        data: data.map(item => item.total),
                        backgroundColor: data.map(() => getRandomColor()), // Random color for each bar
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    animation: true, // Enable animations
                    scales: {
                        y: {
                            beginAtZero: true
                        },
                        x: {
                            ticks: {
                                display: false 
                            }
                        }
                    },
                    
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                color: 'black',
                                boxWidth: 15
                            }
                        },
                        tooltips: {
                            enabled: true,
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleFontColor: 'white',
                            bodyFontColor: 'white',
                            displayColors: false
                        }
                    }
                }
            });
        } else {
            // If the chart has already been created, update it
            window.myChart.chart.data.labels = data.map(item => item.school);
            window.myChart.chart.data.datasets[0].data = data.map(item => item.total);
            window.myChart.chart.data.datasets[0].backgroundColor = data.map(() => getRandomColor());
            window.myChart.chart.update('none'); // Update without animation
        }
    }
    // Call fetchAndUpdateChart immediately to load the initial data
    fetchAndUpdateChart();

    // Then call fetchAndUpdateChart every 5 seconds to refresh the data
    setInterval(fetchAndUpdateChart, 5000);

    function fetchAndUpdateChart() {
        fetch('fetch school total.php') // Replace with the actual endpoint providing JSON data
            .then(response => response.json())
            .then(data => {
                updateChart(data);
            })
            .catch(error => console.error('Error:', error));
    }
</script>
</body>
</html>
