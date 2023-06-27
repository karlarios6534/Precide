<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Predict') }}
        </h2>
    </x-slot>

    <div class="py-12 d-flex justify-content-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

            @php
                $band = '';
                if (isset($result['resultado'])) {
                    $resultado = $result['resultado'];
                } else {
                    $resultado = 'Resultado no encontrado (Api fail)';
                    $band='Error';
                }

                if (isset($result['porcentaje'])) {
                    $porcentaje = $result['porcentaje'];
                } else {
                    $porcentaje = 'Porcentaje no encontrado (Api fail)';
                    $band='Error';
                }
            @endphp

            <form method="POST" action="{{ route('regitrores') }}">
            @csrf
            <table id="result" class = "table table-striped mt-4 m-5" style="width: 50%; font-size: 16px;" cellspacing="0">
            <tbody>
                <tr>
                    <td style="font-weight: bold;">Resultados obtenidos</td>
                    <td></td>
                </tr>
                <tr>
                <td>Resultado</td>
                <td id="resultado">
                    <input style="  background-color: transparent;
                                    border: none;
                                    outline: none;
                                    pointer-events: none;"
                    type="text" name="resultado" value="{{$resultado}}" readonly>
                </td>
                </tr>
                <tr>
                <td>Porcentaje de probabilidad de veracidad</td>
                <td id="porcentaje">
                <input style="  background-color: transparent;
                                    border: none;
                                    outline: none;
                                    pointer-events: none;"
                    type="text" name="porcentaje" value="{{$porcentaje}}" readonly>
                </td>
                </tr>
            </tbody>
            <tfoot>
            <!-- Resto de los campos del formulario -->
            <tr>
                <td colspan="2"><button id="miBoton" action="{{ route('regitrores') }}" type="submit" method="POST" class = "btn btn-primary " tabindex ="5" style="background-color: #DE4980; border-color: #DE4980;">Asociar resultados a paciente</button></td>
            </tr>
            </form>

            </tfoot>
            </table>  
            <div class="row">
  <div class="col-sm-6 m-5">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Acerca del resultado</h5>
        <p class="card-text">
            La regresión logística es un método estadístico utilizado para predecir la probabilidad de eventos
            binarios, como diagnósticos médicos. Aunque es útil en predicciones médicas, no debe considerarse
            la verdad absoluta. Utiliza variables para estimar la probabilidad de un resultado específico, 
            pero tiene limitaciones y no refleja completamente la individualidad de cada paciente. 
            Se debe interpretar y utilizar con el juicio clínico adecuado, considerando otros factores clínicos.
            Es una herramienta valiosa, pero su interpretación debe ser cuidadosa y siempre respaldada por 
            conocimiento médico. La regresión logística es un complemento útil, pero no debe ser la única base 
            para la toma de decisiones médicas.</p>
        <a href="https://www.kaggle.com/datasets/uciml/breast-cancer-wisconsin-data?resource=download" class="btn btn-primary" target="_blank" style="background-color: #DE4980; border-color: #DE4980;">Ir al dataset</a>
      </div>
    </div>
  </div> 
</div>
        </div>
    </div>
    <script>
        var resultado = '<?php echo $band; ?>'; // Obtener el valor de la variable PHP en JavaScript

        // Verificar si la variable es null y deshabilitar el botón si es el caso
        if (resultado === 'Error') {
            document.getElementById("miBoton").disabled = true;
        }
    </script>
    <script>
function submitForm() {
    var resultado = document.getElementById('resultado').value;
    var porcentaje = document.getElementById('porcentaje').value;

    var objeto = {
        'resultado': resultado,
        'porcentaje': porcentaje
    };

    // Convertir los datos en un objeto JSON
    var jsonData = JSON.stringify(objeto);

    // Crear una solicitud HTTP POST
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "{{ route('regitrores') }}", true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(jsonData);
}


</script>
</x-app-layout>