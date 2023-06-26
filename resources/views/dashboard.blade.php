<x-app-layout>
    <x-slot name="header">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-5 p-5">
    <div class="card radius-10 border-start border-0 border-3 border-info shadow">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div>
                <div>
                    <p class="mb-0 text-secondary">Total de pacientes.</p>
                    <h4 class="my-1 text-info">{{$totalPacientes}}</h4>
                    <p class="mb-0 text-secondary">Total de pacientes registrados esta semana.</p>
                    <p class="mb-0 font-13">{{$pacientesRegistradosSemana}}</p>
                </div>
                <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white">
                    <i class="fa fa-shopping-cart"></i>
                </div>
            </div>
            <div class="ms-auto" style="width:5%">
                <img src="assets/img/logo_pre.png" alt="Imagen" class="img-fluid" >
            </div>
        </div>
    </div>
</div>





        <div class="flex flex-wrap p-5">
            <div class="w-1/2 md:w-1/4">
                <div class="rounded p-1 m-2" style="transition: transform 0.3s ease; background-color:#F2F3F5; width:90%" onmouseover="this.style.transform = 'scale(1.2)';" onmouseout="this.style.transform = 'scale(1)';">
                    Numero de registros en el historial por paciente.
                </div>
                <canvas id="pacientesChart" width="100" height="100"></canvas>
            </div>

            <div class="w-1/2 md:w-1/4 ">
                <div class="rounded p-1 m-2" style="transition: transform 0.3s ease; background-color:#F2F3F5; width:90%" onmouseover="this.style.transform = 'scale(1.2)';" onmouseout="this.style.transform = 'scale(1)';">
                    Actividad de medicos registrados con su respectivo numero de historiales registrados.
                </div>
                <canvas id="medicosChart" width="100" height="100"></canvas>
            </div>

            <div class="w-1/2 md:w-1/4">
                <div class="rounded p-1 m-2" style="transition: transform 0.3s ease; background-color:#F2F3F5; width:90%" onmouseover="this.style.transform = 'scale(1.2)';" onmouseout="this.style.transform = 'scale(1)';">
                    Cantidad de predicicones benignas contra malignas dentro del historial medico.
                </div>
                <canvas id="prediccionesChart" width="100" height="100"></canvas>
            </div>

            <div class="w-1/2 md:w-1/4">
                <div class="rounded p-1 m-2" style="transition: transform 0.3s ease; background-color:#F2F3F5; width:90%" onmouseover="this.style.transform = 'scale(1.2)';" onmouseout="this.style.transform = 'scale(1)';">
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
                    borderWidth: 2,
                    borderRadius: 10, // Agrega esquinas redondeadas a las barras
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false, // Oculta las líneas de la cuadrícula del eje y
                        },
                        ticks: {
                            font: {
                                weight: 'bold', // Establece el peso de la fuente de las etiquetas del eje y a negrita
                            },
                        },
                    },
                    x: {
                        grid: {
                            display: false, // Oculta las líneas de la cuadrícula del eje x
                        },
                    },
                },
                plugins: {
                    legend: {
                        display: false, // Oculta la leyenda
                    },
                },
            },
        });


        // Crear gráfico de médicos
        new Chart(medicosChart, {
            type: 'bar',
            data: {
                labels: medicosData.labels,
                datasets: [{
                    label: 'Registros por médico',
                    data: medicosData.values,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    borderRadius: 5, // Agrega esquinas redondeadas a las barras
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false, // Oculta las líneas de la cuadrícula del eje y
                        },
                        ticks: {
                            font: {
                                weight: 'bold', // Establece el peso de la fuente de las etiquetas del eje y a negrita
                            },
                        },
                    },
                    x: {
                        grid: {
                            display: false, // Oculta las líneas de la cuadrícula del eje x
                        },
                    },
                },
                plugins: {
                    legend: {
                        display: false, // Oculta la leyenda
                    },
                },
            },
        });

        new Chart(prediccionesChart, {
            type: 'pie',
            data: {
                labels: prediccionesData.labels,
                datasets: [{
                    label: 'Registros por categoría',
                    data: prediccionesData.values,
                    backgroundColor: [
                        'rgba(185, 255, 0, 0.6)',
                        'rgba(240, 0, 0, 0.6)'
                    ],
                    borderColor: [
                        'rgba(69, 95, 0, 1)',
                        'rgba(185, 14, 14, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom', // Posición de la leyenda (abajo)
                        labels: {
                            font: {
                                weight: 'bold', // Establece el peso de la fuente de las etiquetas de la leyenda a negrita
                                size: 14 // Tamaño de la fuente de las etiquetas de la leyenda
                            }
                        }
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
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(255, 255, 255, 1)', // Color de fondo de los puntos
                    pointBorderColor: 'rgba(247, 90, 0, 1)', // Color del borde de los puntos
                    pointBorderWidth: 2,
                    pointRadius: 4 // Radio de los puntos
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false // Ocultar la leyenda
                    }
                },
                elements: {
                    line: {
                        tension: 0.4 // Curva de tensión de la línea
                    }
                }
            }
        });

    </script>   
</x-app-layout>

