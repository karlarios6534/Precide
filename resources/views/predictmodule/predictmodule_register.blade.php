<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Predict') }}
        </h2>
    </x-slot>

    <div class="py-12 d-flex justify-content-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <form id="myForm" action="{{ route('apiregister')}}" method="POST">
            @csrf
            <div class="row g-3 align-items-center m-1">

                <div class="col-sm-6 m-4" style="background-color:#F2F3F5; border-radius: 10px; width:80%">
                <div class="col-sm-3">
                <label for="inputPassword6" class="col-form-label">Resultado</label>
                </div>
                <div class="col-sm-5 d-flex align-items-center">
                    <input type="text" name="resultado" class="form-control bg-light rounded" value="{{$resultado}}" aria-describedby="passwordHelpInline" readonly>
                </div>
                </div>
                
                <div class="col-sm-6 m-4" style="background-color:#F2F3F5; border-radius: 10px; width:80%">
                <div class="col-sm-3">
                <label for="inputPassword6" class="col-form-label">Porcentaje veracidad</label>
                </div>
                <div class="col-sm-5 d-flex align-items-center">
                    <input type="text" name="porcentaje" class="form-control bg-light rounded" value="{{$porcentaje}}" aria-describedby="passwordHelpInline" readonly>
                </div>
                </div>

                <div class="col-sm-6 m-4" style="background-color:#F2F3F5; border-radius: 10px; width:80%">
                <div class="col-sm-3">
                <label for="inputPassword6" class="col-form-label">Comentarios</label>
                </div>
                <div class="col-sm-15 d-flex align-items-center">
                    <input style="height:10rem" type="text" name="comentario" pattern="^[a-zA-Z0-9]{1,190}$" class="form-control bg-light rounded" aria-describedby="passwordHelpInline">
                </div>
                </div>

                <div class="col-sm-6 m-4" style="background-color:#F2F3F5; border-radius: 10px; width:80%">
                <select name="patient" id="patient" class="form-select" > 
                    <option value="">Selecciona paciente</option>
                    @foreach ($patients as $patient)
                        <option value="{{ $patient->id }}">{{ $patient->id }} {{ $patient->name }}</option>
                    @endforeach
                </select>
                </div>
                
                <input style="height:1rem; background-color: transparent; border: none; color: transparent;" type="text" name="user" value="{{ Auth::user()->id }}" class="form-control bg-light rounded" aria-describedby="passwordHelpInline">
                <button type="submit" class = "btn btn-primary " tabindex ="5" style="background-color: #DE4980; border-color: #DE4980; width:10%">Guardar</button>
            </div>
        </div>
    </div>
</x-app-layout>