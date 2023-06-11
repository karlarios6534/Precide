<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Predict') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <table id="result" class = "table table-striped mt-4 m-5" style="width: 50%; font-size: 16px;" cellspacing="0">
            <tbody>
                <tr>
                    <td style="font-weight: bold;">Resultados obtenidos</td>
                    <td></td>
                </tr>
                <tr>
                <td>Resultado</td>
                <td>{{$result['resultado']}}</td>
                </tr>
                <tr>
                <td>Porcentaje de probabilidad de veracidad</td>
                <td>{{$result['porcentaje']}}</td>
                </tr>
            </tbody>
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
</x-app-layout>