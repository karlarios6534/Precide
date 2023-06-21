<x-app-layout>
    <x-slot name="header">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-5 p-5">
        <div class="flex flex-wrap p-5">
            <div class="w-1/2 md:w-1/4">
                <div class="rounded p-1" style="transition: transform 0.3s ease; background-color:#F2F3F5; width:90%" onmouseover="this.style.transform = 'scale(1.2)';" onmouseout="this.style.transform = 'scale(1)';">
                    Numero de registros en el historial por paciente.
                </div>
                <canvas id="pacientesChart" width="100" height="100"></canvas>
            </div>

            <div class="w-1/2 md:w-1/4 ">
                <div class="rounded p-1" style="transition: transform 0.3s ease; background-color:#F2F3F5; width:90%" onmouseover="this.style.transform = 'scale(1.2)';" onmouseout="this.style.transform = 'scale(1)';">
                    Actividad de medicos registrados con su respectivo numero de historiales registrados.
                </div>
                <canvas id="medicosChart" width="100" height="100"></canvas>
            </div>

            <div class="w-1/2 md:w-1/4">
                <div class="rounded p-1" style="transition: transform 0.3s ease; background-color:#F2F3F5; width:90%" onmouseover="this.style.transform = 'scale(1.2)';" onmouseout="this.style.transform = 'scale(1)';">
                    Cantidad de predicicones benignas contra malignas dentro del historial medico.
                </div>
                <canvas id="prediccionesChart" width="100" height="100"></canvas>
            </div>

            <div class="w-1/2 md:w-1/4">
                <div class="rounded p-1" style="transition: transform 0.3s ease; background-color:#F2F3F5; width:90%" onmouseover="this.style.transform = 'scale(1.2)';" onmouseout="this.style.transform = 'scale(1)';">
                    Fechas con mayor numero de actividad, registro en el historial.
                </div>
                <canvas id="recordsChart" width="100" height="100"></canvas>
            </div>
        </div>
    </div>
</div>

    <script>
        var pacientesChart = document.getElementById('pacientesChart').getContext('2d');
        var medicosChart = document.getElementById('medicosChart').getContext('2d');
        var prediccionesChart = document.getElementById('prediccionesChart').getContext('2d');
        var recordsChart = document.getElementById('recordsChart').getContext('2d');

        // Obtener los datos de pacientes y médicos desde el controlador
        var pacientesData = {!! json_encode($pacientesData) !!};
        var medicosData = {!! json_encode($medicosData) !!};
        var prediccionesData = {!! json_encode($prediccionesData) !!};
        var recordsData = {!! json_encode($recordsData) !!};

        // Crear gráfico de pacientes
        new Chart(pacientesChart, {
            type: 'bar',
            data: {
                labels: pacientesData.labels,
                datasets: [{
                    label: 'Registros por paciente',
                    data: pacientesData.values,
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

        // Crear gráfico de médicos
        new Chart(medicosChart, {
            type: 'bar',
            data: {
                labels: medicosData.labels,
                datasets: [{
                    label: 'Registros por medico',
                    data: medicosData.values,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
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

        new Chart(prediccionesChart, {
            type: 'doughnut',
            data: {
                labels: prediccionesData.labels,
                datasets: [{
                    label: 'Registros por categoria',
                    data: prediccionesData.values,
                    backgroundColor: ['rgba(185, 255, 0, 0.2)', 'rgba(240, 0, 0, 0.2)'],
                    borderColor: ['rgba(69, 95, 0, 1)', 'rgba(185, 14, 14, 1)'],
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

        // Crear gráfico de médicos
        new Chart(recordsChart, {
            type: 'line',
            data: {
                labels: recordsData.labels,
                datasets: [{
                    label: 'Registros por fecha',
                    data: recordsData.values,
                    backgroundColor: 'rgba(240, 148, 7, 0.2)',
                    borderColor: 'rgba(247, 90, 0, 1)',
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
    </script>   
</x-app-layout>

