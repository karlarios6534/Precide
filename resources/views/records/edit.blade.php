<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registros') }}
        </h2>  
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-5">
            <div class="content" style="margin-left: 25%; margin-right: 25%">
                <form action="/record/{{$record->id}}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="" class="form-label">Prediccion</label>
                        <input id="prediccion" name="prediccion" class="form-control bg-light rounded" tabindex="2" type="text" value="{{$record->prediccion}}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Veracidad</label>
                        <input id="veracidad" name="veracidad" class="form-control bg-light rounded" tabindex="3" type="text" value="{{$record->veracidad}}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Comentario</label>
                        <input id="comentario" name="comentario" pattern="^[a-zA-Z0-9]{1,190}$" class="form-control bg-light rounded" tabindex="3" type="text" value="{{$record->comentario}}">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Fecha</label>
                        <input id="fecha" name="fecha" class="form-control bg-light rounded" tabindex="3" type="date" value="{{ \Carbon\Carbon::parse($record->fecha)->format('Y-m-d') }}">
                    </div>

                    <div class="text-center">
                        <a href="/record" class="btn btn-secondary" tabindex="4">Cancel</a>
                        <button type="submit" class="btn btn-primary" tabindex="5" style="background-color: #DE4980; border-color: #DE4980;">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
