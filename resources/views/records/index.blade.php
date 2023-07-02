<x-app-layout>
    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Historial') }}
        </h2>
        <div>
    <button id="exportar-btn">Exportar Dataset <i class="fa-solid fa-download" style="color: #de4980;"></i></button>
    </div>

    </x-slot>
    <div class = "content" style="margin-left : 3rem; margin-right : 3rem">
    <table id="records" class = "table table-striped mt-4" style="width: 100%; font-size: 15px;" cellspacing="0">
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
                <td style="width:10%">
                <form action="{{ route('record.destroy',$record->patient->id)}}" method = "POST">
                    @csrf
                    @method('DELETE')
                <a href="/record/{{$record->patient->id}}/details"class = "btn btn-info"><i class="fa-solid fa-circle-info" style="color: #000000;"></i></a>
                <button class = "btn btn-danger"><i class="fa-solid fa-trash" style="color: #000000;"></i></button>
                </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- ScriptJS to use datatables properties -->
<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
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
    document.getElementById('exportar-btn').addEventListener('click', function() {
    // Obtener los datos de los valores
    const valores = {!! $values !!};

    // Crear el libro de trabajo y la hoja de cálculo
    const workbook = XLSX.utils.book_new();
    const worksheet = XLSX.utils.json_to_sheet(valores);

    // Agregar la hoja de cálculo al libro de trabajo
    XLSX.utils.book_append_sheet(workbook, worksheet, 'Valores');

    // Generar el archivo Excel
    const excelBuffer = XLSX.write(workbook, { bookType: 'xlsx', type: 'array' });

    // Descargar el archivo Excel
    const blob = new Blob([excelBuffer], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
    const fileName = 'valores.xlsx';
    saveAs(blob, fileName);
});

</script>
<script>
$(document).ready(function () {
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
                filename: 'Registros_precide',
                exportOptions: {
                    columns: ':not(:last-child)' // Especifica las columnas que deseas exportar (índices basados en cero)
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i>',
                titleAttr: 'Export to pdf',
                filename: 'Registros_precide',
                exportOptions: {
                    columns: ':not(:last-child)' // Especifica las columnas que deseas exportar (índices basados en cero)
                }
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print" ></i>',
                titleAttr: 'Print',
                filename: 'Registros_precide',
                exportOptions: {
                    columns: ':not(:last-child)' // Especifica las columnas que deseas exportar (índices basados en cero)
                }
            }
            
        ]
    });
});
</script>

</x-app-layout>