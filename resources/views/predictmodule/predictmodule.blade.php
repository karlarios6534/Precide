<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Modulo machine learning') }}
        </h2>
        @if (session('error'))
            <p style="width:50%;background-color: #f8d7da; color: #721c24; padding: 10px; border: 1px solid #f5c6cb; border-radius: 4px; margin-bottom: 10px;">
                {{ session('error') }}
            </p>
        @endif

    </x-slot>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-5">
            <table>
            <thead>
                <tr>
                    <td></td>
                </tr>
            </thead>
            <tr>
                <td>
            <form id="myForm" action="{{ route('apians')}}" method="POST">
            @csrf
            <div class="row g-3 align-items-center m-1" style="width: 200%;">
                <div class="d-flex flex-wrap">
                    @foreach ($elements as $index => $element)
                        <div class="col-sm-6 m-4" style="background-color:#F2F3F5; border-radius: 10px;">
                            @foreach ($element as $key => $value)
                            <div class="row g-3 align-items-center m-1">
                                <div class="col-sm-3">
                                    <label for="inputPassword6" class="col-form-label">{{$key}}</label>
                                </div>
                                <div class="col-sm-5 d-flex align-items-center">
                                    <input type="text"  pattern="[0-9.]{1,10}" name="variable{{$key}}"  class="form-control bg-light rounded" aria-describedby="passwordHelpInline" required>
                                    <button type="button" class="btn btn-primary btn-sm ml-3" style="background-color: #DE4980; border-color: #DE4980;" data-toggle="popover" title="{{$value}}">
                                        <i class="bi bi-question-circle-fill"></i>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </td>
        <td style="vertical-align: top; padding: 50px;">            
                    <div class="card" style="width: 20rem;">
                    <a href="https://www.elsevier.es/es-revista-gaceta-mexicana-oncologia-305-articulo-biopsia-aspiracion-con-aguja-fina-X1665920112544861" target="_blank">
                    <img src="assets/img/celulas_BAAF.png" class="card-img-top" alt="BAAF analisis de celulas.">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title"><strong>Células extraidas de masas mamarias</strong></h5>
                        <p class="card-text" style="text-align: justify;">Las imágenes digitales de aspiraciones con aguja 
                            fina (FNA) de masas mamarias 
                            son registros médicos obtenidos mediante la biopsia por aspiración. Utilizando una aguja delgada,
                            se extraen células de masas sospechosas en la mama, que se examinan bajo un microscopio. 
                            Estas imágenes digitales ofrecen una visión detallada de las células, permitiendo un análisis y
                            diagnóstico preciso. Al observar características como tamaño, forma y organización celular, 
                            se pueden identificar indicios de benignidad o malignidad. Estas imágenes son cruciales en la 
                            evaluación y seguimiento del cáncer de mama, complementando otras pruebas clínicas y análisis
                            para una toma de decisiones informada.</p>
                    </div>
                    </div>
                </td>
        </tr>
        <tfoot>
            <tr>
                <td colspan="2">
                <div class="text-center">
        <button type="submit" class = "btn btn-primary " tabindex ="5" style="background-color: #DE4980; border-color: #DE4980;">Iniciar</button>
                </td>
            </tr>
        </tfoot>
        </table>
        </form>
    </div>    
</div>

    <!-- Inicializar los tooltips utilizando JavaScript -->
    <script>
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
    });
    </script>  
    <script>
function submitForm() {
    var formData = {};

    // Obtener todos los campos del formulario
    var formFields = document.getElementById('myForm').querySelectorAll('input');

    // Iterar sobre los campos y agregar los valores al objeto formData
    formFields.forEach(function(field) {
        formData[field.name] = field.value;
    });

    // Convertir los datos en un objeto JSON
    var jsonData = JSON.stringify(formData);

    // Crear una solicitud HTTP POST
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "{{ route('apians')}}", true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    // Enviar los datos como un objeto JSON en el cuerpo de la solicitud
    xhr.send(jsonData);
}

</script>

    </div>
</x-app-layout>