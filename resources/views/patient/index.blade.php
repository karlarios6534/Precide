<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Patients') }}
        </h2>
        <a href = "patients/create" class="btn btn-info"><img src="{{URL::asset('img/plus.png')}}" alt="create"width = "10rem"></a>
    </x-slot>
    <div class = "content" style="margin-left : 3rem; margin-right : 3rem " >
    <table class = "table table-success table-striped mt-4">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Code</th>
                <th scope="col">Name</th>
                <th scope="col">Age</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patients as $patient)

            <tr>
                <td>{{$patient->id}}</td>
                <td>{{$patient->code}}</td>
                <td>{{$patient->name}}</td>
                <td>{{$patient->birth_date}}</td>
                <td>
                <form action="{{ route('patients.destroy',$patient->id)}}" method = "POST">
                    @csrf
                    @method('DELETE')
                <a href="/patients/{{$patient->id}}/edit"class = "btn btn-info">Edit</a>
                <button class = "btn btn-danger">Delete</button>
                </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>
