<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles') }}
        </h2>
        <a href = "records/create" class="btn btn-info"><img src="{{URL::asset('img/plus.png')}}" alt="create"width = "10rem"></a>
       
    </x-slot>

    <div class = "content" style="margin-left : 3rem; margin-right : 3rem">
    @if (!$records->isEmpty())
            <br>
            <div style="background-color: white; display: inline-block;">
            <h1 class="display-8 text-primary mb-4">Paciente: {{$records[0]->patient->name}}</h1>
            <h1 class="display-8 text-success">Medico: {{$records[0]->user->name}}</h1>
        </div>
    @endif
    <table id="records" class = "table table-striped mt-4" style="width: 100%; font-size: 15px;" cellspacing="0">
        <thead>
            <tr>
                <th scope="col">Prediccion</th>
                <th scope="col">Veracidad</th>
                <th scope="col">Comentario</th>
                <th scope="col">Fecha</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $record)
            <tr>
                <td>{{$record->prediccion}}</td>
                <td>{{$record->veracidad}}</td>
                <td>{{$record->comentario}}</td>
                <td>{{$record->date}}</td>
                <td>
                <form action="{{ route('record.destroy_id',$record->id)}}" method = "POST">
                    @csrf

                <a href="/record/{{$record->id}}/edit"class = "btn btn-info">Editar</a>
                <button class = "btn btn-danger">Delete</button>
                </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>