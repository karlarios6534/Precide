<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('records') }}
        </h2>  
    </x-slot>
    <div class = "content" style="margin-left : 4rem; margin-right : 30rem " >
    <form action="/record/{{$record->id}}" method="POST">
        @csrf
        @method('PUT')
    <div class = "mb-3">
        <label for="" class = "form-label">Prediccion</label>
        <input id="prediccion" name="prediccion" class="form-control" tabindex="2" type="text" value="{{$record->prediccion}}" readonly>
    </div>
    <div class = "mb-3">
        <label for="" class = "form-label">Veracidad</label>
        <input id="veracidad" name="veracidad" class="form-control" tabindex="3" type="text" value="{{$record->veracidad}}" readonly>
    <div class = "mb-3">
        <label for="" class = "form-label">Comentario</label>
        <input id="comentario" name="comentario" class="form-control" tabindex="3" type="text" value="{{$record->comentario}}">
    </div>
    <div class = "mb-3">
        <label for="" class = "form-label">Fecha</label>
        <input id="fecha" name="fecha" class="form-control" tabindex="3" type="date" value="{{ \Carbon\Carbon::parse($record->fecha)->format('Y-m-d') }}">
    </div>
    <a href="/record" class = "btn btn-secondary" tabindex ="4">Cancel</a>
    <button type="submit" class = "btn btn-primary" tabindex ="5">Save</button>
</form>
</div>
</x-app-layout>