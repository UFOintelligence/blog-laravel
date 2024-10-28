<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo - Brito Academy</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100">

    <!-- Toggle Dark Mode -->
    <div class="container mx-auto px-6 py-4 flex justify-end">
        <button onclick="toggleDarkMode()" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
            Modo Oscuro/Claro
        </button>
    </div>

    <!-- Dashboard -->
    <div class="container mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Student Count -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg flex items-center">
            <i class="fas fa-users text-4xl text-blue-600"></i>
            <div class="ml-4">
                <p class="text-lg font-semibold">Estudiantes</p>
                <p class="text-2xl font-bold">520</p>
            </div>
        </div>

        <!-- Revenue -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg flex items-center">
            <i class="fas fa-dollar-sign text-4xl text-green-500"></i>
            <div class="ml-4">
                <p class="text-lg font-semibold">Ingresos</p>
                <p class="text-2xl font-bold">$12,800</p>
            </div>
        </div>

        <!-- Course Progress -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg flex items-center">
            <i class="fas fa-chart-line text-4xl text-yellow-500"></i>
            <div class="ml-4">
                <p class="text-lg font-semibold">Progreso del Curso</p>
                <p class="text-2xl font-bold">75%</p>
            </div>
        </div>

        <!-- Active Courses -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg flex items-center">
            <i class="fas fa-book text-4xl text-purple-500"></i>
            <div class="ml-4">
                <p class="text-lg font-semibold">Cursos Activos</p>
                <p class="text-2xl font-bold">4</p>
            </div>
        </div>

    </div>

    <!-- Charts -->
    <div class="container mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Revenue Chart -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-semibold mb-4">Ingresos Mensuales</h3>
            <canvas id="revenueChart"></canvas>
        </div>

        <!-- Student Progress Chart -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-semibold mb-4">Progreso de Estudiantes</h3>
            <canvas id="progressChart"></canvas>
        </div>

    </div>

    <script>
        // Dark Mode Toggle
        function toggleDarkMode() {
            document.body.classList.toggle("dark");
        }

        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio'],
                datasets: [{
                    label: 'Ingresos',
                    data: [2000, 3000, 1500, 5000, 6000, 8000, 7500],
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        color: '#333',
                        grid: {
                            color: '#ddd',
                        }
                    },
                    x: {
                        color: '#333',
                        grid: {
                            color: '#ddd',
                        }
                    }
                }
            }
        });

        // Student Progress Chart
        const progressCtx = document.getElementById('progressChart').getContext('2d');
        new Chart(progressCtx, {
            type: 'pie',
            data: {
                labels: ['Completado', 'En Progreso', 'Pendiente'],
                datasets: [{
                    label: 'Progreso de Estudiantes',
                    data: [40, 30, 30],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(255, 205, 86, 0.6)',
                        'rgba(255, 99, 132, 0.6)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            color: '#333'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
