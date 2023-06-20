<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="content" style="margin-left: 3rem; margin-right: 3rem">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Gráfica de Médicos</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="doctorsChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Gráfica de Pacientes</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="patientsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ScriptJS para cargar los datos y crear las gráficas -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Obtener datos de los médicos
            var usersData = {!! json_encode($usersData) !!};

            // Configurar gráfica de médicos
            var doctorsChart = new Chart(document.getElementById('doctorsChart'), {
                type: 'bar',
                data: {
                    labels: usersData.labels,
                    datasets: [{
                        label: 'Cantidad de Médicos',
                        data: usersData.values,
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            precision: 0
                        }
                    }
                }
            });

            // Obtener datos de los pacientes
            var patientsData = {!! json_encode($patientsData) !!};

            // Configurar gráfica de pacientes
            var patientsChart = new Chart(document.getElementById('patientsChart'), {
                type: 'pie',
                data: {
                    labels: patientsData.labels,
                    datasets: [{
                        data: patientsData.values,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 206, 86, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(153, 102, 255, 0.5)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true
                }
            });
        });
    </script>
</x-app-layout>

