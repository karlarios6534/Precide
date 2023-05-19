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
            @foreach($elements as $index => $elemento)
            <div class="row g-3 align-items-center m-1 ">
                <div class="col-sm-2">
                    <label for="inputPassword6" class="col-form-label">{{$elemento}}</label>
                </div>
                <div class="col-sm-2">
                    <input type="text" name="variable{{$index}}" class="form-control bg-light rounded" aria-describedby="passwordHelpInline">
                </div>
                <div class="col-sm-6">
                    <span id="passwordHelpInline" class="form-text">Descripción</span>
                </div>
            </div>
        @endforeach
            </div>
        </div>
        <button type="submit" class = "btn btn-primary" tabindex ="5">Save</button>
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

        // Obtener solo los valores del objeto formData y unirlos en una cadena separada por comas
        var valuesString = Object.values(formData).join(',');

        // Crear una solicitud HTTP POST
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/api/ans', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // Enviar los valores como una cadena en el cuerpo de la solicitud
        xhr.send(valuesString);
    }
</script>









    </div>
</x-app-layout>