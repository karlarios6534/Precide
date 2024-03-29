<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pacientes') }}
        </h2>  
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-5">
            <div class="content" style="margin-left: 25%; margin-right: 25%">
                <form action="/patients/{{$patient->id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class = "mb-3">
                        <label for="" class = "form-label">Nombre</label>
                        <input id="name" name="name" pattern="^[A-Za-zñÑ\s]{1,190}$" class="form-control bg-light rounded" tabindex="2" type="text" value="{{$patient->name}}" required>
                    </div>
                    <div class = "mb-3">
                        <label for="" class = "form-label">Fecha de nacimiento</label>
                        <input id="birth_date" name="birth_date" class="form-control bg-light rounded" tabindex="3" type="date" value="{{$patient->birth_date}}" required>
                    </div>
                    <div class = "mb-3">
                        <label for="" class = "form-label">Direccion</label>
                        <input id="adress" name="adress" pattern="^.{1,99}$" class="form-control bg-light rounded" tabindex="3" type="text" value="{{$patient->adress}}" required>
                    </div>
                    <div class = "mb-3">
                        <label for="" class = "form-label">Telefono</label>
                        <input id="phone" name="phone" pattern="^[\d\s+]{1,15}$" class="form-control bg-light rounded" tabindex="3" type="text" value="{{$patient->phone}}" required>
                    </div>
                    <div class = "mb-3">
                        <label for="" class = "form-label">Email</label>
                        <input id="email" name="email"  pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" class="form-control bg-light rounded" tabindex="3" type="email" value="{{$patient->email}}" required>
                    </div>
                    <div class = "mb-3">
                        <label for="" class = "form-label">Contacto de emergencia</label>
                        <input id="emergency_contact" name="emergency_contact" pattern="^[\d\s+]{1,15}$" class="form-control bg-light rounded" tabindex="3" type="text" value="{{$patient->emergency_contact}}" required>
                    </div>
                    <div class = "mb-3">
                        <label for="" class = "form-label">Alergias</label>
                        <input id="allergies" name="allergies" pattern="^[A-Za-zñÑ\s.,]{1,190}$" class="form-control bg-light rounded"" tabindex="3" type="text" value="{{$patient->allergies}}" required>
                    </div>
                    <div class="text-center">
                    <a href="/patients" class = "btn btn-secondary" tabindex ="4">Cancelar</a>
                    <button type="submit" class = "btn btn-primary" tabindex ="5" style="background-color: #DE4980; border-color: #DE4980;">Guardar</button>
                    </div>     
                </form>
            </div>
        </div> 
    </div>
</x-app-layout>
