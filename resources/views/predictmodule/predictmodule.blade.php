<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Predict') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <form id="myForm" action="/api/ans" method="POST">

            @csrf
            @foreach ($elements as $clave => $valor)
            <div class="row g-3 align-items-center m-1 ">
                <div class="col-sm-2">
                    <label for="inputPassword6" class="col-form-label">{{$clave}}</label>
                </div>
                <div class="col-sm-2">
                    <input type="text" name="variable{{$clave}}" class="form-control bg-light rounded" aria-describedby="passwordHelpInline" required>
                </div>
                <div class="col-sm-6">
                    <span  class="form-text">{{$valor}}</span>
                </div>
            </div>
        @endforeach
</select>
        <div class="text-center">
        <button type="submit" class = "btn btn-primary " tabindex ="5" style="background-color: #DE4980;">Iniciar</button>
</div>    
    </div>
        </div>
    </form>
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
    xhr.open('POST', '/api/ans', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    // Enviar los datos como un objeto JSON en el cuerpo de la solicitud
    xhr.send(jsonData);
}

</script>











    </div>
</x-app-layout>