<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Historial') }}
        </h2>
        <a href = "records/create" class="btn btn-info"><img src="{{URL::asset('img/plus.png')}}" alt="create"width = "10rem"></a>
       
    </x-slot>

    <div class = "content" style="margin-left : 3rem; margin-right : 3rem">
    <table id="records" class = "table table-striped mt-4" style="width: 100%; font-size: 14px;" cellspacing="0">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Paciente</th>
                <th scope="col">Doctor</th>
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
                <td>{{$record->id}}</td>
                <td>{{$record->patient->name}}</td>
                <td>{{$record->user->name}}</td>
                <td>{{$record->prediccion}}</td>
                <td>{{$record->veracidad}}</td>
                <td>{{$record->comentario}}</td>
                <td>{{$record->date}}</td>
                <td>
                <form action="{{ route('record.destroy',$record->id)}}" method = "POST">
                    @csrf
                    @method('DELETE')
                <a href="/record/{{$record->id}}/edit"class = "btn btn-info">Edit</a>
                <button class = "btn btn-danger">Delete</button>
                </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- ScriptJS to use datatables properties -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
<!-- ScriptJS to use datatables buttons properties -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>
<!--ScriptJS to use iconns from fontawesome-->
<script src="https://kit.fontawesome.com/0395bf88e1.js" crossorigin="anonymous"></script>
<!--ScriptJS to make datatable-->
<script>
$(document).ready(function () {
    $('#records').DataTable({
        "lengthMenu" : [[5,10,50,-1],[5,10,50,"All"]],
        "responsive" : "true",
        "dom" : 'Bfrtilp',
        "buttons" : [
            {
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel "></i>',
                titleAttr: 'Export to excel'
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i>',
                titleAttr: 'Export to pdf'
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print" ></i>',
                titleAttr: 'Print'
            }
            
        ]
    });
});
</script>

</x-app-layout>