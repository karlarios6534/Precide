<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles') }}
        </h2>
    </x-slot>

    <div class="content" style="margin-left: 3rem; margin-right: 3rem">
        @if (!$records->isEmpty())
        <br>
        <div class=" d-flex flex-wrap">
            <h1 id="patientname" class="card-title mr-3">Páciente: {{ $records[0]->patient->name }}</h1>
            <h2 class="card-tittle mr-3">Médico(s): </h2>
            @php
            $previousName = null;
            @endphp
            @foreach ($records as $record)
            @if ($record->user->name !== $previousName)
                <h1 id="username" class="text-success mr-3">·{{ $record->user->name }}</h1>
                @php
                $previousName = $record->user->name;
                @endphp
            @endif
            @endforeach
        </div>
        @endif

        <table id="records" class="table table-striped mt-4" style="width: 100%; font-size: 15px;" cellspacing="0">
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
                    <td style="width:10%">
                        <form action="{{ route('record.destroy_id',$record->id)}}" method="POST">
                            @csrf
                            <a href="/record/{{$record->id}}/edit" class="btn btn-info"><i class="fa-regular fa-pen-to-square" style="color: #FFFFFF;"></i></a>
                            <button class="btn btn-danger"><i class="fa-solid fa-trash" style="color: #FFFFFF;"></i></button>
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
    var patientName = document.getElementById('patientname').textContent;

    $('#records').DataTable({
        "lengthMenu" : [[5,10,50,-1],[5,10,50,"All"]],
        "responsive" : true,
        "dom" : 'Bfrtilp',
        "searching": true,
        "buttons" : [
            {
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel "></i>',
                titleAttr: 'Export to excel',
                filename: patientName,
                exportOptions: {
                    columns: ':not(:last-child)' // Especifica las columnas que deseas exportar (índices basados en cero)
                },
                init: function(api, node, config) {
                            $(node).removeClass('btn-secondary'); // Elimina la clase CSS predeterminada del botón
                            $(node).addClass('btn-custom'); // Agrega la clase CSS personalizada al botón
                            $(node).css('background-color', '#5bc0de'); // Cambia el color de fondo del botón
                            $(node).css('color', '#ffffff'); // Cambia el color del texto del botón
                            // Agrega otros estilos personalizados según tus necesidades
                            }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i>',
                titleAttr: 'Export to pdf',
                filename: patientName,
                exportOptions: {
                    columns: ':not(:last-child)' // Especifica las columnas que deseas exportar (índices basados en cero)
                },
                init: function(api, node, config) {
                            $(node).removeClass('btn-secondary'); // Elimina la clase CSS predeterminada del botón
                            $(node).addClass('btn-custom'); // Agrega la clase CSS personalizada al botón
                            $(node).css('background-color', '#5bc0de'); // Cambia el color de fondo del botón
                            $(node).css('color', '#ffffff'); // Cambia el color del texto del botón
                            // Agrega otros estilos personalizados según tus necesidades
                            }
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print" ></i>',
                titleAttr: 'Print',
                filename: patientName,
                exportOptions: {
                    columns: ':not(:last-child)' // Especifica las columnas que deseas exportar (índices basados en cero)
                },
                init: function(api, node, config) {
                            $(node).removeClass('btn-secondary'); // Elimina la clase CSS predeterminada del botón
                            $(node).addClass('btn-custom'); // Agrega la clase CSS personalizada al botón
                            $(node).css('background-color', '#5bc0de'); // Cambia el color de fondo del botón
                            $(node).css('color', '#ffffff'); // Cambia el color del texto del botón
                            // Agrega otros estilos personalizados según tus necesidades
                            }
            }
            
        ]
    });
});
</script>

</x-app-layout>
